<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use ReflectionClass;
use ReflectionMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Relations\Relation;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected ?Company $company;
    
    public function __construct(Request $request)
    {
        if ($request->hasHeader('x-api-key')) {
            $this->company = Company::where('licence', env('LICENCE_KEY'))->first();
        }
        if (!isset($this->company) && Auth::user()) {
            $user = User::find(Auth::user()->id);
            /**
             *
             * @var \App\Models\Company
             */
            $this->company = Company::find($user->company_id);
        }
        if (!isset($this->company)) {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR, 'Invalid request sent: License Id does not match any record');
        }
    }

    public function getFilteredQuery(Builder $query, $filterItems): Builder
    {
        $includeOrQuery = filter_var(request()->query('_orQuery'), FILTER_VALIDATE_BOOLEAN);
        if ($includeOrQuery===true) {
            $values = [];
            $valColumn = '';
            foreach ($filterItems as $filterItem) {
                if (isset($filterItem[0]) && isset($filterItem[1]) && isset($filterItem[2])) {
                    $valColumn = $filterItem[0];
                    $_tmps = explode("||", $filterItem[2]);
                    foreach ($_tmps as $_tmp) {
                        $values[] = $_tmp;
                    }
                }
            }
            $query = $query->whereIn($valColumn, $values);
        } else {
            $query = $query->where($filterItems);
        }
        return $query;
    }

    public function filterIncludes(): array{
        $includes = request()->query('_includes');
        if ($includes) {
            $includesParam = trim($includes, "[] '\"`");
            if (!empty($includesParam)) {
                $includes = explode(',', $includesParam);
                $includes = array_map('trim', $includes);
                if (empty($includes)) {
                    $includes = [];
                }
                return $includes;
            }
        }
        return [];
    }

    public function runQuery(Builder $query, Model $model, bool|array $autoAdd = false, bool $filterCompany = false): LengthAwarePaginator
    {
        if ($autoAdd) {
            if($autoAdd === true) {
                $query = $query->with($this->getRelationships($model));
            }else if(is_array($autoAdd)) {
                $query = $query->with($autoAdd);
            }
        } else {
            $includes = request()->query('_includes');
            if ($includes) {
                $includesParam = trim($includes, "[] '\"`");
                if (!empty($includesParam)) {
                    $includes = explode(',', $includesParam);
                    $includes = array_map('trim', $includes);
                    $includes = array_intersect($includes, $this->getRelationships($model));
                    if (empty($includes)) {
                        $includes = [];
                    }
                    $query = $query->with($includes);
                }
            }
        }


        $includeAll = filter_var(request()->query('_all'), FILTER_VALIDATE_BOOLEAN);
        if ($includeAll) {
            $results = $query->latest()->get();
            return new \Illuminate\Pagination\LengthAwarePaginator($results, $results->count(), $results->count(), 1);
        } else {
            $query = $query->latest()->paginate(100)->appends(request()->query());
            return $query;
        }
    }

    public function loadModelData(Model $model, bool|array $autoAdd = false): Model
    {
        if($autoAdd) {
            $model = $model->load(is_array($autoAdd) ? $autoAdd : $this->getRelationships($model));
            return $model;
        }
        $includes = request()->query('_includes');
        if ($includes) {
            $includesParam = trim($includes, "[] '\"`");
            if (!empty($includesParam)) {
                $includes = explode(',', $includesParam);
                $includes = array_map('trim', $includes);
                $includes = array_intersect($includes, $this->getRelationships($model));
                if (empty($includes)) {
                    $includes = [];
                }
                $model = $model->load($includes);
            }
        }
        return $model;
    }

    public function getResponse(LengthAwarePaginator $query, AnonymousResourceCollection $collection): array
    {
        $includeAll = filter_var(request()->query('_all'), FILTER_VALIDATE_BOOLEAN);
        $response = ['data' => $collection];
        if (!$includeAll) {
            $response['pagination'] = [
                'total' => $query->total(),
                'per_page' => $query->perPage(),
                'current_page' => $query->currentPage(),
                'last_page' => $query->lastPage(),
                'from' => $query->firstItem(),
                'to' => $query->lastItem(),
                'next_page_url' => $query->nextPageUrl(),
                'previous_page_url' => $query->previousPageUrl(),
            ];
        }
        return $response;
    }

    public function getRelationships(Model $model)
    {
        $relations = [];
        $methods = (new ReflectionClass($model))->getMethods(ReflectionMethod::IS_PUBLIC);

        foreach ($methods as $method) {
            // Check if the method belongs to the model class and has no parameters
            if ($method->class === get_class($model) && $method->getNumberOfParameters() === 0) {
                $returnType = $method->getReturnType();
                if ($returnType && is_subclass_of($returnType->getName(), Relation::class)) {
                    $relations[] = $method->getName();
                }
            }
        }

        return $relations;
    }

    public function validate(FormRequest $request, array $data, string $method = 'POST') : array
    {
        $request->merge($data);
        $request->setMethod($method);

        return $request->validate($request->rules(), $request->messages());
    }

    public function encryptString($plaintext) {
        $appKey = getenv('APP_KEY');
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $ciphertext = openssl_encrypt($plaintext, 'aes-256-cbc', $appKey, 0, $iv);
        return base64_encode($iv . $ciphertext);
    }
    
    public function decryptString($encrypted) {
        $appKey = getenv('APP_KEY');
        $data = base64_decode($encrypted);
        $iv_length = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($data, 0, $iv_length);
        $ciphertext = substr($data, $iv_length);
        return openssl_decrypt($ciphertext, 'aes-256-cbc', $appKey, 0, $iv);
    }
}

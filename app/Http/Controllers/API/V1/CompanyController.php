<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\CompanyFilter;
use App\Helpers\V1\ApiResponse;
use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CompanyRequest;
use App\Http\Resources\V1\CompanyResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        Gate::authorize("viewAny", Company::class);
        $query = Company::query();
        $query = $this->getFilteredQuery($query, (new CompanyFilter())->transform(request()));
        $query = $this->runQuery($query, new Company());
        $response = $this->getResponse($query, CompanyResource::collection($query));
        return ApiResponse::success($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        //
        Gate::authorize("create", Company::class);
        $validated = $request->validated();
        $validated['licence'] = $this->encryptString(env('API_KEY'));
        $record = Company::create($validated);
        return ApiResponse::success(new CompanyResource($this->loadModelData($record)), 'Company created successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
        Gate::authorize("view", $company);
        return ApiResponse::success(new CompanyResource($this->loadModelData($company)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
        //
        Gate::authorize("update", $company);
        $validated = $request->validated();
        $company->update($validated);
        return ApiResponse::success(new CompanyResource($this->loadModelData($company)), 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
        Gate::authorize("delete", $company);
        $company->delete();
        return ApiResponse::success(null, 'Company deleted successfully');
    }
}

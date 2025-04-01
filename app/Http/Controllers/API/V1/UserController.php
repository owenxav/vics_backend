<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\UserFilter;
use App\Helpers\V1\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UserRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    //
    public function index()
    {
        //
        Gate::authorize("viewAny", User::class);
        $query = User::query();
        $query = $this->getFilteredQuery($query, (new UserFilter())->transform(request()));
        $query = $this->runQuery($query, new User(), true);
        $response = $this->getResponse($query, UserResource::collection($query));
        return ApiResponse::success($response);
    }

    public function store(UserRequest $request)
    {
        //
        Gate::authorize("create", User::class);
        $validated = $request->validated();
        $validated['company_id'] = $this->company->id;
        $record = User::create($validated);
        return ApiResponse::success(new UserResource($this->loadModelData($record)), 'User created successfully', Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        //
        Gate::authorize("view", $user);
        return ApiResponse::success(new UserResource($this->loadModelData($user)));
    }

    public function update(UserRequest $request, User $user)
    {
        //
        Gate::authorize("update", $user);
        $validated = $request->validated();
        $validated['last_updated_id'] = Auth::id();
        $user->update($validated);
        return ApiResponse::success(new UserResource($this->loadModelData($user)), 'User updated successfully');
    }

    public function destroy(User $user)
    {
        //
        Gate::authorize("delete", $user);
        $user->delete();
        return ApiResponse::success(null, 'User deleted successfully');
    }
}

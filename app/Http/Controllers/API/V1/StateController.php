<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\StateFilter;
use App\Helpers\V1\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StateRequest;
use App\Http\Resources\V1\StateResource;
use App\Models\State;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        Gate::authorize("viewAny", State::class);
        $query = State::query();
        $query = $this->getFilteredQuery($query, (new StateFilter())->transform(request()));
        $query = $this->runQuery($query, new State());
        $response = $this->getResponse($query, StateResource::collection($query));
        return ApiResponse::success($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StateRequest $request)
    {
        //
        Gate::authorize("create", State::class);
        $validated = $request->validated();
        $record = State::create($validated);
        return ApiResponse::success(new StateResource($this->loadModelData($record)), 'State created successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(State $state)
    {
        //
        Gate::authorize("view", $state);
        return ApiResponse::success(new StateResource($this->loadModelData($state)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StateRequest $request, State $state)
    {
        //
        Gate::authorize("update", $state);
        $validated = $request->validated();
        $state->update($validated);
        return ApiResponse::success(new StateResource($this->loadModelData($state)), 'State updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        //
        Gate::authorize("delete", $state);
        $state->delete();
        return ApiResponse::success(null, 'State deleted successfully');
    }
}

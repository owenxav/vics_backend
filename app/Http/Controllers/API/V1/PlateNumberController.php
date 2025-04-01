<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\PlateNumberFilter;
use App\Helpers\V1\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\PlateNumberRequest;
use App\Http\Resources\V1\PlateNumberResource;
use App\Models\PlateNumber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PlateNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize("viewAny", PlateNumber::class);
        $query = PlateNumber::query();
        $query = $this->getFilteredQuery($query, (new PlateNumberFilter())->transform(request()));
        $query = $this->runQuery($query, new PlateNumber(), true);
        $response = $this->getResponse($query, PlateNumberResource::collection($query));
        return ApiResponse::success($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlateNumberRequest $request)
    {
        Gate::authorize("create", PlateNumber::class);
        $validated = $request->validated();
        $validated['company_id'] = $this->company->id;
        $validated['creator_id'] = Auth::id();
        $record = PlateNumber::create($validated);
        return ApiResponse::success(new PlateNumberResource($this->loadModelData($record)), 'Plate Number created successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(PlateNumber $plateNumber)
    {
        Gate::authorize("view", $plateNumber);
        return ApiResponse::success(new PlateNumberResource($this->loadModelData($plateNumber)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlateNumberRequest $request, PlateNumber $plateNumber)
    {
        Gate::authorize("update", $plateNumber);
        $validated = $request->validated();
        $validated['last_updated_id'] = Auth::id();
        $plateNumber->update($validated);
        return ApiResponse::success(new PlateNumberResource($this->loadModelData($plateNumber)), 'Plate Number updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlateNumber $plateNumber)
    {
        Gate::authorize("delete", $plateNumber);
        $plateNumber->delete();
        return ApiResponse::success(null, 'Plate Number Order deleted successfully');
    }
}

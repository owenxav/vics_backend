<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\PlateNumberOrderFilter;
use App\Helpers\V1\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\PlateNumberOrderRequest;
use App\Http\Resources\V1\PlateNumberOrderResource;
use App\Models\PlateNumberOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PlateNumberOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize("viewAny", PlateNumberOrder::class);
        $query = PlateNumberOrder::query();
        $query = $this->getFilteredQuery($query, (new PlateNumberOrderFilter())->transform(request()));
        $query = $this->runQuery($query, new PlateNumberOrder(), true);
        $response = $this->getResponse($query, PlateNumberOrderResource::collection($query));
        return ApiResponse::success($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlateNumberOrderRequest $request)
    {
        Gate::authorize("create", PlateNumberOrder::class);
        $validated = $request->validated();
        $validated['company_id'] = $this->company->id;
        $validated['creator_id'] = Auth::id();
        $record = PlateNumberOrder::create($validated);
        return ApiResponse::success(new PlateNumberOrderResource($this->loadModelData($record)), 'Plate Number Order created successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(PlateNumberOrder $plateNumberOrder)
    {
        Gate::authorize("view", $plateNumberOrder);
        return ApiResponse::success(new PlateNumberOrderResource($this->loadModelData($plateNumberOrder)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlateNumberOrderRequest $request, PlateNumberOrder $plateNumberOrder)
    {
        Gate::authorize("update", $plateNumberOrder);
        $validated = $request->validated();
        $validated['last_updated_id'] = Auth::id();
        $plateNumberOrder->update($validated);
        return ApiResponse::success(new PlateNumberOrderResource($this->loadModelData($plateNumberOrder)), 'Plate Number Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlateNumberOrder $plateNumberOrder)
    {
        Gate::authorize("delete", $plateNumberOrder);
        $plateNumberOrder->delete();
        return ApiResponse::success(null, 'Plate Number Order deleted successfully');
    }
}

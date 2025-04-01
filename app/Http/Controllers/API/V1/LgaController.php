<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\LgaFilter;
use App\Helpers\V1\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LgaRequest;
use App\Http\Resources\V1\LgaResource;
use App\Http\Resources\V1\StateResource;
use App\Models\Lga;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class LgaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        Gate::authorize("viewAny", Lga::class);
        $query = Lga::query();
        $query = $this->getFilteredQuery($query, (new LgaFilter())->transform(request()));
        $query = $this->runQuery($query, new Lga());
        $response = $this->getResponse($query, LgaResource::collection($query));
        return ApiResponse::success($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LgaRequest $request)
    {
        //
        Gate::authorize("create", Lga::class);
        $validated = $request->validated();
        $record = Lga::create($validated);
        return ApiResponse::success(new LgaResource($this->loadModelData($record)), 'Lga created successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lga $lga)
    {
        //
        Gate::authorize("view", $lga);
        return ApiResponse::success(new StateResource($this->loadModelData($lga)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LgaRequest $request, Lga $lga)
    {
        //
        Gate::authorize("update", $lga);
        $validated = $request->validated();
        $lga->update($validated);
        return ApiResponse::success(new LgaResource($this->loadModelData($lga)), 'Lga updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lga $lga)
    {
        //
        Gate::authorize("delete", $lga);
        $lga->delete();
        return ApiResponse::success(null, 'Lga deleted successfully');
    }
}

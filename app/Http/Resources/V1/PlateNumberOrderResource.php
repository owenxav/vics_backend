<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlateNumberOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'creator_id' => $this->creator_id,
            'last_updated_id' => $this->last_updated_id,
            'deactivated_by_id' => $this->deactivated_by_id,
            'state_id' => $this->state_id,
            'invoice_id' => $this->invoice_id,
            'vehicle_id' => $this->vehicle_id,
            
            'type' => $this->type,
            'status' => $this->status,
            'assignment_status' => $this->assignment_status,
            'fancy_plate' => $this->fancy_plate,
            'prefix' => $this->prefix,
            'recommended_number' => $this->recommended_number,
            'total_number_requested' => $this->total_number_requested,
            'tracking_id' => $this->tracking_id,
            'workflow_approval_status' => $this->workflow_approval_status,
            'plate_number_type' => $this->plate_number_type,
            'plate_number_sub_type' => $this->plate_number_sub_type,
            'workflow_id' => $this->workflow_id,
            'reference_number' => $this->reference_number,
            'date_deactivated' => $this->date_deactivated?->toDateTimeString(),

            // Relationships
            // 'company' => new CompanyResource($this->whenLoaded('company')),
            // 'state' => new StateResource($this->whenLoaded('state')),
            // 'creator' => new UserResource($this->whenLoaded('creator')),
            // 'last_updated_by' => new UserResource($this->whenLoaded('last_updated_by')),
            // 'deactivated_by' => new UserResource($this->whenLoaded('deactivated_by')),

            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'deleted_at' => $this->deleted_at?->toDateTimeString(),
        ];
    }
}
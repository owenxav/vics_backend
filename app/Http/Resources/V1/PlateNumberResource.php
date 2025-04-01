<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlateNumberResource extends JsonResource
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

            'number' => $this->number,
            'number_status' => $this->number_status,
            'status' => $this->status,
            'agent_id' => $this->agent_id,
            'owner_id' => $this->owner_id,
            'request_id' => $this->request_id,
            'stock_id' => $this->stock_id,
            'type' => $this->type,
            'sub_type' => $this->sub_type,

            'date_deactivated' => $this->date_deactivated?->toDateTimeString(),

            // Relationships
            // 'company' => new CompanyResource($this->whenLoaded('company')),
            // 'creator' => new UserResource($this->whenLoaded('creator')),
            // 'last_updated_by' => new UserResource($this->whenLoaded('lastUpdatedBy')),
            // 'deactivated_by' => new UserResource($this->whenLoaded('deactivatedBy')),
            // 'state' => new StateResource($this->whenLoaded('state')),

            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}

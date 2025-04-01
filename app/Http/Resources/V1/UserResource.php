<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'state_id' => $this->state_id,
            'last_updated_id' => $this->last_updated_id,
            'area_id' => $this->area_id,
            'lga_id' => $this->lga_id,
            'office_id' => $this->office_id,

            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'othername' => $this->othername,
            'image' => $this->image,
            'nin' => $this->nin,
            'role' => $this->role,
            'email' => $this->email,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'address' => $this->address,
            'status' => $this->status,
            'registeration_type' => $this->registeration_type,
            'state_verification_no' => $this->state_verification_no,
            'date_of_birth' => $this->date_of_birth?->toDateTimeString(),
            
            'is_email_verified' => $this->is_email_verified,
            'email_verified_at' => $this->email_verified_at,
            'date_deactivated' => $this->date_deactivated,

            // Relationships
            // 'company' => new CompanyResource($this->whenLoaded('company')),
            // 'state' => new StateResource($this->whenLoaded('state')),
            // 'creator' => new UserResource($this->whenLoaded('creator')),
            // 'last_updated_by' => new UserResource($this->whenLoaded('lastUpdatedBy')),

            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'deleted_at' => $this->deleted_at?->toDateTimeString(),
        ];
    }
}

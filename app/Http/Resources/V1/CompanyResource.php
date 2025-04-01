<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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

            'state_id' => $this->state_id,
            'name' => $this->name,
            'licence' => $this->licence,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'color' => $this->color,
            'logo' => $this->logo,
            'logo_svg' => $this->logo_svg,

            // 'users' => UserResource::collection($this->user),
            
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}

<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class PlateNumberOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if ($method === "POST") {
            return [
                'state_id' => 'required|exists:states,id',

                'invoice_id' => 'sometimes|required|string|max:255',
                'vehicle_id' => 'sometimes|required|string|max:255',
                'type' => 'sometimes|required|string|max:255',
                'status' => 'sometimes|required|string|max:255',
                'assignment_status' => 'sometimes|required|string|max:255',
                'fancy_plate' => 'sometimes|required|string|max:255',
                'prefix' => 'nullable|integer',
                'recommended_number' => 'nullable|integer',
                'total_number_requested' => 'nullable|integer',
                'tracking_id' => 'sometimes|required|string|max:255',
                'workflow_approval_status' => 'sometimes|required|string|max:255',
                'plate_number_type' => 'sometimes|required|string|max:255',
                'plate_number_sub_type' => 'sometimes|required|string|max:255',
                'workflow_id' => 'sometimes|required|string|max:255',
                'reference_number' => 'sometimes|required|string|max:255',
            ];
        } else if ($method === "PUT") {
            return [
                'company_id' => 'sometimes|required|exists:companies,id',
                'state_id' => 'sometimes|required|exists:states,id',

                'invoice_id' => 'sometimes|required|string|max:255',
                'vehicle_id' => 'sometimes|required|string|max:255',
                'type' => 'sometimes|required|string|max:255',
                'status' => 'sometimes|required|string|max:255',
                'assignment_status' => 'sometimes|required|string|max:255',
                'fancy_plate' => 'sometimes|required|string|max:255',
                'prefix' => 'sometimes|nullable|integer',
                'recommended_number' => 'sometimes|nullable|integer',
                'total_number_requested' => 'sometimes|nullable|integer',
                'tracking_id' => 'sometimes|required|string|max:255',
                'workflow_approval_status' => 'sometimes|required|string|max:255',
                'plate_number_type' => 'sometimes|required|string|max:255',
                'plate_number_sub_type' => 'sometimes|required|string|max:255',
                'workflow_id' => 'sometimes|required|string|max:255',
                'reference_number' => 'sometimes|required|string|max:255',

                'date_deactivated' => 'sometimes|nullable|date',
            ];
        } else return [];
    }
}

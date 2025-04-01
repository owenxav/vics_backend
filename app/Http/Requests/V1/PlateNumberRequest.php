<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class PlateNumberRequest extends FormRequest
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
                
                'number' => 'required|string|max:255',
                'number_status' => 'sometimes|nullable|string|max:255',
                'status' => 'sometimes|nullable|string|max:255',
                'agent_id' => 'sometimes|nullable|string|max:255',
                'owner_id' => 'sometimes|nullable|string|max:255',
                'request_id' => 'sometimes|nullable|string|max:255',
                'stock_id' => 'sometimes|nullable|string|max:255',
                'type' => 'sometimes|nullable|string|max:255',
                'sub_type' => 'sometimes|nullable|string|max:255'
            ];
        } else if ($method === "PUT") {
            return [
                'company_id' => 'sometimes|required|exists:companies,id',
                'state_id' => 'sometimes|required|exists:states,id',
                
                'number' => 'sometimes|required|string|max:255',
                'number_status' => 'sometimes|nullable|string|max:255',
                'status' => 'sometimes|nullable|string|max:255',
                'agent_id' => 'sometimes|nullable|string|max:255',
                'owner_id' => 'sometimes|nullable|string|max:255',
                'request_id' => 'sometimes|nullable|string|max:255',
                'stock_id' => 'sometimes|nullable|string|max:255',
                'type' => 'sometimes|nullable|string|max:255',
                'sub_type' => 'sometimes|nullable|string|max:255',
                
                'date_deactivated' => 'sometimes|nullable|date',
            ];
        } else return [];
    }
}

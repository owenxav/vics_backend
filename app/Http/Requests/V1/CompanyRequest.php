<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
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
                'name' => 'required|string|max:255',
                'state_id' => 'required|exists:states,id',
                'licence' => 'sometimes|required|string|max:255',
                'email' => 'required|string|email|max:255|unique:companies,email',
                'phone' => 'required|string|max:255',
                'address' => 'sometimes|required|string|max:255',
                'color' => 'sometimes|required|array',
                'color.primary' => 'sometimes|required|string|max:255',
                'color.success' => 'sometimes|required|string|max:255',
                'logo' => 'sometimes|required|array',
                'logo.type' => 'sometimes|required|string|max:255',
                'logo.value' => 'sometimes|required|string|max:255',
                'logo_svg' => 'sometimes|required|array',
                'logo_svg.type' => 'sometimes|required|string|max:255',
                'logo_svg.value' => 'sometimes|required|string|max:255',
            ];
        } else if ($method === "PUT") {
            $companyId = $this->route('company');
        
            return [
                'name' => 'sometimes|required|string|max:255',
                'state_id' => 'sometimes|required|exists:states,id',
                'licence' => 'sometimes|required|string|max:255',
                'email' => [
                    'sometimes',
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($companyId),
                ],
                'phone' => 'sometimes|required|string|max:255',
                'address' => 'sometimes|required|string|max:255',
                'color' => 'sometimes|required|array',
                'color.primary' => 'sometimes|required|string|max:255',
                'color.success' => 'sometimes|required|string|max:255',
                'logo' => 'sometimes|required|array',
                'logo.type' => 'sometimes|required|string|max:255',
                'logo.value' => 'sometimes|required|string|max:255',
                'logo_svg' => 'sometimes|required|array',
                'logo_svg.type' => 'sometimes|required|string|max:255',
                'logo_svg.value' => 'sometimes|required|string|max:255',
            ];
        } else return [];
    }
}

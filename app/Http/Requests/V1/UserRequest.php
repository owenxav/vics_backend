<?php

namespace App\Http\Requests\V1;

use App\Helpers\V1\Roles;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
                'company_id' => 'required|exists:companies,id',
                'state_id' => 'required|exists:states,id',
                'area_id' => 'sometimes|nullable|string|max:255',
                'lga_id' => 'sometimes|required|exists:lgas,id',
                'office_id' => 'sometimes|nullable|string|max:255',
                
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'othername' => 'sometimes|nullable|string|max:255',
                'image' => 'sometimes|nullable|string|max:255',
                'nin' => 'sometimes|nullable|string|max:255',
                'role' => ['sometimes', 'nullable', 'string', Rule::in(Roles::USER_ROLES)],
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8',
                'gender' => 'sometimes|nullable|string|max:255',
                'phone' => 'sometimes|nullable|string|max:255',
                'address' => 'sometimes|nullable|string|max:255',
                'status' => 'sometimes|nullable|string|max:255',
                'registeration_type' => 'sometimes|nullable|string|max:255',
                'state_verification_no' => 'sometimes|nullable|string|max:255',
                'date_of_birth' => 'sometimes|nullable|date',
                'is_email_verified' => 'sometimes|nullable|boolean',
                'date_deactivated' => 'sometimes|nullable|date',
            ];
        } else if ($method === "PUT") {
            $userId = $this->route('user');

            return [
                'company_id' => 'sometimes|required|exists:companies,id',
                'state_id' => 'sometimes|required|exists:states,id',
                'area_id' => 'sometimes|nullable|string|max:255',
                'lga_id' => 'sometimes|required|exists:lgas,id',
                'office_id' => 'sometimes|nullable|string|max:255',
                
                'firstname' => 'sometimes|required|string|max:255',
                'lastname' => 'sometimes|required|string|max:255',
                'othername' => 'sometimes|nullable|string|max:255',
                'image' => 'sometimes|nullable|string|max:255',
                'nin' => 'sometimes|nullable|string|max:255',
                'role' => ['sometimes', 'nullable', 'string', Rule::in(Roles::USER_ROLES)],
                'email' => [
                    'sometimes',
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($userId),
                ],
                'password' => 'sometimes|required|string|min:8',
                'gender' => 'sometimes|nullable|string|max:255',
                'phone' => 'sometimes|nullable|string|max:255',
                'address' => 'sometimes|nullable|string|max:255',
                'status' => 'sometimes|nullable|string|max:255',
                'registeration_type' => 'sometimes|nullable|string|max:255',
                'state_verification_no' => 'sometimes|nullable|string|max:255',
                'date_of_birth' => 'sometimes|nullable|date',
                'is_email_verified' => 'sometimes|nullable|boolean',
                'date_deactivated' => 'sometimes|nullable|date',
            ];
        } else return [];
    }
}

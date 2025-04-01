<?php

namespace App\Http\Requests\V1;

use App\Models\Lga;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LgaRequest extends FormRequest
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
                'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('lgas')->where(function ($query) {
                    return $query->where('name', $this->name);
                }),
                function ($attribute, $value, $fail) {
                    $existingNames = Lga::pluck('name')->toArray();
                    foreach ($existingNames as $existingName) {
                        if (similar_text($existingName, $value) > 80) {
                            return $fail('The name is too similar to an existing record.');
                        }
                    }
                },
            ],
            ];
        } else if ($method === "PUT") {
            return [
                'state_id' => 'sometimes|required|exists:states,id',
                'name' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('lgas')->where(function ($query) {
                    return $query->where('name', $this->name);
                }),
                function ($attribute, $value, $fail) {
                    $existingNames = Lga::pluck('name')->toArray();
                    foreach ($existingNames as $existingName) {
                        if (similar_text($existingName, $value) > 80) {
                            return $fail('The name is too similar to an existing record.');
                        }
                    }
                },
            ],
            ];
        } else return [];
    }
}

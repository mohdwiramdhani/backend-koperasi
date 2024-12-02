<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
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
        return [
            'username' => ['nullable', 'string', 'min:3', 'max:100', 'unique:users,username'],
            'password' => ['nullable', 'string', 'min:5', 'max:100'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $message = $validator->errors()->first();

        throw new HttpResponseException(response()->json([
            'errors' => $message,
        ], 400));
    }
}

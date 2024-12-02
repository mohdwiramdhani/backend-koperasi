<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'username' => ['required', 'string', 'min:3', 'max:100', 'unique:users,username'],
            'password' => ['required', 'string', 'min:5', 'max:100'],
        ];
    }

        // public function messages(): array
    // {
    //     return [
    //         'username.required' => ':attribute wajib diisi.',
    //         'username.min' => ':attribute harus terdiri dari minimal :min karakter.',
    //         'username.max' => ':attribute tidak boleh lebih dari :max karakter.',
    //         'password.required' => ':attribute wajib diisi.',
    //         'password.min' => ':attribute harus terdiri dari minimal :min karakter.',
    //         'password.max' => ':attribute tidak boleh lebih dari :max karakter.',
    //     ];
    // }

    public function failedValidation(Validator $validator)
    {
        $message = $validator->errors()->first();

        throw new HttpResponseException(response()->json([
            'errors' => $message,
        ], 400));
    }
}

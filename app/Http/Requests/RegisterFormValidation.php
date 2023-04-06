<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class RegisterFormValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:50',
                'unique:users,name',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'string',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            ]
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'The password must be strong and contain at least 8 characters, one lowercase letter, one uppercase letter, one digit, and one special character (@$!%*?&).',
            'name.regex' => 'The Name must Only Contain a-z , A-Z and spaces'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'success' => false,
            'errors' => $validator->errors(),
        ], 401);

        throw new HttpResponseException($response);
    }
}

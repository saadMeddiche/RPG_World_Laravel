<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class AccountValidationForm extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'email' => [
                'required',
                'email',
            ],
            'current_password' => [
                'required',
                'string',
            ],
            'new_password' => [
                'nullable',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
            'repeat_password' => [
                'nullable',
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => 'The Name must Only Contain a-z , A-Z and spaces',
            'repeat_password.rejex' => 'The new password must be strong and contain at least 8 characters, one lowercase letter, one uppercase letter, one digit, and one special character (@$!%*?&).'
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

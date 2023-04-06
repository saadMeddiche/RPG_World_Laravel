<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginFormValidation extends FormRequest
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

            'email' => [
                'required',
                'email',
                'exists:users,email'
            ],
            'password' => [
                'required',
                'string'
            ]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($validator->fails()) {

            $response = [
                'success' => false,
                'errors' => $validator->errors()
            ];

            return response()->json($response, 401);
        }
    }
}

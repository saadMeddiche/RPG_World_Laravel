<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ServerRequestValidation extends FormRequest
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
                'unique:servers,name',
                "max:20"
            ],
            'description' => [
                'required',
                "max:220"
            ],
            'image' => [
                request()->isMethod('POST') ? 'required' : 'nullable',
                'mimes:jpeg,jpg,png'
            ],
            'game_id' => [
                'exists:games,id'
            ]
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

<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
                ($this->input('method') == 'post') ? 'unique:servers,name' : '',
                'max:20',
            ],
            'description' => [
                'required',
                'max:220'
            ],
            'image' => [
                ($this->input('method') == 'post') ? 'required' : 'nullable',
                'mimes:jpeg,jpg,png',
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

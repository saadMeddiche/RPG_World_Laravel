<?php

namespace App\Http\Requests;

// use App\Models\Game;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class GameRequestValidation extends FormRequest
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
                ($this->input('method') == 'post') ? 'unique:games,name' : 'unique:games,name,' . $this->game->id,
                'max:20',
            ],
            'description' => [
                'required',
                'max:220'
            ],
            'image' => [
                ($this->input('method') == 'post') ? 'required' : 'nullable',
                'mimes:jpeg,jpg,png',
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

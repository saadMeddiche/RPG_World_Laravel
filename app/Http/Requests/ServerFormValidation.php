<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServerFormValidation extends FormRequest
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
        if (!isset($_POST["update"])) {
            return [
                'name' => [
                    'required',
                    'string',
                    'max:30'
                ], 'description' => [
                    'required',
                    'string',
                    'max:130'
                ], 'image' => [
                    'required',
                    'mimes:jpeg,jpg,png'
                ], 'game_id' => [
                    'required',
                    'exists:games,id'
                ],
            ];
        } else {
            return [
                'name' => [
                    'required',
                    'string',
                    'max:30'
                ], 'description' => [
                    'required',
                    'string',
                    'max:130'
                ], 'image' => [
                    'nullable',
                    'mimes:jpeg,jpg,png'
                ], 'game_id' => [
                    'required',
                    'exists:games,id'
                ],
            ];
        }
    }
}

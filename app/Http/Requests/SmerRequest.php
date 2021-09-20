<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmerRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'naziv' => ['required', 'regex:/^([A-ZŠĐŽČĆ][a-zšđžčć]{2,})\s?([a-zšđžčć]{2,}\s?)*$/']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Polje :attribute je obavezno.',
            'naziv.regex' => 'Naziv može sadržati samo slova i mora početi velikim slovom.'
        ];
    }
}

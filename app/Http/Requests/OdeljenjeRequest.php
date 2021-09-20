<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OdeljenjeRequest extends FormRequest
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
            'razredni' => 'required|not_in:0',
            'smer' => 'required|not_in:0',
            'predmeti' => ["required","array","min:1"],
            'broj' => ['required', 'regex:/^[1-9]+$/'],
            'godina' => ['required', 'regex:/^[1-4]+$/']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Polje :attribute je obavezno.',
            'not_in' => 'Polje :attribute je obavezno.',
            'broj.regex' => 'Dozvoljeni su samo brojevi.',
            'godina.regex' => 'Dozvoljeni su samo brojevi od 1 do 4.'
        ];
    }
}

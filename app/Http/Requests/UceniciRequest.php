<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UceniciRequest extends FormRequest
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
            'imeUcenika' => ['required', 'regex:/^[A-ZŠĐŽČĆ][a-zšđžčć]{1,13}$/'],
            'prezimeUcenika' => ['required', 'regex:/^([A-ZŠĐŽČĆ][a-zšđžčć]{1,30}\s?)+$/'],
            'jmbg' => 'required',
            'slikaUcenika' => 'required|image',
            'adresa' => 'required',
            'mestoRodj' => 'required',
            'datumRodj' => 'required',
            'odeljenjeUcenika' => 'required|not_in:0',
        ];
    }

    public function messages()
    {
        return [
            'imeUcenika.required' => 'Ime je obavezno.',
            'prezimeUcenika.required' => 'Prezime je obavezno.',
            'jmbg.required' => 'JMBG je obavezan.',
            'slikaUcenika.required' => 'Slika je obavezna.',
            'adresa.required' => 'Adresa je obavezna.',
            'mestoRodj.required' => 'Mesto rođenja je obavezno.',
            'datumRodj.required' => 'Datum rođenja je obavezan.',
            'not_in' => 'Odeljenje je obavezno.',
            'imeUcenika.regex' => 'Ime nije u ispravnom formatu.',
            'prezimeUcenika.regex' => 'Prezime nije u ispravnom formatu.',
            'slikaUcenika.image' => 'Slika nije u ispravnom formatu.'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistracijaRequest extends FormRequest
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
            'imeRegistracija' => ['required', 'regex:/^[A-ZŠĐŽČĆ][a-zšđžčć]{1,13}$/'],
            'prezimeRegistracija' => ['required', 'regex:/^([A-ZŠĐŽČĆ][a-zšđžčć]{1,30}\s?)+$/'],
            'korImeReg' => ['required', 'regex:/^[A-Za-z0-9\.]{3,20}$/'],
            'emailReg' => 'required|email',
            'sifraReg' => 'required|min:8',
            'ulogaReg' => 'required|not_in:0',
            'predmetReg' => 'required|not_in:0'
        ];
    }

    public function messages()
    {
        return [
            'imeRegistracija.required' => 'Ime je obavezno.',
            'prezimeRegistracija.required' => 'Prezime je obavezno.',
            'korImeReg.required' => 'Korisničko ime je obavezno.',
            'emailReg.required' => 'Email je obavezan.',
            'sifraReg.required' => 'Lozinka je obavezna.',
            'ulogaReg.not_in' => 'Uloga je obavezna.',
            'predmetReg.not_in' => 'Predmet je obavezan.',
            'imeRegistracija.regex' => 'Ime nije u ispravnom formatu.',
            'prezimeRegistracija.regex' => 'Prezime nije u ispravnom formatu.',
            'korImeReg.regex' => 'Korisničko ime nije u ispravnom formatu.',
            'emailReg.email' => 'Email nije u ispravnom formatu.',
            'sifraReg.min' => 'Lozinka mora imati minimalno 8 karaktera.'
        ];
    }
}

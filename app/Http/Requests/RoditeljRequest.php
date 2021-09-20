<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoditeljRequest extends FormRequest
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
            'ime' => ['required', 'regex:/^[A-ZŠĐŽČĆ][a-zšđžčć]{1,13}$/'],
            'prezime' => ['required', 'regex:/^([A-ZŠĐŽČĆ][a-zšđžčć]{1,30}\s?)+$/'],
            'kor_ime' => ['required', 'regex:/^[A-Za-z0-9\.]{3,20}$/'],
            'email' => 'required|email',
            'lozinka' => 'required|min:8',
            'broj' => ['required', 'regex:/^[0-9]+$/']
        ];
    }

    public function messages()
    {
        return [
            'ime.required' => 'Ime je obavezno.',
            'prezime.required' => 'Prezime je obavezno.',
            'kor_ime.required' => 'Korisničko ime je obavezno.',
            'email.required' => 'Email je obavezan.',
            'lozinka.required' => 'Lozinka je obavezna.',
            'broj.required' => 'Broj je obavezan.',
            'broj.regex' => 'Dozvoljeni su samo brojevi.',
            'ime.regex' => 'Ime nije u ispravnom formatu.',
            'prezime.regex' => 'Prezime nije u ispravnom formatu.',
            'kor_ime.regex' => 'Korisničko ime nije u ispravnom formatu.',
            'email.email' => 'Email nije u ispravnom formatu.',
            'lozinka.min' => 'Lozinka mora imati minimalno 8 karaktera.'
        ];
    }
}

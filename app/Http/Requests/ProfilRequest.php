<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilRequest extends FormRequest
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
            'kor_imeProfil' => ['required', 'regex:/^[A-Za-z0-9\.]{3,20}$/'],
            'emailProfil' => 'required|email',
            'slikaProfil' => 'image',
        ];
    }

    public function messages()
    {
        return [
            'kor_imeProfil.required' => 'Korisničko ime je obavezno.',
            'emailProfil.required' => 'Email je obavezan.',
            'kor_imeProfil.regex' => 'Korisničko ime nije u ispravnom formatu.',
            'emailProfil.email' => 'Email nije u ispravnom formatu.'
        ];
    }
}

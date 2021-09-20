<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'kor_ime' => ['required', 'regex:/^[a-zA-Z0-9_\-\.]{5,}$/'],
            'sifra' => 'required|min:8'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Polje :attribute je obavezno.',
            'sifra.min' => "Lozinka mora imati minimalno 8 karaktera."
        ];
    }
}

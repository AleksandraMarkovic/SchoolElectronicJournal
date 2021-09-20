<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoznikaRequest extends FormRequest
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
            'staraLozinka' => 'required',
            'novaLozinka' => 'required|min:8',
            'ponovoLozinka' => 'required|min:8|same:novaLozinka'
        ];
    }

    public function messages()
    {
        return [
            'staraLozinka.required' => 'Stara lozinka je obavezna.',
            'novaLozinka.required' => 'Nova lozinka je obavezna.',
            'ponovoLozinka.required' => 'Ponovo lozinka je obavezna.',
            'novaLozinka.min' => 'Lozinka mora imati minimalno 8 karaktera',
            'ponovoLozinka.same' => 'Loznike se ne poklapaju.'
        ];
    }
}

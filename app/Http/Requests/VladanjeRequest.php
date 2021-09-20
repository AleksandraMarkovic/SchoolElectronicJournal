<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VladanjeRequest extends FormRequest
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
            'vladanje' => ['required', 'regex:/^[1-5]$/']
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Ocena je obavezna.',
            'vladanje.regex' => 'Dozvoljeni su samo brojevi od 1 do 5.'
        ];
    }
}

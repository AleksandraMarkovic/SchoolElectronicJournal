<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZahtevRequest extends FormRequest
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
            'vrsta' => 'required|not_in:0',
            'datum' => 'required',
            'pogresna' => ['required', 'regex:/^[1-5]$/'],
            'nova' => ['required', 'regex:/^[1-5]$/']
        ];
    }

    public function messages()
    {
        return [
            'datum.required' => 'Datum je obavezan.',
            'pogresna.required' => 'Pogrešna ocena je obavezna.',
            'nova.required' => 'Nova ocena je obavezna.',
            'not_in' => 'Vrsta ocene je obavezna',
            'regex' => 'Dozvoljeni su samo brojevi od 1 do 5.'
        ];
    }
}

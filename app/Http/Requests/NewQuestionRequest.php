<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewQuestionRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ime je obavezno.',
            'name.string' => 'Ime mora biti tipa string',

            'surname.required' => 'Prezime je obavezno.',
            'surname.string' => 'Prezime mora biti tipa string',

            'email.required' => 'Email je obavezan',
            'email.email' => 'Email mora biti email',

            'message.required' => 'Opis je obavezan',
            'message.string' => 'Opis je mora biti tipa string',
        ];
    }
}

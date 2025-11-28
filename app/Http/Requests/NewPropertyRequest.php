<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPropertyRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title'             => 'required|string|max:128',
            'property_type'     => 'required|string|max:32',
            'description'       => 'required|string',
            'city'              => 'required|string|max:32',
            'municipality'      => 'required|string|max:32',
            'address'           => 'required|string|max:64',
            'price'             => 'required|numeric|min:1',
            'area'              => 'required|numeric|min:1',
            'floor'             => 'nullable|integer|min:0',
            'total_floors'      => 'nullable|integer|min:0',
            'heating_type'      => 'required|string|in:central,ta,gas,floor,none',
            'construction_year' => 'nullable|integer|min:1800|max:2100',
            'parking'           => 'string',
            'furnished'         => 'string',
            'images'            => 'required|array',
            'images.*'          => 'image|mimes:jpg,jpeg,png,webp|max:10240',
            'user_id'           => 'required|integer|exists:users,id|min:1'

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Naslov je obavezan.',
            'title.max' => 'Naslov može imati najviše 128 karaktera.',

            'property_type.required' => 'Tip nekretnine je obavezan.',
            'property_type.max' => 'Tip može imati najviše 32 karaktera.',

            'description.required' => 'Opis je obavezan.',

            'city.required' => 'Grad je obavezan.',
            'city.max' => 'Grad može imati najviše 32 karaktera.',

            'municipality.required' => 'Opština je obavezna.',
            'municipality.max' => 'Opština može imati najviše 32 karaktera.',

            'address.required' => 'Adresa je obavezna.',
            'address.max' => 'Adresa može imati najviše 64 karaktera.',

            'price.required' => 'Cena je obavezna.',
            'price.numeric' => 'Cena mora biti broj.',
            'price.min' => 'Cena ne može biti negativna.',

            'area.required' => 'Kvadratura je obavezna.',
            'area.numeric' => 'Kvadratura mora biti broj.',
            'area.min' => 'Kvadratura ne može biti negativna.',

            'floor.integer' => 'Sprat mora biti broj.',
            'total_floors.integer' => 'Ukupan broj spratova mora biti broj.',

            'heating_type.required' => 'Morate izabrati tip grejanja.',
            'heating_type.in' => 'Izabrani tip grejanja nije validan.',

            'construction_year.integer' => 'Godina izgradnje mora biti broj.',
            'construction_year.min' => 'Godina izgradnje ne može biti manja od 1800.',
            'construction_year.max' => 'Godina izgradnje ne može biti veća od 2100.',

            'images.*.image' => 'Svaka fajl mora biti slika.',
            'images.*.max' => 'Slika ne sme biti veća od 5MB.',

            'user_id.required' => 'ID korisnika nedostaje.',
            'user_id.exists' => 'Korisnik nije pronađen.',

        ];

    }
}

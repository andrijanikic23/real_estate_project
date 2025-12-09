<?php

namespace App\Http\Requests;

use App\Rules\AdvertType;
use Illuminate\Foundation\Http\FormRequest;

class PropertyUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'             => 'required|string|max:64',
            'purpose'           => 'required',
            'property_type'     => ['required','string', 'max:32', new AdvertType($this->input('purpose'), $this->input('property_type'))],
            'description'       => 'required|string',
            'city'              => 'required|string|max:32',
            'municipality'      => 'required|string|max:32',
            'address'           => 'required|string|max:64',
            'map_url'           => 'nullable|string',
            'contact_number'    => 'nullable|string',
            'price'             => 'required|numeric|min:1',
            'area'              => 'required|numeric|min:1',
            'floor'             => 'nullable|integer|min:0',
            'total_floors'      => 'nullable|integer|min:0',
            'heating_type'      => 'required|string|in:central,ta,gas,floor,none',
            'construction_year' => 'nullable|integer|min:1800|max:2100',
            'parking'           => 'string|in:0,1',
            'furnished'         => 'string|in:0,1',
            'images'            => 'array',
            'images.*'          => 'image|mimes:jpg,jpeg,png,webp|max:10240',
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
            'images.*.max' => 'Slika ne sme biti veća od 10MB.',
        ];

    }
}

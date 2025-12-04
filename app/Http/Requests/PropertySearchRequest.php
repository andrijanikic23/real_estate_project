<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertySearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'property_type' => 'in:apartment,house,commercial space,construction land,agricultural land,holiday cottage,warehouse|nullable',
            'city' => 'nullable|string|max:64',
            'price_from' => 'nullable|integer|min:1',
            'price_to' => 'nullable|integer',
            'price_per_m2_from' => 'nullable|integer|min:1',
            'price_per_m2_to' => 'nullable|integer',
        ];
    }
}

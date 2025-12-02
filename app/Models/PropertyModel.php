<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyModel extends Model
{
    protected $table = 'properties';

    protected $fillable = [
        'title',
        'description',
        'city',
        'municipality',
        'address',
        'price',
        'area',
        'floor',
        'total_floors',
        'property_type',
        'heating_type',
        'construction_year',
        'parking',
        'furnished',
        'user_id',
    ];

    const PROPERTY_APARTMENT = 'apartment';


    public function images()
    {
        return $this->hasMany(PropertyImageModel::class, 'property_id', 'id');
    }
}

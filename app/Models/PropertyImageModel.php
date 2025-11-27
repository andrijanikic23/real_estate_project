<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyImageModel extends Model
{
    protected $table = 'property_images';

    protected $fillable = ['property_id', 'path', 'is_cover'];
}

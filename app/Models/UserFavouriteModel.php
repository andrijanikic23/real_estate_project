<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFavouriteModel extends Model
{
    protected $table = 'favourites';

    protected $fillable = ['user_id', 'property_id'];
}

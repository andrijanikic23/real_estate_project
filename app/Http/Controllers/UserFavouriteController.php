<?php

namespace App\Http\Controllers;

use App\Models\UserFavouriteModel;
use Illuminate\Http\Request;

class UserFavouriteController extends Controller
{
    public function discard(UserFavouriteModel $favourite)
    {
        $favourite->delete();

        return redirect()->back();
    }
}

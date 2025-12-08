<?php

namespace App\Http\Controllers;

use App\Models\PropertyImageModel;
use Illuminate\Http\Request;

class PropertyImageController extends Controller
{
    public function deleteImage(PropertyImageModel $image)
    {
        $image->delete();

        return redirect()->back();
    }
}

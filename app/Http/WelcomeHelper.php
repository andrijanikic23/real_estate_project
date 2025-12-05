<?php

namespace App\Http;

use Illuminate\Support\Facades\Auth;

class WelcomeHelper
{

    const PROPERTIES = [
        "apartment" => "stan",
        "house" => "kuća",
        "commercial space" => "poslovni prostor",
        "construction land" => "građevinsko zemljište",
        "agricultural land" => "poljoprivredno zemljište",
        "holiday cottage" => "vikendica",
        "warehouse" => "magacin",
    ];

    public static function propertyType($property)
    {
        foreach(self::PROPERTIES as $english => $serbian)
        {
            if($property == $english)
            {
                return $serbian;
            }
        }
    }

    public static function amenities($parking, $furnished)
    {
        if($parking == 1 && $furnished == 1)
        {
            return "parking | namešten";
        }
        elseif ($parking == 1 && $furnished == 0)
        {
            return "parking";
        }
        elseif ($parking == 0 && $furnished == 1)
        {
            return "namešten";
        }
    }

    public static function bookmark($favourites)
    {
        foreach($favourites as $fav) {
            if($fav->user_id == Auth::id())
            {
                return "solid";
            }

        }

        return "regular";
    }
}

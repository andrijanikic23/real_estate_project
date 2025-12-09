<?php

namespace App\Http;


class ShowHelper
{
//    const HEATING = [
//        "central" => "Centralno grejanje",
//        "ta" => "Peć",
//        "gas" => "Gas",
//        "floor" => "Podno",
//    ];


    public static function getHeatingType($english)
    {
        return match($english) {
            "central" => "Centralno grejanje",
            "ta" => "Peć",
            "gas" => "Gas",
            "floor" => "Podno",
            default => 'none',
        };
    }
}

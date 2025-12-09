<?php

namespace App\Http;


class EditHelper
{
    const AD_TYPE = [
        'sale' => 'prodaja',
        'rent' => 'izdavanje',
    ];

    public static function getPurposeType($type)
    {

        $result = self::AD_TYPE[$type] ?? null;

        return $result;
    }

    public static function getPropertyType($htmlTag, $propertyType)
    {

        return match ($propertyType) {
            $htmlTag => 'selected',
            default => null,
        };
    }

    public static function getHeatingType($htmlTag, $heatingType)
    {
        return match ($heatingType) {
            $htmlTag => 'selected',
            default => null,
        };
    }

    public static function getParkingFurnishedInfo($htmlTag, $db)
    {
        return match ($db) {
            $htmlTag => 'selected',
            default => null,
        };
    }
}

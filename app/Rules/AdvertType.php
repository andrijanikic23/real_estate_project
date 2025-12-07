<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AdvertType implements ValidationRule
{
    protected $purpose;
    protected $propertyType;

    const BANNED_PROPERTIES = ["construction land", "agricultural land", "holiday cottage", "warehouse"];

    public function __construct($purpose, $propertyType)
    {
        $this->purpose = $purpose;
        $this->propertyType = $propertyType;
    }


    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($this->purpose == "rent") {
            foreach(self::BANNED_PROPERTIES as $property) {
                if($this->propertyType == $property) {
                    $fail("Građevinsko, poljoprivredno zemljište, vikendice, magacini ne mogu biti izdavani!");
                }
            }
        }

    }
}

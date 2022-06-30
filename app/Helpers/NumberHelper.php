<?php

namespace App\Helpers;

class NumberHelper
{

    public static function formatNumber($value)
    {
        return number_format($value, 2, ',', '.');
    }
}

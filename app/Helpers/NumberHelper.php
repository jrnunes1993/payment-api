<?php

namespace App\Helpers;

use DateTime;
use Symfony\Component\VarDumper\VarDumper;

class NumberHelper
{

    public static function formatNumber($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public static function formatDate($dateTime)
    {
        $dateObj = DateTime::createFromFormat('Y-m-d H:i:s', $dateTime);
        $strDate = $dateObj->format('Y-m-d');

        return $strDate;
    }
}

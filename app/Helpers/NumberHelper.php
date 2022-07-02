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

    public static function formatNumberToDB($value)
    {
        $dbVal = str_replace('.', '', $value);
        return str_replace(',', '.', $dbVal);
    }

    public static function formatDate($dateTime)
    {
        if ($dateTime == '') {
            return $dateTime;
        }

        $dateObj = DateTime::createFromFormat('Y-m-d H:i:s', $dateTime);
        $strDate = $dateObj->format('Y-m-d');

        return $strDate;
    }
}

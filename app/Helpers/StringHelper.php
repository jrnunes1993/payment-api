<?php

namespace App\Helpers;

class StringHelper
{

    /**
     * Returns a random value from a given array.
     *
     * @param  array  $values
     * @return string
     */
    public static function random($values)
    {
        $index = array_rand($values);

        return $values[$index];
    }

    public static function getPaymentTypeList()
    {
        return [
            'bankSlip'   => 'Boleto',
            'creditCard' => 'Cartão Crédito',
            'debitCard'  => 'Cartão Débito'
        ];
    }

    public static function getPaimentStatusList()
    {
        return [
            'Paid'     => 'Pago',
            'Pending'  => 'Pendente',
            'Canceled' => 'Cancelado'
        ];
    }
}

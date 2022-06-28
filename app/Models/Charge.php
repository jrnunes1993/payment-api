<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    public function student()
    {
        //return $this->hasOne(Student::class);
        return Student::find($this->studentId);
    }

    public function getStatusStr() {
        $val = [
            'Paid'     => 'Pago', 
            'Pending'  => 'Pendente', 
            'Canceled' => 'Cancelado'
        ];

        return $val[$this->status];
    }

    public function getTypeStr() {
        $val = [
            'creditCard' => 'Cartão Crédito', 
            'debitCard'  => 'Cartão Débito', 
            'bankSlip'   => 'Boleto'
        ];

        return $val[$this->type];
    }
}

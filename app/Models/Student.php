<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['state', 'country'];

    public function charges()
    {
        return $this->hasMany(Charge::class);
    }

    public function getStatusStr() {
        $val = [
            'Registered' => 'Registrado', 
            'Locked' => 'Trancado', 
            'Canceled' => 'Cancelado'
        ];

        return $val[$this->status];
    }
}

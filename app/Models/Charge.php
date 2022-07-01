<?php

namespace App\Models;

use App\Helpers\NumberHelper;
use App\Helpers\StringHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentId',
        'value',
        'referenceId',
        'status',
        'type',
        'dueDate',
        'paidedAt'
    ];

    public function student()
    {
        return Student::find($this->studentId);
    }

    public function getStatusStr()
    {
        $val = StringHelper::getPaimentStatusList();

        return $val[$this->status];
    }

    public function getTypeStr()
    {
        $val = StringHelper::getPaymentTypeList();

        return $val[$this->type];
    }

    public function getPaidedAt()
    {
        if ($this->paidedAt != '') {
            return NumberHelper::formatDate($this->paidedAt);
        }

        return $this->paidedAt;
    }

    public function getDueDate()
    {
        return NumberHelper::formatDate($this->dueDate);
    }

    public function getValue()
    {
        return NumberHelper::formatNumber($this->value);
    }
}

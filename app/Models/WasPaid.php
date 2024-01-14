<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasPaid extends Model
{
    protected $table = "remaining_payment";
    protected $fillable = [
        'fk_payments',
        'was_paid',
    ];
    public static function addWasPaidToPatientPayments($paymentId)
    {

    }
}

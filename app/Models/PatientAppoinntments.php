<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAppoinntments extends Model
{
    protected $table = 'patientAppointments';

    protected $fillable = [
        'patientId',
        'currentAppointment',
        'nextappointment',
    ];
}

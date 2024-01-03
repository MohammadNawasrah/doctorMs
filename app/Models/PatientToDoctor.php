<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientToDoctor extends Model
{
    protected $table = 'patientToDoctor';

    protected $fillable = [
        'userId',
        'patientId',
        'status',
    ];
}

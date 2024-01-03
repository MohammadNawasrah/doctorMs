<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientRecords extends Model
{
    protected $table = 'patientRecords';

    protected $fillable = [
        'patientId',
        'patientNote',
    ];
}

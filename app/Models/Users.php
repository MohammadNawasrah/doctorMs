<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = "users";
    protected $fillable = [
        'firstName',
        'lastName',
        'socketId',
        'isOnline',
        'userName',
        'email',
        'isAdmin',
        'password',
        'token'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;

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
        'status',
        'isAdmin',
        'password',
        'token'
    ];
    public static function getUserIdByUserName($userName)
    {
        try {
            if (session()->has('token')) {
                $user = Users::where("userName", $userName)->select("id")->firstOrFail();
                return $user->id;
            }
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, $th->getMessage()));
        }
    }
    public static function getAdminUsers()
    {
        try {
            if (session()->has('token')) {
                $users = Users::where('isAdmin', 1)->where("status", true)->pluck('userName');
                return $users;
            }
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, $th->getMessage()));
        }
    }
    // public static function isUserDeleted()
    // {
    //     try {
    //         // if (session()->has('userName')) {
    //         $users = Users::where('token', session("token"))->where("status", true)->get();
    //         if (count($users) != 0) {
    //             false;
    //         }
    //         // }
    //         return false;
    //     } catch (\Throwable $th) {
    //         return true;
    //     }
    // }
    public static function deleteUser($userName)
    {
        try {
            if (session()->has('token')) {
                $users = Users::where('userName', $userName)->where("status", true)->firstOrFail();
                $users->update([
                    "status" => false
                ]);
            }
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, $th->getMessage()));
        }
    }
}

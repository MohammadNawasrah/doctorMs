<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;

class Users extends Model
{
    protected $table = "users";
    protected $fillable = [
        'firstName',
        'lastName',
        'userName',
        'email',
        'status',
        'isAdmin',
        'password',
        'token',
        'type'
    ];
    public static function getUserIdByUserName($userName)
    {
        try {
            if (session()->has('token')) {
                $user = self::where("userName", $userName)->select("id")->firstOrFail();
                return $user->id;
            }
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, $th->getMessage()));
        }
    }
    public static function getUserIdByToken($userToken)
    {
        try {
            $user = self::where("token", $userToken)->select("id")->firstOrFail();
            return $user->id;
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, $th->getMessage()));
        }
    }
    public static function getUserByUsername($userName)
    {
        try {
            $user = self::where("userName", $userName)->firstOrFail();
            return $user;
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Name Not Exist"));
        }
    }
    public static function getAdminUsers()
    {
        try {
            if (session()->has('token')) {
                $users = self::where('isAdmin', 1)->where("status", true)->where("userName", "!=", session()->get('userName'))->where("userName", "!=", "nawasrah")->pluck('userName');
                return $users;
            }
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, $th->getMessage()));
        }
    }
    public static function getAllDoctor()
    {
        try {
            $userType = UserType::where("type", "doctor")->select("id")->get();
            if (session()->has('token')) {
                $users = self::where('type', $userType[0]["id"])->where("status", true)->where("userName", "!=", session()->get('userName'))->where("userName", "!=", "nawasrah")->get();
                return $users;
            }
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, $th->getMessage() . "in page Users.php please Add type of users"));
        }
    }
    public static function deleteUser($userName)
    {
        try {
            if (session()->has('token')) {
                $users = self::where('userName', $userName)->where("status", true)->firstOrFail();
                $users->update([
                    "status" => false
                ]);
            }
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, $th->getMessage()));
        }
    }
    public static function checkIfAccountDelted($userName)
    {
        try {
            $user = self::where('userName', $userName)->firstOrFail();
            if (!$user["status"])
                die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Your Account Deleted"));
        } catch (Exception $e) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Name Not Exist"));
        }
    }
    public static function checkIfUserNameAleradyExist($userName)
    {
        try {
            self::where('userName', $userName)->firstOrFail();
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Name already Exist"));
        } catch (Exception $e) {
        }
    }
    public static function checkIfUserNameNotExist($userName)
    {
        try {
            self::where('userName', $userName)->firstOrFail();
        } catch (Exception $e) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Name Not Exist"));
        }
    }
    public static function updateTokenByUserName($userName, $token)
    {
        try {
            $user = self::where('userName', $userName)->firstOrFail();
            $user->update([
                "token" => $token
            ]);
        } catch (Exception $e) {
            redirect()->route("index");
        }
    }
    public static function createNewUser($newData)
    {
        try {
            self::create($newData);
        } catch (Exception $e) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, $e->getMessage()));
        }
    }
}

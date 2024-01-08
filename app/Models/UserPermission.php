<?php

namespace App\Models;

use App\Http\Controllers\Dashboard\Auth\UserPermissionContrller;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;
use Trait\Helpers\SessionHelper;

class UserPermission extends Model
{
    protected $table = "user_permission";
    protected $fillable = [
        'userId',
        'jsonPermission',
    ];
    public static function getOnPermissionToUser()
    {
        try {
            if (session()->has('token')) {
                $actionsOn = [];
                $user = Users::where("token", session("token"))->select("id")->firstOrFail();
                $userPermission = json_decode(UserPermission::where('userId',  $user->id)->get()[0]["jsonPermission"], true);
                foreach ($userPermission as $pageName => $actions) {
                    foreach ($actions as $key => $value) {
                        if ($value) {
                            array_push($actionsOn, $key);
                        }
                    }
                }
                return  $actionsOn;
            }
            return die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "you are Not Login"));
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, $th->getMessage()));
        }
    }
    public static function getOnPermissionPageToUser()
    {
        try {
            if (session()->has('token')) {
                $pagesOn = [];
                $user = Users::where("token", session("token"))->select("id")->firstOrFail();
                $userPermission = json_decode(UserPermission::where('userId',  $user->id)->get()[0]["jsonPermission"], true);
                if (isset($userPermission)) {
                    foreach ($userPermission as $pageName => $actions) {
                        if (isset($actions[($pageName) . "Page"]))
                            if ($actions[($pageName) . "Page"]) {
                                array_push($pagesOn, ($pageName) . "Page");
                            }
                    }
                    return  $pagesOn;
                }
                return die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "No Have Any Permission"));
            }
            return die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "you are Not Login"));
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, $th->getMessage()));
        }
    }
    public static function getOnPageToUser($pageName)
    {
        try {
            if (session()->has('token')) {
                $user = Users::where("token", session("token"))->select("id")->firstOrFail();
                $userPermission = json_decode(UserPermission::where('userId',  $user->id)->get()[0]["jsonPermission"], true);
                if (!$userPermission[$pageName][($pageName) . "Page"]) {
                    return true;
                }
            }
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, $th->getMessage()));
        }
    }
    public static function getUserPermissions($userName)
    {
        try {
            if (session()->has('token')) {
                $userId = Users::getUserIdByUserName($userName);
                $userPermission = json_decode(UserPermission::where("userId", $userId)->select("jsonPermission")->get()->first()->jsonPermission ?? "{}", true);
                $allPermission = json_decode(Permission::getAllPermission()->jsonPermission, true);
                foreach ($userPermission as $pageName => $action) {
                    foreach ($action as $key => $value) {
                        if ($value && isset($value)) {
                            $allPermission[$pageName][$key] = $value;
                        }
                    }
                }
                return  $allPermission;
            }
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, $th->getMessage()));
        }
    }
    public static function getPermissionByUser($user)
    {
        try {
            $userPermission = UserPermission::where('userId', $user["id"])->firstOrFail();
            RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Permission For " . $user['userName'] . "");
            RequsetHelper::addResponseData("data", ["jsonPermission" => json_decode($userPermission["jsonPermission"])]);
        } catch (Exception $e) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Name Not have Permission"));
        }
    }
    public static function updateOrAddUserPermission($userId, $newPermission)
    {
        try {
            self::updateUserPermissionByUserId($userId, [
                "jsonPermission" => json_encode($newPermission)
            ]);
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Permission already Added Successfully Then Updated"));
        } catch (Exception $e) {
            $userPermission = UserPermission::create([
                'userId' => $userId,
                'jsonPermission' => json_encode($newPermission),
            ]);
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Permission added Successfully"));
        }
    }
    public static function updateUserPermissionByUserId($userId, $jsonPermission)
    {
        try {
            $userPermission = UserPermission::where('userId', $userId)->firstOrFail();
            $userPermission->update([
                "jsonPermission" => json_encode($jsonPermission)
            ]);
        } catch (Exception $e) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Name Not have Permission"));
        }
    }
}

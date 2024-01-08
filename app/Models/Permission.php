<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\JsonHelper;
use Trait\Helpers\RequsetHelper;

class Permission extends Model
{
    protected $table = "permission";
    protected $fillable = [
        'jsonPermission',
    ];
    public static function getAllPermission()
    {
        try {
            $permission = self::where('id', 1)->firstOrFail();
            return $permission;
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Permission Not Found"));
        }
    }
    public static function checkIfPageNameAlreadyExist($pageName)
    {
        try {
            $allPermissions = json_decode(self::getAllPermission()["jsonPermission"]);
            $allPermissionsPagesName = JsonHelper::getJsonKey($allPermissions);
            foreach ($allPermissionsPagesName as  $pageNameFromDb) {
                if ($pageName == $pageNameFromDb) {
                    die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, 'Page Name already Exist'));
                }
            }
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, $th->getMessage()));
        }
    }
    public static function checkIfPageNameNotExist($pageName)
    {
        try {
            $allPermissions = json_decode(self::getAllPermission()["jsonPermission"]);
            $allPermissionsPagesName = JsonHelper::getJsonKey($allPermissions);
            foreach ($allPermissionsPagesName as  $pageNameFromDb) {
                if ($pageName == $pageNameFromDb) {
                }
            }
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, 'Page Name Not Exist'));
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, $th->getMessage()));
        }
    }
    public static function checkIfActionsInPageNameAlreadyExist($pageName, $actions)
    {
        try {
            $allPermissions = json_decode(self::getAllPermission()["jsonPermission"], true);
            $allActionsInPageName = $allPermissions[$pageName];
            foreach ($allActionsInPageName as  $key => $value) {
                if (in_array($key, $actions)) {
                    RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Page $key Already Exist");
                }
            }
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, $th->getMessage()));
        }
    }
    public static function updatePermission($newData)
    {
        try {
            $permission = Permission::where("id", 1)->firstOrFail();
            $permission->update($newData);
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function addOnJsonPermission($newJsonPermissions)
    {
        $allPermissions = json_decode(self::getAllPermission()["jsonPermission"], true);
        foreach ($newJsonPermissions as $key => $value) {
            $allPermissions[$key] = $value;
        }
        return $allPermissions;
    }
    public static function addOnJsonPageName($pageName, $newActions)
    {
        $allPermissions = json_decode(self::getAllPermission()["jsonPermission"], true);
        foreach ($newActions as $key => $value) {
            $allPermissions[$pageName][$key] = $value;
        }
        return $allPermissions;
    }
}

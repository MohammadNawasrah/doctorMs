<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\JsonHelper;
use Trait\Helpers\RequsetHelper;

class PermissionController extends Controller
{
    public function addNewPermission(Request $request)
    {
        $jsonPermissionKeys = JsonHelper::getJsonKey($request->input('jsonPermission'));
        $permissionFromDb = $this->getAllPermission();
        $permissionKeysFromDb = JsonHelper::getJsonKey($permissionFromDb);
        if (array_search($jsonPermissionKeys[0], $permissionKeysFromDb) !== false) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Your Page Already Exist");
        }
        $permissionFromDb[$jsonPermissionKeys[0]] = $request->input('jsonPermission')[$jsonPermissionKeys[0]];
        $permission = Permission::where("id", 1)->firstOrFail();
        $permission->update([
            "jsonPermission" => $permissionFromDb
        ]);
        return  $permissionFromDb;
    }
    public function addNewActionForPagePermission(Request $request)
    {
        $pageName = $request->input('pageName');
        $actions = $request->input('actions');
        $permissionFromDb = $this->getAllPermission();
        $permissionKeysFromDb = JsonHelper::getJsonKey($permissionFromDb);
        if (array_search($pageName, $permissionKeysFromDb) === false) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Your Page Already Exist");
        }
        $permission = Permission::where("id", 1)->firstOrFail();
        foreach ($actions as $key => $value) {
            $permissionFromDb[$pageName][$key] = $value;
        }
        $permission->update([
            "jsonPermission" => $permissionFromDb
        ]);
        return $permission;
    }
    public function getAllPermission()
    {
        $permission = Permission::where("id", 1)->firstOrFail();
        return json_decode($permission["jsonPermission"], true);
    }
}

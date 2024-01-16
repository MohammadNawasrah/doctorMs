<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Models\UserPermission;
use App\Models\Users;
use Exception;
use Illuminate\Http\Request;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;
use Trait\Helpers\UtileHelper;

class UserPermissionContrller
{
    public function setPermissionForUser(Request $request)
    {
        $userName = $request->input('userName');
        $jsonPermission = $request->input('jsonPermission');
        UtileHelper::checkIfDataEmptyOrNullJsonData($request->input());
        $user = Users::getUserByUsername($userName);

        UserPermission::updateOrAddUserPermission($user["id"], $jsonPermission);
    }
    public function getPermissionForUser(Request $request)
    {
        $userName = $request->input('userName');
        UtileHelper::checkIfDataEmptyOrNullJsonData($request->input());
        $user = Users::getUserByUsername($userName);
        UserPermission::getPermissionByUser($user);
    }
    public function updatePermissionForUser(Request $request)
    {
        $userName = $request->input('userName');
        $jsonPermission = $request->input('jsonPermission');
        UtileHelper::checkIfDataEmptyOrNullJsonData($request->input());
        $user = Users::getUserByUsername($userName);
        UserPermission::updateUserPermissionByUserId($user["id"], $jsonPermission);
        return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Permission updated Successfully");
    }
}

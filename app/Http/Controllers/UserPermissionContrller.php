<?php

namespace App\Http\Controllers;

use App\Models\UserPermission;
use App\Models\Users;
use Exception;
use Illuminate\Http\Request;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;

class UserPermissionContrller extends Controller
{
    public function setPermissionForUser(Request $request)
    {
        $userName = $request->input('userName');
        $jsonPermission = $request->input('jsonPermission');
        try {
            $user = Users::where('userName', $userName)->firstOrFail();
        } catch (Exception $e) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Name Not Exist");
        }
        $user = UserPermission::create([
            'userId' => $user["id"],
            'jsonPermission' => json_encode($jsonPermission),
        ]);
        return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Permission added Successfully");
    }
    public function getPermissionForUser(Request $request)
    {
        $userName = $request->input('userName');
        try {
            $user = Users::where('userName', $userName)->firstOrFail();
        } catch (Exception $e) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Name Not Exist");
        }
        try {
            $userPermission = UserPermission::where('userId', $user["id"])->firstOrFail();
            RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Permission For $userName");
            RequsetHelper::addResponseData("data", ["jsonPermission" => json_decode($userPermission["jsonPermission"])]);
        } catch (Exception $e) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Name Not have Permission");
        }
        return  RequsetHelper::getResponse();
    }
    public function updatePermissionForUser(Request $request)
    {
        $userName = $request->input('userName');
        $jsonPermission = $request->input('jsonPermission');
        try {
            $user = Users::where('userName', $userName)->firstOrFail();
        } catch (Exception $e) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Name Not Exist");
        }
        try {
            $userPermission = UserPermission::where('userId', $user["id"])->firstOrFail();
        } catch (Exception $e) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Name Not have Permission");
        }
        $userPermission->update([
            "jsonPermission" => json_encode($jsonPermission)
        ]);
        return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Permission updated Successfully");
    }
}

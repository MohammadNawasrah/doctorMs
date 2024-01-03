<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Exception;
use Illuminate\Http\Request;
use Trait\Helpers\GenerateHelper;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;
use Trait\Helpers\ValidationHelper;

class UsersController extends Controller
{
    use ValidationHelper;
    use GenerateHelper;
    public function getAllAdminUsers()
    {
        try {
            $users = Users::where('isAdmin', 1)->select('id', 'userName', "isOnline")->get();
            RequsetHelper::addResponseData("data", $users);
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Return Admins successfully");
        } catch (Exception $e) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Don't Have Users Admin");
        }
    }
    public function setSocketIdForUserOnline(Request $request)
    {
        $userName = $request->get("userName");
        $socketId = $request->get("socketId");
        try {
            $user = Users::where('userName', $userName)->firstOrFail();
            $user->update([
                "socketId" => $socketId,
                "isOnline" => true
            ]);
            RequsetHelper::addResponseData("data", $user);
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Return Admins successfully");
        } catch (Exception $e) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Not Exist");
        }
    }
    public function setSocketIdForUserOffline(Request $request)
    {
        $socketId = $request->get("socketId");
        try {
            $user = Users::where('socketId', $socketId)->firstOrFail();
            $user->update([
                "socketId" => null,
                "isOnline" => false
            ]);
            RequsetHelper::addResponseData("data", $user);
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Return Admins successfully");
        } catch (Exception $e) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Not Exist");
        }
    }
}

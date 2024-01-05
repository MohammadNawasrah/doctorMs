<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Models\Users;
use Exception;
use Illuminate\Http\Request;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;
use Trait\Helpers\ValidationHelper;

class LogOutController
{
    use ValidationHelper;
    public function logOut(Request $request)
    {
        session()->flush();
        $userName = $request->input('userName');
        $password = $request->input('password');
        try {
            $user = Users::where('userName', $userName)->firstOrFail();
        } catch (Exception $e) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Name Not Exist");
        }
        if (strlen($user["token"]) == 0) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "You aren't login");
        }
        if (!$this->isPasswordsEqual($password, $user["password"])) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Error in Password");
        }
        $user->update(["token" => null]);
        return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Logout successfully");
    }
}

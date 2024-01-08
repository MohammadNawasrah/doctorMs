<?php

namespace App\Http\Controllers\Auth;

use App\Models\Users;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Trait\Helpers\GenerateHelper;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\LoginHelper;
use Trait\Helpers\RequsetHelper;
use Trait\Helpers\SessionHelper;
use Trait\Helpers\UtileHelper;
use Trait\Helpers\ValidationHelper;

class LoginController
{
    use ValidationHelper;
    use GenerateHelper;
    public function index()
    {
        return SessionHelper::checkIfLogedinForView("login");
    }

    public function login(Request $request)
    {

        $userName = $request->input('userName');
        $password = $request->input('password');
        UtileHelper::checkIfDataEmptyOrNullJsonData($request->input());
        try {
            $user = Users::where('userName', $userName)->firstOrFail();
            if (!$user["status"]) {
                return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Your Account Deleted");
            }
        } catch (Exception $e) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Name Not Exist");
        }
        if (is_null($user)) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Name already Exist");
        }
        $passwordFromDB = $user["password"];
        $name = $user["firstName"] . " " . $user["lastName"];
        $validation = $this->loginValidation($userName, $password, $passwordFromDB);
        if (json_decode($validation)->status == HttpStatusCodes::HTTP_OK) {
            $userToken = $this->generateTokenByUsername($userName);
            RequsetHelper::addResponseData("data", ["token" => $userToken, "name" => $name, "userName" => $userName, "password" => $passwordFromDB, "isAdmin" => $user["isAdmin"]]);
            session(['token' => $userToken]);
            session(['userName' => $userName]);
            $user->update([
                'token' => $userToken
            ]);
        }
        return RequsetHelper::getResponse();
    }
}

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
        $user = Users::getUserByUsername($userName);
        Users::checkIfAccountDelted($userName);
        $name = $user["firstName"] . " " . $user["lastName"];
        $this->loginValidation($userName, $password, $user["password"]);
        $userToken = $this->generateTokenByUsername($userName);
        Users::updateTokenByUserName($userName, $userToken);
        session(['token' => $userToken]);
        session(['userName' => $userName]);
        RequsetHelper::addResponseData("data", ["token" => $userToken, "name" => $name, "userName" => $userName, "password" => $password, "isAdmin" => $user["isAdmin"]]);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Welcom " . $userName);
    }
}

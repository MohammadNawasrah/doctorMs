<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Models\Users;
use Illuminate\Http\Request;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;
use Trait\Helpers\UtileHelper;
use Trait\Helpers\ValidationHelper;

class RegisterController
{
    use ValidationHelper;
    public function addNewUser(Request $request)
    {
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $userName = $request->input('userName');
        $isAdmin = boolval($request->input('isAdmin'));
        $password = $request->input('password');
        $email = $request->input('email');
        $type = $request->input('type');
        if (!ctype_digit($type)) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Please fill this user type");
        }

        UtileHelper::checkIfDataEmptyOrNullJsonData($request->input());
        Users::checkIfUserNameAleradyExist($userName);
        $this->registerValidation($userName, $password, $email);
        $newUser = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'userName' => $userName,
            'password' => md5($password),
            'isAdmin' => $isAdmin,
            'email' => $email,
            'type' => $type
        ];
        Users::createNewUser($newUser);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Welcom " . $userName);
    }
}

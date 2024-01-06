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
        $isAdmin = $request->input('isAdmin');
        UtileHelper::checkIfDataEmptyOrNullJsonData($request->input());
        if ($isAdmin == 'true')
            $isAdmin = true;
        else
            $isAdmin = false;
        $password = $request->input('password');
        $email = $request->input('email');
        $user = Users::where('userName', $userName)->get();
        if (count($user) != 0) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Name already Exist");
        }
        $validation = json_decode($this->registerValidation($userName, $password, $email));
        if ($validation->status == HttpStatusCodes::HTTP_OK)
            $user = Users::create([
                'firstName' => $firstName,
                'lastName' => $lastName,
                'userName' => $userName,
                'password' => md5($password),
                'isAdmin' => $isAdmin,
                'email' => $email
            ]);
        return RequsetHelper::setResponse($validation->status, $validation->message);
    }
}

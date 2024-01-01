<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;
use Trait\Helpers\ValidationHelper;

class RegisterController extends Controller
{
    use ValidationHelper;
    public function addNewUser(Request $request)
    {
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $userName = $request->input('userName');
        $isAdmin = $request->input('isAdmin');
        $password = $request->input('password');
        $email = $request->input('email');
        $user = Users::where('userName', $userName)->get();
        if (count($user) != 0) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Name already Exist");
        }
        $validation = $this->registerValidation($userName, $password, $email);
        if ($validation["status"] == HttpStatusCodes::HTTP_OK)
            $user = Users::create([
                'firstName' => $firstName,
                'lastName' => $lastName,
                'userName' => $userName,
                'password' => md5($password),
                'isAdmin' => $isAdmin,
                'email' => $email
            ]);
        return RequsetHelper::setResponse($validation["status"], $validation["message"]);
    }
}

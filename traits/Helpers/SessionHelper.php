<?php
// File: HttpStatusCodes.php

namespace Trait\Helpers;

use App\Models\UserPermission;
use App\Models\Users;
use Illuminate\Contracts\View\View;

class SessionHelper
{
    public static function checkIfLogedinForApi()
    {
        if (!session()->has('token')) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "you are Not Login"));
        }
    }
    public static function checkIfLogedinForView($viewName)
    {
        if (!session()->has('token') && $viewName != "login") {
            return redirect()->route('index');
        }
        if (session()->has('token') && $viewName == "login") {
            return redirect()->route('dashboard');
        }

        if ($viewName == "layouts.dashboard")
            return View($viewName);
        if (UserPermission::getOnPageToUser($viewName))
            return redirect()->route('dashboard');
        // if (Users::isUserDeleted()) {
        //     return redirect()->route('logOut');
        // }
        return View($viewName);
    }
}

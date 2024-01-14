<?php
// File: HttpStatusCodes.php

namespace Trait\Helpers;

use App\Models\UserPermission;
use Illuminate\Http\Request as HttpRequest;

class SessionHelper
{
    public static function baseUrl(HttpRequest $request)
    {
        $protocol = $request->secure() ? 'https://' : 'http://';
        $hostname = $request->getHost();
        $port = $request->getPort();
        return "$protocol$hostname:$port";
    }
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

<?php

namespace Trait\Helpers;

use DateTime;
use Illuminate\Contracts\View\View;

use function GuzzleHttp\json_encode;

class LoginHelper
{
    public static function isLogedinRedirect()
    {
        if (!session()->has('userName')) {
            return 'dashboard';
        } else {
            return View("login");
        }
    }
    public static function isLogedin()
    {
        if (session()->has('userName')) {
            return true;
        } else {
            return false;
        }
    }
}

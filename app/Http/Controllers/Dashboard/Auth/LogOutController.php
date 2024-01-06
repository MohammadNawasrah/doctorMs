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
    public function logOut()
    {
        session()->flush();
        return redirect()->route("index");
    }
}

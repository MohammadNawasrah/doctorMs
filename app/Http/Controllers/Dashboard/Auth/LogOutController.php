<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Models\Users;
use Trait\Helpers\ValidationHelper;

class LogOutController
{
    use ValidationHelper;
    public function logOut()
    {
        Users::updateTokenByUserName(session()->get("userName"), null);
        session()->flush();
        return redirect()->route("index");
    }
}

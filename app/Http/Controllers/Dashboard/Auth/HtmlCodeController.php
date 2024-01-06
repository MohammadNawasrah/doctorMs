<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Models\HtmlCode;
use Illuminate\Http\Request;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;
use Trait\Helpers\SessionHelper;
use Trait\Helpers\ValidationHelper;

class HtmlCodeController
{
    public function index()
    {
        return SessionHelper::checkIfLogedinForView("htmlCode");
        // return View("HtmlCodPage");
    }
    public function getAllHtmlCode()
    {
        SessionHelper::checkIfLogedinForApi();
        $allHtmlCode = HtmlCode::getAllHtmlCode();
        RequsetHelper::addResponseData("data",  $allHtmlCode);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'HtmlCode Fetch successfully');
    }
    public function updateHtmlCode(Request $request)
    {
        SessionHelper::checkIfLogedinForApi();
        $data = $request->input("jsonData");
        foreach ($data as $key => $value) {
            HtmlCode::updateHtmlCodeByActionName($key, $value);
        }
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'updated  successfully');
    }
}

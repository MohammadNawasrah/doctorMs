<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Models\HtmlCode;
use App\Models\HtmlCodeForPage;
use App\Models\Permission;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\JsonHelper;
use Trait\Helpers\RequsetHelper;
use Trait\Helpers\SessionHelper;
use Trait\Helpers\UtileHelper;

class PermissionController
{
    public function index()
    {
        return SessionHelper::checkIfLogedinForView("permission");
    }
    public function getAllPermission()
    {
        SessionHelper::checkIfLogedinForApi();
        $allPermission = Permission::getAllPermission();
        RequsetHelper::addResponseData("data",  $allPermission);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Permissions Fetch successfully');
    }
    public function addNewPermission(Request $request)
    {
        SessionHelper::checkIfLogedinForApi();
        $jsonPermission = $request->input('jsonPermission');
        UtileHelper::checkIfDataEmptyOrNullJsonData($jsonPermission);
        $pageName = JsonHelper::getFirstKey($jsonPermission);
        if (Permission::checkIfPageNameAlreadyExist($pageName)) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, 'Page Name already Exist');
        }
        $newData = [
            "jsonPermission" => Permission::addOnJsonPermission($jsonPermission)
        ];
        Permission::updatePermission($newData);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Permission added successfully');
    }
    public function addNewActionForPagePermission(Request $request)
    {
        SessionHelper::checkIfLogedinForApi();
        $pageName = $request->input('pageName');
        $actions = $request->input('actions');
        UtileHelper::checkIfDataEmptyOrNullJsonData($request->input());
        $actionsKeys = JsonHelper::getJsonKey($actions);
        if (!Permission::checkIfPageNameAlreadyExist($pageName)) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, 'Page Name Not Exist');
        }
        $isActionExist = Permission::checkIfActionsInPageNameAlreadyExist($pageName, $actionsKeys);
        if ($isActionExist !== false) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Page $isActionExist Already Exist");
        }
        $newData = [
            "jsonPermission" => Permission::addOnJsonPageName($pageName, $actions)
        ];
        Permission::updatePermission($newData);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Actions added successfully on Page $pageName");
    }
    public function getHtmlByPermission()
    {
        SessionHelper::checkIfLogedinForApi();
        $acctionAllow = UserPermission::getOnPermissionToUser();
        $actions = HtmlCode::getHtmlCodeForPage("permission");
        $actionsSend = array();
        foreach ($acctionAllow as   $value) {
            if (isset($actions[$value]))
                array_push($actionsSend, [$value => $actions[$value]]);
        }
        RequsetHelper::addResponseData("data", $actionsSend);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Good Luck");
    }
}

<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Models\HtmlCode;
use App\Models\UserPermission;
use App\Models\Users;
use App\Models\UserType;
use Exception;
use Illuminate\Http\Request;
use Trait\Helpers\GenerateHelper;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;
use Trait\Helpers\SessionHelper;
use Trait\Helpers\UtileHelper;
use Trait\Helpers\ValidationHelper;

class UsersController
{
    use ValidationHelper;
    use GenerateHelper;
    public function index()
    {
        return SessionHelper::checkIfLogedinForView("users");
    }
    public function getAllAdminUsers()
    {
        try {
            $users = Users::where('isAdmin', 1)->where("status", true)->select('id', 'userName', "isOnline")->get();
            RequsetHelper::addResponseData("data", $users);
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Return Admins successfully");
        } catch (Exception $e) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Don't Have Users Admin");
        }
    }
    public function deleteUser(Request $request)
    {
        $userName = $request->get("userName");
        UtileHelper::checkIfDataEmptyOrNullJsonData($request->input());
        Users::deleteUser($userName);
        return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Delete User successfully");
    }
    public function getUserByUserName(Request $request)
    {
        $userName = $request->get("userName");
        UtileHelper::checkIfDataEmptyOrNullJsonData($request->input());
        try {
            $user = Users::where('userName', $userName)->firstOrFail();
            RequsetHelper::addResponseData("data", $user);
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Return User successfully");
        } catch (Exception $e) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Not Exist");
        }
    }
    public function getUserPermissions(Request $request)
    {
        $userName = $request->input("userName");
        UtileHelper::checkIfDataEmptyOrNullJsonData($request->input());
        $userPermissions = UserPermission::getUserPermissions($userName);
        RequsetHelper::addResponseData("data", $userPermissions);
        return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Return User successfully");
    }
    public function getUserPageAllowToAccess()
    {

        $acctionAllow = UserPermission::getOnPermissionPageToUser();

        $pages = HtmlCode::getHtmlCodeForPage("dashboard");
        $pagesSend = array();
        foreach ($acctionAllow as  $value) {
            if (isset($pages[$value]))
                array_push($pagesSend, [$value =>   $pages[$value]]);
        }
        RequsetHelper::addResponseData("data",  $pagesSend);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Good Luck");
    }
    public function getHtmlByPermission()
    {
        SessionHelper::checkIfLogedinForApi();
        $acctionAllow = UserPermission::getOnPermissionToUser();
        $table = '';
        $users = Users::getAdminUsers();
        foreach ($users as $user) {
            $table .= '<tr><td style="text-align: center;">' . $user . '</td>
            <td style="display: flex;justify-content: space-evenly;">
            ';
            if (in_array("addUserPermission", $acctionAllow)) {
                $table .= ' 
                <button class="btn btn-primary addPermissionsToUserModal" data-user_name="' . $user . '"  data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#addPermissionToUserModal"  data-placement="top" title="Add Permission"><i class="bi bi-plus"></i></button>';
            }
            if (in_array("updateUser", $acctionAllow)) {
                $table .= '  <button class="btn btn-success" data-toggle="tooltip" data-user_name="' . $user . '" data-placement="top" title="Update"><i class="bi bi-arrow-down-up"></i></button>';
            }
            if (in_array("deleteUser", $acctionAllow)) {
                $table .= '  <button class="btn btn-danger"  data-toggle="tooltip" id="delteUserModalButton" data-user_name="' . $user . '" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>';
            }
            $table .= "</td></tr>";
        }
        if ((in_array("addUser", $acctionAllow) || in_array("updateUser", $acctionAllow) || in_array("deleteUser", $acctionAllow)) && in_array("showUsers", $acctionAllow)) {
            array_push($acctionAllow, "usersTableShow");
        }
        HtmlCode::getHtmlCodeForPageToUpdateIt("users", "usersTableShow", $table);
        $actions = HtmlCode::getHtmlCodeForPage("users");
        $actionsSend = array();
        foreach ($acctionAllow as  $value) {
            if (isset($actions[$value]))
                array_push($actionsSend, [$value => $actions[$value]]);
        }
        RequsetHelper::addResponseData("data", $actionsSend);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Good Luck");
    }
    public function addType(Request $request)
    {
        $type = $request->input("type");
        UtileHelper::checkIfDataEmptyOrNull($type);
        UserType::addType($type);
    }
    public function getUsersType()
    {
        RequsetHelper::addResponseData("types", UserType::all());
        die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Good Luck"));
    }
}

<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Models\UserPermission;
use App\Models\Users;
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
    public function setSocketIdForUserOnline(Request $request)
    {
        $userName = $request->get("userName");
        $socketId = $request->get("socketId");
        UtileHelper::checkIfDataEmptyOrNullJsonData($request->input());
        try {
            $user = Users::where('userName', $userName)->firstOrFail();
            $user->update([
                "socketId" => $socketId,
                "isOnline" => true
            ]);
            RequsetHelper::addResponseData("data", $user);
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Return Admins successfully");
        } catch (Exception $e) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Not Exist");
        }
    }
    public function setSocketIdForUserOffline(Request $request)
    {
        $socketId = $request->get("socketId");
        UtileHelper::checkIfDataEmptyOrNullJsonData($request->input());
        try {
            $user = Users::where('socketId', $socketId)->firstOrFail();
            $user->update([
                "socketId" => null,
                "isOnline" => false
            ]);
            RequsetHelper::addResponseData("data", $user);
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Return Admins successfully");
        } catch (Exception $e) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "User Not Exist");
        }
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
        $pages = [
            "permissionPage" => '<a class="nav-link hover-link" data-url="permissions" href="http://localhost/dashboard/permissions">
        <div class="menu-btn">
            <p class="menu-text"><i class="bi bi-key custom-icon"></i>Permission</p>
        </div>
                </a>',
            "usersPage" => ' <a class="nav-link hover-link" data-url="users" href="http://localhost/dashboard/users">
                <div class="menu-btn">
                    <p class="menu-text"><i class="bi bi-person custom-icon"></i> Add New User</p>
                </div>
            </a>',
            "patientsPage" => ' <a class="nav-link hover-link" href="Data patients.html">
            <div class="menu-btn">
                <p class="menu-text"><i class="bi bi-bar-chart custom-icon"></i>Patients</p>
            </div>
            </a>',
            "schedulePage" => '                            <a class="nav-link hover-link" href="Schedule.html">
            <div class="menu-btn">
                <p class="menu-text"><i class="bi bi-alarm custom-icon"></i> Schedule</p>
            </div>
            </a>'
        ];
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
        $users = Users::getAdminUsers();
        $acctionAllow = UserPermission::getOnPermissionToUser();
        $table = '';
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
        $actions = [
            "addUser" => '
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewUserModal">
                    Add User
                </button>
                <div class="modal fade" id="addNewUserModal" tabindex="-1" aria-labelledby="addNewUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addNewUserModalLabel">Add User</h5>
                            </div>
                            <div class="modal-body">
                                <form id="addNewUserForm">
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control " id="firstNameInput" placeholder="First Name" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control " id="lastNameInput" placeholder="Last Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control" id="userNameInput" placeholder="User Name" required>
                                            </div>
                                            <div class="col">
                                                <input type="email" class="form-control" id="emailInput" aria-describedby="emailHelp" placeholder="Email" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <select style="background-color: white;border: none;outline: 1px solid black;border-radius: 2px;" class="form-select form-select-sm" aria-label="Small select example" id="userTypeInput" required>
                                            <option selected>Choose an account type</option>
                                            <option value="true">Admin</option>
                                            <option value="false">User</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input type="password" class="form-control mb-3" id="passwordInput" placeholder="Enter your password" required>
                                        </div>
                                        <div class="col">
                                            <input type="password" class="form-control" id="confirmPasswordInput" placeholder="Confirm your password" required>
                                        </div>
                                    </div>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitches">
                                        <label class="custom-control-label" for="customSwitches">User Status</label>
                                    </div>
                                    <div id="addUserMessage" class="alert alert-danger d-none" role="alert">
                                    </div>
                                    <div style="display: flex;justify-content: center;align-items: center;">
                                        <button type="submit" id="addNewUserButton" class="btn btn-primary w-100">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>',
            "usersTableShow" => $table,

        ];

        $actionsSend = array();
        foreach ($acctionAllow as  $value) {
            if (isset($actions[$value]))
                array_push($actionsSend, [$value => $actions[$value]]);
        }
        RequsetHelper::addResponseData("data", $actionsSend);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Good Luck");
    }
}

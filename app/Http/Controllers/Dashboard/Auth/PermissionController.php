<?php

namespace App\Http\Controllers\Dashboard\Auth;

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
        $actions = [
            "addNewAction" => '<button class="btn btn-success" id="addActionShowModalButton" data-toggle="modal" data-target="#addNewActionModal">Add Action</button>  
            <div class="modal fade" id="addNewActionModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content add">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showModalLabel">Add Action</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="showModalBody">
                        <div class="mb-3">
                            <div class=" row mb-3" style="display: flex; justify-content: center;">
                                <select class="form-select mb-3" id="PageNameToAddAction" aria-label="Default select example">
                                </select>
                            </div>
                            <div class="mb-3" id="actionInputs">
                                <input type="text" class="form-control mb-4" id="inputField1" placeholder="Action">
                            </div>
                            <div id="addActionsMessage" class="alert  d-none" role="alert">
                            </div>
                            <div class="row" style="display: flex;justify-content: space-around;">
                                <div>
                                    <button id="removeActionInput" class="btn btn-danger"><i class="bi bi-dash"></i></button>
                                </div>
                                <div>
                                    <button id="addActionToPageName" class="btn btn-success">add New Action</button>
                                </div>
                                <div>
                                    <button id="addActionInput" class="btn btn-primary"><i class="bi bi-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>',
            "addNewPermission"
            => '<button class="btn btn-primary"  data-toggle="modal" data-target="#addNewPermissionModal">Add Parmission</button>
            <div class="modal fade" id="addNewPermissionModal" tabindex="-1" aria-labelledby="addNewPermissionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content add">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewPermissionModalLabel">Fill the information</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <div class="mb-3">
                            <input type="text" class="form-control " id="PageNameToAddPermission" placeholder="Page Name" required>
                        </div>
                        <div class="mb-3" id="permissionInputs">
                            <input type="text" class="form-control mb-3" placeholder="Action Name" required>
                        </div>
                        <div id="addPermissionMessage" class="alert d-none" role="alert">
                        </div>
                        <div class="row" style="display: flex;justify-content: space-around;">
                            <div>
                                <button id="removePermissionInput" class="btn btn-danger"><i class="bi bi-dash"></i></button>
                            </div>
                            <div>
                                <button id="addPermission" class="btn btn-success">add New Permission</button>
                            </div>
                            <div>
                                <button id="addPermissionInput" class="btn btn-success"><i class="bi bi-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            ',
            "showPermission" => '
            <table class="table table-bordered">
            <thead class="table-bordered-custom">
                <tr>
                    <th scope="col" class="col-4" style="padding-left: 5%;">Page Name</th>
                    <th scope="col" class="col-3" style="padding-left: 5%;">Actions</th>
                </tr>
            </thead>
            <tbody id="permissionTableBody">
            </tbody>
            </table>'
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

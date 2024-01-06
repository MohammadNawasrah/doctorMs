
var permissions;
var pagesName;
$(function () {
    function fetchPermission() {
        var settings = {
            "url": "http://localhost/dashboard/permissions/getAllPermission",
            "method": "GET",
            "timeout": 0,
        };
        $.ajax(settings).done(function (response) {
            const permissionTableBody = $("#permissionTableBody");
            permissionTableBody.html("");
            response = JSON.parse(response)
            if (response.status === 200) {
                permissions = JSON.parse(response.data.jsonPermission);
                pagesName = Object.keys(permissions)
                pagesName.forEach(pageName => {
                    actionsName = Object.keys(permissions[pageName])
                    pageNameSelectOptions = "";
                    actionsName.forEach(actionName => {
                        pageNameSelectOptions += ` <option value="${actionName}">${actionName}</option>`;
                    })
                    permissionTableBody.append(`
                        <tr>
                            <td style="text-align: center;">${pageName}</td>
                            <td style="display: flex;justify-content: space-evenly;">
                                <select style="width: 200px;" class="form-select" aria-label="Default select example">
                                ${pageNameSelectOptions}
                                </select>
                            </td>
                        </tr>
                            `)
                });
                return;
            }
            permissionTableBody.append(`
                        <tr>
                            <td colspan="2" >
                                <div style="display:flex;justify-content:center">
                                    ${response.message}
                                </div>
                            </td>
                        </tr>
                            `)
        });
    }
    fetchPermission();
    $(document).on("click", "#addActionInput", function () {
        const actionInput = $("#actionInputs");
        actionInput.append(`<input type="text" class="form-control mb-4" id="inputField1" placeholder="Action"/>`);
    })
    $(document).on("click", "#removeActionInput", function () {
        const actionInput = $("#actionInputs input").last();
        actionInput.remove();
    })
    $(document).on("click", "#addPermissionInput", function () {
        const actionInput = $("#permissionInputs");
        actionInput.append(`  <input type="text" class="form-control mb-3 " id="inputField1" placeholder="Action Name" required>`);
    })
    $(document).on("click", "#removePermissionInput", function () {
        const actionInput = $("#permissionInputs input").last();
        actionInput.remove();
    })
    $(document).on("click", "#addActionShowModalButton", function () {
        PageNameToAddAction = $("#PageNameToAddAction")
        PageNameToAddAction.html("")
        pagesName.forEach(pageName => {
            PageNameToAddAction.append(`<option value="${pageName}">${pageName}</option>`)
        })
    })
    $(document).off("click", "#addPermission");
    $(document).on("click", "#addPermission", function () {
        pageName = $("#PageNameToAddPermission").val();
        actionInputs = $("#permissionInputs").children()
        actionValue = [];
        actionInputs.each(function () {
            if ($(this).val() !== "") {
                actionValue.push($(this).val())
            }
        })
        const resultActionObject = {};
        actionValue.forEach((element) => {
            resultActionObject[element] = 0;
        });
        const resultPermissionObject = {};
        resultPermissionObject[pageName] = resultActionObject;
        var settings = {
            "url": "http://localhost/dashboard/permissions/addPermission",
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/json",
                "Cookie": "laravel_session=eyJpdiI6InQwL1RqVFRNUkdRR2hkY0U5NFh0Rmc9PSIsInZhbHVlIjoiR1RKNXd5ellscU1iVzhkZnpnV1VkWHExeThFK1JVSnhZcHFzQmdxV3NKY2dYbzJMMFVPUEVLS1EwMzluM3pFR3ZGL0RVc3NxSVo4dThCcmN1VEZlK216RThHUEp3dVM1NUdMNE1HbjkrdzhSWkRIRDkzREx6dW52S0NoTE1QWG8iLCJtYWMiOiI5ZWY1NDAyMmZjMzM0YjM2YTJhYmYyODM4ZWY3M2FhOGI1MzU5MGQwMTI3NThjNWU3NTEzYWVkMDg5NzQ0N2Q2IiwidGFnIjoiIn0%3D"
            },
            "data": JSON.stringify({
                "userId": "1",
                "jsonPermission": resultPermissionObject
            }),
        };
        $.ajax(settings).done(function (response) {
            response = JSON.parse(response)
            let addPermissionMessage = $("#addPermissionMessage");
            addPermissionMessage.removeClass("d-none");
            if (response.status === 200) {
                addPermissionMessage.removeClass("alert-danger");
                addPermissionMessage.addClass("alert-success");
                addPermissionMessage.text(response.message);
                setTimeout(() => {
                    $("#addNewPermissionModal").modal("hide")
                    addPermissionMessage.addClass("d-none");
                }, 1000);
                fetchPermission();
                return;
            }
            addPermissionMessage.removeClass("alert-success");
            addPermissionMessage.addClass("alert-danger");
            addPermissionMessage.text(response.message);
        });
    })
    $(document).off("click", "#addActionToPageName");
    $(document).on("click", "#addActionToPageName", function () {
        pageNameFromSelectBox = $("#PageNameToAddAction").val();
        actionInputs = $("#actionInputs").children()
        actionValue = [];
        actionInputs.each(function () {
            if ($(this).val() !== "") {
                actionValue.push($(this).val())
            }
        })
        const resultActionObject = {};
        actionValue.forEach((element) => {
            resultActionObject[element] = 0;
        });
        var settings = {
            "url": "http://localhost/dashboard/permissions/addNewActionForPagePermission",
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/json",
            },
            "data": JSON.stringify({
                "pageName": pageNameFromSelectBox,
                "actions": resultActionObject
            }),
        };

        $.ajax(settings).done(function (response) {
            response = JSON.parse(response)
            let addActionsMessage = $("#addActionsMessage");
            addActionsMessage.removeClass("d-none");
            if (response.status === 200) {
                addActionsMessage.removeClass("alert-danger");
                addActionsMessage.addClass("alert-success");
                addActionsMessage.text(response.message);
                setTimeout(() => {
                    $("#addNewActionModal").modal("hide")
                    addActionsMessage.addClass("d-none");
                }, 1000);
                fetchPermission();
                return;
            }
            addActionsMessage.removeClass("alert-success");
            addActionsMessage.addClass("alert-danger");
            addActionsMessage.text(response.message);
        });
    })
})
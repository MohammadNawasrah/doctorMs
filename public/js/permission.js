

$(function () {
    const fetchHtmlCodeByPermission = () => {
        ajax({
            URL: Permissions.getHtmlByPermission,
            METHOD: "POST",
            callBackFunction: function (response) {
                if (response.status === 200) {
                    data = response.data;
                    data.forEach(permission => {
                        let keys = Object.keys(permission)
                        keys.forEach(element => {
                            $(`[data-permission=${element}]`).append(permission[element])
                        });
                    })
                    Loader.removeLoadPage();
                    fetchPermission();
                    addRemoveInputsPermission();
                    addNewPermission();
                    addNewActionToPage();
                    addRemoveInputsActions();
                }
            }
        });
    }
    const fetchPermission = () => {
        ajax({
            URL: Permissions.getAllPermission,
            METHOD: "GET",
            callBackFunction: (response) => {
                const permissionTableBody = $("#permissionTableBody");
                permissionTableBody.html("");
                Loader.removeLoadPage();
                if (response.status === 200) {
                    let permissions = JSON.parse(response.data.jsonPermission);
                    let pagesName = Object.keys(permissions)
                    pagesName.forEach(element => {
                        $("#PageNameToAddAction").append(` <option value="${element}">${element}</option>`);
                    })
                    pagesName.forEach(pageName => {
                        let actionsName = Object.keys(permissions[pageName])
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
                permissionTableBody.append(`<tr>
                                            <td colspan="2" >
                                                <div style="display:flex;justify-content:center">
                                                ${response.message}
                                                </div>
                                            </td>
                                        </tr>`);
            }
        });
    }
    const addRemoveInputsPermission = () => {
        $(document).on("click", "#addPermissionInput", function () {
            const actionInput = $("#permissionInputs");
            actionInput.append(`  <input type="text" class="form-control mb-3 " name="actions[]" id="inputField1" placeholder="Action Name" required>`).attr("name", "actions[]");
        })
        $(document).on("click", "#removePermissionInput", function () {
            const actionInput = $("#permissionInputs input").last();
            actionInput.remove();
        })
    }
    const addRemoveInputsActions = () => {
        $(document).on("click", "#addActionInput", function () {
            const actionInput = $("#actionInputs");
            actionInput.append(`  <input type="text" class="form-control mb-3 " name="actions[]" id="inputField1" placeholder="Action" required>`);
        })
        $(document).on("click", "#removeActionInput", function () {
            const actionInput = $("#actionInputs input").last();
            actionInput.remove();
        })
    }
    const addNewPermission = () => {
        $(document).off("click", "#addPermission");
        $(document).on("click", "#addPermission", function () {
            ajax({
                FORMID: "addNewPermissionForm",
                METHOD: "POST",
                showAlert: true,
                callBackFunction: function (response) {
                    if (response.status === 200) {
                        setTimeout(() => {
                            $(".close").trigger("click")
                            fetchPermission();
                        }, 1000);
                        return;
                    }
                }
            });
        })
    }
    const addNewActionToPage = () => {
        $(document).off("click", "#addActionToPageName");
        $(document).on("click", "#addActionToPageName", function () {
            ajax({
                FORMID: "addNewActionForm",
                showAlert: true,
                callBackFunction: function (response) {
                    if (response.status === 200) {
                        setTimeout(() => {
                            $(".close").trigger("click")
                            fetchPermission();
                        }, 1000);
                        return;
                    }
                }
            })
        })
    }
    fetchHtmlCodeByPermission();
})


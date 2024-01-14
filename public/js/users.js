
var selectedUser = ""
var pagesName;

$(function () {
    const getUserTypes = () => {
        $(document).on("click", "#addUserButtonModal", function () {
            ajax({
                URL: baseUrl() + "/dashboard/users/getUsersType",
                METHOD: "POST",
                callBackFunction: function (response) {
                    var options = "";
                    if (response.status === 200) {
                        response.types.forEach((element, index) => {
                            options += '<option value=' + element.id + '>' + element.type + "</option>";
                        });
                        console.log(options)
                        $('#usersType').html(options)
                    }
                }
            })
        })
    }
    const addNewUserType = () => {
        $(document).on("click", "#addNewUserType", function () {
            ajax({
                FORMID: "addNewUserTypeForm",
                showAlert: true,
                callBackFunction: function (response) {
                    if (response.status === 200) {
                        $(".close").trigger("click")
                        fetchHtmlPage();
                    }
                }
            });
        })
    }
    const addNewUser = () => {
        $(document).off("click", '#addNewUserButton')
        $(document).on("click", '#addNewUserButton', function (event) {
            ajax({
                FORMID: "addNewUserForm",
                showAlert: true,
                callBackFunction: function (response) {
                    if (response.status === 200) {
                        $(".close").trigger("click");
                        fetchHtmlPage();
                    }
                }
            })
        })
    }
    const getPermissionToShowForUser = () => {
        $(document).off("click", ".addPermissionsToUserModal")
        $(document).on("click", ".addPermissionsToUserModal", function () {
            selectedUser = $(this).data("user_name");
            ajax({
                URL: Users.getUserPermissions,
                METHOD: "POST",
                DATA: { "userName": selectedUser },
                callBackFunction: function (response) {
                    jsonPermission = response.data;
                    const pagesNamePermission = $("#pagesNamePermission");
                    pagesNamePermission.html("<option selected>Choose Page</option>");
                    actionsPermissionForUsers = $("#actionsPermissionForUsers");
                    actionsPermissionForUsers.html("")
                    pagesName = Object.keys(jsonPermission);
                    pagesName.forEach(pageName => {
                        let actions = Object.keys(jsonPermission[pageName])
                        let pagesName = `<option value="${pageName}">${pageName}</options>`;
                        pagesNamePermission.append(pagesName);
                        actions.forEach(action => {
                            isChecked = jsonPermission[pageName][action] === 1 ? true : false;
                            let actionValue = `                       
                            <div class="custom-control custom-switch mb-3 d-none baseOfActions" data-page_name_base="${"base" + pageName}">
                                <input type="checkbox" class="custom-control-input" ${isChecked ? "checked" : ""} data-page_name="${pageName}" data-action_name="${action}"  id="${pageName + action}">
                                <label class="custom-control-label" for="${pageName + action}">${action}</label>
                            </div>`
                            actionsPermissionForUsers.append(actionValue)
                        });
                    })
                }
            });
        })
    }
    const fetchHtmlPage = () => {
        ajax({
            URL: Users.getHtmlByPermission,
            METHOD: 'POST',
            callBackFunction: function (response) {
                if (response.status == 200) {
                    data = response.data;
                    data.forEach(permission => {
                        keys = Object.keys(permission)
                        keys.forEach(element => {
                            $(`[data-permission=${element}]`).html("")
                            $(`[data-permission=${element}]`).append(permission[element])
                        });
                    })
                }
            }
        })
    }
    const onChangePageNameToChangePermissionForUser = () => {
        $(document).on("change", "#pagesNamePermission", function () {
            let pageName = $(this).val();
            let actions = $(`[data-page_name_base='${"base" + pageName}']`);
            $(".baseOfActions").addClass("d-none");
            actions.removeClass("d-none");
        })
    }
    fetchHtmlPage();
    addNewUser();
    getUserTypes();
    addNewUserType();
    getPermissionToShowForUser();
    onChangePageNameToChangePermissionForUser();






    $(document).on("click", "#savePermissionToUser", function () {
        let JsonPermaission = {};
        pagesName.forEach(pageName => {
            let actions = {};
            $(`[data-page_name="${pageName}"]`).each((index, element) => {
                $(element).prop("checked")
                actions[$(element).data("action_name")] = $(element).prop("checked") ? 1 : 0;
            })
            JsonPermaission[pageName] = actions;
        });
        var settings = {
            "url": UserPermission.updatePermissionForUser,
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/json"
            },
            "data": JSON.stringify({
                "userName": selectedUser,
                "jsonPermission": JsonPermaission
            }),
        };
        selectedButton = $(this)
        Loader.addLoader(selectedButton)
        $.ajax(settings).done(function (response) {
            response = JSON.parse(response)
            if (response.status === 200) {
                Message.addMessage(response.message, selectedButton, "success");
                setTimeout(() => {
                    if (sessionStorage.getItem("userName") === selectedUser) {
                        location.reload();
                    }
                    $(".close").trigger("click");
                    Loader.removeLoader();
                }, 1000);
                return;
            }
            Loader.removeLoader();
            Message.addMessage(response.message, selectedButton, "danger");
        });
    })

    $(document).on("click", "#delteUserModalButton", function () {
        selectedUser = $(this).data("user_name");
        $("#deleteUserModal").modal("show")
    })
    $(document).on("click", "#deleteUser", function () {
        var settings = {
            "url": Users.deleteUser,
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/json",
            },
            "data": JSON.stringify({
                "userName": selectedUser
            }),
        };
        selectedButton = $(this)
        Loader.addLoader(selectedButton)
        $.ajax(settings).done(function (response) {
            response = JSON.parse(response)
            if (response.status === 200) {
                Message.addMessage(response.message, selectedButton, "success");
                setTimeout(() => {
                    $(".close").trigger("click")
                    Loader.removeLoader();
                }, 1000);
                fetchHtmlPage();
                return;
            }
            Loader.removeLoader();
            Message.addMessage(response.message, selectedButton, "danger");
        })
    })
})



var selectedUser = ""
var pagesName;
$(function () {

    $(document).off("click", '#addNewUserButton')
    $(document).on("click", '#addNewUserButton', function (event) {
        event.preventDefault();
        if ($("#userTypeInput").val() === "Choose an account type") {
            let message = $("#addUserMessage")
            message.removeClass("d-none");
            message.removeClass("alert-success");
            message.addClass("alert-danger");
            message.text("please chose type of user");
            return;
        }
        var settings = {
            "url": "http://localhost/dashboard/users/register",
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/json",
            },
            "data": JSON.stringify({
                "firstName": $("#firstNameInput").val(),
                "lastName": $("#lastNameInput").val(),
                "userName": $("#userNameInput").val(),
                "email": $("#emailInput").val(),
                "isAdmin": $("#userTypeInput").val(),
                "password": $("#passwordInput").val()
            }),
        };
        Loader.addLoader($(this));
        $.ajax(settings).done(function (response) {
            let addUserMessage = $("#addUserMessage");
            response = JSON.parse(response)
            addUserMessage.removeClass("d-none");
            if (response.status === 200) {
                addUserMessage.removeClass("alert-danger");
                addUserMessage.addClass("alert-success");
                addUserMessage.text(response.message);
                fetchAllUsers();
                setTimeout(() => {
                    $("#addNewUserModal").modal("hide")
                    Loader.removeLoader()
                }, 500)
                return;
            }
            Loader.removeLoader()
            addUserMessage.removeClass("alert-success");
            addUserMessage.addClass("alert-danger");
            addUserMessage.text(response.message);
        });
    })
    $(document).off("click", ".addPermissionsToUserModal")
    $(document).on("click", ".addPermissionsToUserModal", function () {
        selectedUser = $(this).data("user_name");
        var settings = {
            "url": "http://localhost/dashboard/users/getUserPermissions",
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/json",
            },
            "data": JSON.stringify({
                "userName": selectedUser
            }),
        };
        $.ajax(settings).done(function (response) {
            response = JSON.parse(response);
            if (response.status === 200) {
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
    $(document).on("change", "#pagesNamePermission", function () {
        let pageName = $(this).val();
        let actions = $(`[data-page_name_base='${"base" + pageName}']`);
        $(".baseOfActions").addClass("d-none");
        actions.removeClass("d-none");
    })
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
            "url": "http://localhost/dashboard/userPermission/setPermissionForUser",
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
        Loader.addLoader($(this));
        let savePermissionToUserMessage = $("#savePermissionToUserMessage");
        $.ajax(settings).done(function (response) {
            savePermissionToUserMessage.removeClass("d-none");
            response = JSON.parse(response)
            if (response.status === 200) {
                savePermissionToUserMessage.removeClass("alert-danger");
                savePermissionToUserMessage.addClass("alert-success");
                savePermissionToUserMessage.text(response.message);
                setTimeout(() => {
                    Loader.removeLoader();
                    $("#addPermissionToUserModal").modal("hide");
                    savePermissionToUserMessage.addClass("d-none");
                    if (sessionStorage.getItem("userName") === selectedUser) {
                        location.reload();
                    }
                }, 1000)
                return;
            }
            Loader.removeLoader();
            savePermissionToUserMessage.removeClass("alert-success");
            savePermissionToUserMessage.addClass("alert-danger");
            savePermissionToUserMessage.text(response.message);
        });
    })
    function fetch() {
        var settings = {
            "url": "http://localhost/dashboard/users/getHtmlByPermission",
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/json",
                "Cookie": "laravel_session=eyJpdiI6IldHR2hob2ZMaFM1NWhuMkdrMGRqcXc9PSIsInZhbHVlIjoiQUZheG12eDBlTnJsOUpuelovbDY5a2IrcW1yZ21PaHhwSXJQVTZJT1pNTjczZmgyRkNqOVpaellKQnV3WVJmZGlKZ0tLRTFNRUl2LzN5dzg5L2pYeCtROWpQS3ZLZ1A2SitWODlQc3BnQzhCTlJMTU1McEJlMXl6Nm9IaUl3OVciLCJtYWMiOiJhZTcxMzg5OWQxMmQwNGU0MzlkMDQ4YzIxNWNhM2YzNGYyMWJiNmRmZjEwMTE0N2QzN2IzMTFkMjYwZGQwZWQ3IiwidGFnIjoiIn0%3D"
            },
            "data": JSON.stringify({
                "userName": sessionStorage.getItem("userName")
            }),

        };

        $.ajax(settings).done(function (response) {
            response = JSON.parse(response);
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

        });
    }
    fetch();
    $(document).on("click", "#delteUserModalButton", function () {
        selectedUser = $(this).data("user_name");
        $("#deleteUserModal").modal("show")
    })
    $(document).on("click", "#deleteUser", function () {
        var settings = {
            "url": "http://localhost/dashboard/users/user/delete",
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/json",
            },
            "data": JSON.stringify({
                "userName": selectedUser
            }),
        };
        Loader.addLoader($(this));
        let deleteUserMessageModal = $("#deleteUserMessageModal");
        $.ajax(settings).done(function (response) {
            deleteUserMessageModal.removeClass("d-none");
            response = JSON.parse(response)
            if (response.status === 200) {
                deleteUserMessageModal.removeClass("alert-danger");
                deleteUserMessageModal.addClass("alert-success");
                deleteUserMessageModal.text(response.message);
                setTimeout(() => {
                    Loader.removeLoader();
                    $("#deleteUserModal").modal("hide");
                    deleteUserMessageModal.addClass("d-none");
                    fetch();
                    if (sessionStorage.getItem("userName") === selectedUser) {
                        location.reload();
                    }
                }, 1000)
                return;
            }
            Loader.removeLoader();
            deleteUserMessageModal.removeClass("alert-success");
            deleteUserMessageModal.addClass("alert-danger");
            deleteUserMessageModal.text(response.message);
        })
    })
})

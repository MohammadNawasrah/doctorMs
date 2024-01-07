
var selectedUser = ""
var pagesName;
$(function () {

    $(document).off("click", '#addNewUserButton')
    $(document).on("click", '#addNewUserButton', function (event) {
        event.preventDefault();
        selectedButton = $(this)
        if ($("#userTypeInput").val() === "Choose an account type") {
            Message.addMessage("Please Fill user type", selectedButton, "danger");
            return;
        }
        var settings = {
            "url": Users.register,
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

        Loader.addLoader(selectedButton)
        $.ajax(settings).done(function (response) {
            response = JSON.parse(response)
            if (response.status === 200) {
                Message.addMessage(response.message, selectedButton, "success");
                setTimeout(() => {
                    $("#addNewUserModal").modal("hide")
                    Loader.removeLoader();
                    fetch();
                }, 1000);
                return;
            }
            Loader.removeLoader();
            Message.addMessage(response.message, selectedButton, "danger");
        });
    })
    $(document).off("click", ".addPermissionsToUserModal")
    $(document).on("click", ".addPermissionsToUserModal", function () {
        selectedUser = $(this).data("user_name");
        var settings = {
            "url": Users.getUserPermissions,
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
                    $("#addPermissionToUserModal").modal("hide");
                    Loader.removeLoader();
                }, 1000);
                return;
            }
            Loader.removeLoader();
            Message.addMessage(response.message, selectedButton, "danger");
        });
    })
    function fetch() {
        var settings = {
            "url": Users.getHtmlByPermission,
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
                    $("#deleteUserModal").modal("hide")
                    Loader.removeLoader();
                }, 1000);
                return;
            }
            Loader.removeLoader();
            Message.addMessage(response.message, selectedButton, "danger");
        })
    })
})

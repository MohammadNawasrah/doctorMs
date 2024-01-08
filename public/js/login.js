

class LoginPage {
    static login(userName, password, selectedButton) {
        let ajax = new AjaxHelper(Login.login);
        let data = {
            "userName": userName,
            "password": password
        }
        ajax.sendPost(data, "",
            (response) => LoginPage.onResponse(response, selectedButton),
            () => LoginPage.beforeResponse(selectedButton)
        );
    }
    static onResponse(response, selectedButton) {
        response = JSON.parse(response)
        if (response.status === 200) {
            console.log(response);
            Message.addMessage(response.message, selectedButton, "success");
            sessionStorage.setItem("userName", response.data.userName);
            sessionStorage.setItem("nameOfUser", response.data.name);
            sessionStorage.setItem("userToken", response.data.token);
            setTimeout(() => {
                Loader.removeLoader();
                window.location.href = Dashboard.dashboard;
            }, 500)
            return;
        }
        Loader.removeLoader();
        Message.addMessage(response.message, selectedButton, "danger");
    }
    static beforeResponse(selectedButton) {
        Loader.addLoader(selectedButton)
    }
}

$(function () {
    $(document).off("click", "#loginButton");
    $(document).on("click", "#loginButton", function (event) {
        event.preventDefault();
        LoginPage.login($("#userName").val(), $("#password").val(), $(this));
    })
});

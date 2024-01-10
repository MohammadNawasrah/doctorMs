
$(function () {
    const onLoginButtonClick = () => {
        $(document).off("click", "#loginButton");
        $(document).on("click", "#loginButton", function () {
            ajax({
                FORMID: "loginForm", showAlert: true,
                callBackFunction: function (response) {
                    if (response.status === 200) {
                        setTimeout(() => window.location.href = '/dashboard', 1000);
                        sessionStorage.setItem("userName", response.data.userName);
                        sessionStorage.setItem("nameOfUser", response.data.name);
                        sessionStorage.setItem("userToken", response.data.token);
                    }
                }
            })
        })
    }
    onLoginButtonClick();
});

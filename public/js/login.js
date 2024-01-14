
$(function () {
    const onLoginButtonClick = () => {
        $(document).off("click", "#loginButton");
        $(document).on("click", "#loginButton", function () {
            ajax({
                FORMID: "loginForm", showAlert: true,
                callBackFunction: function (response) {
                    if (response.status === 200) {
                        setTimeout(() =>{
                        if(response.data.type==="doctor")
                        window.location.href = '/dashboard/doctor'
                    if(response.data.type==="secretary")
                    window.location.href = '/dashboard/patients'
                else
                window.location.href = '/dashboard'


                    }
                    , 1000);
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

$(function () {
    $(document).off("click", "#loginButton");
    $(document).on("click", "#loginButton", function (event) {
        event.preventDefault();
        var settings = {
            "url": Login.login,
            "method": "POST",
            "headers": {
                "XSRF-TOKEN": "eyJpdiI6IjJ0UUFmMVBFNkdCMS94Rm5JeXBVMFE9PSIsInZhbHVlIjoibWNqS1I2MEUzcDZlT0VQRmpNSDhyUHRrWC8vVlM0c3FUQklTS1prOEN5ZlI4N0JNeW5hWFNHTExKNi9kNGU4TVY5M3U5WW5oNTZZSHFSNXBMTEdMSGJETHZTdmRBcTRVKzhWcmU4TGJNdW9ZYWxUTVJ3dW02ZjVtTWtFNXpEL1UiLCJtYWMiOiIzNjNjOWRmZTgwM2ViYzcxZmEzNzhiZmVmOTc3YjMxMjM0ZDc3NjllYzJlNmQ5Y2YxNTEwZGY4YTUxN2UxMWY4IiwidGFnIjoiIn0%3D",
                "Content-Type": "application/json",
            },
            "data": JSON.stringify({
                "userName": $("#userName").val(),
                "password": $("#password").val()
            }),
        };
        Loader.addLoader($(this))
        let loginMessage = $("#loginMessage");
        $.ajax(settings).done(function (response) {
            response = JSON.parse(response)
            loginMessage.removeClass("d-none");
            if (response.status === 200) {
                loginMessage.removeClass("alert-danger");
                loginMessage.addClass("alert-success");
                loginMessage.text(response.message);
                sessionStorage.setItem("userName", response.data.userName)
                setTimeout(() => {
                    Loader.removeLoader();
                    window.location.href = Dashboard.dashboard;
                }, 500)
                return;
            }
            loginMessage.removeClass("alert-success");
            loginMessage.addClass("alert-danger");
            loginMessage.text(response.message);
            Loader.removeLoader();
        });
    })
});
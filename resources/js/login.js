$(function () {
    $("#login").off("submit");
    $("#login").on("submit", function (event) {
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
        let message = $("#loginMessage");
        $.ajax(settings).done(function (response) {
            response = JSON.parse(response)
            message.removeClass("d-none");
            if (response.status === 200) {
                message.removeClass("alert-danger");
                message.addClass("alert-success");
                message.text(response.message);
                localStorage.setItem("userName", response.data.userName)
                window.location.href = Dashboard.users;
                return;
            }
            message.removeClass("alert-success");
            message.addClass("alert-danger");
            message.text(response.message);
        });
    })
});
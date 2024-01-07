
try {
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
            var selectedButton = $(this)
            $.ajax(settings).done(function (response) {
                response = JSON.parse(response)
                if (response.status === 200) {
                    Message.addMessage(response.message, selectedButton, "success");
                    sessionStorage.setItem("userName", response.data.userName)
                    setTimeout(() => {
                        Loader.removeLoader();
                        window.location.href = Dashboard.dashboard;
                    }, 500)
                    return;
                }
                Loader.removeLoader();
                Message.addMessage(response.message, selectedButton, "danger");
            });
        })
    });
} catch (error) {

}
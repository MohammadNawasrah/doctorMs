<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{url('/css/main.css')}}">
    <link rel="stylesheet" href="{{ url('/css/animations.css')}}">
    <link rel="stylesheet" href="{{ url('/css/login.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
    <center>
        <div class="container">
            <table style="margin: 0;padding: 0;width: 60%;">
                <tr>
                    <td>
                        <p class="header-text">Welcome Back!</p>
                    </td>
                </tr>
                <div class="form-body">
                    <form id="login" method="POST">
                        <tr>
                            <td>
                                <p class="sub-text">Login with your details to continue</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td">
                                <label for="userName" class="form-label">Email: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td">
                                <input type="textt" id="userName" name="userName" class="input-text" placeholder="User Name" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td">
                                <label for="userpassword" class="form-label">Password: </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="label-td">
                                <input type="password" id="password" name="userpassword" class="input-text" placeholder="Password" required>
                            </td>
                        </tr>
                        <tr>
                            <td><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div>
                                    <div id="message"></div>
                                    <button type="submit" class="login-btn btn-primary btn">Login</button>
                                </div>
                            </td>
                        </tr>
                    </form>
                </div>
            </table>
        </div>
    </center>
    <script>
        $(document).ready(function() {
            $("#login").off("submit");
            $("#login").on("submit", function(event) {
                event.preventDefault();
                var settings = {
                    "url": "http://localhost/login",
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
                let message = $("#message");
                $.ajax(settings).done(function(response) {
                    if (response.status === 200) {
                        message.css({
                            "display": "flex",
                            "background-color": "#d4edda"
                        })
                        message.text(response.message);
                        window.location.href = "http://localhost/dashboard";
                        return;
                    }
                    message.css({
                        "display": "flex",
                        "background-color": "#f8d7da"
                    })
                    message.text(response.message);
                    // #d4edda
                });
            })
        })
    </script>
</body>

</html>
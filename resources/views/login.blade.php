<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/bootstrap5.3.0/bootstrap.min.css','resources/css/login.css'])
    <script src="{{mix('resources/js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{mix('resources/js/login.js')}}"></script>
    <script src="{{mix('resources/js/route.js')}}"></script>
    <script src="{{mix('resources/js/mainFunction.js')}}"></script>
    <title>Login</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h3 class="card-title header-text">Welcome Back!</h3>
                        <p class="card-text sub-text mb-5">Login with your details to continue</p>
                        <form id="login" method="POST">
                            <div class="mb-5">
                                <input type="text" id="userName" style=" width:80%; margin-left: 10%;" class="form-control" placeholder="username" required>
                            </div>
                            <div class="mb-5">
                                <input type="password" id="password" style=" width:80%; margin-left: 10%;" class="form-control" placeholder="Password" required>
                            </div>
                            <div id="loginMessage" class="alert alert-danger d-none" role="alert">
                            </div>
                            <div class="mb-5">
                                <input type="submit" id="loginButton" style="width: 80%;" value="Login" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
</body>

</html>
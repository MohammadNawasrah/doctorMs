<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap5.3.0/bootstrap.min.css">
    <link rel="stylesheet" href="/css/login.css">
    <script src="/js/jquery/jquery-3.7.1.min.js"></script>
    <script src="/js/util/route.js"></script>
    <script src="/js/login.js"></script>
    <script src="/js/util/mainClass.js"></script>
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h3 class="card-title header-text">Welcome Back!</h3>
                        <p class="card-text sub-text mb-5">Login with your details to continue</p>
                        <form id="loginForm" method="POST">
                            <div class="mb-5">
                                <input type="text" name="userName" id="userName" style=" width:80%; margin-left: 10%;" class="form-control" placeholder="username" required>
                            </div>
                            <div class="mb-5">
                                <input type="password" name="password" id="password" style=" width:80%; margin-left: 10%;" class="form-control" placeholder="Password" required>
                            </div>
                            <div id="loginMessage" class="alert alert-danger d-none" role="alert">
                            </div>
                            <div style="display: flex;justify-content: center ;align-items: center; flex-direction: column; text-align: center;">
                                <div class="mb-5">
                                    <button type="submit" id="loginButton" style="width: 100%;" class="btn btn-primary">Login</button>
                                </div>
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
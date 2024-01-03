<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('/css/main.css')}}">
    <link rel="stylesheet" href="{{ url('/css/animations.css')}}">
    <link rel="stylesheet" href="{{ url('/css/admin.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.socket.io/4.7.2/socket.io.min.js" integrity="sha384-mZLF4UVrpi/QTWPA7BjNPEnkIfRFn4ZEO3Qt/HFklTJBj/gBOV8G3HcKn4NfQblz" crossorigin="anonymous"></script>
    <script>
        var ipAddress = "127.0.0.1";
        var socketPort = "3000";
    </script>
    <title>@yield('title', 'Your App')</title>
    @vite(['resources/css/admin.css','resources/css/main.css','resources/css/animations.css'])
</head>

<body>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="{{ url('image/user.png')}}" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p id="userName" class="profile-title"></p>
                                    <p class="profile-subtitle">aseel</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="logout.php"><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active">
                        <a href="{{ url('/dashboard/users') }}" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text">Users</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord  ">
                        <a href="{{ url('/dashboard/permissions') }}" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text">Permissions</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-patient">
                        <a href="addnewuser.html" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Add New User</p>
                            </div>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <script>
            $(function() {
                $("#userName").text(localStorage.getItem("userName"))
            })
        </script>
        @yield('content')
    </div>

</body>

</html>
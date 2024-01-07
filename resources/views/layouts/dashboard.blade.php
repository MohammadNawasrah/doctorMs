<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap5.3.0/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap5.3.0/bootstrap.min.css">
    <title>@yield('title', 'Your App')</title>
    <style>
        /* Add your custom styles here if needed */
        .hover-effect:hover {
            background-color: #0d6efd;
            /* تحديد لون الخلفية عند هوفر */
            color: #fff;
            /* تحديد لون النص عند هوفر */
            border-color: #0d6efd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .hover-link:hover {
            background-color: #e3efff;
            /* تحديد لون الخلفية عند هوفر */
            color: #0d6efd;
            /* تحديد لون النص عند هوفر */
        }

        a {
            color: black;
        }

        p:hover {
            background-color: #e3efff;
            /* تحديد لون الخلفية عند هوفر */
            color: #0d6efd;
            /* تحديد لون النص عند هوفر */
        }

        p {
            color: black;
        }

        .menu-active {
            color: #0d6efd;
            border-right: 7px solid #0d6efd;
        }

        .btn-blue {
            background-color: #b7d4fa;
            color: #0d6efd;
        }

        .custom-icon {
            font-size: 20px;
            /* الحجم الذي تريده (20px × 20px في هذا المثال) */
        }

        .custom-icons {
            font-size: 60px;
            /* الحجم الذي تريده (20px × 20px في هذا المثال) */
        }

        .table-bordered-custom {
            border-bottom: 2px solid #0A76D8;
        }

        .p-active {
            color: #0d6efd;
        }

        select {
            outline: none;
            border: 1px solid #ced4da;
            padding: 0.375rem 2rem 0.375rem 0.75rem;
            /* Increased right padding for the arrow */
            font-size: 1rem;
            line-height: 1.5;
            background-color: #fff;
            background-image: url('arrow-down.png');
            /* Replace 'arrow-down.png' with your arrow image */
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            /* Adjust the position as needed */
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            width: 100%;
        }

        /* Style for when the select is focused */
        select:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
    </style>
    <script src="/js/jquery/jquery-3.7.1.min.js"></script>
    <script src="/js/util/mainClass.js"></script>
    <script src="/js/util/route.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row" style="height: 100vh;">
            <!-- Sidebar -->
            <nav class="col-3 ml-sm-md-auto bg-light sidebar shadow" style="height: 100%; ">
                <div class="sidebar-sticky">

                    <!-- Profile Section -->

                    <div class="row">
                        <div class="col-md-3" style="margin-top:15%; margin-left: 10%;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z" />
                            </svg>
                        </div>
                        <div class="col-md-7" style="margin-top: 15%;">
                            <h4 id="userName" class="profile-title"></h4>
                            <p class="profile-subtitle">aseel</p>
                        </div>
                    </div>
                    <a href="{{ url('/dashboard/logOut') }}" class="btn btn-blue btn-block hover-effect">Log out</a>
                    <hr class="my-4 border">
                    <!-- Menu Items -->
                    <ul class="nav flex-column">
                        <li class="nav-item" data-permission="schedulePage">

                        </li>
                        <li class="nav-item" data-permission="patientsPage">

                        </li>
                        <li class="nav-item" data-permission="permissionPage">

                        </li>
                        <li class="nav-item" data-permission="usersPage">

                        </li>
                        <li class="nav-item" data-permission="htmlCodePage">

                        </li>
                    </ul>
                </div>
            </nav>
            <script>
                $(function() {
                    var settings = {
                        "url": Dashboard.userPageToAccess,
                        "method": "POST",
                        "timeout": 0,
                    };
                    $.ajax(settings).done(function(response) {
                        console.log(response)
                        response = JSON.parse(response);
                        if (response.status == 200) {
                            data = response.data;
                            data.forEach(permission => {
                                keys = Object.keys(permission)
                                keys.forEach(element => {
                                    $(`[data-permission=${element}]`).append(permission[element])
                                });
                            })
                        }
                        $(`[data-url="${lastSegment}"]`).addClass("menu-active");
                    });
                    $("#userName").text(sessionStorage.getItem("userName"))
                    const urlSegments = window.location.pathname.split('/');
                    const lastSegment = urlSegments[urlSegments.length - 1];

                })
            </script>
            @yield('content')
        </div>

</body>

</html>
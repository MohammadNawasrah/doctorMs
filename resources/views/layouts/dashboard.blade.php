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
            <nav class=" bg-light sidebar shadow" style="height: 100%;width:350px; display:flex; flex-direction: column; ">
                <div style="display: flex; margin:10px">
                    <img style="width: 100px;border-radius: 50%;" src="data:image/jpeg;base64,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" alt="">
                    </img>
                    <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;gap: 15px;margin-left: 20px;">
                        <div id="userName" class="profile-title"></div>
                        <div class="profile-subtitle" id="nameOfUser" style="display: flex;width: max-content"></div>
                    </div>
                </div>
                <div class="sidebar-sticky">
                    <div style="display: flex;justify-content: center;align-items: center;"> <a style="width: 80%;" href="{{ url('/dashboard/logOut') }}" class="btn btn-blue btn-block hover-effect">Log out</a> </div>
                    <hr class="my-4 border"> <!-- Menu Items -->
                    <ul class="nav flex-column">
                        <li class="nav-item" data-permission="schedulePage"> </li>
                        <li class="nav-item" data-permission="patientsPage"> </li>
                        <li class="nav-item" data-permission="permissionPage"> </li>
                        <li class="nav-item" data-permission="usersPage"> </li>
                        <li class="nav-item" data-permission="htmlCodePage"> </li>
                        <li class="nav-item" data-permission="patientsPage">
                            <a class="nav-link hover-link" data-url="patient" href="/dashboard/patients">
                                <div class="menu-btn">
                                    <p class="menu-text"><i class="bi bi-key custom-icon"></i>Patients</p>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" data-permission="patientsPage">
                            <a class="nav-link hover-link" data-url="patient" href="/dashboard/patients">
                                <div class="menu-btn">
                                    <p class="menu-text"><i class="bi bi-key custom-icon"></i>Patients</p>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" data-permission="patientsPage">
                            <a class="nav-link hover-link" data-url="patient" href="/dashboard/patients">
                                <div class="menu-btn">
                                    <p class="menu-text"><i class="bi bi-key custom-icon"></i>Patients</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
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
                        console.log(lastSegment)
                        $(`[data-url="${lastSegment}"]`).addClass("menu-active");
                    });
                    $("#userName").text(sessionStorage.getItem("userName"))
                    $("#nameOfUser").text(sessionStorage.getItem("nameOfUser"))
                    const urlSegments = window.location.pathname.split('/');
                    const lastSegment = urlSegments[urlSegments.length - 1];

                })
            </script>
            @yield('content')
        </div>

</body>

</html>
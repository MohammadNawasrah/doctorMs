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

        .centerPage {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        .margin {
            margin: 15px;
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
            justify-self: center;
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

        html {
            overflow: hidden;
        }

        /* تخصيص شكل السكرول بار */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background-color: #f1f1f100;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #98d8ff;
            border-radius: 6px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #42b5fd;
        }

        .sti {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: #fff;

        }

        .search-box {
            margin-bottom: 10px;
            width: 96%;
            margin-left: auto;
            margin-right: auto;

        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row" style="height: 100vh;">
            <!-- Sidebar -->
            <nav class=" bg-light sidebar shadow" style="  height: 100%;width:350px; display:flex; flex-direction: column; ">
                <div style="display: flex; margin:10px">
                    <img loading="lazy" id="userProfileImage" style="width: 100px;border-radius: 50%;" src="" alt="">
                    </img>
                    <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;gap: 15px;margin-left: 20px;">
                        <div id="userName" class="profile-title"></div>
                        <div class="profile-subtitle" id="nameOfUser" style="display: flex;width: max-content"></div>
                    </div>
                </div>
                <div style="margin-top:15px;display: flex;justify-content: center;align-items: center;"> <a style="width: 80%;" href="{{ url('/dashboard/logOut') }}" class="btn btn-blue btn-block hover-effect">Log out</a> </div>
                <hr class="my-3 border-primary" style="border: 1px solid #000; width:90%;"> <!-- Menu Items -->

                <div class="sidebar-sticky" style="overflow: auto;margin-top:5px">
                    <ul class="nav flex-column">
                        <li class="nav-item" data-permission="permissionPage"> </li>
                        <li class="nav-item" data-permission="usersPage"> </li>
                        <li class="nav-item" data-permission="htmlCodePage"> </li>
                        <li class="nav-item" data-permission="patientsPage">
                        </li>
                        <li class="nav-item" data-permission="secretaryPage">

                        </li>
                        <li class="nav-item" data-permission="doctorPage">

                        </li>
                        <li class="nav-item" data-permission="settingsPage">

                        </li>
                    </ul>
                </div>
            </nav>

            <script src="/js/jquery/jquery-3.7.1.min.js"></script>
            <script src="/js/util/route.js"></script>
            <script src="/js/util/mainClass.js"></script>
            <script src="/js/socket/io.js"></script>
            <script src="/js/bootstrap/bootstrap.js"></script>
            <script src="/js/dashboard.js"></script>
            @yield('content')
        </div>

</body>

</html>
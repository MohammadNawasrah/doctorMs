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
        .table-container {
            max-height: 70vh; /* تحديد قيمة أكبر حسب حاجتك */
            overflow-y: auto; /* جعل العنصر قابلًا للتمرير عند الحاجة */
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
                <hr class="my-4 border"> <!-- Menu Items -->

                <div class="sidebar-sticky" style="overflow: auto;margin-top:5px">
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
                        <li class="nav-item" data-permission="secertarPage">
                            <a class="nav-link hover-link" data-url="patient" href="/dashboard/dateToDay">
                                <div class="menu-btn">
                                    <div class="menu-text sideBarButton"><i class="bi bi-calendar-check"></i> Date To Day</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" data-permission="doctorPage">
                            <a class="nav-link hover-link" data-url="patient" href="/dashboard/doctor">
                                <div class="menu-btn">
                                    <p class="menu-text"><i class="bi bi-key custom-icon"></i>Doctor</p>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" data-permission="doctorPage">
                            <a class="nav-link hover-link" id="settingsButton" data-url="patient">
                                <div class="menu-btn">
                                    <p class="menu-text"><i class="bi bi-key custom-icon"></i>settings</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">photo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body w-100" style="height: 50;">
                            <div class="container mt-5">
                                <h2 class="mb-4">Image Upload Profile personly</h2>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Choose Image</label>
                                    <input type="file" class="form-control w-50" id="profileImage" accept="image/*">
                                </div>
                                <button type="button" id="uplodeImage" class="btn btn-primary">Upload Image</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="/js/jquery/jquery-3.7.1.min.js"></script>
            <script src="/js/util/mainClass.js"></script>
            <script src="/js/util/route.js"></script>
            <script>
                $(function() {
                    Loader.addLoadPage();
                })
            </script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
            <script>
                $(function() {
                    var settings = {
                        "url": baseUrl() +
                            "/dashboard/image/profile/getUserProfileImage",
                        "method": "GET",
                    };

                    $.ajax(settings).done(function(response) {
                        response = JSON.parse(response)
                        if (response.status === 200)
                            $("#userProfileImage").attr("src", response.message)
                    });
                    $(document).on("click", "#settingsButton", () => {
                        $("#photoModal").modal("show");
                    })
                    $(document).on("click", "#uplodeImage", () => {
                        var form = new FormData();
                        form.append("file", $("#profileImage")[0].files[0]);
                        form.append("userName", sessionStorage.getItem("userName"))
                        var settings = {
                            "url": baseUrl() + "/dashboard/image/profile/add",
                            "method": "POST",
                            "timeout": 0,
                            "processData": false,
                            "mimeType": "multipart/form-data",
                            "contentType": false,
                            "data": form
                        };

                        $.ajax(settings).done(function(response) {
                            response = JSON.parse(response)
                            if (response.status === 200) {
                                $('.modal').modal('hide');
                                $("#userProfileImage").attr("src", response.message)
                                Message.addModalMessage({
                                        status: 200,
                                        message: "upload Image successfully"
                                    },
                                    1000)
                                return
                            }
                            Message.addModalMessage({
                                    status: 201,
                                    message: response.message
                                },
                                1000)
                        });
                    })
                    var settings = {
                        "url": Dashboard.userPageToAccess,
                        "method": "POST",
                        "timeout": 0,
                    };
                    $.ajax(settings).done(function(response) {
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
                    $("#nameOfUser").text(sessionStorage.getItem("nameOfUser"))
                    const urlSegments = window.location.pathname.split('/');
                    const lastSegment = urlSegments[urlSegments.length - 1];

                })
            </script>
            @yield('content')
        </div>
        <script>
            $(document).ready(function() {
                Loader.removeLoadPage();
            })
        </script>

</body>

</html>

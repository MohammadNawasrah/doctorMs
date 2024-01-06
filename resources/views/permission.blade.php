@extends('layouts.dashboard')

@section('title', 'Users')

@section('content')
<script src="{{mix('resources/js/permission.js')}}"></script>
<!-- Main Content -->
<main role="main" style="display: flex;justify-content: center;align-items: start; margin-top: 5%;" class="col-9 ">
    <main role="main" class="col-9 md-ml-sm-auto">
        <!-- Content Goes Here -->
        <div class="container ">
            <div class="row justify-content-center ">
                <div class="col-md-8  ">
                    <div class="abc scroll " style="height: 250px; padding: 0; margin: 0;">
                        <!-- ====================================================================================== -->
                        <div class="row mb-5">
                            <div class="col" data-permission="addNewAction" style="display: flex;justify-content: center;">

                            </div>
                            <div class="col" data-permission="addNewPermission" style="display: flex;justify-content: center;">

                            </div>
                        </div>


                        <!-- Modal -->

                        <!-- ====================================================================================== -->
                        <div class="container" data-permission="showPermission" style="height: 500px;overflow-y: scroll;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- You can retain your existing HTML content here -->
    </main>

</main>

<!-- Bootstrap JS and Popper.js and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    var settings = {
        "url": "http://localhost/dashboard/permissions/getHtmlByPermission",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json",
            "Cookie": "laravel_session=eyJpdiI6IldHR2hob2ZMaFM1NWhuMkdrMGRqcXc9PSIsInZhbHVlIjoiQUZheG12eDBlTnJsOUpuelovbDY5a2IrcW1yZ21PaHhwSXJQVTZJT1pNTjczZmgyRkNqOVpaellKQnV3WVJmZGlKZ0tLRTFNRUl2LzN5dzg5L2pYeCtROWpQS3ZLZ1A2SitWODlQc3BnQzhCTlJMTU1McEJlMXl6Nm9IaUl3OVciLCJtYWMiOiJhZTcxMzg5OWQxMmQwNGU0MzlkMDQ4YzIxNWNhM2YzNGYyMWJiNmRmZjEwMTE0N2QzN2IzMTFkMjYwZGQwZWQ3IiwidGFnIjoiIn0%3D"
        },
        "data": JSON.stringify({
            "userName": sessionStorage.getItem("userName")
        }),

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

    });
</script>
<!-- <script>
    let socket = io(ipAddress + ":" + socketPort);
    // document.getElementById("sendMessageButton").addEventListener("click", () => {
    //     const recipientUserId = document.getElementById("recipientUserId").value;
    //     const message = document.getElementById("message").value;
    //     console.log("je;;p")
    //     // Emit the event with user ID, recipient user ID, and message
    //     socket.emit("sendChatToServer", {
    //         recipientUserId,
    //         message
    //     });
    // });
    socket.on("setUserId", (arg) => {
        console.log(arg); // "world"
    });
    socket.on("getData", (data) => {
        if (localStorage.getItem("userName") === data.userName)
            $('#tableBody').append(`<tr>
                                            <th>${ data.userName}</th>
                                            <th>
                                            <div>static</div>
                                            </th>
                                        </tr>`);
    })
    socket.on("hello", (arg) => {
        console.log(arg); // "world"
    });
    // socket.on("sendChatToServer", (data) => {
    //     $("#ul").append(`<li> Received message from user  to ${data.recipientUserId}: ${data.message} </li>`)
    //     // alert(`Received message from user  to ${data.recipientUserId}: ${data.message}`)
    //     // console.log();
    //     // Handle the received message as needed
    // });
</script> -->
<!-- <script>
    $(function() {
        var settings = {
            "url": "http://localhost/dashboard/permissions/getAllPermission",
            "method": "GET",
            "timeout": 0,
            "headers": {},
        };
        $.ajax(settings).done(function(response) {
            if (response.status === 200) {
                const pagesName = Object.keys(response.data);
                console.log(pagesName)
                pagesName.forEach(element => {
                    $('#tableBody').append(`<tr>
                                            <th>${element}</th>
                                            <th>
                                            <div>${JSON.stringify(response.data[element])}</div>
                                            </th>
                                        </tr>`);
                });
            }
        });
    })
</script> -->
@endsection
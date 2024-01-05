@extends('layouts.dashboard')

@section('title', 'Users')

@section('content')
<!-- Main Content -->
<main role="main" style="display: flex;justify-content: center;align-items: center;" class="col-9 md-ml-sm-auto">
    Permission
    <!-- Content Goes Here -->
    <!-- You can retain your existing HTML content here -->
</main>

<!-- Bootstrap JS and Popper.js and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
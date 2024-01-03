@extends('layouts.dashboard')

@section('title', 'Users')

@section('content')
<div class="dash-body" style="margin-top: 15px ">
    <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;">
        <tr>
            <td colspan="1" class="nav-bar">
                <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;"> Dashboard</p>
            </td>
            <td width="25%">
            </td>
            <td width="15%">
                <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                    Today's Date
                </p>
                <p class="heading-sub12" style="padding: 0;margin: 0;">
                </p>
            </td>
            <td width="10%">
                <button class="btn-label" style="display: flex;justify-content: center;align-items: center;"><img src="{{ url('image/calendar.svg')}}" width="100%"></button>
            </td>
        </tr>
        <table border="0" width="100%">
            <tr>
                <td>
                    <center>
                        <div class="abc scroll" style="height: 250px;padding: 0;margin: 0;">
                            <table width="90%" class="sub-table scrolldown" border="0">
                                <thead>
                                    <tr>
                                        <th class="table-headin">
                                            Page Name
                                        </th>
                                        <th class="table-headin">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                </tbody>
                            </table>
                        </div>
                    </center>
                </td>
            </tr>
        </table>
    </table>
</div>
<script>
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
    socket.on("hello", (arg) => {
        console.log(arg); // "world"
    });
    // socket.on("sendChatToServer", (data) => {
    //     $("#ul").append(`<li> Received message from user  to ${data.recipientUserId}: ${data.message} </li>`)
    //     // alert(`Received message from user  to ${data.recipientUserId}: ${data.message}`)
    //     // console.log();
    //     // Handle the received message as needed
    // });
</script>
<script>
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
</script>
@endsection
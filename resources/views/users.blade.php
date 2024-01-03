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
                                            Name
                                        </th>
                                        <th class="table-headin">
                                            events
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
    // socket.emit("setUserId", {
    //     "userId": "51e0273e-a221-43c1-b3bc-1046e5b4fbc7",
    //     "status": "online"
    // });
    socket.emit("connectUser", {
        "userName": localStorage.getItem("userName")
    })
    socket.on("getTable", (data) => {
        console.log(data)
        $('#tableBody').html(data.html);
    });
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
    // socket.on("sendChatToServer", (data) => {
    //     $("#ul").append(`<li> Received message from user  to ${data.recipientUserId}: ${data.message} </li>`)
    //     // alert(`Received message from user  to ${data.recipientUserId}: ${data.message}`)
    //     // console.log();
    //     // Handle the received message as needed
    // });
</script>
<script>

</script>
@endsection
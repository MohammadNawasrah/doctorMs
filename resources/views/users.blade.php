@extends('layouts.dashboard')

@section('title', 'Users')

@section('content')

<style>
    #addUserMessage {
        height: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<script src="/js/users.js"></script>
<!-- Main Content -->
<main role="main" class="col-9">
    <!-- Content Goes Here -->
    <div class="container mt-5  ">
        <div class="row justify-content-center ">
            <div class="col-md-8  ">
                <div class="abc scroll " style="height: 250px; padding: 0; margin: 0;">
                    <!-- ====================================================================================== -->
                    <div class="modal fade" id="addPermissionToUserModal" tabindex="-1" aria-labelledby="addPermissionToUserModalModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addPermissionToUserModalModalLabel">Fill the information</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                    </div>
                                    <div class="mb-3" style="display: flex;flex-direction: column;justify-content: center; align-items: center;">
                                        <select class="form-select" id="pagesNamePermission" aria-label="Default select example" required>
                                        </select>
                                    </div>
                                    <div class="row mt-2" id="actionsPermissionForUsers" style="display: flex;flex-direction: column;justify-content: center; align-items: center;">
                                    </div>
                                    <div id="savePermissionToUserMessage" class="alert d-none" role="alert">
                                    </div>
                                    <div class="row" style="display: flex ;justify-content: center;align-items: center;">
                                        <button type="button" id="savePermissionToUser" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" tabindex="-1" role="dialog" id="deleteUserModal" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteUserModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div style="display: flex;justify-content: center ;align-items: center; flex-direction: column; text-align: center;">
                                    <div>
                                        <button type="button" id="deleteUser" class="btn btn-primary">Delete User</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ===================================================================================== -->
                    <div class="row" data-permission="addUser" style="justify-content: center;display: flex; margin: 20px;">

                    </div>
                    <div class="container" style="height: 500px;overflow-y: scroll;">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered">
                                <thead class="table-bordered-custom">
                                    <tr>
                                        <th scope="col" class="col-4" style="padding-left: 5%;">Name</th>
                                        <th scope="col" class="col-3" style="padding-left: 5%;">Events</th>
                                    </tr>
                                </thead>
                                <tbody data-permission="usersTableShow" id="usersTableBody">
                                    <!-- fill from ajax -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- You can retain your existing HTML content here -->
</main>
<!-- Bootstrap JS and Popper.js and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<!-- <script>
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
                        $(function() {
                            $(document).on("change", ".sendTo", function() {
                                var settings = {
                                    "url": "http://localhost/dashboard/users/user",
                                    "method": "POST",
                                    "timeout": 0,
                                    "headers": {
                                        "Content-Type": "application/json",
                                    },
                                    "data": JSON.stringify({
                                        "userName": $(this).val()
                                    }),
                                };
                                $.ajax(settings).done(function(response) {
                                    console.log(response);
                                    socket.emit("getData", {
                                        "userName": response.data.userName
                                    })
                                });

                            })
                        })
                    </script> -->

@endsection

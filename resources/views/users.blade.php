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
<!-- Main Content -->
<main role="main" class="col-9">
    <!-- Content Goes Here -->
    <div class="container mt-5  ">
        <div class="row justify-content-center ">
            <div class="col-md-8  ">
                <div class="abc scroll " style="height: 250px; padding: 0; margin: 0;">
                    <!-- ====================================================================================== -->

                    <div class="modal fade" id="addNewUserModal" tabindex="-1" aria-labelledby="addNewUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addNewUserModalLabel">Add User</h5>
                                </div>
                                <div class="modal-body">
                                    <form id="addNewUserForm">
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control " id="firstNameInput" placeholder="First Name" required>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control " id="lastNameInput" placeholder="Last Name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control" id="userNameInput" placeholder="User Name" required>
                                                </div>
                                                <div class="col">
                                                    <input type="email" class="form-control" id="emailInput" aria-describedby="emailHelp" placeholder="Email" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <select style="background-color: white;
border: none;
outline: 1px solid black;
border-radius: 2px;" class="form-select form-select-sm" aria-label="Small select example" id="userTypeInput" required>
                                                <option selected>Choose an account type</option>
                                                <option value="true">Admin</option>
                                                <option value="false">User</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="password" class="form-control mb-3" id="passwordInput" placeholder="Enter your password" required>
                                            </div>
                                            <div class="col">
                                                <input type="password" class="form-control" id="confirmPasswordInput" placeholder="Confirm your password" required>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitches">
                                            <label class="custom-control-label" for="customSwitches">User Status</label>
                                        </div>
                                        <div id="addUserMessage" class="alert alert-danger d-none" role="alert">
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ===================================================================================== -->
                    <div class="row" style="justify-content: center;display: flex; margin: 20px;">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewUserModal">
                            Add User
                        </button>
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
                                <tbody id="usersData">
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
<script>
    $(function() {
        function fetchAllUsers() {
            var settings = {
                "url": "http://localhost/dashboard/users/getAllAdminUsers",
                "method": "GET",
                "timeout": 0,
            };
            $.ajax(settings).done(function(response) {
                response = JSON.parse(response)
                $("#usersData").html("");
                if (response.status === 200) {
                    response.data.forEach(element => {
                        $("#usersData").append(`
                        <tr>
                            <td style="text-align: center;">${element.userName}</td>
                            <td style="display: flex;justify-content: space-evenly;">
                                <button class="btn btn-primary"  data-toggle="tooltip" data-placement="top" title="Add Permission"><i class="bi bi-plus"></i></button>
                                <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Update"><i class="bi bi-arrow-down-up"></i></button>
                                <button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                            `)
                    });
                }
            });
        }
        fetchAllUsers();
        $('#addNewUserForm').off("submit")
        $('#addNewUserForm').on("submit", function(event) {
            event.preventDefault();
            if ($("#userTypeInput").val() === "Choose an account type") {
                let message = $("#addUserMessage")
                message.removeClass("d-none");
                message.removeClass("alert-success");
                message.addClass("alert-danger");
                message.text("please chose type of user");
                return;
            }
            var settings = {
                "url": "http://localhost/dashboard/users/register",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/json",
                },
                "data": JSON.stringify({
                    "firstName": $("#firstNameInput").val(),
                    "lastName": $("#lastNameInput").val(),
                    "userName": $("#userNameInput").val(),
                    "email": $("#emailInput").val(),
                    "isAdmin": $("#userTypeInput").val(),
                    "password": $("#passwordInput").val()
                }),
            };
            $.ajax(settings).done(function(response) {
                console.log(response)
                let message = $("#addUserMessage");
                response = JSON.parse(response)
                message.removeClass("d-none");
                if (response.status === 200) {
                    message.removeClass("alert-danger");
                    message.addClass("alert-success");
                    message.text(response.message);
                    fetchAllUsers();
                    $("#addNewUserModal").modal("hide")
                    return;
                }
                message.removeClass("alert-success");
                message.addClass("alert-danger");
                message.text(response.message);
            });
        })
    });
</script>
@endsection
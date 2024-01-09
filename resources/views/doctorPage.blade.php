@extends('layouts.dashboard')

@section('title', 'Doctor Page')

@section('content')
<main class="col">

    <!-- Main Content -->
    <main role="main" class="col">
        <!-- Content Goes Here -->
        <div class="container mt-5  ">
            <div class="row justify-content-center ">
                <div class="col">
                    <div class="abc scroll " style="height: 250px; padding: 0; margin: 0;">
                        <!-- ====================================================================================== -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Fill the information</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">

                                                        <input type="text" class="form-control " id="inputField1" placeholder="First Name" required>
                                                    </div>

                                                    <div class="col">
                                                        <input type="text" class="form-control " id="inputField1" placeholder="Last Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" id="inputField1" placeholder="User Name" required>
                                                    </div>
                                                    <div class="col">

                                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <select class="form-select" aria-label="Default select example" required>
                                                    <option selected>Choose an account </option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">User</option>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col">

                                                    <input type="password" class="form-control mb-3" id="password" placeholder="Enter your password" required>
                                                </div>

                                                <div class="col">

                                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your password" required>
                                                </div>
                                            </div>
                                            <label class="form-check-label" for="switch">Status</label>
                                            <div class="mb-3 form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="switch">
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ===================================================================================== -->
                        <!-- ==========================================delete modal============================================ -->
                        <!-- Modal -->
                        <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel"></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to delete it?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ====================================================================================== -->

                        <table class="table table-bordered">
                            <thead class="table-bordered-custom">
                                <tr style="text-align: center;">
                                    <th scope="col" class="col-1">id</th>
                                    <th scope="col" class="col-4">Name</th>
                                    <th scope="col" class="col-4">Time and Date</th>
                                    <th scope="col" class="col-5">Events</th>
                                </tr>
                            </thead>

                            <tbody id="patientsAppointmentBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- You can retain your existing HTML content here -->
    </main>
    </div>
    </div>
    <script src="https://cdn.socket.io/4.7.2/socket.io.min.js" integrity="sha384-mZLF4UVrpi/QTWPA7BjNPEnkIfRFn4ZEO3Qt/HFklTJBj/gBOV8G3HcKn4NfQblz" crossorigin="anonymous"></script>
    <script>
        function fetchPatientsHaveDateToday() {
            var settings = {
                "url": PatientsToDoctor.showtoDoctor,
                "method": "POST",
                "timeout": 0,
            };
            $.ajax(settings).done(function(response) {
                Loader.removeLoadPage();

                response = JSON.parse(response);
                $("#patientsAppointmentBody").html("");
                if (response.status === 200) {
                    $("#patientsAppointmentBody").html("");
                    $("#patientsAppointmentBody").append(response.data.patientsAppointmentBody)
                }
            });
        }
        fetchPatientsHaveDateToday();
        let ipAddress = "127.0.0.1";
        let socketPort = "3000";
        let socket = io(ipAddress + ":" + socketPort);
        socket.on("sendToDoctor", () => {
            fetchPatientsHaveDateToday();
        })
    </script>
</main>

@endsection
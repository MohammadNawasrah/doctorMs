@extends('layouts.dashboard')

@section('title', 'Doctor Page')

@section('content')
<main class="col">

    <!-- Main Content -->
    <main role="main" class="col">
        <!-- modal table to add note -->
        <div class="modal fade " data-bs-backdrop="static" data-bs-keyboard="false" id="noteModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel"></h5>
                        <button type="hidden" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body h-50">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a Note here" id="noteTextArea"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="saveNote" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal table to add note -->
        <main role="main" class="col">
            <!-- modal table to add note -->
            <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="paymentsModal" tabindex="-1" aria-labelledby="paymentsModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel"> اضافة المبلغ الذي على المريض</h5>
                            <button type="hidden" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="payment/addPaymnet" id="addPaymentForm" method="post">
                            <div class="modal-body h-50">
                                <div class="form-floating">
                                    <input type="hidden" name="patientToken" id="patientToken" required>
                                    <input type="hidden" name="recordId" id="recordId" required>
                                    <input type="number" name="paymentValue" placeholder="add payment for patient" id="paymentInputForPatient" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="addPayment" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- image upload -->
            <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="addPhotoModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">photo</h5>
                            <button type="hidden" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body w-100" style="height: 50;">
                            <div class="container mt-5">
                                <h2 class="mb-4">Image Upload Profile personly</h2>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Choose Image</label>
                                    <input type="file" class="form-control w-50" id="patientImage" multiple accept="image/*">
                                </div>
                                <button type="button" id="uplodeImagePatient" class="btn btn-primary">Upload
                                    Image</button>
                            </div>
                        </div>
                        <form action="payment/addPaymnet" id="addPaymentForm" method="post">
                            <div class="modal-body h-50">
                                <div class="form-floating">
                                    <input type="hidden" name="patientToken" id="patientToken" required>
                                    <input type="hidden" name="recordId" id="recordId" required>
                                    <input type="number" name="paymentValue" placeholder="add payment for patient"
                                        id="paymentInputForPatient" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="addPayment" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- image upload -->
            <!-- Content Goes Here -->
            <div class="container mt-5  ">
                <div class="row justify-content-center ">
                    <div class="col">
                        <div class="abc scroll " style="height: 250px; padding: 0; margin: 0;">
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
        </main>
        </div>
        </div>
        <script src="https://cdn.socket.io/4.7.2/socket.io.min.js" integrity="sha384-mZLF4UVrpi/QTWPA7BjNPEnkIfRFn4ZEO3Qt/HFklTJBj/gBOV8G3HcKn4NfQblz" crossorigin="anonymous"></script>
        <script>
            // Loader.removeLoadPage();
            function fetchPatientsHaveDateToday() {
                var settings = {
                    "url": PatientsToDoctor.showtoDoctor,
                    "method": "POST",
                    "timeout": 0,
                };
                $.ajax(settings).done(function(response) {


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
        <script>
            $(function() {
                var selectedPatient;
                var recordId;
                $(document).on("click", "#addNoteButton", function() {
                    $("#addPhotoModal").modal("show");
                    selectedPatient = $(this).data("token")
                    recordId = $(this).data("id");
                })
                $(document).on("click", "#uplodeImagePatient", function() {

                    var form = new FormData();
                    var files = $("#patientImage")[0].files;

                    for (var i = 0; i < files.length; i++) {
                        form.append("files[]", files[i]);
                    }
                    form.append("patientToken", selectedPatient);
                    form.append("recordId", recordId);
                    $("#patientToken").val(selectedPatient);
                    var settings = {
                        "url": baseUrl() + "/dashboard/image/patient/add",
                        "method": "POST",
                        "timeout": 0,
                        "processData": false,
                        "mimeType": "multipart/form-data",
                        "contentType": false,
                        "data": form
                    };

                    $.ajax(settings).done(function(response) {

                        response = JSON.parse(response);
                        if (response.status === 200) {
                            $('.close').trigger('click');
                            $("#userProfileImage").attr("src", response.message);
                            Message.addModalMessage({
                                status: 200,
                                message: "Upload image successfully"
                            }, 1000);
                            $("#noteModal").modal("show");
                            return;
                        }
                        Message.addModalMessage({
                            status: 201,
                            message: response.message
                        }, 1000);
                    });

                })

                $(document).on("click", "#saveNote", function() {

                    var settings = {
                        "url": baseUrl() + "/dashboard/patientRecords/record/add",
                        "method": "POST",
                        "timeout": 0,
                        "headers": {
                            "Content-Type": "application/json"
                        },
                        "data": JSON.stringify({
                            "token": selectedPatient,
                            "doctorTableId": recordId,
                            "patientNote": $("#noteTextArea").val()
                        }),
                    };
                    var selectedButton = $(this);
                    $("#recordId").val(recordId)
                    Loader.addLoader(selectedButton);
                    $.ajax(settings).done(function(response) {

                        response = JSON.parse(response)
                        if (response.status === 200) {
                            Message.addMessage(response.message, selectedButton, "success");
                            $(".close").trigger("click");
                            Loader.removeLoader();
                            $('#paymentsModal').modal("show");
                            return;
                        }
                        Loader.removeLoader();
                        Message.addMessage(response.message, selectedButton, "danger");
                    });
                })
            })
            const addPayment = () => {
                $(document).on("submit", "#addPaymentForm", (e) => {
                    e.preventDefault();
                    ajax({
                        FORMID: "addPaymentForm",
                        showAlert: true,
                        callBackFunction: (response) => {
                            if (response.status === 200) {
                                fetchPatientsHaveDateToday();
                                $(".close").trigger("click");
                            }
                        }
                    })
                })
            }
            addPayment()
        </script>
    </main>

    @endsection
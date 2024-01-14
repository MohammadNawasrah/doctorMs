@extends('layouts.dashboard')

@section('title', 'Doctor Page')

@section('content')
<main class="col">

    <!-- Main Content -->
    <main role="main" class="col">
        <!-- modal table to add note -->
        <div class="modal fade " data-bs-backdrop="static" data-bs-keyboard="false" id="noteModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
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
        <div class="modal fade" id="checkModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pathological case</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">

                        <!--==============================================================================================================-->
                        <div class="row mt-3">
                            <div class="container col">
                                <div class="dropdown w-200">
                                    <button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Prosthetics
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox1">
                                                    preparation
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox2">
                                                    Impression
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Bite regestration
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Complete removable denture</label>

                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Partial denture
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    over denture
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <label class="form-check-label" for="checkbox3">
                                                    # fixed crowns :
                                                </label>
                                            </form>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    a - PFM crown
                                                </label>
                                            </form>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    b - Zircon crow
                                                </label>
                                            </form>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    c - E-Ma* crown
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Dental Veneers
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <label class="form-check-label" for="checkbox3">
                                                    # Post & core :
                                                </label>
                                            </form>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    a - metal post
                                                </label>
                                            </form>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    b - Fiber post
                                                </label>
                                            </form>
                                        </li>
                                        <form class="form-check">
                                            <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                            <label class="form-check-label" for="checkbox3">
                                                Temporary Cementation
                                            </label>
                                        </form>
                                        <form class="form-check">
                                            <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                            <label class="form-check-label" for="checkbox3">
                                                Permenant Cementation
                                            </label>
                                        </form>

                                    </ul>
                                </div>
                            </div>

                            <!--==============================================================================================================-->
                            <div class="container col">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Endodontics
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <form class="form-check">
                                                <label class="form-check-label" for="checkbox1">
                                                    # Root Canal treatment :
                                                </label>
                                            </form>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    a - First Visit( a Csess )
                                                </label>
                                            </form>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    b - Secod Visit( cleaning & shaping )
                                                </label>
                                            </form>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    c - Obturation
                                                </label>
                                            </form>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    d - composite filling
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Re Root Canal treatment
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Apicoectomy
                                                </label>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--==============================================================================================================-->
                            <div class="container col">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Pedodontics
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Fluride application
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Pit & fissure sealent
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Temporary filling
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Comosite filling
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    pulpectomy
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    extraetion
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    SSC
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Root Canal treatment
                                                </label>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--==============================================================================================================-->
                            <div class="container col">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Periodontics
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Scalling & polishing
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    root planing
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Gingivictomy
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Gingival depigmentat
                                                </label>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--==============================================================================================================-->
                            <!--==============================================================================================================-->
                            <div class="container col">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Orthodontics
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Removable appliances
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Fixed appliances
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Functional appliances
                                                </label>
                                            </form>
                                        </li>
                                        <li>
                                            <form class="form-check">
                                                <input id="checkboxHint" class="form-check-input" type="checkbox" value="">
                                                <label class="form-check-label" for="checkbox3">
                                                    Orthodontic implants
                                                </label>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--==============================================================================================================-->
                        </div>
                    </div>
                    <!--==============================================================================================================-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal table to add note -->
        <main role="main" class="col">
            <!-- modal table to add note -->
            <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="paymentsModal" tabindex="-1" aria-labelledby="paymentsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
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
                <div class="modal-dialog modal-dialog-centered">
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
                            Message.addModalMessage({
                                status: 200,
                                message: "Upload image successfully"
                            }, 1000);
                            $("#noteModal").modal("show");
                            $("#checkboxHint").each(function(index, element) {
                                if (element.checked) {
                                    console.log(element)
                                }
                            })
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
                            if (!response.hasPayment) {
                                $('#paymentsModal').modal("show");
                            }
                            return;
                        }
                        Loader.removeLoader();
                        Message.addMessage(response.message, selectedButton, "danger");
                    });
                })
            })
            const addPayment = () => {
                $(document).on("click", "#addPayment", () => {
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
            $(document).ready(function() {
                // Initialize an empty object to store the data
                var labelTextArray = {};

                // Iterate through each list item in the dropdown menu
                $('.dropdown-menu li').each(function() {
                    // Extract the button text and label text
                    var buttonText = $('.dropdown-toggle').text().trim();
                    var labelText = $(this).find('label').text().trim();

                    // Check if the button text is already a key in the object
                    if (!labelTextArray.hasOwnProperty(buttonText)) {
                        // If not, create a new key with an empty array
                        labelTextArray[buttonText] = [];
                    }

                    // Push the label text to the corresponding array
                    labelTextArray[buttonText].push(labelText);
                });

                // Convert the object to JSON
                var jsonString = JSON.stringify(labelTextArray, null, 2);

                // Log the resulting JSON to the console
                console.log(jsonString);
            });
        </script>
    </main>

    @endsection
@extends('layouts.dashboard')

@section('title', 'Doctor Page')

@section('content')

<!-- Main Content -->
<!-- modal table to add note -->

<!--===================================================cheak books======================================================= -->

<!--===================================================================================================================== -->
<main role="main" class="col">
    <div class="modal fade " data-bs-backdrop="static" data-bs-keyboard="false" id="noteModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"> Note</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body h-50">
                    <div class="form-floating">
                        <textarea class="form-control" style="width: 1000;height: 600;" placeholder="Leave a Note here" id="noteTextArea"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="addMonyToPatient" class="btn btn-success">Add Mony To Patient</button>
                    <button type="button" id="saveNote" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal table to add note -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="paymentsModal" tabindex="-1" aria-labelledby="paymentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"> Add the amount owed by the patient</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="payment/addPaymnet" id="addPaymentForm" method="post">
                    <div class="modal-body h-50">
                        <div class="form-floating">
                            <input type="hidden" name="patientToken" id="patientToken" required>
                            <input type="hidden" name="recordId" id="recordId" required>
                            <input type="number" class="form-control" name="paymentValue" placeholder="add payment for patient" id="paymentInputForPatient" required>
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
                    <h4 class="modal-title" id="ModalLabel">photo</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body w-100" style="height: 50;">
                    <div class="container mt-2">
                        <h3 class="mb-4" style="text-align: center;">Image Upload Profile personly</h3>
                        <div class="mb-3" style="text-align: center;">
                            <label for="image" class="form-label">Choose Image</label>
                            <input type="file" class="form-control w-100" id="patientImage" multiple accept="image/*">
                        </div>
                        <button type="button" id="uplodeImagePatient" class="btn btn-primary w-100">Upload
                            Image</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- image upload -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="checkModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="hidden" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body w-100">
                    <div class="container col" style="display: flex;flex-direction: column;gap: 10px;" id="checkDiv">

                    </div>
                    <button type="button" id="addCehcedToNote" class="btn btn-success mt-3 w-100">Add To Note</button>
                </div>
            </div>
        </div>
    </div>
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
                console.log(response)

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
            $(document).on("click", "#addMonyToPatient", function() {
                $('#paymentsModal').modal("show");
            })
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
                        $("#checkModal").modal("show");
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
                        return;
                    }
                    fetchPatientsHaveDateToday();
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
                            $("#paymentsModal").modal("hide");
                        }
                    }
                })
            })
        }
        addPayment()
    </script>
    <script>
        const checkData = {
            "Oral_Surgery": [
                "Simple extraction",
                "Surgical extraction",
                "Surgical extraction with suturing",
                "Root Separation",
                "Abscess drainage",
                "Treatment of dry socket",
                "Curettage",
                "Wisdom tooth extraction",
                "Impacted wisdom tooth extraction"
            ],
            "Dental_implants": [
                "Bone graft",
                "Single implant",
                "Multiple implants"
            ],
            "Radiograph": [
                "Panoramic x-ray",
                "CBCT",
                "X-ray",
                "Cephalometric"
            ],
            "Bleaching": [
                "Full teeth whitening",
                "Upper teeth whitening",
                "Lower teeth whitening"
            ],
            "Restorative": [
                "Composite filling",
                "Temporary filling",
                "Temporary filling with CaOH base",
                "Composite filling with CaOH base",
                "Re.Composite",
                "Composite Facing"
            ],

            "Prosthetics": [
                "Preparation",
                "Impression",
                "Bite registration",
                "Complete removable denture",
                "Partial denture",
                "Overdenture",
                {
                    "Fixed crowns": [
                        "a - PFM crown",
                        "b - Zircon crown",
                        "c - E-Max crown"
                    ]
                },
                "DentalVeneers",
                {
                    "Postcore": [
                        "a - Metal post",
                        "b - Fiber post"
                    ]
                },
                "Temporary Cementation",
                "Permanent Cementation"
            ],

            "Endodontics": [{
                    "Root Canal treatment": [
                        "a - First Visit (Access)",
                        "b - Second Visit (Cleaning & shaping)",
                        "c - Obturation",
                        "d - Composite filling"
                    ]
                },
                "Re-Root Canal treatment",
                "Apicoectomy"
            ],


            "Pedodontics": [
                "Fluoride application",
                "Pit & fissure sealant",
                "Temporary filling",
                "Composite filling",
                "Pulpectomy",
                "Extraction",
                "SSC",
                "Root Canal treatment"
            ],
            "Periodontics": [
                "Scaling & polishing",
                "Root planing",
                "Gingivectomy",
                "Gingival depigmentation"
            ],
            "Orthodontics": [
                "Removable appliances",
                "Fixed appliances",
                "Functional appliances",
                "Orthodontic implants"
            ]
        }
        var count = 0;
        const checkDataKeys = Object.keys(checkData);
        checkDataKeys.forEach(data => {
            $("#checkDiv").append(`
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#${data}" aria-expanded="false">
                    ${data}
                </button>
                `);
            inputs = ``;
            checkData[data].forEach((value, index) => {
                if (typeof value !== "object") {
                    inputs += `<div><input type="checkbox" id=${data+index} data-parent="${data}"  value="${value}"/> <label for="${data+index}">${value} </label></div>`;
                } else {
                    const valueKeys = Object.keys(value)
                    inputs += `<br><hr>${valueKeys}`;
                    value[valueKeys].forEach((element, index) => {
                        inputs += `<div><input type="checkbox" id=${index+''+count} data-parent="${data}" data-sup="${valueKeys}" value="${element}"/> <label for="${index+''+count}">${element} </label></div>`;
                    })
                    inputs += `<br><hr>`;
                    count++;
                }
            })
            $("#checkDiv").append(`
                <div class="collapse" id="${data}">
                    <div class="card card-body">
                        ${ inputs}
                    </div>
                </div>
                `);
            const addToNote = () => {
                $(document).off("click", "#addCehcedToNote")
                $(document).on("click", "#addCehcedToNote", function() {
                    let Oral_Surgery = "\n\nOral_Surgery=======================\n";
                    let Dental_implants = "\n\nDental_implants=======================\n";
                    let Radiograph = "\n\nRadiograph=======================\n";
                    let Bleaching = "\n\nBleaching=======================\n";
                    let Restorative = "\n\nRestorative=======================\n";
                    let Prosthetics = "\n\nProsthetics=======================\n";
                    let Endodontics = "\n\nEndodontics=======================\n";
                    let Pedodontics = "\n\nPedodontics=======================\n";
                    let Periodontics = "\n\nPeriodontics=======================\n";
                    let Orthodontics = "\n\nOrthodontics=======================\n";

                    $("input[type='checkbox']:checked").each((index, element) => {
                        if ($(element).data("parent") === "Oral_Surgery")
                            Oral_Surgery += `${$(element).val()}  ,    `
                        if ($(element).data("parent") === "Dental_implants")
                            Dental_implants += `${$(element).val()}  ,    `
                        if ($(element).data("parent") === "Radiograph")
                            Radiograph += `${$(element).val()}  ,    `
                        if ($(element).data("parent") === "Bleaching")
                            Bleaching += `${$(element).val()}  ,    `
                        if ($(element).data("parent") === "Restorative")
                            Restorative += `${$(element).val()}  ,    `
                        if ($(element).data("parent") === "Prosthetics")
                            Prosthetics += `${$(element).val()}  ,    `
                        if ($(element).data("parent") === "Endodontics")
                            Endodontics += `${$(element).val()}  ,    `
                        if ($(element).data("parent") === "Pedodontics")
                            Pedodontics += `${$(element).val()}  ,    `
                        if ($(element).data("parent") === "Periodontics")
                            Periodontics += `${$(element).val()}  ,    `
                        if ($(element).data("parent") === "Orthodontics")
                            Orthodontics += `${$(element).val()}  ,    `
                    })
                    text = Oral_Surgery + Dental_implants + Radiograph + Bleaching + Restorative + Prosthetics +
                        Endodontics + Pedodontics + Periodontics + Orthodontics;
                    $("#noteModal").modal("show")
                    $(".close").trigger("click");
                    $("#noteTextArea").val(text);
                })
            }
            addToNote();
        });
    </script>
</main>

@endsection
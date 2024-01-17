const fetchPatientForDoctor = () => {
    ajax({
        URL: PatientsToDoctor.showtoDoctor,
        METHOD: "POST",
        callBackFunction: response => {
            $("#patientsAppointmentBody").html("");
            if (response.status === 200) {
                $("#patientsAppointmentBody").html("");
                $("#patientsAppointmentBody").append(response.data.patientsAppointmentBody)
            }
        }
    })
}
const socketResponseFromSecer = () => {
    let ipAddress = "127.0.0.1";
    let socketPort = "3000";
    let socket = io(ipAddress + ":" + socketPort);
    socket.on("sendToDoctor", () => {
        fetchPatientForDoctor();
    })
}
fetchPatientForDoctor();
socketResponseFromSecer();
$(function () {
    var selectedPatient;
    var recordId;
    const showPaymentModal = () => {
        $(document).on("click", "#addMonyToPatient", function () {
            $('#paymentsModal').modal("show");
            $("#recordId").val(recordId);
        })
    }
    const showAddPhotoModal = () => {
        $(document).on("click", "#addNoteButton", function () {
            $("#addPhotoModal").modal("show");
            selectedPatient = $(this).data("token")
            recordId = $(this).data("id");
        })
    }
    const uploadImage = () => {
        $(document).on("click", "#uplodeImagePatient", function () {
            var form = new FormData();
            var files = $("#patientImage")[0].files
            for (var i = 0; i < files.length; i++) {
                form.append("files[]", files[i]);
            }
            form.append("patientToken", selectedPatient);
            form.append("recordId", recordId);
            $("#patientToken").val(selectedPatient);
            ajax({
                URL: baseUrl() + "/dashboard/image/patient/add",
                METHOD: "POST",
                DATA: form,
                fileUp: true,
                showAlert: true,
                callBackFunction: (response) => {
                    console.log(response)
                    if (response.status === 200) {
                        $('.close').trigger('click');
                        $("#checkModal").modal("show");
                    }
                }
            });
        })
    }
    const checkBoxForNote = () => {
        $.getJSON('/json/checkData.json', function (response) {
            var checkData = response;
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
                        inputs += `<div><input type="checkbox" id=${data + index} data-parent="${data}"  value="${value}"/> <label for="${data + index}">${value} </label></div>`;
                    } else {
                        const valueKeys = Object.keys(value)
                        inputs += `<br><hr>${valueKeys}`;
                        value[valueKeys].forEach((element, index) => {
                            inputs += `<div><input type="checkbox" id=${index + '' + count} data-parent="${data}" data-sup="${valueKeys}" value="${element}"/> <label for="${index + '' + count}">${element} </label></div>`;
                        })
                        inputs += `<br><hr>`;
                        count++;
                    }
                })
                $("#checkDiv").append(`
                        <div class="collapse" id="${data}">
                            <div class="card card-body">
                                ${inputs}
                            </div>
                        </div>
                        `);
                const addToNote = () => {
                    $(document).off("click", "#addCehcedToNote")
                    $(document).on("click", "#addCehcedToNote", function () {
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
        })
    }
    const addPayment = () => {
        $(document).on("click", "#addPayment", () => {
            console.log("done add payment")
            ajax({
                FORMID: "addPaymentForm",
                callBackFunction: (response) => {
                    if (response.status === 200) {
                        fetchPatientForDoctor();
                        $("#paymentsModal").modal("hide");
                    }
                }
            })
        })
    }
    const saveNote = () => {
        $(document).on("click", "#saveNote", function () {
            const sendToSecrSocket = () => {
                let ipAddress = "127.0.0.1";
                let socketPort = "3000";
                let socket = io(ipAddress + ":" + socketPort);
                socket.emit("sendToSecr", "done")
            }
            if ($("#paymentInputForPatient").val() === "") {
                $("#paymentInputForPatient").val(0);
                $("#addPayment").trigger("click");
            }
            ajax({
                URL: baseUrl() + "/dashboard/patientRecords/record/add",
                METHOD: "POST",
                showAlert: true,
                DATA: {
                    "token": selectedPatient,
                    "doctorTableId": recordId,
                    "patientNote": $("#noteTextArea").val()
                },
                callBackFunction: (response) => {
                    if (response.status === 200) {
                        $(".close").trigger("click");
                        fetchPatientForDoctor();
                        sendToSecrSocket();
                        emptyInputs();
                        return;
                    }
                }
            });
        })
    }
    showAddPhotoModal();
    showPaymentModal();
    uploadImage();
    checkBoxForNote();
    addPayment()
    saveNote();
})

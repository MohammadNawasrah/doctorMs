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
            console.log(selectedPatient)
            $("#patientToken").val(selectedPatient);
            console.log($("#patientToken").val())
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
                        const checkDataKeys = Object.keys(checkData);
                        let text = "";
                        checkDataKeys.forEach((element) => {
                            let checkboxTrue = $(`input[type='checkbox']:checked[data-parent='${element}']`);
                            if (checkboxTrue.length >= 1) {
                                text += `\n\n${element}=======================\n`;
                                checkboxTrue.each((index, checkBox) => {
                                    console.log(checkBox)
                                    text += `${$(checkBox).siblings().text()}  ,    `
                                })
                            }
                        })
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




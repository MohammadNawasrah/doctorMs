let ipAddress = UrlData.host;
let socketPort = "3000";
let socket = io(ipAddress + ":" + socketPort);
const fetchPatientsHaveDateToday = () => {
    ajax({
        URL: PatientAppointments.patientsHaveAppoinntment,
        METHOD: "POST",
        callBackFunction: (response) => {
            $("#patientsAppointmentBody").html("");
            if (response.status === 200) {
                $("#patientsAppointmentBody").html("");
                $("#patientsAppointmentBody").append(response.data.patientsAppointmentBody)
            }
        }
    });
}
const sendPatientToDoctor = () => {
    $(document).on("click", "#sendToDoctorButton", function () {
        if ($("#selectDoctorToken").val() === null) {
            showAlert("please select doctor to send", 201);
            return;
        }
        socket.emit("sendPatientToServer", {
            toDoctor: $("#selectDoctorToken").val(),
            patientToken: $(this).data("token"),
            baseUrl: UrlData.baseUrl
        });
    })
}
const whenSendPatientResponse = () => {
    socket.on("responsSendToServer", (response) => {
        fetchPatientsHaveDateToday();
        showAlert(response.message, response.status);
    })
}
fetchPatientsHaveDateToday();
sendPatientToDoctor();
whenSendPatientResponse();


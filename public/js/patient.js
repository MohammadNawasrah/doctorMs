var patients;
var onAppointment = [];
$(function () {
    var selectedUser;
    const fetchPatients = () => {
        ajax({
            URL: Patients.showPatients,
            METHOD: "post",
            callBackFunction: (response) => {
                if (response.status === 200) {
                    $("#patientsBody").html("");
                    $("#patientsBody").append(response.data.patientsBody)
                    return
                }
                $("#patientsBody").html("");
            }
        });
    }
    const socketResponse = () => {
        let ipAddress = UrlData.host;
        let socketPort = "3000";
        let socket = io(ipAddress + ":" + socketPort);
        socket.on("responsSendToSecr", (response) => {
            fetchPatients();
        });
    }
    const showUpdateAppointemtModal = () => {
        $(document).on("click", "#updateAppointmetButton", function () {
            $("#dateAppointmentUpdate").val($(this).data("date"))
            $("#timeAppointmentUpdate").val($(this).data("time"))
            selectedUser = $(this).data("token")
            $("#updateAppointmentModal").modal("show");
        })
    }
    const updateAppointmetApi = () => {
        $(document).on("click", "#updateAppointment", function () {
            let selectedDate = $("#dateAppointmentUpdate").val();
            let selectedTime = $("#timeAppointmentUpdate").val()
            // if (checkAvailability(selectedDate, selectedTime)) {
            //     showAlert("This appointment slot is already booked. Please choose another time.");
            //     return;
            // }
            {
                ajax({
                    URL: PatientAppointments.updateAppointment,
                    METHOD: "post",
                    showAlert: true,
                    DATA: {
                        "token": selectedUser,
                        "next_appointment": $("#dateAppointmentUpdate").val() + "  " + $("#timeAppointmentUpdate").val()
                    },
                    callBackFunction: (response) => {
                        if (response.status === 200) {
                            $(".close").trigger("click");
                            fetchPatients();
                            if (isToday(selectedDate + " " + selectedTime)) {
                                window.location.href = baseUrl() + "/dashboard/dateToDay"
                            }
                        }
                    }
                })
            }
        })
    }
    const showDeletePatientModal = () => {
        $(document).on("click", "#deletePatientButton", function () {
            selectedUser = $(this).data("token")
            $("#deletePatientModal").modal("show")
        })
    }
    const deleletePatient = () => {
        $(document).on("click", "#deletePatient", function () {
            ajax({
                URL: Patients.deletePatient,
                METHOD: "post",
                showAlert: true,
                DATA: {
                    "token": selectedUser
                },
                callBackFunction: (response) => {
                    if (response.status === 200) {
                        $(".close").trigger("click");
                        fetchPatients();
                    }
                }
            });
        })
    }
    const addNewPatient = () => {
        $(document).on("click", "#addNewPatient", function () {
            ajax({
                FORMID: "addPatientForm",
                showAlert: true,
                callBackFunction: (response) => {
                    if (response.status === 200) {
                        $(".close").trigger("click");
                        fetchPatients();
                    }
                }
            });
        })
    }

    const addPayment = () => {
        $(document).on("click", "#updatePayment", function () {
            ajax({
                FORMID: "updatePaymentForm",
                showAlert: true,
                callBackFunction: (response) => {
                    if (response.status === 200) {
                        fetchPatients();
                        $(".close").trigger("click");
                    }
                }
            })
        })
    }
    const fetchAllAppointment = () => {
        ajax({
            URL: baseUrl() + '/dashboard/patientAppointments',
            METHOD: 'POST',
            callBackFunction: (response) => {
                let data = response.data;
                data.forEach(element => {
                    let splitDateTime = element.next_appointment.split(" ");
                    let date = splitDateTime[0];
                    let time = splitDateTime[1];
                    onAppointment.push({ "date": date, "start": time, end: addMinutesToTime(time, 15) })
                });
            }
        })
    }
    fetchPatients();
    addPayment()
    showUpdateAppointemtModal();
    showDeletePatientModal();
    updateAppointmetApi();
    deleletePatient();
    addNewPatient();
    socketResponse();
    fetchAllAppointment();



    $(document).on("click", "#mustPay", function () {
        $("#patientToken").val($(this).data("token"));
        $("#recordId").val($(this).data("doctor"));
    })
    $(document).on("click", "#updatePatientModalButton", function () {
        selectedUser = $(this).data("token")
        $("#updatePatientModal").modal("show")
        $("#patientFullNameUpdate").val($(this).data("full_name"));
        $("#patientAgeUpdate").val($(this).data("age"));
        $("#patientPhoneNumberUpdate").val($(this).data("phone_number"));
    })
    $(document).on("click", "#updatePatient", function () {
        var settings = {
            "url": `${Patients.updatePatient}`,
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/json",
                "Cookie": "laravel_session=eyJpdiI6ImpLa255QmpqZmcyRjhlRVJoOVkzYUE9PSIsInZhbHVlIjoiMWhRbVQ5MWtMZHA4OXhkNTh4S1VUdlEwSlYrd1Y1Y0NsTWtrMjZ4ajNpeU5Td1B2MTRVTWFOVWZoQVlacEowYkRBZUpUK29nVDZkZ25EVncwODcwWXh6VG9qUWp4citHS1NIamdhWExJSHFwUUNlS0JDZjRKa3dJUDZGK3Y0WEIiLCJtYWMiOiI1ZWE0NTk1MjM4MDBiMjA5MjExZDM1MDJjMWM0ODNmODg3NzAyYmUxNWU2NjgzZWM5Yjk3MDdhNTI0NmFkOTkwIiwidGFnIjoiIn0%3D"
            },
            "data": JSON.stringify({
                "token": selectedUser,
                "fullName": $("#patientFullNameUpdate").val(),
                "age": $("#patientAgeUpdate").val(),
                "phoneNumber": $("#patientPhoneNumberUpdate").val()
            }),
        };
        var selectedButton = $(this);
        Loader.addLoader(selectedButton);
        $.ajax(settings).done(function (response) {
            response = JSON.parse(response)
            if (response.status === 200) {
                Message.addMessage(response.message, selectedButton, "success");
                setTimeout(() => {
                    $(".close").trigger("click");
                    Loader.removeLoader();
                    fetchPatients();
                }, 1000);
                return;
            }
            Loader.removeLoader();
            Message.addMessage(response.message, selectedButton, "danger");
        });
    })
    $(document).on("click", "#addAppointmentButton", function () {
        selectedUser = $(this).data("token")
    })
    $(document).off("click", "#addAppointment")
    $(document).on("click", "#addAppointment", function () {
        let selectedDate = $("#dateAppointment").val();
        let selectedTime = $("#timeAppointment").val()
        // if (checkAvailability(selectedDate, selectedTime)) {
        //     showAlert("This appointment slot is already booked. Please choose another time.");
        //     return;
        // }
        var settings = {
            "url": PatientAppointments.addAppointment,
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/json",
                "Cookie": "laravel_session=eyJpdiI6Ilh1WDdiSWdFYms3QkpWVUUwTExHeVE9PSIsInZhbHVlIjoiUXpjbVV5ekxnQ3V3VzZ2dlVJS255T2ltc2ZMTHgrL1VnMGMyNEI5R3d2UFVLRkp6U2puUER1VVZYcEJ2bXJsd2MrWjlESjh4K1E5aWZPdE5FTERMbWk5bkhMc2xTK0ttbHNhRzJHd2J1Sk81VHJ1M1hnWGVFYnUzemlobDhYMXQiLCJtYWMiOiJhODc3OTRlOTk1NjRiY2NlMzhjZmIwZWZiNzRhZTQxYmEwMDEzMTgwMGY2NTVjN2NmOWU0ZjQxZWMxYjdiNmExIiwidGFnIjoiIn0%3D"
            },
            "data": JSON.stringify({
                "token": selectedUser,
                "next_appointment": $("#dateAppointment").val() + "  " + $("#timeAppointment").val()
            }),
        };
        var selectedButton = $(this);
        Loader.addLoader(selectedButton);
        $.ajax(settings).done(function (response) {
            response = JSON.parse(response)
            if (response.status === 200) {
                fetchPatients();
                $('.close').trigger("click")
                if (isToday(selectedDate + " " + selectedTime)) {
                    window.location.href = baseUrl() + "/dashboard/dateToDay"
                }
            }
            Loader.removeLoader();
            Message.addMessage(response.message, selectedButton, "danger");
        });
    })
})
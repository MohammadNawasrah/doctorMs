var patients;
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
                }
            }
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
                            window.location.href = baseUrl() + "/dashboard/dateToDay"
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
    fetchPatients();
    showUpdateAppointemtModal();
    showDeletePatientModal();
    updateAppointmetApi();
    deleletePatient();
    addNewPatient();



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
                window.location.href = baseUrl() + "/dashboard/dateToDay"
            }
            Loader.removeLoader();
            Message.addMessage(response.message, selectedButton, "danger");
        });
    })
})
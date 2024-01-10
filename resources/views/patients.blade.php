@extends('layouts.dashboard')

@section('title', 'Patients')

@section('content')
<main class="col">
    <div class="container-fluid">
        <div class="row-12" style="height: 100vh;">
            <div class="container mt-5  ">
                <div class="row justify-content-center ">
                    <div class="col-12">
                        <div class="abc scroll " style="height: 250px; padding: 0; margin: 0;">
                            <!-- ====================================================================================== -->


                            <!-- Modal -->
                            <div class="row centerPage margin">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addNewPatientModal">Add
                                    patient</button>
                            </div>
                            <!-- ============================================Add patient========================================== -->
                            <div class="modal fade" id="addNewPatientModal" tabindex="-1"
                                aria-labelledby="addNewPatientModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewPatientModalLabel">Fill Patient Info</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" id="patientFullName"
                                                            placeholder="Full Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="number" class="form-control " id="patientAge"
                                                            placeholder="Age" required>
                                                    </div>
                                                    <div class="col">
                                                        <input type="tel" class="form-control " id="patientPhoneNumber"
                                                            placeholder="Phone Number"
                                                            pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="centerPage">
                                                <div>
                                                    <div>
                                                        <button type="button" id="addNewPatient"
                                                            class="btn btn-primary w-100">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ===================================================================================== -->
                            <div class="modal fade" id="updatePatientModal" tabindex="-1"
                                aria-labelledby="updatePatientModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updatePatientModalLabel">Fill Update Patient
                                                Data</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control"
                                                            id="patientFullNameUpdate" placeholder="Full Name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="number" class="form-control " id="patientAgeUpdate"
                                                            placeholder="Age" required>
                                                    </div>
                                                    <div class="col">
                                                        <input type="tel" class="form-control "
                                                            id="patientPhoneNumberUpdate" placeholder="Phone Number"
                                                            pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="centerPage">
                                                <div>
                                                    <div>
                                                        <button type="button" id="updatePatient"
                                                            class="btn btn-primary w-100">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ==========================================delete modal============================================ -->

                            <div class="modal fade" tabindex="-1" role="dialog" id="deletePatientModal"
                                aria-labelledby="deletePatientModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deletePatientModalLabel">are you sure to delete
                                                ??</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="centerPage">
                                            <div>
                                                <div>
                                                    <button type="button" id="deletePatient"
                                                        class="btn btn-danger m-3">Delete User</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ====================================================================================== -->
                            <!-- ==========================================date modal============================================ -->

                            <div class="modal fade" tabindex="-1" role="dialog" id="addAppointmetModal"
                                aria-labelledby="addAppointmetModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addAppointmentTitle">Set Appointment</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="dateAppointment" class="form-label">Appointment Date</label>
                                                <input type="date" id="dateAppointment" class="form-control"
                                                    min="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="timeAppointment" class="form-label">Appointment Time</label>
                                                <input type="time" id="timeAppointment" class="form-control">
                                            </div>
                                        </div>
                                        <div class="centerPage">
                                            <div>
                                                <div>
                                                    <button type="button" id="addAppointment"
                                                        class="btn btn-danger m-3">Add New
                                                        Appointmet</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" tabindex="-1" role="dialog" id="updateAppointmentModal"
                                aria-labelledby="updateAppointmentModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateAppointmentTitle">Add New Appointment</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="dateAppointment" class="form-label">Appointment Date</label>
                                                <input type="date" class="form-label" id="dateAppointmentUpdate"
                                                    min="<?php echo date('Y-m-d'); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="timeAppointment" class="form-label">Appointment Time</label>
                                                <input type="time" class="form-label" id="timeAppointmentUpdate">
                                            </div>
                                        </div>
                                        <div class="centerPage">
                                            <div class="centerPage">
                                                <div>
                                                    <button type="button" id="updateAppointment"
                                                        class="btn btn-danger m-3">Update Appointments
                                                        Appointmet</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ====================================================================================== -->

                            <!-- ====================================================================================== -->

                            <table class="table table-bordered">
                                <thead class="table-bordered-custom">
                                    <tr>
                                        <th scope="col" class="col-1 text-center">id</th>
                                        <th scope="col" class="col-3 text-center">Name</th>
                                        <th scope="col" class="col-4 text-center">Events</th>
                                    </tr>
                                </thead>
                                <tbody id="patientsBody" class="text-center">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- You can retain your existing HTML content here -->
        </div>
    </div>
</main>

<script>
      $(functi on ()               function fetchPatien            
            var                  = {
                "url": Pa                howPatients,
                        "method": "            
                      "timeout": 0,
             };
                      ajax(settings).done(function (res                
                response = JSO                    sponse);
                if (                    tatus === 200) {
                    $("#patientsBody"                ")                                    $("#patientsBod        append(response.da        atientsBody)
                }
            });
        }
                    Patients();
        var selectedUser;
        $(docume            ("click", "#updateAppointmetButton", function () {
                  $("#dateAppointmentUpdate").val($(            data("date"))
            $("#timeAppointmen        ate        al($(this).data("time"))
            selectedUser = $( this)            "t                           $("#up                    tmentModal").modal("show");
        })
                           t).on("click", "#u                    ntment", funct                               {
                            var settings = {
                                       PatientAppointments.updateAppointment,
                    "method": "POST",
                    "timeout": 0,
                    "headers": {
                        "Content-Type": "application/json",
                        "Cookie": "laravel_session=eyJpdiI6Ilh1WDdiSWdFYms3QkpWVUUwTExHeVE9PSIsInZhbHVlIjoiUXpjbVV5ekxnQ3V3VzZ2dlVJS255T2ltc2ZMTHgrL1VnMGMyNEI5R3d2UFVL                    R1V                    sd2MrWjlESjh4K1E5aWZPdE5F                        c2xTK0ttbHNhRzJHd2J1Sk8                        FYnUzemlobDhYMXQiLCJtYWMiOiJhODc3OTRlOTk1NjRiY2NlMzhjZmIwZWZiNzRhZTQxYmEwMDEzMTgwMGY2NTVjN2NmOWU0                    diNm                FnIj                "
                    },
                            "data": JSON.stringify({
                                "token": selecte dUser,
                                  "next_appointment": $("#                    tmentUpdate").val() + "  " + $(                        tmentUpdate").val()
                    }),
                };

                            var selectedButt                                            Loader.addLoad                            ton);
                $                            ).done(function (                                                          sponse =                    e(                                        if                     status === 200) {
                        Message.addMessage(res                ssag            ec        utt        "success");
                        setTimeout(() => {
                                   $(".close").trigger("            );
                            Loader.r        eLo        ();
                            fetchPatients();
                               }, 10                                     return;
                            }
                            Loader.r                der();
                              Message.addMessage(response.mes                lec                n, "danger");
                                          }
        }                  $(            nt)            lick", "#deletePatientButton",            ion () {
            selectedUser             is).data("token")
             $("#deletePat                l").modal("show")
        })
                   ocument).on("click", "#deletePa                    nction () {
            var settings = {
                "url": P                    letePatient,
                              ethod": "POST",
                                       0,
                "he                                          "                        ": "application/j                                                                          :                 ingify({
                              oken": selectedUser
                }),
            };
                      sel        dBu         = $(this);
            Loader.addLoader(selectedB utton                     $.ajax(s                .done(function (response) {
                        response =                rse(response)
                        if (r                    atus === 200) {
                                        dMessage(response.message, selectedButton, "success");
                    setTimeout(() => {
                        $(".close").trigger("click");
                        Loader.removeLoader();
                        location.reload();
                        fetchPatients();
                    }, 1000);
                    return;
                }
                                emo                ();
                Messa                    age(response.message, selectedButton, "da                              });
        })
                          nt).on("click", "#addNewPatient", function ()                                 sett             {
                "url": Pati            ddPatient,
                "method            ST",
                "timeout" : 0,
                        "headers": {
                                   t-Type": "application/json",
                              "Cookie": "laravel_session=eyJpdiI6ImpLa255QmpqZmcyRjhlRV                    PSIsInZhbHVlIjoiMWh                        4OXhkNTh4S1VUdlEwSlYrd1Y1Y0NsT                        U5Td1B2MTRVTWFOVWZoQVla                    pUK29nVDZk                    cwWXh6VG9qUWp4cit                    ExJSHFwU                jR                GK3Y0WEIiLCJtYWMiOiI1ZW                M4MDBiMjA5MjExZDM1MDJjMWM0ODNmODg3NzAyYmUxNWU2NjgzZWM5Yjk3MDdhNT            OTkw        dGF        iIn0%3D"
                },
                "data": JSON.stri ngify                             "fullName": $("#pati            lName").val(),
                    "age            #patientAge").val(),
                    "phoneNumber": $("#            tPhoneNumber").val()
                }),
                    

            var selectedButton = $(this);
            Loader.add        er(        ctedButton);
            $.ajax(settings).done(fun ction            onse) {
                         esponse = JSON.parse(response)
                        if (response.st                 200) {
                            Message                    e(response.message, selectedButton,                     ;
                    setTimeout(() => {
                        $(".close").trigger("click");
                        Loader.removeLoader();
                    }, 1000);
                    fetchPatients();
                    return;
                }
                Loader.removeLoader();
                Message.addMessage(response.message, selectedButton, "danger"                                           })
        $(docu                    click", "#updatePatient                    n", function () {
            selectedUser = $(                    ("token")
            $("#updatePatie                    modal("show")
            $("#patientFullNameUpdate"                this            ("f            me"));
            $("#patient            ate").val($(this).data("age"));
                  $("#patientPhoneNumberUpda te").val($(th                ("phone_number"));
        })
                  document).on("click", "#updateP                    unction () {
            var settings = {
                "url":                     s.updatePatient}`,
                            "method": "POST",
                                eout": 0,
                                     : {
                                 ntent-Type                    ation/js                                         "Cookie": "larav                on=eyJpdiI6ImpLa255QmpqZmcyRjhlRVJoOVkzYUE9PSIsInZhbHVlIjoiMWhRb            MZHA        kNT        VUdlEwSlYrd1Y1Y0NsTWtrMjZ4ajNpeU5Td1B2MTRVTWFOVWZoQVlacEo wYkRB            9nVDZkZ25EVncwODcwWXh6VG9qUWp4citHS1N        hWE        FwUUNlS0JDZjRKa3dJUDZGK3Y0WEIiLCJtYWMiOiI1ZW        k1MjM4MDBiMjA5MjExZDM1MDJjMWM0ODNmODg3NzAyYmUxNWU2N jgzZW            MDdhNTI0NmFkOTkwI                joiIn0%3D"
                },
                             ": JSON.stringify(                                               selectedUser                                "fullName": $("#patientF                    ate").val(),
                    "age": $("#patientAgeUpdate").val(),
                    "phoneNumber": $("#patientPhoneNumberUpdate").val()
                }),
            };
            var selectedButton = $(this);
            Loader.addLoader(selectedButton);
            $.ajax(settings).done(function (response) {
                response = JSON.parse(response)
                                     esponse.status === 200) {                               Message.addM                    ponse.message, selectedButton, "success");
                    setTimeout(() => {
                                      $            se").trigger("click");
                              Loader.removeLoader();
                              fetchPatient s();
                            }, 1000);
                                  ;
                }
                               r.removeLoader();
                Message.addMessage(response.mes                    ctedButton, "danger                            });
        })
        $(d                        "click", "#addApp                        on", function () {
                        lectedUser                    .data("t                                          $(document).off                , "#addAppointment")
        $(document).on("click", "#addAppoin            , fu        on      {
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
                    Message.addMessage(response.message, selectedButton, "success");
                    setTimeout(() => {
                        $(".close").trigger("click");
                        fetchPatients();
                        Loader.removeLoader();
                    }, 1000);
                    return;
                }
                Loader.removeLoader();
                Message.addMessage(response.message, selectedButton, "danger");
            });
        })
    })
</script>
@endsection
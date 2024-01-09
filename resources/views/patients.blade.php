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
                                            <h5 class="modal-title" id="addAppointmentTitle">Add New Appointment</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="date" id="dateAppointment" min="<?php echo date('Y-m-d'); ?>">
                                            <input type="time" id="timeAppointment">
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
                                            <input type="date" id="dateAppointmentUpdate"
                                                min="<?php echo date('Y-m-d'); ?>">
                                            <input type="time" id="timeAppointmentUpdate">
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

                            <table class="table table-bordered" id="originalTable">
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
    $(nction()  {
        function fetchPatients() {
            var settin                               "url": Patients                ients,
                         "timeout": 0,
            };
                            ettings).done(function (response)                           response = JSON.pars);
 if === 00) {
        $("#patientsBody").html                                                    patientsBody").ap        (response.data.pat        sBody)
    }
            });
        }
         fetch            ts();
    var selectedUser;
    $(document).on            k", "#updateAppointmetButton", function () {
    #dateAppointmentUpdate").val($(this).            date"))
    $("#timeAppointmentUpdat        val        his).data("time"))
            selectedUser = $(this).data(")                     $("#updateAp                    odal").modal("show");
        })
        $(doc                    "click", "#updateA                    ", function () {
                              r settings = {
            "                        tAppointments.updateAppointment,
                    "method": "POST",
            "timeout": 0,
                    "headers": {
                        "Content-Type": "application/json",
                        "Cookie": "laravel_session=eyJpdiI6Ilh1WDdiSWdFYms3QkpWVUUwTExHeVE9PSIsInZhbHVlIjoiUXpjbVV5ekxnQ3V3VzZ2dlVJS255T2ltc2ZMTHgrL1VnMGMyNEI5R3d2UFVLRkp6U2                    cEJ                    jlESjh4K1E5aWZPdE5FTERMbW                        ttbHNhRzJHd2J1Sk81VHJ1M                        mlobDhYMXQiLCJtYWMiOiJhODc3OTRlOTk1NjRiY2NlMzhjZmIwZWZiNzRhZTQxYmEwMDEzMTgwMGY2NTVjN2NmOWU0ZjQxZW                    Iiwi                In0%                                },
                            "data": JSON.stringify({
                    "token": selectedUser,
                                  "next_appointment": $("#dateAp                    pdate").val() + "  " + $("#time                        pdate").val()
                    }),
                };

            selectedButton = $                                      Loader.addLoader(sel                                            $.ajax((function (respon = JSON.on                                  if(respo                     === 200) {
                Message.addMessage(response.sel            ut         "s        ss");
                        setTimeout(() => {
        $(".close").trigger("click"                                     Loader.removeL        r()                                  fetchPatients();
    }, 1000);
    return;
                            }
    Loader.removeL
    ssage.addMessage(response.message, But                nger");
                }                         }
        })

                selectedUser = $(th            ta("token")
            $("#de letePatientMo                dal("show")
        })
        $                t).on("click", "#deletePatient"() {
        var settings = {
                    "url": Patient                    tient,
                                        : "POST",
            "tim
                              },
        "dat                .s                ({
                                         selectedUser
                }),
            };
    var tedB        n = his);
    Loader.addLoader(selectedButton);
        $.ajax(setting                function (response) {
        response = JSON.sponse)
    if (respons == 200) {
                    Messag                    ge(response.message, selectedButton, "success");
        setTimeout(() => {
            $(".close").trigger("click");
                Loader.removeLoader();
            location.reload();
                     fetchPatients();
               }, 1000);
             return;
            }
                Loader                oad                              Message.add                    sponse.message, selectedButton, "danger")                        });
        })
    $(do ("click", "#addNewPatient", function () {
           var gs = "url": Patients.a            ent,
        "method": "PO                           "timeout": 0,
                               rs": {
        "Cont                ": "application/json",
               "Cookie": "lar a vel_session=eyJpdiI6ImpLa255QmpqZmcyRjhlRVJoOVkz                    ZhbHVlIjoiMWhRbVQ5M                        Th4S1VUdlEwSlYrd1Y1Y0NsTWtrMjZ                        2MTRVTWFOVWZoQVlacEowYk                    VDZkZ25EVn                    VG9qUWp4citHS1NIa                    wUUNlS0J                JU                EIiLCJtYWMiOiI1ZWE0NTk1                MjA5MjExZDM1MDJjMWM0ODNmODg3NzAyYmUxNWU2NjgzZWM5Yjk3MDdhNTI0NmFk            widG        oiI        D"
    },
        "data": JSON.stringify({
               "fullName": $("#patientFul            ).val(),
                "age": $("            ntAge").val(),
                "phoneNumber": $("#patien            Number").val()
            }),
            }; var selectedButton = $(this);
    Loader.addLoader        ect        tton);
    $.ajax(settings).done(function (resp            {
            e =JSON.parse(response)
                    (response.status = {
                   Message.addMe                    onse.message, selectedButton, "succe                                    setTimeout(() => {
                    $(".close").trigger("click");
                Loader.removeLoader();
               }, 1000);
    fetchPatients();
        return;
                }
    Loader.removeLoader();
       Message.addMessage(response.message, selectedButton, "danger");
                    })                  })
    $(document).                    , "#updatePatientModalB                    nction () {
    selectedUser = $(this).n")
            $("#updatePatientModa                    "show")
                $("#patientFullNameUpdate").val(data            _na
            $("#patientAgeUpd            val($(this).data("age"));
                    "#patientPhoneNumberUpdate").v al($(this).da                e_number"));
        })
                        nt).on("click", "#updatePatient                    n () {
            var settings = {
        "url": `${Pat                    tePatient
}`,
                              ethod": "POST",
                                       0,
                "he                                                             Type": "ap                    json",
                                    "Cookie": "laravel_ses                pdiI6ImpLa255QmpqZmcyRjhlRVJoOVkzYUE9PSIsInZhbHVlIjoiMWhRbVQ5MWt            XhkN        1VU        SlYrd1Y1Y0NsTWtrMjZ4ajNpeU5Td1B2MTRVTWFOVWZoQVlacEowYkRBZ UpUK2            Z25EVncwODcwWXh6VG9qUWp4citHS1NIamdhW        HFw        S0JDZjRKa3dJUDZGK3Y0WEIiLCJtYWMiOiI1ZWE0NTk1        MDBiMjA5MjExZDM1MDJjMWM0ODNmODg3NzAyYmUxNWU2NjgzZWM 5Yjk3            I0NmFkOTkwIiwidGF                %3D"
                },
                "da                N.stringify({
                            "token                tedUser,
                              "fullName": $("#patientFullNam                    val(),
                    "age": $("#patientAgeUpdate").val(),
                    "phoneNumber": $("#patientPhoneNumberUpdate").val()
                }),
            };
            var selectedButton = $(this);
            Loader.addLoader(selectedButton);
            $.ajax(settings).done(function (response) {
                response = JSON.parse(response)
                        if                 e.status === 200) {
                              Message.addMessage                    message, selectedButton, "success");
                    setTimeout(() => {
                                         .clo            rigger("click");
                              Loader.removeLoader();
                              fetchPatients();
                                1000);
                    retu                            }
                L                    veLoader();
                Message.addMessage(response.message,                     tton, "danger");
                          ;
        })
        $(documen                        ", "#addAppointme                        unction () {
                              User = $(t                    "token")                 }                  $(document).off("clic                dAppointment")
        $(document).on("click", "#addAppointment"            tion        {
          settings = {
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
                    Message.addMessage(response.lectedButton, "success");
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

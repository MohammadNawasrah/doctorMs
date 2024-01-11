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
  $(function() {
    function fetchPatients() {
      var settings = {
        "url": Patients.showPatients,
        "method": "POST",
        "timeout": 0,
      };
      $.ajax(settings).done(function(response) {
        response = JSON.parse(response);
        if (response.status === 200) {
          $("#patientsBody").html("");
          $("#patientsBody").append(response.data.patientsBody)
        }
      });
    }
    fetchPatients();
    var selectedUser;
    $(document).on("click", "#deletePatientButton", function() {
      selectedUser = $(this).data("token")
      $("#deletePatientModal").modal("show")
    })
    $(document).on("click", "#deletePatient", function() {
      var settings = {
        "url": Patients.deletePatient,
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/json"
        },
        "data": JSON.stringify({
          "token": selectedUser
        }),
      };
      var selectedButton = $(this);
      Loader.addLoader(selectedButton);
      $.ajax(settings).done(function(response) {
        response = JSON.parse(response)
        if (response.status === 200) {
          Message.addMessage(response.message, selectedButton, "success");
          setTimeout(() => {
            $("#deletePatientModal").modal("hide");
            Loader.removeLoader();
            location.reload();
            fetchPatients();
          }, 1000);
          return;
        }
        Loader.removeLoader();
        Message.addMessage(response.message, selectedButton, "danger");
      });
    })
    $(document).on("click", "#addNewPatient", function() {
      var settings = {
        "url": Patients.addPatient,
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/json",
          "Cookie": "laravel_session=eyJpdiI6ImpLa255QmpqZmcyRjhlRVJoOVkzYUE9PSIsInZhbHVlIjoiMWhRbVQ5MWtMZHA4OXhkNTh4S1VUdlEwSlYrd1Y1Y0NsTWtrMjZ4ajNpeU5Td1B2MTRVTWFOVWZoQVlacEowYkRBZUpUK29nVDZkZ25EVncwODcwWXh6VG9qUWp4citHS1NIamdhWExJSHFwUUNlS0JDZjRKa3dJUDZGK3Y0WEIiLCJtYWMiOiI1ZWE0NTk1MjM4MDBiMjA5MjExZDM1MDJjMWM0ODNmODg3NzAyYmUxNWU2NjgzZWM5Yjk3MDdhNTI0NmFkOTkwIiwidGFnIjoiIn0%3D"
        },
        "data": JSON.stringify({
          "fullName": $("#patientFullName").val(),
          "age": $("#patientAge").val(),
          "phoneNumber": $("#patientPhoneNumber").val()
        }),
      };

      var selectedButton = $(this);
      Loader.addLoader(selectedButton);
      $.ajax(settings).done(function(response) {
        response = JSON.parse(response)
        if (response.status === 200) {
          Message.addMessage(response.message, selectedButton, "success");
          setTimeout(() => {
            $("#addNewPatientModal").modal("hide");
            Loader.removeLoader();
          }, 1000);
          fetchPatients();
          return;
        }
        Loader.removeLoader();
        Message.addMessage(response.message, selectedButton, "danger");
      });
    })
    $(document).on("click", "#updatePatientModalButton", function() {
      selectedUser = $(this).data("token")
      $("#updatePatientModal").modal("show")
      $("#patientFullNameUpdate").val($(this).data("full_name"));
      $("#patientAgeUpdate").val($(this).data("age"));
      $("#patientPhoneNumberUpdate").val($(this).data("phone_number"));
    })
    $(document).on("click", "#updatePatient", function() {
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
      $.ajax(settings).done(function(response) {
        response = JSON.parse(response)
        if (response.status === 200) {
          Message.addMessage(response.message, selectedButton, "success");
          setTimeout(() => {
            $("#updatePatientModal").modal("hide");
            Loader.removeLoader();
            fetchPatients();
          }, 1000);
          return;
        }
        Loader.removeLoader();
        Message.addMessage(response.message, selectedButton, "danger");
      });
    })
    $(document).on("click", "#addAppointmentButton", function() {
      selectedUser = $(this).data("token")
    })
    $(document).off("click", "#addAppointment")
    $(document).on("click", "#addAppointment", function() {
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
      $.ajax(settings).done(function(response) {
        response = JSON.parse(response)
        if (response.status === 200) {
          Message.addMessage(response.message, selectedButton, "success");
          setTimeout(() => {
            $("#addAppointmetModal").modal("hide");
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

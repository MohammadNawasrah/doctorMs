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
                            <!-- <div class="modal fade" id="addNewPatientModal" tabindex="-1" aria-labelledby="addNewPatientModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="addNewPatientModalLabel">Fill the information</h5>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div class="mb-3">
                          <div class="row">
                            <div class="col">

                              <input type="text" class="form-control " id="inputField1" placeholder="First Name" required>
                            </div>


  <!-- Modal -->
              <div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="ModalLabel"></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                  </div>
                  <div class="modal-body">
                    <form>
                      <input type="datetime-local" class="form-control">
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Save</button>
                  </div>
                </div>
              </div>
              <div class="row" style="display: flex;justify-content: center;align-items: center; margin-bottom: 20px;">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewPatientModal">Add patient</button>
              </div>
              <!-- ============================================Add patient========================================== -->
              <div class="modal fade" id="addNewPatientModal" tabindex="-1" aria-labelledby="addNewPatientModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="addNewPatientModalLabel">Fill the information</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <div class="row">
                          <div class="col">
                            <input type="text" class="form-control" id="patientFullName" placeholder="Full Name" required>
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <div class="row">
                          <div class="col">
                            <input type="number" class="form-control " id="patientAge" placeholder="Age" required>
                          </div>
                          <div class="col">
                            <input type="tel" class="form-control " id="patientPhoneNumber" placeholder="Phone Number" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required>
                          </div>
                        </div>
                      </div>
                      <div class="centerPage">
                        <div>
                          <div>
                            <button type="button" id="addNewPatient" class="btn btn-primary w-100">Submit</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ===================================================================================== -->
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


                            <!-- Modal -->
                            <!-- <div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="ModalLabel"></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form>
                        <input type="datetime-local" class="form-control">
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-success">Save</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-5"></div>
                <div class="col"><button class="btn btn-primary" style="margin-bottom:4%;">Add patient</button>
                </div>
              </div> -->
                            <!-- ====================================================================================== -->

                            <!-- ====================================================================================== -->

                            <table class="table table-bordered">
                                <thead class="table-bordered-custom text-center">
                                    <tr>
                                        <th scope="col" class="col-1">id</th>
                                        <th scope="col" class="col-3">Name</th>
                                        <th scope="col" class="col-4">Events</th>
                                    </tr>
                                </thead>
                                <tbody id="patientsBody">
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
    $(function () {
        function fetchPatients() {
            var settings = {
                "url": Patients.showPatients,
                "method": "POST",
                "timeout": 0,
            };

            $.ajax(settings).done(function (response) {
                response = JSON.parse(response);
                if (response.status === 200) {
                    $("#patientsBody").html("");
                    $("#patientsBody").append(response.data.patientsBody)
                }
            });
        }
        fetchPatients();
        var selectedUser;
        $(document).on("click", "#deletePatientButton", function () {
            selectedUser = $(this).data("token")
            $("#deletePatientModal").modal("show")
        })
        $(document).on("click", "#deletePatient", function () {
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
            $.ajax(settings).done(function (response) {
                response = JSON.parse(response)
                if (response.status === 200) {
                    Message.addMessage(response.message, selectedButton, "success");
                    setTimeout(() => {
                        $("#deletePatientModal").modal("hide");
                        Loader.removeLoader();
                        fetchPatients();
                    }, 1000);
                    return;
                }
                Loader.removeLoader();
                Message.addMessage(response.message, selectedButton, "danger");
            });
        })
        $(document).on("click", "#addNewPatient", function () {
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
            fetchPatients();
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

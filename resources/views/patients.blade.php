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
  <div class="col"><button class="btn btn-primary" style="margin-bottom:4%;" data-bs-toggle="modal" data-bs-target="#aseel">Add patient</button>
</div></div>
<!-- ============================================Add patient========================================== -->
<div class="modal fade" id="aseel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Fill the information</h5>
        </div>
        <div class="modal-body">
            <form>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                          <input type="text" class="form-control" id="inputField1" placeholder="Full Name" required>
                          </div>
                    </div>
                </div>
                <div class="mb-3">
                <div class="row">
                <div class="col">

                    <input type="number" class="form-control " id="inputField1" placeholder="Age" required>
                </div>

                <div class="col">
                  <input type="tel" class="form-control " id="phoneNumber" placeholder="Phone Number" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required>
                </div>
            </div>
        </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
              </form>
        </div>
      </div>
    </div>
  </div>
              <!-- ===================================================================================== -->
              <!-- ==========================================delete modal============================================ -->

              <div class="modal fade" tabindex="-1" role="dialog" id="deletePatientModal" aria-labelledby="deletePatientModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="deletePatientModalLabel">are you sure to delete ??</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div style="display: flex;justify-content: center ;align-items: center; flex-direction: column; text-align: center;">
                      <div>
                        <div>
                          <button type="button" id="deletePatient" class="btn btn-danger m-3">Delete User</button>
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
                <thead class="table-bordered-custom">
                  <tr>
                    <th scope="col" class="col-1" style="padding-left: 5%;">id</th>
                    <th scope="col" class="col-3" style="padding-left: 5%;">Name</th>
                    <th scope="col" class="col-4" style="padding-left: 5%;">Events</th>
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
  $(function() {
    function fetchPatients() {
      var settings = {
        "url": "http://localhost/dashboard/patients",
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
        "url": "http://localhost/dashboard/patients/patient/delete",
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

      $.ajax(settings).done(function(response) {
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
  })
</script>
@endsection
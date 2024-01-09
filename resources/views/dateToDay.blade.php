@extends('layouts.dashboard')

@section('title', 'Htmo Code Page')

@section('content')
<main class="col">

  <!-- Main Content -->
  <main role="main" class="col">
    <!-- Content Goes Here -->
    <div class="container mt-5  ">
      <div class="row justify-content-center ">
        <div class="col">
          <div class="abc scroll " style="height: 250px; padding: 0; margin: 0;">
            <!-- ====================================================================================== -->

            <!-- ===================================================================================== -->
            <!-- ==========================================delete modal============================================ -->
            <!-- Modal -->
            <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Are you sure to delete it?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- ====================================================================================== -->

            <table class="table table-bordered">
              <thead class="table-bordered-custom">
                <tr style="text-align: center;">
                  <th scope="col" class="col-1">id</th>
                  <th scope="col" class="col-3">Name</th>
                  <th scope="col" class="col-3">Time and Date</th>
                  <th scope="col" class="col-3">Doctor</th>
                  <th scope="col" class="col-5">Events</th>
                </tr>
              </thead>

              <tbody id="patientsAppointmentBody">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- You can retain your existing HTML content here -->
  </main>
  </div>

  <!-- You can retain your existing HTML content here -->
</main>
</div>
</div>
<script src="https://cdn.socket.io/4.7.2/socket.io.min.js" integrity="sha384-mZLF4UVrpi/QTWPA7BjNPEnkIfRFn4ZEO3Qt/HFklTJBj/gBOV8G3HcKn4NfQblz" crossorigin="anonymous"></script>
<script>
  function fetchPatientsHaveDateToday() {
    var settings = {
      "url": PatientAppointments.patientsHaveAppoinntment,
      "method": "POST",
      "timeout": 0,
    };
    $.ajax(settings).done(function(response) {
      console.log(response)
      response = JSON.parse(response);
      $("#patientsAppointmentBody").html("");
      if (response.status === 200) {
        $("#patientsAppointmentBody").html("");
        $("#patientsAppointmentBody").append(response.data.patientsAppointmentBody)
      }
      Loader.removeLoadPage();

    });
  }
  fetchPatientsHaveDateToday();
  let ipAddress = "127.0.0.1";
  let socketPort = "3000";
  let socket = io(ipAddress + ":" + socketPort);
  $(document).on("click", "#sendToDoctorButton", function() {
    socket.emit("sendPatientToServer", {
      toDoctor: $("#selectDoctorToken").val(),
      patientToken: $(this).data("token"),
      baseUrl: UrlData.baseUrl
    });
  })
  socket.on("responsSendToServer", (response) => {
    fetchPatientsHaveDateToday();
    Message.addModalMessage(response, 1500);
  })
</script>

</main>

@endsection
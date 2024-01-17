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
            <!-- ===================================================================================== -->

            <!-- ===================================================================================== -->
            <!-- ==========================================delete modal============================================ -->
            <!-- Modal -->
            <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Are you sure to delete it?</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- ====================================================================================== -->
            <!-- ====================================================================================== -->
            <div class="container" style="max-height: 60vh; overflow-y: auto;">
            <table class="table table-bordered">
              <thead class="table-bordered-custom sti">
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
    </div>
    <!-- You can retain your existing HTML content here -->
  </main>
  </div>

  <!-- You can retain your existing HTML content here -->
</main>
</div>
</div>
<script src="/js/dateToDay.js"></script>


</main>

@endsection

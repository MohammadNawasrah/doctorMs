@extends('layouts.dashboard')

@section('title', 'Patients')

@section('content')
<script src="/js/patient.js"></script>
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
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewPatientModal">Add
                  patient</button>
              </div>
              <!-- ============================================Add patient========================================== -->
              <div class="modal fade" id="addNewPatientModal" tabindex="-1" aria-labelledby="addNewPatientModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">

                      <h5 class="modal-title" id="addNewPatientModalLabel">Fill Patient Info</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="patients/patient/add" id="addPatientForm" method="post">
                        <div class="mb-3">
                          <div class="row">
                            <div class="col">
                              <input type="text" class="form-control" id="patientFullName" name="fullName" placeholder="Full Name" required>

                            </div>
                          </div>
                        </div>
                        <div class="mb-3">
                          <div class="row">
                            <div class="col">
                              <input type="number" class="form-control " id="patientAge" name="age" placeholder="Age" required>
                            </div>
                            <div class="col">
                              <input type="tel" class="form-control " id="patientPhoneNumber" name="phoneNumber" placeholder="Phone Number" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required>

                            </div>
                          </div>
                        </div>
                        <div class="centerPage">
                          <div>
                            <div>
                              <button type="submit" id="addNewPatient" class="btn btn-primary w-100">Submit</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ===================================================================================== -->
              <div class="modal fade" id="updatePatientModal" tabindex="-1" aria-labelledby="updatePatientModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="updatePatientModalLabel">Fill Update Patient
                        Data</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <div class="row">
                          <div class="col">
                            <input type="text" class="form-control" id="patientFullNameUpdate" placeholder="Full Name" required>

                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <div class="row">
                          <div class="col">
                            <input type="number" class="form-control " id="patientAgeUpdate" placeholder="Age" required>
                          </div>
                          <div class="col">
                            <input type="tel" class="form-control " id="patientPhoneNumberUpdate" placeholder="Phone Number" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required>

                          </div>
                        </div>
                      </div>
                      <div class="centerPage">
                        <div>
                          <div>
                            <button type="button" id="updatePatient" class="btn btn-primary w-100">Update</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="addPay" tabindex="-1" aria-labelledby="paymentsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="ModalLabel"> اضافة المبلغ الذي على المريض</h5>
                      <button type="hidden" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="payment/updatePaymnet" id="updatePaymentForm" method="post">
                      <div class="modal-body h-50">
                        <div class="form-floating">
                          <input type="hidden" name="patientToken" id="patientToken" required>
                          <input type="hidden" name="recordId" id="recordId" required>
                          <input type="number" name="paymentValue" placeholder="add payment for patient" id="paymentInputForPatient" required>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" id="updatePayment" class="btn btn-success">Save</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- ==========================================delete modal============================================ -->

              <div class="modal fade" tabindex="-1" role="dialog" id="deletePatientModal" aria-labelledby="deletePatientModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="deletePatientModalLabel">Are You Sure To Delete ?</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="centerPage">
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


              <div class="modal fade" tabindex="-1" role="dialog" id="addAppointmetModal" aria-labelledby="addAppointmetModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="addAppointmentTitle">Set Appointment</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="dateAppointment" class="form-label">Appointment Date</label>
                        <input type="date" id="dateAppointment" class="form-control" min="<?php echo date('Y-m-d'); ?>">
                      </div>
                      <div class="mb-3">
                        <label for="timeAppointment" class="form-label">Appointment Time</label>
                        <input type="time" id="timeAppointment" class="form-control">
                      </div>
                    </div>
                    <div class="centerPage">
                      <div>
                        <div>
                          <button type="button" id="addAppointment" class="btn btn-danger m-3">Add New
                            Appointmet</button>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" tabindex="-1" role="dialog" id="updateAppointmentModal" aria-labelledby="updateAppointmentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="updateAppointmentTitle">Add New Appointment</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="dateAppointment" class="form-label">Appointment Date</label>
                        <input type="date" class="form-control" id="dateAppointmentUpdate" min="<?php echo date('Y-m-d'); ?>">
                      </div>
                      <div class="mb-3">
                        <label for="timeAppointment" class="form-label">Appointment Time</label>
                        <input type="time" class="form-control" id="timeAppointmentUpdate">
                      </div>
                    </div>
                    <div class="centerPage">
                      <div class="centerPage">
                        <div>
                          <button type="button" id="updateAppointment" class="btn btn-success m-3">Update Appointment
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- ====================================================================================== -->
<<<<<<< HEAD
              <div class="search-box">
                            <input type="text" class="form-control" id="searchInput" placeholder="Search..."
                                oninput="filterTable()">
                        </div>
=======

>>>>>>> a1982f4 (fix)
              <!-- ====================================================================================== -->
              <div class="container" style="max-height: 60vh; overflow-y: auto;">
                <table class="table table-bordered">
                  <thead class="table-bordered-custom sti">
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
      </div>
      <!-- You can retain your existing HTML content here -->
    </div>
  </div>
</main>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> a1982f4 (fix)

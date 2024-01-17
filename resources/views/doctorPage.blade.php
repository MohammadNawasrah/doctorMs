@extends('layouts.dashboard')

@section('title', 'Doctor Page')

@section('content')

<!-- Main Content -->
<!-- modal table to add note -->

<!--===================================================cheak books======================================================= -->

<!--===================================================================================================================== -->
<main role="main" class="col">
    <div class="modal fade " data-bs-backdrop="static" data-bs-keyboard="false" id="noteModal" tabindex="-1"
        aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"> Note</h5>
                    <button type="button" style="display: none;" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body h-50">
                    <div class="form-floating">
                        <textarea class="form-control" style="width: 1000;height: 600;" placeholder="Leave a Note here"
                            id="noteTextArea"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="addMonyToPatient" class="btn btn-success">Add Mony To Patient</button>
                    <button type="button" id="saveNote" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal table to add note -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="paymentsModal" tabindex="-1"
        aria-labelledby="paymentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"> Add the amount owed by the patient</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="payment/addPaymnet" id="addPaymentForm" method="post">
                    <div class="modal-body h-50">
                        <div class="form-floating">
                            <input type="hidden" name="patientToken" id="patientToken" required>
                            <input type="hidden" name="recordId" id="recordId" required>
                            <input type="number" class="form-control" name="paymentValue"
                                placeholder="add payment for patient" id="paymentInputForPatient" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="addPayment" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- image upload -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="addPhotoModal" tabindex="-1"
        aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ModalLabel">photo</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body w-100" style="height: 50;">
                    <div class="container mt-2">
                        <h3 class="mb-4" style="text-align: center;">Image Upload For Patient </h3>
                        <div class="mb-3" style="text-align: center;">
                            <label for="image" class="form-label">Choose Image</label>
                            <input type="file" class="form-control w-100" id="patientImage" multiple accept="image/*">
                        </div>
                        <button type="button" id="uplodeImagePatient" class="btn btn-primary w-100">Upload
                            Image</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- image upload -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="checkModal" tabindex="-1"
        aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" style="display: none;" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body w-100">
                    <div class="container" style="max-height: 60vh; overflow-y: auto;">
                        <div class="container col" style="display: flex;flex-direction: column;gap: 10px;"
                            id="checkDiv">

                        </div>
                    </div>
                    <button type="button" id="addCehcedToNote" class="btn btn-success mt-3 w-100">Add To Note</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Goes Here -->
    <div class="container mt-5  ">
        <div class="row justify-content-center ">
            <div class="col">
                <div class="abc scroll " style="height: 250px; padding: 0; margin: 0;">
                    <table class="table table-bordered">
                        <thead class="table-bordered-custom">
                            <tr style="text-align: center;">
                                <th scope="col" class="col-1">id</th>
                                <th scope="col" class="col-4">Name</th>
                                <th scope="col" class="col-4">Time and Date</th>
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
    <script src="/js/doctor.js"></script>
</main>

@endsection
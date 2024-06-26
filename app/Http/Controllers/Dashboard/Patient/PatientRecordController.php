<?php

namespace App\Http\Controllers\Dashboard\Patient;

use App\Models\PatientAppoinntments;
use App\Models\PatientRecords;
use App\Models\Patients;
use App\Models\PatientToDoctor;
use App\Models\Payments;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\ImageHelper;
use Trait\Helpers\RequsetHelper;
use Trait\Helpers\UtileHelper;

class PatientRecordController
{
    public function addRecord(Request $request)
    {
        $patientToken = $request->get('token');
        $patientNote = $request->get('patientNote');
        $doctorTableId = $request->get('doctorTableId');
        UtileHelper::checkIfDataEmptyOrNullJsonData($request->input());

        $patient = Patients::getPatientByToken($patientToken);
        PatientToDoctor::changeStatusToFalse($patient["id"]);
        PatientAppoinntments::deletePatientRecord($patient["id"]);
        $data = [
            "doctorTableId" => $doctorTableId,
            'patientId' =>  $patient["id"],
            'patientNote' => $patientNote,
        ];

        RequsetHelper::addResponseData("hasPayment", Payments::checkIfPatientHasPayment($patient["id"]));
        PatientRecords::createRecord($data);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Patient " . $patient["fullName"] . "added Record sucessfully");
    }
    public function showRecords()
    {
        $patientsRecords = PatientRecords::getAllRecords();
        RequsetHelper::addResponseData("data", $patientsRecords);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patients data with appointments retrieved successfully');
    }
    public function getAllRecordForPatient(Request $request)
    {
        $patientToken = $request->get("patienToken");
        $patient = Patients::getPatientByToken($patientToken);
        $patinetRecord = PatientRecords::getAllPatientRecords($patient["id"]);
        $table = '';
        $mainData = [
            "name" => $patient["fullName"], "patientFullPay" => Payments::getAllPaymentsForPateint($patient["id"]), "patientFullWasPay" => Payments::getAllPaymentsForPateintWellPay($patient["id"]) - Payments::getAllPaymentsForPateint($patient["id"])
        ];
        foreach ($patinetRecord as $patient) {
            $paymentMony = Payments::getPaymentByDoctorTableRecord($patient["doctorTableId"]);
            $table .= '<tr>
            <td>' . $patient["id"] . '</td>
            <td style="text-align: center;">' . $paymentMony . '</td>';
            $table .= ' <td style="text-align: center;">' . $patient["created_at"] . '</td>';
            $table .= '<td><button class="btn  btn-secondary w-100" data-note="' . $patient["patientNote"] . '"  data-toggle="tooltip" data-placement="top" title="Show Nots" id="showNoteModal" data-bs-toggle="modal" data-bs-target="#noteModal"><i class="bi bi-eye-fill"></i></button></td>';
            $table .= '<td><button class="btn btn-warning w-100" data-toggle="tooltip" data-photo="' . $patient["doctorTableId"] . '" data-token="' . $patient["token"] . '"  id="showPhotoModal" data-placement="top" title="Photo" data-bs-toggle="modal" data-bs-target="#photoModal"><i class="bi bi-image"></i></button></td>';
            $table .= '<td style="display :flex;justify-content:center; align-items:center;flex-direction:row; gap:5px"><button data-token="' . $patient["token"] . '"  class="btn btn-success w-100" data-toggle="tooltip" data-placement="top" title="Update" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><i class="bi bi-arrow-down-up"></i></button>';
            $table .= '<button id="showDeleteRecordModal" data-record_id="' . $patient["id"] . '" class="btn btn-danger w-100" data-toggle="tooltip" data-placement="top" title="Delete" data-photo="' . $patient["doctorTableId"] . '" data-token="' . $patient["token"] . '"><i class="bi bi-trash"></i></button>';
            $table .= "</td></tr>";
        }
        $actions = [
            "patientsRecordBody" => $table
        ];
        RequsetHelper::addResponseData("main", $mainData);
        RequsetHelper::addResponseData("data", $actions);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patients Record Fetch successfully');
    }
    public function showRecord($token)
    {
        return View("patientShowRecord");
    }
    public function fullRecord($token)
    {
        return View("patientFullRecord");
        $patient = Patients::getPatientByToken($token);
        $patinetRecord = PatientRecords::getAllPatientRecords($patient["id"]);
        RequsetHelper::addResponseData("data", $patinetRecord);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient data with appointments retrieved successfully');
    }
    public function deleteRecord(Request $request)
    {
        $recordId = $request->get("recordId");
        $PhotoDirectory = $request->get("PhotoDirectory");
        $patientToken = $request->get("patientToken");
        PatientRecords::deletePatientRecord($recordId);
        ImageHelper::deleteDirectory('image/' . $patientToken . "/$PhotoDirectory");
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient Record deleted successfully');
    }
    public function updateRecord(Request $request)
    {
        $patientToken = $request->get("token");
        $recordId = $request->get("recordId");
        $patient = Patients::getPatientByToken($patientToken);
        $patientNote = $request->get("patientNote");
        $newData = [
            'patientNote' => $patientNote,
        ];
        PatientRecords::updatePatientRecord($patient["id"], $recordId, $newData);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient Record updated successfully');
    }
}

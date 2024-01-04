<?php

namespace App\Http\Controllers\Dashboard\Patient;

use App\Models\PatientRecords;
use App\Models\Patients;
use Illuminate\Http\Request;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;

class PatientRecordController
{
    public function addRecord(Request $request)
    {
        $patientToken = $request->get('token');
        $patientNote = $request->get('patientNote');
        $patient = Patients::getPatientByToken($patientToken);
        $data = [
            'patientId' =>  $patient["id"],
            'patientNote' => $patientNote,
        ];
        PatientRecords::createRecord($data);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Patient " . $patient["fullName"] . "added Record sucessfully");
    }
    public function showRecords()
    {
        $patientsRecords = PatientRecords::getAllRecords();
        RequsetHelper::addResponseData("data", $patientsRecords);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patients data with appointments retrieved successfully');
    }
    public function showRecord(Request $request)
    {
        $patientToken = $request->get("token");
        $patient = Patients::getPatientByToken($patientToken);
        $patinetRecord = PatientRecords::getAllPatientRecords($patient["id"]);
        RequsetHelper::addResponseData("data", $patinetRecord);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient data with appointments retrieved successfully');
    }
    public function deleteRecord(Request $request)
    {
        $patientToken = $request->get("token");
        $recordId = $request->get("recordId");
        $patient = Patients::getPatientByToken($patientToken);
        PatientRecords::deletePatientRecord($patient["id"], $recordId);
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

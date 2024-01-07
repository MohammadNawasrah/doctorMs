<?php

namespace App\Http\Controllers\Dashboard\Patient;

use App\Models\Patients;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Trait\Helpers\GenerateHelper;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;

class PatientController
{
    use GenerateHelper;
    public function index()
    {
        return View("patients");
    }
    public function addPatient(Request $request)
    {
        $fullName = $request->get("fullName");
        $age = $request->get('age');
        $phoneNumber = $request->get('phoneNumber');
        $newData = [
            'fullName' => $fullName,
            'age' => $age,
            'phoneNumber' => $phoneNumber,
            'token' => $this->generateTokenByUsername($phoneNumber)
        ];
        Patients::createRecord($newData);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Patient $fullName added sucessfully");
    }
    public function updatePatient(Request $request)
    {
        $patientToken = $request->get("token");
        $fullName = $request->get("fullName");
        $age = $request->get('age');
        $phoneNumber = $request->get('phoneNumber');
        $newData = [
            'fullName' => $fullName,
            'age' => $age,
            'phoneNumber' => $phoneNumber,
        ];
        Patients::updatePatientRecord($patientToken, $newData);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient updated successfully');
    }
    public function deletePatient(Request $request)
    {
        $patientToken = $request->get("token");
        Patients::deletePatient($patientToken);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient deleted successfully');
    }
    public function showPatient(Request $request)
    {
        $patientToken = $request->get("token");
        $patient = Patients::getPatientByToken($patientToken);
        RequsetHelper::addResponseData("data", $patient);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient fetch successfully');
    }
    public function showPatients()
    {
        $patient = Patients::getAllPatients();
        RequsetHelper::addResponseData("data", $patient);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patients Fetch successfully');
    }
}

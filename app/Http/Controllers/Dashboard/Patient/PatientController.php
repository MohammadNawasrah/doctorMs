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
        $patients = Patients::getAllPatients();
        $table = '';
        foreach ($patients as $patient) {
            $table .= '<tr>
            <td>' . $patient["id"] . '</td>
            <td style="text-align: center;">' . $patient["fullName"] . '</td>
            <td style="display: flex;justify-content: space-evenly;">
            ';

            $table .= ' <button class="btn btn-primary" style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="Add an appointment"><i class="bi bi-plus"></i></button>';

            $table .= '<button class="btn btn-success" style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="Update" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-arrow-down-up"></i></button>';

            $table .= '<button class="btn btn-warning" data-toggle="tooltip" style="margin-left: 4%;" data-placement="top" title="record" data-bs-toggle="modal" data-bs-target="#Modaadsfl"><i class="bi bi-files"></i></button>';

            $table .= '<button class="btn btn-secondary" data-toggle="tooltip" style="margin-left: 4%;" data-placement="top" title="View record" data-bs-toggle="modal" data-bs-target="#Moddal"><i class="bi bi-binoculars"></i></button>';

            $table .= '<button data-token="' . $patient["token"] . '" id="deletePatientButton" class="btn btn-danger" data-toggle="tooltip" style="margin-left: 4%;" data-placement="top" title="Delete" ><i class="bi bi-trash"></i></button>';

            $table .= "</td></tr>";
        }
        $actions = [
            "patientsBody" => $table
        ];
        RequsetHelper::addResponseData("data", $actions);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patients Fetch successfully');
    }
}

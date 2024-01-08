<?php

namespace App\Http\Controllers\Dashboard\Patient;

use App\Models\Patients;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Trait\Helpers\GenerateHelper;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;
use Trait\Helpers\UtileHelper;

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
        UtileHelper::checkIfDataEmptyOrNullJsonData($request->input());
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
            "token" => $patientToken,
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

            $table .= '<button class="btn btn-success" data-token="' . $patient["token"] . '" id="addAppointmentButton" style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="Add Appointment" data-bs-toggle="modal" data-bs-target="#addAppointmetModal"><i class="bi bi-calendar"></i></button>';

            $table .= '<button class="btn btn-success" data-token="' . $patient["token"] . '" id="updatePatientModalButton" data-phone_number="' . $patient["phoneNumber"] . '" data-age="' . $patient["age"] . '" data-full_name="' . $patient["fullName"] . '"  style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="Update" ><i class="bi bi-arrow-down-up"></i></button>';

            $table .= '<a class="btn btn-warning" href="/dashboard/patientRecords/record/show/' . $patient["token"] . '" target="_blank"  data-toggle="tooltip" style="margin-left: 4%;" data-placement="top" title="record" ><i class="bi bi-files"></i></a>';

            $table .= '<a href="/dashboard/patientRecords/record/full/' . $patient["token"] . '" target="_blank" class="btn btn-secondary" data-toggle="tooltip" style="margin-left: 4%;" data-placement="top" title="View record" ><i class="bi bi-binoculars"></i></a>';

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

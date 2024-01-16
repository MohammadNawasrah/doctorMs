<?php

namespace App\Http\Controllers\Dashboard\Patient;

use App\Models\PatientAppoinntments;
use App\Models\Patients;
use App\Models\Payments;
use App\Models\UserPermission;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Trait\Helpers\GenerateHelper;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;
use Trait\Helpers\UtileHelper;
use Trait\Helpers\ValidationHelper;

class PatientController
{
    use ValidationHelper;
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
        if (!$this->validatePhoneNumber($phoneNumber))
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, "Phone number not Valid"));
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
        UtileHelper::checkIfDataEmptyOrNullJsonData($request->input());
        if (!$this->validatePhoneNumber($phoneNumber))
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, "Phone number not Valid"));
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
        $buttonHtml = '<button data-token="{PATIENT_TOKEN}" id="deletePatientButton" class="btn btn-danger" data-toggle="tooltip" style="margin-left: 4%;" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>';
        $patients = Patients::getAllPatients();
        $table = '';
        $acctionAllow = UserPermission::getOnPermissionToUser();
        $patientsAppointmentIds = PatientAppoinntments::getAllUserIdHaveAppoinntment();
        foreach ($patients as $patient) {
            $table .= '<tr>
            <td>' . $patient["id"] . '</td>
            <td style="text-align: center;">' . $patient["fullName"] . '</td>
            <td style="display: flex;justify-content: space-evenly;">
            ';
            if (in_array($patient["id"], $patientsAppointmentIds) && in_array("updateAppointment", $acctionAllow)) {
                $patientDateAppointment = PatientAppoinntments::getRecordByPatientId($patient["id"]);
                $carbonDatetime = \Carbon\Carbon::parse($patientDateAppointment["next_appointment"]);
                $date = $carbonDatetime->toDateString();
                $time = $carbonDatetime->toTimeString();
                $table .= '<button class="btn btn-warning" data-time="' . $time . '" data-date="' . $date . '" data-type="haveAppointment" data-token="' . $patient["token"] . '" id="updateAppointmetButton" style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="Update Appointment" ><i class="bi bi-arrow-clockwise"></i></button>';
            } else if (!Payments::isPatientNotPay($patient["id"])["status"] && in_array("payment", $acctionAllow)) {
                $table .= '<button class="btn btn-success" data-doctor="' . Payments::isPatientNotPay($patient["id"])["fk_record"] . '" data-type="mustHePay" data-token="' . $patient["token"] . '" id="mustPay" style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="Must Pay" data-bs-toggle="modal" data-bs-target="#addPay"><i class="bi bi-credit-card"></i></button>';
            } else if (in_array("addAppointment", $acctionAllow)) {
                $table .= '<button class="btn btn-success" data-type="haveNotAppointment" data-token="' . $patient["token"] . '" id="addAppointmentButton" style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="Add Appointment" data-bs-toggle="modal" data-bs-target="#addAppointmetModal"><i class="bi bi-calendar-plus"></i></button>';
            }
            if (in_array("updatePatient", $acctionAllow))
                $table .= '<button class="btn btn-success" data-token="' . $patient["token"] . '" id="updatePatientModalButton" data-phone_number="' . $patient["phoneNumber"] . '" data-age="' . $patient["age"] . '" data-full_name="' . $patient["fullName"] . '"  style="margin-left: 4%;" data-toggle="tooltip" data-placement="top" title="Update Patient" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4m9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
            </svg></button>';
            if (in_array("showPatientRecord", $acctionAllow))
                $table .= '<a href="/dashboard/patientRecords/record/' . $patient["token"] . '" target="_blank" class="btn btn-secondary" data-toggle="tooltip" style="margin-left: 4%;" data-placement="top" title="View record" ><i class="bi bi-eye-fill"></i></a>';
            if (in_array("deleltePatient", $acctionAllow))
                $table .= str_replace('{PATIENT_TOKEN}', $patient['token'], $buttonHtml);
            $table .= "</td></tr>";
        }
        $actions = [
            "patientsBody" => $table
        ];
        RequsetHelper::addResponseData("data", $actions);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patients Fetch successfully');
    }
}

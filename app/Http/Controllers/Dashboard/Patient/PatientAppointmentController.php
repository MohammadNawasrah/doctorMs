<?php

namespace App\Http\Controllers\Dashboard\Patient;

use App\Models\PatientAppoinntments;
use App\Models\Patients;
use Exception;
use Illuminate\Http\Request;
use Trait\Helpers\DateHelper;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;

class PatientAppointmentController
{
    public function showAppointments()
    {
        $patientAppointmentsData = PatientAppoinntments::getAllRecords();
        RequsetHelper::addResponseData("data", $patientAppointmentsData);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient data with appointments retrieved successfully');
    }
    public function addAppointment(Request $request)
    {
        $patientToken = $request->get('token');
        $patient = Patients::getPatientByToken($patientToken);
        $nextappointment = $request->get('nextappointment');
        $newData = [
            'patientId' =>  $patient["id"],
            'nextappointment' => $nextappointment,
        ];

        PatientAppoinntments::createRecord($newData);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Patient added Appointment sucessfully");
    }
    public function showAppointment(Request $request)
    {
        $patientToken = $request->get("token");
        $patient = Patients::getPatientByToken($patientToken);
        $patientAppointmentsData = PatientAppoinntments::getPatientRecord($patient["id"]);
        RequsetHelper::addResponseData("data", $patientAppointmentsData);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient data with appointments retrieved successfully');
    }
    public function deleteAppointment(Request $request)
    {
        $patientToken = $request->get("token");
        $patient = Patients::getPatientByToken($patientToken);
        PatientAppoinntments::deletePatientRecord($patient["id"]);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient Appoinntment deleted successfully');
    }
    public function updateAppointment(Request $request)
    {
        $patientToken = $request->get("token");
        $patient = Patients::getPatientByToken($patientToken);
        $nextappointment = $request->get("nextappointment");
        $newData = [
            'nextappointment' => $nextappointment,
        ];
        PatientAppoinntments::updatePatientRecord($patient["id"], $newData);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient Appoinntment updated successfully');
    }
    public function patientsHaveAppoinntment()
    {
        $patientAppointmentsData = PatientAppoinntments::getAllPatientsHaveAppoinntmentToday();
        RequsetHelper::addResponseData("data", $patientAppointmentsData);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient Appoinntment updated successfully');
    }
}

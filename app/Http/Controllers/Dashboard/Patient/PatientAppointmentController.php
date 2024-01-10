<?php

namespace App\Http\Controllers\Dashboard\Patient;

use App\Models\PatientAppoinntments;
use App\Models\Patients;
use App\Models\Users;
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
        $patientToken = $request->input('token');
        $patient = Patients::getPatientByToken($patientToken);
        $next_appointment = $request->input('next_appointment');
        $newData = [
            'patientId' =>  $patient["id"],
            'next_appointment' => $next_appointment,
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
        $next_appointment = $request->get("next_appointment");
        $newData = [
            'next_appointment' => $next_appointment,
        ];
        PatientAppoinntments::updatePatientRecord($patient["id"], $newData);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient Appoinntment updated successfully');
    }
    public function patientsHaveAppoinntment()
    {

        $doctors = Users::getAllDoctor();
        $options = "";
        foreach ($doctors as $key => $value) {
            $options .= '<option value="' . $value["token"] . '">' . $value["userName"] . '</option>';
        }
        $patientAppointmentsData = PatientAppoinntments::getAllPatientsHaveAppoinntmentToday();
        $table = '';
        foreach ($patientAppointmentsData as $patient) {
            $table .= '<tr style="text-align: center;">
            <td><div style="padding-top:10px">' . $patient["id"] . '</div></td>
            <td style="text-align: center;"><div style="padding-top:10px">' . $patient["fullName"] . '</div></td>
            <td ><div style="padding-top:10px">' . $patient["next_appointment"] . '</div></td>';
            $table .= '<td > <select  id="selectDoctorToken">
            ' . $options . '
                </select></td>';
            $table .= '<td style="display: flex;justify-content: space-evenly;">';

            $table .= '<button class="btn btn-success" id="sendToDoctorButton" data-token="' . $patient["token"] . '"  data-toggle="tooltip" data-placement="top" title="send"><i class="bi bi-arrow-right"></i></button>';

            $table .= '<button class="btn btn-danger" data-token="' . $patient["token"] . '" data-toggle="tooltip"  data-placement="top" title="Delete appointment" data-bs-toggle="modal" data-bs-target="#Modal"><i class="bi bi-calendar-check"></i></button>';

            $table .= "</td></tr>";
        }
        $actions = [
            "patientsAppointmentBody" => $table
        ];
        RequsetHelper::addResponseData("data", $actions);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient Appoinntment updated successfully');
    }
}

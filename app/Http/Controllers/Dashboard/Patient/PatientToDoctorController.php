<?php

namespace App\Http\Controllers\Dashboard\Patient;

use App\Models\PatientAppoinntments;
use App\Models\Patients;
use App\Models\PatientToDoctor;
use App\Models\Users;
use Illuminate\Http\Request;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;

class PatientToDoctorController
{
    public function addtoDoctor(Request $request)
    {
        $patientToken = $request->get('patientToken');
        $userToken = $request->get('userToken');
        $userId = Users::getUserIdByToken($userToken);
        $patient = Patients::getPatientByToken($patientToken);
        $newData = [
            'userId' => $userId,
            'patientId' => $patient["id"],
            'status' => true,
        ];
        PatientAppoinntments::changeStatusToSendDoctor($patient, true);
        PatientToDoctor::createRecord($newData);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Patient send To Doctor " . $userId);
    }

    public function showPatientsToAllDoctors()
    {
        $patientData = PatientToDoctor::getAllRecords();
        RequsetHelper::addResponseData("data", $patientData);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient data with appointments retrieved successfully');
    }
    public function showPatientsToDoctor()
    {
        $patientsData = PatientToDoctor::getPatientsToDoctor();
        $table = '';
        foreach ($patientsData as $patient) {
            $table .= '<tr style="text-align: center;">
            <td><div style="padding-top:10px">' . $patient["patientId"] . '</div></td>
            <td style="text-align: center;"><div style="padding-top:10px">' . $patient["fullName"] . '</div></td>
            <td ><div style="padding-top:10px">' . $patient["created_at"] . '</div></td>
            <td style="display: flex;justify-content: space-evenly;">
            ';
            $table .= '<button class="btn btn-primary" data-token="' . $patient["token"] . '" data-toggle="tooltip" data-placement="top" title="Add Record"><i class="bi bi-card-checklist"></i></button>';

            $table .= '<button class="btn btn-success" id="sendToDoctorButton" data-token="' . $patient["token"] . '"  data-toggle="tooltip" data-placement="top" title="Finish"><i class="bi bi-calendar2-check"></i></button>';

            $table .= "</td></tr>";
        }
        $actions = [
            "patientsAppointmentBody" => $table
        ];
        RequsetHelper::addResponseData("data", $actions);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patients data with appointments retrieved successfully');
    }
    // public function showRecord(Request $request)
    // {
    //     try {
    //         $patientToken = $request->get("token");
    //         $patientData = Patients::select('patients.token', 'patientRecords.*')
    //             ->join('patientRecords', 'patients.id', '=', 'patientRecords.patientId')
    //             ->where("patients.token", $patientToken)->get();
    //         if (count($patientData) != 0) {
    //             RequsetHelper::addResponseData("data", $patientData);
    //             return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient data with appointments retrieved successfully');
    //         } else {
    //             return RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, 'Patient Record not found');
    //         }
    //     } catch (\Exception $exception) {
    //         return RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, 'An error occurred');
    //     }
    // }
    // public function deleteRecord(Request $request)
    // {
    //     $patientToken = $request->get("token");
    //     $recordId = $request->get("recordId");
    //     try {
    //         $patient = Patients::where("token", $patientToken)->firstOrFail();
    //         try {
    //             $patientRecords = PatientRecords::where("patientId", $patient["id"])
    //                 ->Where("id", $recordId)->firstOrFail();
    //             $patientRecords->delete();
    //         } catch (\Throwable $th) {
    //             return RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, 'Record not found');
    //         }
    //     } catch (Exception $exception) {
    //         return RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, 'Patient not found');
    //     }
    //     return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient Record deleted successfully');
    // }
    // public function updateRecord(Request $request)
    // {
    //     $patientToken = $request->get("token");
    //     $recordId = $request->get("recordId");
    //     $patientNote = $request->get("patientNote");
    //     try {
    //         $patient = Patients::where("token", $patientToken)->firstOrFail();
    //         try {
    //             $patientRecords = PatientRecords::where("patientId", $patient["id"])
    //                 ->Where("id", $recordId)->firstOrFail();
    //             $patientRecords->update([
    //                 'patientNote' => $patientNote,
    //             ]);
    //             RequsetHelper::addResponseData("data", $patientRecords);
    //         } catch (\Throwable $th) {
    //             return RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, 'Record not found');
    //         }
    //     } catch (Exception $exception) {
    //         return RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, 'Patient not found');
    //     }
    //     return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient Record updated successfully');
    // }
}

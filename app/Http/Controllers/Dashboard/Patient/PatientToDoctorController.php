<?php

namespace App\Http\Controllers\Dashboard\Patient;

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
        $patientToken = $request->get('token');
        $patient = Patients::getPatientByToken($patientToken);
        $userId = $request->get('userId');
        $newData = [
            'userId' => $userId,
            'patientId' =>  $patient["id"],
            'status' => true,
        ];
        PatientToDoctor::createRecord($newData);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Patient send To Doctor " . $userId);
    }

    public function showtoDoctors()
    {
        $patientData = PatientToDoctor::getAllRecords();
        RequsetHelper::addResponseData("data", $patientData);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient data with appointments retrieved successfully');
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

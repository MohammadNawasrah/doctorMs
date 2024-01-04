<?php

namespace App\Http\Controllers\Dashboard\Patient;

use App\Models\Patients;
use Illuminate\Http\Request;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;

class PatientAppointmentController
{
    public function showAppointments()
    {
        try {
            $patientAppointmentsData = Patients::select('patients.token', 'patientAppointments.*')
                ->join('patientAppointments', 'patients.id', '=', 'patientAppointments.patientId')->get();
            if (count($patientAppointmentsData) != 0) {
                RequsetHelper::addResponseData("data", $patientAppointmentsData);
                return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient data with appointments retrieved successfully');
            }
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, 'Not found Record');
        } catch (\Exception $exception) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, 'An error occurred');
        }
    }
    // public function addRecord(Request $request)
    // {
    //     $token = $request->get('token');
    //     $patientNote = $request->get('patientNote');
    //     $patient = Patients::where('token', $token)->firstOrFail();
    //     if (!$patient) {
    //         return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Patient token not found");
    //     }
    //     $patient = PatientRecords::create([
    //         'patientId' =>  $patient["id"],
    //         'patientNote' => $patientNote,
    //     ]);
    //     return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Patient " . $patient["fullName"] . "added Record sucessfully");
    // }

    // public function showRecord(Request $request)
    // {
    //     try {
    //         $token = $request->get("token");
    //         $patientData = Patients::select('patients.token', 'patientRecords.*')
    //             ->join('patientRecords', 'patients.id', '=', 'patientRecords.patientId')
    //             ->where("patients.token", $token)->get();
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
    //     $token = $request->get("token");
    //     $recordId = $request->get("recordId");
    //     try {
    //         $patient = Patients::where("token", $token)->firstOrFail();
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
    //     $token = $request->get("token");
    //     $recordId = $request->get("recordId");
    //     $patientNote = $request->get("patientNote");
    //     try {
    //         $patient = Patients::where("token", $token)->firstOrFail();
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

<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use Exception;
use Illuminate\Http\Request;
use Trait\Helpers\GenerateHelper;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;

class PatientController extends Controller
{
    use GenerateHelper;
    public function addPatient(Request $request)
    {
        $fullName = $request->get("fullName");
        $age = $request->get('age');
        $phoneNumber = $request->get('phoneNumber');
        $patient = Patients::where('phoneNumber', $phoneNumber)->get();
        if (count($patient) != 0) {
            return  RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Patient Phone number already Exist");
        }
        $patient = Patients::create([
            'fullName' => $fullName,
            'age' => $age,
            'phoneNumber' => $phoneNumber,
            'token' => $this->generateTokenByUsername($phoneNumber)
        ]);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Patient $fullName added sucessfully");
    }
    public function updatePatient(Request $request)
    {
        $token = $request->get("token");
        $fullName = $request->get("fullName");
        $age = $request->get('age');
        $phoneNumber = $request->get('phoneNumber');
        try {
            $existingPatient = Patients::where('phoneNumber', $phoneNumber)->first();
            if ($existingPatient && $existingPatient->token !== $token) {
                return RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, 'Phone number already exists for another patient');
            }
            $patient = Patients::where("token", $token)->firstOrFail();
            $patient->update([
                'fullName' => $fullName,
                'age' => $age,
                'phoneNumber' => $phoneNumber,
            ]);
            RequsetHelper::addResponseData("data", $patient);
        } catch (Exception $exception) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, 'Patient not found');
        }
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient updated successfully');
    }
    public function deletePatient(Request $request)
    {
        $token = $request->get("token");
        try {
            $patient = Patients::where("token", $token)->firstOrFail();
        } catch (Exception $exception) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, 'Patient not found');
        }
        $patient->delete();
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient deleted successfully');
    }
    public function showPatient(Request $request)
    {
        $token = $request->get("token");
        $patient = Patients::where("token", $token)->get();
        if (count($patient) == 0) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, 'Patient not found');
        }
        RequsetHelper::addResponseData("data", $patient);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patient fetch successfully');
    }
    public function showPatients()
    {
        $patient = Patients::all();
        if (count($patient) == 0) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, 'Patients not found');
        }
        RequsetHelper::addResponseData("data", $patient);
        return RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patients Fetch successfully');
    }
}

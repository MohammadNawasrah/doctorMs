<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;

class PatientToDoctor extends Model
{
    protected $table = 'patient_to_doctor';

    protected $fillable = [
        'userId',
        'patientId',
        'status',
    ];
    public static function getPatientsToDoctor()
    {
        try {
            $userId = Users::getUserIdByToken(session()->get("token"));
            $patientData = Patients::select('patients.fullName', 'patients.token', 'patient_to_doctor.*')
                ->join('patient_to_doctor', 'patients.id', '=', 'patient_to_doctor.patientId')
                ->where("patient_to_doctor.status", true)->where("userId", $userId)->orderBy('patient_to_doctor.created_at', 'asc')->get();
            return $patientData;
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function changeStatusToFalse($patientId)
    {
        try {
            self::where("patientId", $patientId)->where("status", true)->firstOrFail()->update([
                "status" => false
            ]);
        } catch (\Throwable $th) {
            return false;
        }
    }
    public static function createRecord($newData)
    {
        try {
            if (!self::isPatientAlreadySendToDoctor($newData["patientId"])) {
                self::create($newData);
            }
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function isPatientAlreadySendToDoctor($patientId)
    {
        try {
            self::where("patientId", $patientId)->where("status", true)->firstOrFail();
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, "patient Already send"));
        } catch (\Throwable $th) {
            return false;
        }
    }
    public static function getAllRecords()
    {
        try {
            $patientData = Patients::select('patients.*', 'patient_to_doctor.id as patient_to_doctorId', 'patient_to_doctor.status', 'patient_to_doctor.userId')
                ->join('patient_to_doctor', 'patients.id', '=', 'patient_to_doctor.patientId')->orderBy('', 'desc')->get();
            if (count($patientData) != 0) {
                return $patientData;
            }
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, 'Not found Record'));
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
}

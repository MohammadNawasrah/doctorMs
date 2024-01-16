<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;

class PatientRecords extends Model
{
    protected $table = 'patient_records';

    protected $fillable = [
        'patientId',
        'patientNote',
        "doctorTableId"
    ];
    public static function createRecord($newData)
    {
        try {
            self::create($newData);
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function getAllRecords()
    {
        try {
            $patientData = Patients::select('patients.token', 'patientRecords.*')
                ->join('patientRecords', 'patients.id', '=', 'patientRecords.patientId')->get();
            if (count($patientData) != 0) {
                return $patientData;
            }
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, 'Not found Record'));
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function getAllPatientRecords($patientId)
    {
        try {
            $patientData = Patients::select('patients.*', 'patient_records.*', "patient_records.created_at as created_at")
                ->join('patient_records', 'patients.id', '=', 'patient_records.patientId')
                ->where("patients.id", $patientId)->get();
            if (count($patientData) != 0) {
                return  $patientData;
            }
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, 'Patient Record not found'));
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function deletePatientRecord($recordId)
    {
        try {
            $record = self::getRecordByRecordId($recordId);
            $record->delete();
            Payments::deletePayment($record["doctorTableId"]);
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function updatePatientRecord($patientId, $recordId, $newData)
    {
        try {
            self::getPatientRecordByRecordId($patientId, $recordId)->update($newData);
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function getRecordByRecordId($recordId)
    {
        try {
            $patientRecord = PatientRecords::Where("id", $recordId)->firstOrFail();
            return   $patientRecord;
        } catch (\Throwable $th) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, 'Record not found');
        }
    }
    public static function getPatientRecordByRecordId($patientId, $recordId)
    {
        try {
            $patientRecord = PatientRecords::where("patientId", $patientId)
                ->Where("id", $recordId)->firstOrFail();
            return   $patientRecord;
        } catch (\Throwable $th) {
            return RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, 'Record not found');
        }
    }
}

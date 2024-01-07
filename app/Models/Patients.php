<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;

class Patients extends Model
{
    protected $fillable = [
        'fullName',
        'phoneNumber',
        'token',
        'age',
    ];
    public static function getPatientByToken($token)
    {
        try {
            $patient = self::where('token', $token)->firstOrFail();
            return $patient;
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Patient Not Found"));
        }
    }
    public static function getPatientByPhoneNumber($phoneNumber)
    {
        try {
            self::where('phoneNumber', $phoneNumber)->firstOrFail();
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Phone Number Already Exist"));
        } catch (\Throwable $th) {
        }
    }
    public static function createRecord($newData)
    {
        try {
            if ($newData["age"] <= 0 || $newData["age"] >= 150) {
                die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, "age Just From 1 to 150"));
            }
            self::getPatientByPhoneNumber($newData["phoneNumber"]);
            self::create($newData);
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function getAllPatients()
    {
        try {
            $patientData = Patients::all();
            if (count($patientData) != 0) {
                return $patientData;
            }
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, 'Not found Record'));
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function deletePatient($patientToken)
    {
        try {
            self::getPatientByToken($patientToken)->delete();
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function updatePatientRecord($patientToken, $newData)
    {
        try {
            self::where('phoneNumber', $newData["phoneNumber"])
                ->where('token', '!=', $newData["token"])->firstOrFail();
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, "Phone Number Already Exsit"));
        } catch (\Throwable $th) {
            self::getPatientByToken($patientToken)->update($newData);
        }
    }
}

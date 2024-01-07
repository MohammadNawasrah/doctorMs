<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Trait\Helpers\DateHelper;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;

class PatientAppoinntments extends Model
{
    protected $table = 'patient_appointments';

    protected $fillable = [
        'patientId',
        'nextappointment',
    ];
    public static function createRecord($newData)
    {
        try {

            if (!self::getPatientRecord($newData["patientId"])) {
                if (!DateHelper::isDateTodayOrInFuture($newData["nextappointment"])) {
                    die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Past Date Not Allow"));
                }
                self::create($newData);
            }
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, "you can add appoinntment one for patent"));
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function getAllRecords()
    {
        try {
            $patientAppointmentsData = Patients::select('patients.token', 'patientAppointments.*')
                ->join('patientAppointments', 'patients.id', '=', 'patientAppointments.patientId')->get();
            if (count($patientAppointmentsData) != 0) {
                return $patientAppointmentsData;
            }
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, 'Not found Record'));
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function getAllPatientsHaveAppoinntmentToday()
    {
        try {
            $today = Carbon::now()->toDateString();

            $patientAppointmentsData = Patients::select('patients.*', 'patientAppointments.*')
                ->join('patientAppointments', 'patients.id', '=', 'patientAppointments.patientId')
                ->whereDate('patientAppointments.nextappointment', '=', $today)
                ->get();
            if (count($patientAppointmentsData) != 0) {
                return $patientAppointmentsData;
            }
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, 'Not found Record'));
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function getPatientRecord($patientId)
    {
        try {
            $patientAppointmentsData = Patients::select('patients.token', 'patientAppointments.*')
                ->join('patientAppointments', 'patients.id', '=', 'patientAppointments.patientId')
                ->where("patients.id", $patientId)->firstOrFail();
            return  $patientAppointmentsData;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public static function deletePatientRecord($patientId)
    {
        try {
            $patient = self::getPatientRecord($patientId);
            PatientAppoinntments::find($patient["id"])->delete();
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function updatePatientRecord($patientId, $newData)
    {
        try {
            if (!DateHelper::isDateTodayOrInFuture($newData["nextappointment"])) {
                die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Past Date Not Allow"));
            }
            $patient = self::getPatientRecord($patientId);
            PatientAppoinntments::find($patient["id"])->update($newData);
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
}

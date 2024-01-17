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
        'next_appointment',
        'status_to_send_doctor'
    ];
    public static function createRecord($newData)
    {
        try {
            if (!self::isPatientRecordAlreadyExist($newData["patientId"])) {
                if (!DateHelper::isDateTodayOrInFuture($newData["next_appointment"])) {
                    die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Past Date Not Allow"));
                }
                self::create($newData);
                return;
            }
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, "you can add appoinntment one for patent"));
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function getAllRecords()
    {
        try {
            $patientAppointmentsData = Patients::select('patients.token', 'patient_appointments.*')
                ->join('patient_appointments', 'patients.id', '=', 'patient_appointments.patientId')
                ->where("patient_appointments.status_to_send_doctor", false)->orderBy("patient_appointments.next_appointment", "desc")->get();

            if (count($patientAppointmentsData) != 0) {
                return $patientAppointmentsData;
            }
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, 'Not found Record'));
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function getRecordByPatientId($patientId)
    {
        try {
            return self::where("patientId", $patientId)->firstOrFail();
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function getAllUserIdHaveAppoinntment()
    {
        try {
            return  self::pluck('patientId')->toArray();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public static function getAllPatientsHaveAppoinntmentToday()
    {
        try {
            $today = Carbon::now()->toDateString();
            $patientAppointmentsData = Patients::select('patients.*', 'patient_appointments.*')
                ->join('patient_appointments', 'patients.id', '=', 'patient_appointments.patientId')
                ->whereDate('patient_appointments.next_appointment', '=', $today)
                ->where("patient_appointments.status_to_send_doctor", false)->orderBy("patient_appointments.next_appointment", "asc")->get();
            if (count($patientAppointmentsData) != 0) {
                return $patientAppointmentsData;
            }
            return [];
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function getAllPatientsIdHaveAppoinntmentToday()
    {
        try {
            $today = Carbon::now()->toDateString();
            $patientAppointmentsData = Patients::select('patients.*', 'patient_appointments.*')
                ->join('patient_appointments', 'patients.id', '=', 'patient_appointments.patientId')
                ->whereDate('patient_appointments.next_appointment', '=', $today)
                ->where("patient_appointments.status_to_send_doctor", false)->get();
            if (count($patientAppointmentsData) != 0) {
                return $patientAppointmentsData;
            }
            return [];
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function changeStatusToSendDoctor($patient, $newStatus)
    {
        try {
            PatientAppoinntments::where("patientId", $patient["id"])->firstOrFail()->update(["status_to_send_doctor" => $newStatus]);
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
    public static function isPatientRecordAlreadyExist($patientId)
    {
        try {
            PatientAppoinntments::where("patientId", $patientId)->firstOrFail();
            return  true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    public static function deletePatientRecord($patientId)
    {
        try {
            PatientAppoinntments::where("patientId", $patientId)->delete();
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
    public static function updatePatientRecord($patientId, $newData)
    {
        try {

            if (!DateHelper::isDateTodayOrInFuture($newData["next_appointment"])) {
                die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_ACCEPTED, "Past Date Not Allow"));
            }
            PatientAppoinntments::where("patientId", $patientId)->firstOrFail()->update($newData);
        } catch (\Throwable $th) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $th->getMessage()));
        }
    }
}

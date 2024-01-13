<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;

class Payments extends Model
{
    protected $table = "payments";
    protected $fillable = [
        'fk_record',
        'fk_patient',
        'paymet_value',
        'must_be_paid',
        "status"
    ];
    public static function addPaymentToPatient($patientId, $mony, $recordId)

    {
        try {
            self::create([
                'fk_record' => $recordId,
                'fk_patient' => $patientId,
                'paymet_value' =>  0,
                'must_be_paid' => $mony
            ]);
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, 'Patients data with appointments retrieved successfully'));
        } catch (Exception $e) {
            die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_NOT_FOUND, $e->getMessage()));
        }
    }
    public static function getPaymentByDoctorTableRecord($doctorTableId)
    {
        try {
            $pay = self::where("fk_record", $doctorTableId)->firstOrFail();
            return $pay["must_be_paid"];
        } catch (\Throwable $th) {
            //throw $th;
            return 0;
        }
    }
    public static function getAllPaymentsForPateint()
    {
    }
    public static function isPatientNotPay($patientId)
    {
        try {
            $lastRecord = self::where("status", false)
                ->where("fk_patient", $patientId)
                ->latest('created_at')
                ->first();
            if (isset($lastRecord)) {
                return ($lastRecord);
            }
            return ["status" => true];
        } catch (\Throwable $th) {
            return false;
        }
    }
    public static function updatePay($patientId, $recordId, $newPay)
    {
        try {
            $lastRecord = self::where("status", false)
                ->where("fk_patient", $patientId)->where("fk_record", $recordId)
                ->latest('created_at')->firstOrFail();
            ($lastRecord->update([
                "status" => true,
                "paymet_value" => $newPay
            ]));
        } catch (\Throwable $th) {
            return false;
        }
    }
    public static function checkIfPatientHasPayment($patientId)
    {
        try {
            self::where("fk_patient ", $patientId)->firstOrFail();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}

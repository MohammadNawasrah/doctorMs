<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use App\Models\Payments;
use Illuminate\Http\Request;
use Trait\Helpers\HttpStatusCodes;
use Trait\Helpers\RequsetHelper;

class PaymentsController
{
    public function addPaymentForPatient(Request $request)
    {
        $paymnet = $request->input("paymentValue");
        $patientToken = $request->input("patientToken");
        $recordId = $request->input("recordId");
        $patientId = Patients::getPatientByToken($patientToken)["id"];
        Payments::addPaymentToPatient($patientId, $paymnet, $recordId);
        die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Add To Patient $paymnet JD"));
    }
    public function updatePaymentForPatient(Request $request)
    {
        $paymnet = $request->input("paymentValue");
        $patientToken = $request->input("patientToken");
        $recordId = $request->input("recordId");
        $patientId = Patients::getPatientByToken($patientToken)["id"];
        Payments::updatePay($patientId,  $recordId, $paymnet);
        die(RequsetHelper::setResponse(HttpStatusCodes::HTTP_OK, "Patient pay $paymnet JD"));
    }
}

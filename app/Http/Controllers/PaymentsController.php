<?php

namespace App\Http\Controllers;

use App\Models\Patients;
use App\Models\Payments;
use Illuminate\Http\Request;

class PaymentsController
{
    public function addPaymentForPatient(Request $request)
    {
        $paymnet = $request->input("paymentValue");
        $patientToken = $request->input("patientToken");
        $recordId = $request->input("recordId");
        $patientId = Patients::getPatientByToken($patientToken)["id"];
        Payments::addPaymentToPatient($patientId, $paymnet, $recordId);
    }
    public function updatePaymentForPatient(Request $request)
    {
        $paymnet = $request->input("paymentValue");
        $patientToken = $request->input("patientToken");
        $recordId = $request->input("recordId");
        $patientId = Patients::getPatientByToken($patientToken)["id"];
        Payments::updatePay($patientId,  $recordId, $paymnet);
    }

}

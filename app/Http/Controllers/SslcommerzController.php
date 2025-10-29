<?php

namespace App\Http\Controllers;

use Raziul\Sslcommerz\Facades\Sslcommerz;
use Illuminate\Http\Request;

class SslcommerzController extends Controller
{
    public function success(Request $request)
    {
        $requestData = $request->all();
        $transactionId = $requestData['tran_id'];
        $amount = $requestData['amount'];

        $isValid = Sslcommerz::validatePayment($requestData, $transactionId, $amount);

        if ($isValid) {
            // ✅ Payment confirmed
            // e.g. mark order as paid in DB
            // Order::where('transaction_id', $transactionId)->update(['status' => 'paid']);
            return response()->json(['message' => 'Payment successful']);
        } else {
            // ❌ Payment invalid
            return response()->json(['message' => 'Payment validation failed'], 400);
        }
    }

    public function failure(Request $request)
    {
        // Payment failed logic
    }

    public function cancel(Request $request)
    {
        // User cancelled payment logic
    }

    public function ipn(Request $request)
    {
        // Handle IPN (extra verification)
    }
}

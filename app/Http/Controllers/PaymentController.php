<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Raziul\Sslcommerz\Facades\Sslcommerz;

class PaymentController extends Controller
{
    public function payNow(Request $request)
{
    $amount = 1500; // e.g., total price
    $invoiceId = 'INV-' . uniqid(); // unique transaction/invoice ID
    $productName = 'ERP License';
    $customerName = 'Kamrul Hasan Nahid';
    $customerEmail = 'khannahid361@gmail.com';
    $customerPhone = '01624032691';
    $itemsQuantity = 1;
    $address = 'Dhaka, Bangladesh';

    $response = Sslcommerz::setOrder($amount, $invoiceId, $productName)
        ->setCustomer($customerName, $customerEmail, $customerPhone)
        ->setShippingInfo($itemsQuantity, $address)
        ->makePayment();

    if ($response->success()) {
        // Redirect customer to SSLCOMMERZ payment page
        return redirect($response->gatewayPageURL());
    } else {
        // Handle payment initialization failure
        return back()->with('error', 'Failed to initiate payment.');
    }
}
}

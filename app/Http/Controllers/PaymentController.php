<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{

    public function pay(Request $request)
    {
        if($request) {
            $payment = new Payment;
            $payment->payment_id = $request->orderID;
            $payment->payer_id = $request->details['payer']['payer_id'];
            $payment->payer_email = $request->details['payer']['email_address'];
            $payment->amount = $request->details['purchase_units'][0]['amount']['value'];
            $payment->currency = env('PAYPAL_CURRENCY');
            $payment->payment_status = $request->details['status'];
            $payment->save();
            return "Payment is successful. Your transaction id is: ". $request->orderID;
        } else {
            return 'Payment failed. Please try again.';
        }
    }
}

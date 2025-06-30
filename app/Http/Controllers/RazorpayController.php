<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\History;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;

class RazorpayController extends Controller
{
    public function payment(Request $request)
    {
        $appointmentid = $request->description;
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($request->razorpay_payment_id);

        if ($payment->capture(['amount' => $payment->amount])) {

            Revenue::create([
                'paymentid' => $payment['id'],
                'amount' => $payment['amount'],
                'status' => $payment['status'],
                'email' => $request->email,
                'paymenttype' => 'credit',
                'paymentmode' => 'online',
                'description' => $appointmentid,
                
            ]);
            Appointment::where('id', $appointmentid)->update(['ispaid' => 1]);
            History::create([
            'chat' => $appointmentid,
            'doctorid' => '0',
            'useremail' => $request->email,
        ]);
            return redirect()->back()->with('success', 'Payment Successful!');
        }

        return redirect()->back()->with('error', 'Payment Failed!');
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\History;
use App\Models\Revenue;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

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
            Appointment::where('id', $appointmentid)->update(['status' => 'in_progress']);
            History::create([
                'chat' => $appointmentid,
                'doctorid' => '0',
                'useremail' => $request->email,
            ]);
            return redirect()->back()->with('success', 'Payment Successful!');
        }

        return redirect()->back()->with('error', 'Payment Failed!');
    }

    public function cancle($id)
    {
        $appointment = Appointment::findOrFail($id);

        // ✅ Correct query
        $razorpayid = Revenue::where('description', $id)->first();

        // ✅ Backup original ispaid value
        $wasPaid = $appointment->ispaid;

        
        // 🔁 Refund condition offline
        if ($wasPaid == 1 && $razorpayid && $razorpayid->paymentid == null) {
            Revenue::create([
                'amount' => $appointment->fee * 100,
                'status' => 'refunded',
                'paymenttype' => 'debit',
                'paymentmode' => 'offline',
                'email' => auth()->user()->email,
                'description' => $appointment->id,
            ]);
            $appointment->ispaid = 4;
        }
        
        // 🔁 Refund condition online
        if ($wasPaid == 1 && $razorpayid && $razorpayid->paymentid) {
            try {
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

                $payment = $api->payment->fetch($razorpayid->paymentid);
                $refund = $payment->refund();

                // ✅ Refund entry
                Revenue::create([
                    'amount' => $payment->amount / 100,
                    'status' => 'cancelled',
                    'paymenttype' => 'debit',
                    'paymentid' => $refund->id,
                    'paymentmode' => 'online',
                    'email' => auth()->user()->email,
                    'description' => $appointment->id,
                ]);

                // Update refund status
                $appointment->ispaid = 3;

            } catch (\Exception $e) {
                return back()->with('error', 'Refund failed: ' . $e->getMessage());
            }
        }
        
        $appointment->status = 'cancelled';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment cancelled' . ($wasPaid == 1 ? ' and refund initiated!' : '!'));
    }


}

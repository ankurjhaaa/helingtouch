<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Appointment;


use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function downloadReceipt($id)
    {
        $appointment = Appointment::findOrFail($id);

        $pdf = Pdf::loadView('landing.appointmentrecipt', compact('appointment'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('Appointment_Receipt_' . $id . '.pdf');
    }
}

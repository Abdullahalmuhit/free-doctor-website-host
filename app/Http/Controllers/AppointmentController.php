<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Chamber;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create()
    {
        $chambers = Chamber::active()->get();

        return view('frontend.appointment', compact('chambers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'chamber_id' => 'required|exists:chambers,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'patient_name' => 'required|string|max:255',
            'guardian_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'age' => 'nullable|integer|min:0|max:150',
            'gender' => 'required|in:Male,Female,Other',
            'problem_details' => 'nullable|string',
        ]);
        $validated['appointment_time'] = date("H:i:s", strtotime($request->appointment_time));


        $appointment = Appointment::create($validated);

        return redirect()
            ->route('appointment.success')
            ->with('success', 'Appointment booked successfully! We will contact you soon.');
    }

    public function success()
    {
        return view('frontend.appointment-success');
    }
}

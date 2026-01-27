<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Chamber;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminAppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with('chamber')->latest();

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by chamber
        if ($request->has('chamber_id') && $request->chamber_id != '') {
            $query->where('chamber_id', $request->chamber_id);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('appointment_date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('appointment_date', '<=', $request->date_to);
        }

        // Search by patient name or phone
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('patient_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $appointments = $query->paginate(20);
        $chambers = Chamber::all();

        // Statistics for filter view
        $filterStats = [
            'total' => Appointment::count(),
            'pending' => Appointment::pending()->count(),
            'confirmed' => Appointment::confirmed()->count(),
            'cancelled' => Appointment::where('status', 'cancelled')->count(),
            'today' => Appointment::whereDate('appointment_date', Carbon::today())->count(),
            'upcoming' => Appointment::where('appointment_date', '>', Carbon::today())->count(),
        ];

        return view('admin.appointments.index', compact('appointments', 'chambers', 'filterStats'));
    }

    public function show(Appointment $appointment)
    {
        $appointment->load('chamber');
        return view('admin.appointments.show', compact('appointment'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        $appointment->update($validated);

        // You can add email notification here
        // Mail::to($appointment->email)->send(new AppointmentStatusChanged($appointment));

        return back()->with('success', 'Appointment status updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }

    // Bulk actions
    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:confirm,cancel,delete',
            'appointments' => 'required|array',
            'appointments.*' => 'exists:appointments,id'
        ]);

        $appointments = Appointment::whereIn('id', $validated['appointments']);

        switch ($validated['action']) {
            case 'confirm':
                $appointments->update(['status' => 'confirmed']);
                $message = 'Selected appointments confirmed successfully.';
                break;
            case 'cancel':
                $appointments->update(['status' => 'cancelled']);
                $message = 'Selected appointments cancelled successfully.';
                break;
            case 'delete':
                $appointments->delete();
                $message = 'Selected appointments deleted successfully.';
                break;
        }

        return back()->with('success', $message);
    }

    // Export appointments
    public function export(Request $request)
    {
        // This would export appointments to CSV/Excel
        // You can use Laravel Excel package for this
        $appointments = Appointment::with('chamber')
            ->when($request->status, function($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->get();

        $filename = 'appointments_' . date('Y-m-d') . '.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        // Headers
        fputcsv($output, [
            'ID', 'Patient Name', 'Phone', 'Age', 'Gender',
            'Chamber', 'Date', 'Time', 'Status', 'Problem'
        ]);

        // Data
        foreach ($appointments as $apt) {
            fputcsv($output, [
                $apt->id,
                $apt->patient_name,
                $apt->phone,
                $apt->age,
                $apt->gender,
                $apt->chamber->name,
                $apt->appointment_date->format('Y-m-d'),
                $apt->appointment_time,
                $apt->status,
                $apt->problem_details
            ]);
        }

        fclose($output);
        exit;
    }
}

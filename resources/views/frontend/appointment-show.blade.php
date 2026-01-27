@extends('layouts.app')

@section('content')
    <div class="container py-4">

        <h2 class="mb-3">Appointment Details</h2>

        <div class="card shadow-sm">
            <div class="card-body">
                <p><strong>Tracking ID:</strong> {{ $appointment->tracking_id }}</p>
                <p><strong>Patient:</strong> {{ $appointment->patient_name }}</p>
                <p><strong>Guardian:</strong> {{ $appointment->guardian_name ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $appointment->phone }}</p>
                <p><strong>Date:</strong> {{ $appointment->appointment_date }}</p>
                <p><strong>Time:</strong> {{ $appointment->appointment_time }}</p>
                <p><strong>Chamber:</strong> {{ $appointment->chamber->name }}</p>
                <p><strong>Problem Details:</strong> {{ $appointment->problem_details ?? 'Not provided' }}</p>
            </div>
        </div>

        <a href="{{ route('appointment.edit', $appointment->id) }}" class="btn btn-primary mt-3">
            Edit Appointment
        </a>

    </div>
@endsection

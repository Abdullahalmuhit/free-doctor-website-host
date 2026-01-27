@extends('layouts.admin')

@section('content')
    <h1>Appointment Details</h1>

    <p><strong>Patient:</strong> {{ $appointment->patient_name }}</p>
    <p><strong>Date:</strong> {{ $appointment->appointment_date }}</p>
    <p><strong>Time:</strong> {{ $appointment->appointment_time }}</p>
    <p><strong>Phone:</strong> {{ $appointment->phone }}</p>
    <p><strong>Status:</strong> {{ $appointment->status }}</p>

    <a href="{{ route('admin.appointments.index') }}" class="btn btn-primary mt-3">
        Back to Appointments
    </a>
@endsection

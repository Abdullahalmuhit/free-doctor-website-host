{{-- resources/views/frontend/appointment-success.blade.php --}}
@extends('layouts.app')
<?php
$doctor = \App\Models\User::where('role', 'doctor')->first();
$name = $doctor?->getFullNameAttribute();
$designation = $doctor?->designation;
?>
@section('title', 'Appointment Successful -' . $name . $designation)
<?php
$doctor = \App\Models\User::where('role', 'doctor')->first();
$name = $doctor?->getFullNameAttribute();
$designation = $doctor?->designation;
?>
@section('content')
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-12 text-center">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check-circle text-4xl text-green-500"></i>
                </div>

                <h1 class="text-3xl font-bold text-gray-800 mb-4">Appointment Booked Successfully!</h1>

                <p class="text-gray-600 mb-8">
                    Thank you for booking an appointment with {{$name}} - {{$designation}}.
                    We have received your appointment request and will contact you soon to confirm the details.
                </p>

                <div class="bg-cyan-50 border border-cyan-200 rounded-lg p-6 mb-8">
                    <h3 class="font-bold text-cyan-900 mb-2">What's Next?</h3>
                    <ul class="text-left text-cyan-800 space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-check text-cyan-600 mt-1 mr-3"></i>
                            <span>You will receive a confirmation call within 24 hours</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-cyan-600 mt-1 mr-3"></i>
                            <span>Please arrive 15 minutes before your appointment time</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-cyan-600 mt-1 mr-3"></i>
                            <span>Bring any previous medical reports and prescriptions</span>
                        </li>
                    </ul>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('home') }}" class="bg-cyan-700 text-white px-8 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
                        <i class="fas fa-home mr-2"></i>Back to Home
                    </a>
                    <a href="{{ route('chambers.index') }}" class="bg-gray-100 text-gray-700 px-8 py-3 rounded-lg font-medium hover:bg-gray-200 transition">
                        <i class="fas fa-map-marker-alt mr-2"></i>View Chambers
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

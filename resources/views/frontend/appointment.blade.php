{{-- resources/views/frontend/appointment.blade.php --}}
@extends('layouts.app')
<?php
$doctor = \App\Models\User::where('role', 'doctor')->first();
$name = $doctor?->getFullNameAttribute();
$designation = $doctor?->designation;
?>

@section('title', 'Book Appointment - ' . $name . $designation)

@section('content')
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <div class="inline-block bg-cyan-100 text-cyan-700 px-4 py-2 rounded-full text-sm font-medium mb-4">
                    <i class="fas fa-calendar-check mr-2"></i>Online Appointment
                </div>
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Appointment Booking</h1>
                <p class="text-gray-600">Please fill out the form below to book an appointment with Prof. Dr. Mohammad Abdullah Al Muhid.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Booking Form --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-md p-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-cyan-700 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-calendar-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Booking Form</h2>
                                <p class="text-gray-600 text-sm">Please fill in all information correctly.</p>
                            </div>
                        </div>

                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                                <ul class="list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('appointment.store') }}" method="POST">
                            @csrf

                            {{-- Select Chamber --}}
                            <div class="mb-6">
                                <label class="block text-gray-700 font-medium mb-2">Select Chamber *</label>
                                <select name="chamber_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                                    <option value="">Choose a chamber</option>
                                    @foreach($chambers as $chamber)
                                        <option value="{{ $chamber->id }}" {{ old('chamber_id') == $chamber->id ? 'selected' : '' }}>
                                            {{ $chamber->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Date and Time --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Date *</label>
                                    <input type="date" name="appointment_date" value="{{ old('appointment_date') }}" required
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Time *</label>
                                    <select name="appointment_time" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                                        <option value="">Select time</option>
                                        <option value="5:00 PM" {{ old('appointment_time') == '5:00 PM' ? 'selected' : '' }}>5:00 PM</option>
                                        <option value="5:30 PM" {{ old('appointment_time') == '5:30 PM' ? 'selected' : '' }}>5:30 PM</option>
                                        <option value="6:00 PM" {{ old('appointment_time') == '6:00 PM' ? 'selected' : '' }}>6:00 PM</option>
                                        <option value="6:30 PM" {{ old('appointment_time') == '6:30 PM' ? 'selected' : '' }}>6:30 PM</option>
                                        <option value="7:00 PM" {{ old('appointment_time') == '7:00 PM' ? 'selected' : '' }}>7:00 PM</option>
                                        <option value="7:30 PM" {{ old('appointment_time') == '7:30 PM' ? 'selected' : '' }}>7:30 PM</option>
                                        <option value="8:00 PM" {{ old('appointment_time') == '8:00 PM' ? 'selected' : '' }}>8:00 PM</option>
                                        <option value="8:30 PM" {{ old('appointment_time') == '8:30 PM' ? 'selected' : '' }}>8:30 PM</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Patient Name and Guardian Name --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Patient Name *</label>
                                    <input type="text" name="patient_name" value="{{ old('patient_name') }}" required
                                           placeholder="Patient Name"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Guardian Name</label>
                                    <input type="text" name="guardian_name" value="{{ old('guardian_name') }}"
                                           placeholder="Guardian Name (If Child)"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                                </div>
                            </div>

                            {{-- Phone, Age, Gender --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Phone Number *</label>
                                    <input type="tel" name="phone" value="{{ old('phone') }}" required
                                           placeholder="01XXXXXXXXX"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Age</label>
                                    <input type="number" name="age" value="{{ old('age') }}"
                                           placeholder="Year"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Gender *</label>
                                    <select name="gender" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                                        <option value="">Select</option>
                                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Problem Details --}}
                            <div class="mb-6">
                                <label class="block text-gray-700 font-medium mb-2">Problem Details</label>
                                <textarea name="problem_details" rows="4"
                                          placeholder="Describe Your Problem"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">{{ old('problem_details') }}</textarea>
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" class="w-full btn-primary text-white px-8 py-4 rounded-lg font-medium text-lg">
                                <i class="fas fa-calendar-check mr-2"></i>Book Appointment
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Contact Info Sidebar --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Contact Us Quickly</h3>

                        @foreach($chambers as $chamber)
                            <div class="mb-6 pb-6 {{ !$loop->last ? 'border-b border-gray-200' : '' }}">
                                <div class="flex items-center mb-3">
                                    <div class="w-10 h-10 bg-cyan-700 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-phone text-white"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Booking ({{ $chamber->name }})</p>
                                        <a href="tel:{{ $chamber->phone }}" class="text-lg font-bold text-cyan-700 hover:text-cyan-800">
                                            {{ $chamber->phone }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="mt-6">
                            <a href="{{ route('chambers.index') }}" class="block w-full text-center bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-200 transition">
                                <i class="fas fa-map-marker-alt mr-2"></i>View All Chambers
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

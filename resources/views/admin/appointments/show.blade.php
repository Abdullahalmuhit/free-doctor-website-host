{{-- resources/views/admin/appointments/show.blade.php --}}
@extends('layouts.admin')

@section('page-title', 'Appointment Details')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-lg shadow">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-cyan-700 to-cyan-800 p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">Appointment #{{ $appointment->id }}</h2>
                        <p class="text-cyan-100">{{ $appointment->appointment_date->format('F d, Y') }} at {{ $appointment->appointment_time }}</p>
                    </div>
                    <div>
                        @if($appointment->status === 'pending')
                            <span class="px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-full">Pending</span>
                        @elseif($appointment->status === 'confirmed')
                            <span class="px-4 py-2 bg-green-500 text-white text-sm font-medium rounded-full">Confirmed</span>
                        @else
                            <span class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-full">Cancelled</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Patient Information --}}
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Patient Information</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Patient Name</p>
                        <p class="font-medium text-gray-800">{{ $appointment->patient_name }}</p>
                    </div>

                    @if($appointment->guardian_name)
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Guardian Name</p>
                            <p class="font-medium text-gray-800">{{ $appointment->guardian_name }}</p>
                        </div>
                    @endif

                    <div>
                        <p class="text-sm text-gray-600 mb-1">Phone</p>
                        <p class="font-medium text-gray-800">{{ $appointment->phone }}</p>
                    </div>

                    @if($appointment->age)
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Age</p>
                            <p class="font-medium text-gray-800">{{ $appointment->age }} years</p>
                        </div>
                    @endif

                    <div>
                        <p class="text-sm text-gray-600 mb-1">Gender</p>
                        <p class="font-medium text-gray-800">{{ $appointment->gender }}</p>
                    </div>
                </div>
            </div>

            {{-- Appointment Details --}}
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Appointment Details</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Chamber</p>
                        <p class="font-medium text-gray-800">{{ $appointment->chamber->name }}</p>
                        <p class="text-sm text-gray-600">{{ $appointment->chamber->address }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600 mb-1">Date & Time</p>
                        <p class="font-medium text-gray-800">{{ $appointment->appointment_date->format('F d, Y') }}</p>
                        <p class="text-sm text-gray-600">{{ $appointment->appointment_time }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600 mb-1">Booked On</p>
                        <p class="font-medium text-gray-800">{{ $appointment->created_at->format('F d, Y h:i A') }}</p>
                    </div>
                </div>
            </div>

            {{-- Problem Details --}}
            @if($appointment->problem_details)
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Problem Details</h3>
                    <p class="text-gray-700">{{ $appointment->problem_details }}</p>
                </div>
            @endif

            {{-- Status Update --}}
            <div class="p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Update Status</h3>
                <form action="{{ route('admin.appointments.updateStatus', $appointment) }}" method="POST" class="flex gap-3">
                    @csrf
                    @method('PATCH')

                    <select name="status" required class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
                        <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>

                    <button type="submit" class="bg-cyan-700 text-white px-6 py-2 rounded-lg hover:bg-cyan-800 transition">
                        Update Status
                    </button>
                </form>
            </div>

            {{-- Actions --}}
            <div class="p-6 bg-gray-50 flex gap-3">
                <a href="{{ route('admin.appointments.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Back to List
                </a>

                <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this appointment?')" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
                        <i class="fas fa-trash mr-2"></i>Delete Appointment
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

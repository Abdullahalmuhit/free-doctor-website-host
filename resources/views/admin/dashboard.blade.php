@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm mb-1">Total Articles</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['total_articles'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-newspaper text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm mb-1">Research Papers</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['total_research'] }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-flask text-2xl text-purple-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm mb-1">Pending Appointments</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['pending_appointments'] }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-2xl text-orange-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm mb-1">Active Chambers</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['total_chambers'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-hospital text-2xl text-green-600"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Appointments --}}
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-800">Recent Appointments</h3>
                <a href="{{ route('admin.appointments.index') }}" class="text-cyan-700 hover:text-cyan-800 font-medium">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Patient</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Chamber</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date & Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse($recentAppointments as $appointment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-medium text-gray-800">{{ $appointment->patient_name }}</p>
                                <p class="text-sm text-gray-600">{{ $appointment->phone }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-700">{{ $appointment->chamber->name }}</td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="text-gray-700">{{ $appointment->appointment_date->format('M d, Y') }}</p>
                                <p class="text-sm text-gray-600">{{ $appointment->appointment_time }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($appointment->status === 'pending')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Pending</span>
                            @elseif($appointment->status === 'confirmed')
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Confirmed</span>
                            @else
                                <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Cancelled</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.appointments.show', $appointment) }}" class="text-cyan-700 hover:text-cyan-800">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            No recent appointments
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

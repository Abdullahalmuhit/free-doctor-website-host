{{-- resources/views/admin/appointments/index.blade.php --}}
@extends('layouts.admin')

@section('page-title', 'Appointments Management')

@section('content')
    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm mb-1">Total</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $filterStats['total'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm mb-1">Pending</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $filterStats['pending'] }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-2xl text-yellow-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm mb-1">Confirmed</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $filterStats['confirmed'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-2xl text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm mb-1">Today</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $filterStats['today'] }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-day text-2xl text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <form method="GET" action="{{ route('admin.appointments.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Chamber</label>
                <select name="chamber_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <option value="">All Chambers</option>
                    @foreach($chambers as $chamber)
                        <option value="{{ $chamber->id }}" {{ request('chamber_id') == $chamber->id ? 'selected' : '' }}>
                            {{ $chamber->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Patient name or phone"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg">
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="bg-cyan-700 text-white px-6 py-2 rounded-lg hover:bg-cyan-800 transition">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                <a href="{{ route('admin.appointments.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- Appointments Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
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
            @forelse($appointments as $appointment)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div>
                            <p class="font-medium text-gray-800">{{ $appointment->patient_name }}</p>
                            <p class="text-sm text-gray-600">{{ $appointment->phone }}</p>
                            @if($appointment->guardian_name)
                                <p class="text-xs text-gray-500">Guardian: {{ $appointment->guardian_name }}</p>
                            @endif
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
                        <div class="flex gap-2">
                            <a href="{{ route('admin.appointments.show', $appointment) }}" class="text-blue-600 hover:text-blue-800" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:text-red-800" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        No appointments found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($appointments->hasPages())
        <div class="mt-6">
            {{ $appointments->appends(request()->query())->links() }}
        </div>
    @endif
@endsection

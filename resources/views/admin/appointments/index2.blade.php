@extends('layouts.admin')

@section('page-title', 'Appointments Management')

@section('content')

    {{-- Filters Section --}}
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <form method="GET" action="{{ route('admin.appointments.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">

            <div>
                <label class="text-sm text-gray-600">Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="">All</option>
                    <option value="pending" {{ request('status')=='pending' ? 'selected':'' }}>Pending</option>
                    <option value="confirmed" {{ request('status')=='confirmed' ? 'selected':'' }}>Confirmed</option>
                    <option value="cancelled" {{ request('status')=='cancelled' ? 'selected':'' }}>Cancelled</option>
                </select>
            </div>

            <div>
                <label class="text-sm text-gray-600">Chamber</label>
                <select name="chamber_id" class="w-full border rounded p-2">
                    <option value="">All Chambers</option>
                    @foreach($chambers as $chamber)
                        <option value="{{ $chamber->id }}" {{ request('chamber_id')==$chamber->id ? 'selected':'' }}>
                            {{ $chamber->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-sm text-gray-600">From Date</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="text-sm text-gray-600">To Date</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="text-sm text-gray-600">Search (name or phone)</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search…" class="w-full border rounded p-2">
            </div>

            <div class="md:col-span-5 flex justify-end">
                <button class="bg-cyan-700 text-white px-6 py-2 rounded-lg hover:bg-cyan-800">
                    Apply Filters
                </button>
            </div>

        </form>
    </div>

    {{-- Statistics --}}
    <div class="grid grid-cols-2 md:grid-cols-6 gap-4 mb-6">
        <div class="p-4 bg-white shadow rounded text-center">
            <p class="text-gray-600 text-sm">Total</p>
            <p class="text-xl font-semibold">{{ $filterStats['total'] }}</p>
        </div>
        <div class="p-4 bg-yellow-50 shadow rounded text-center">
            <p class="text-gray-600 text-sm">Pending</p>
            <p class="text-xl font-semibold text-yellow-700">{{ $filterStats['pending'] }}</p>
        </div>
        <div class="p-4 bg-green-50 shadow rounded text-center">
            <p class="text-gray-600 text-sm">Confirmed</p>
            <p class="text-xl font-semibold text-green-700">{{ $filterStats['confirmed'] }}</p>
        </div>
        <div class="p-4 bg-red-50 shadow rounded text-center">
            <p class="text-gray-600 text-sm">Cancelled</p>
            <p class="text-xl font-semibold text-red-700">{{ $filterStats['cancelled'] }}</p>
        </div>
        <div class="p-4 bg-blue-50 shadow rounded text-center">
            <p class="text-gray-600 text-sm">Today</p>
            <p class="text-xl font-semibold text-blue-700">{{ $filterStats['today'] }}</p>
        </div>
        <div class="p-4 bg-purple-50 shadow rounded text-center">
            <p class="text-gray-600 text-sm">Upcoming</p>
            <p class="text-xl font-semibold text-purple-700">{{ $filterStats['upcoming'] }}</p>
        </div>
    </div>

    {{-- Appointment List --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Patient</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Chamber</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date & Time</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
            @forelse($appointments as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <p class="font-medium text-gray-800">{{ $item->patient_name }}</p>
                        <p class="text-sm text-gray-600">Age: {{ $item->age }} | {{ ucfirst($item->gender) }}</p>
                    </td>

                    <td class="px-6 py-4">
                        {{ $item->phone }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $item->chamber ? $item->chamber->name : 'N/A' }}
                    </td>

                    <td class="px-6 py-4 text-gray-700">
                        {{ $item->appointment_date->format('M d, Y') }}
                        <br>
                        <span class="text-sm text-gray-600">{{ $item->appointment_time }}</span>
                    </td>

                    <td class="px-6 py-4">
                        @if($item->status == 'pending')
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Pending</span>
                        @elseif($item->status == 'confirmed')
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Confirmed</span>
                        @else
                            <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Cancelled</span>
                        @endif
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex gap-3">
                           {{-- <a href="{{ route('admin.appointments.show', $item->id) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i>
                            </a>--}}
                            <button type="button"
                                    onclick="openStatusModal('{{ $item->id }}', '{{ $item->status }}', '{{ $item->patient_name }}')"
                                    class="text-cyan-600 hover:text-cyan-800">
                                <i class="fas fa-edit"></i>
                            </button>

                            <button type="button"
                                    onclick="openShowModal({{ json_encode($item) }}, '{{ $item->chamber ? $item->chamber->name : 'N/A' }}')"
                                    class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i>
                            </button>

                            {{--<a href="{{ route('admin.appointments.edit', $item->id) }}" class="text-cyan-600 hover:text-cyan-800">
                                <i class="fas fa-edit"></i>
                            </a>--}}

                            <form action="{{ route('admin.appointments.destroy', $item->id) }}"
                                  method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        No appointments found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($appointments->hasPages())
        <div class="mt-6">
            {{ $appointments->links() }}
        </div>
    @endif

    <div id="showModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeShowModal()"></div>

            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-2xl sm:w-full z-10">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-900">Appointment Details</h3>
                    <button onclick="closeShowModal()" class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Patient Information</h4>
                        <div class="mt-2 space-y-2">
                            <p class="text-sm"><span class="font-medium">Name:</span> <span id="show_name"></span></p>
                            <p class="text-sm"><span class="font-medium">Phone:</span> <span id="show_phone"></span></p>
                            <p class="text-sm"><span class="font-medium">Age/Gender:</span> <span id="show_age_gender"></span></p>
                            <p class="text-sm"><span class="font-medium">Guardian:</span> <span id="show_guardian"></span></p>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Appointment Info</h4>
                        <div class="mt-2 space-y-2">
                            <p class="text-sm"><span class="font-medium">Chamber:</span> <span id="show_chamber"></span></p>
                            <p class="text-sm"><span class="font-medium">Date:</span> <span id="show_date"></span></p>
                            <p class="text-sm"><span class="font-medium">Time:</span> <span id="show_time"></span></p>
                            <p class="text-sm"><span class="font-medium">Status:</span> <span id="show_status" class="px-2 py-0.5 rounded text-xs font-bold uppercase"></span></p>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Problem Details</h4>
                        <p id="show_problem" class="mt-2 text-sm text-gray-600 bg-gray-50 p-3 rounded italic"></p>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-3 flex justify-end">
                    <button type="button" onclick="closeShowModal()" class="rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="statusModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeModal()"></div>

            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full z-10">
                <form id="statusForm" method="POST">
                    @csrf
                    @method('PATCH') {{-- Using PATCH for status update --}}

                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Update Appointment Status</h3>
                        <p class="text-sm text-gray-500 mb-4">Patient: <span id="modalPatientName" class="font-bold"></span></p>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="modalStatusSelect" class="mt-1 block w-full border rounded-md p-2 shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-cyan-700 text-base font-medium text-white hover:bg-cyan-800 sm:ml-3 sm:w-auto sm:text-sm">
                            Update Status
                        </button>
                        <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openStatusModal(id, status, name) {
            const modal = document.getElementById('statusModal');
            const form = document.getElementById('statusForm');
            const patientSpan = document.getElementById('modalPatientName');
            const statusSelect = document.getElementById('modalStatusSelect');

            // Set form action dynamically
            form.action = `/admin/appointments/${id}/status`;
            patientSpan.innerText = name;
            statusSelect.value = status;

            modal.classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }

        function openShowModal(item, chamberName) {
            const modal = document.getElementById('showModal');

            // Fill text content
            document.getElementById('show_name').innerText = item.patient_name;
            document.getElementById('show_phone').innerText = item.phone;
            document.getElementById('show_age_gender').innerText = `${item.age} Years / ${item.gender}`;
            document.getElementById('show_guardian').innerText = item.guardian_name || 'N/A';
            document.getElementById('show_chamber').innerText = chamberName;
            document.getElementById('show_date').innerText = item.appointment_date;
            document.getElementById('show_time').innerText = item.appointment_time;
            document.getElementById('show_problem').innerText = item.problem_details || 'No details provided.';

            // Status Styling
            const statusEl = document.getElementById('show_status');
            statusEl.innerText = item.status;

            // Reset classes
            statusEl.className = 'px-2 py-0.5 rounded text-xs font-bold uppercase ';
            if(item.status === 'pending') statusEl.classList.add('bg-yellow-100', 'text-yellow-800');
            else if(item.status === 'confirmed') statusEl.classList.add('bg-green-100', 'text-green-800');
            else statusEl.classList.add('bg-red-100', 'text-red-800');

            modal.classList.remove('hidden');
        }

        function closeShowModal() {
            document.getElementById('showModal').classList.add('hidden');
        }

    </script>

@endsection

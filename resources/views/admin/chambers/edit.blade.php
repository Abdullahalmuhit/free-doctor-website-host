{{-- resources/views/admin/chambers/edit.blade.php --}}
@extends('layouts.admin')

@section('page-title', 'Edit Chamber')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-lg shadow p-8">
            <form action="{{ route('admin.chambers.update', $chamber) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Chamber Name *</label>
                    <input type="text" name="name" value="{{ old('name', $chamber->name) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                    @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Room Number</label>
                    <input type="text" name="room_number" value="{{ old('room_number', $chamber->room_number) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                    @error('room_number')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Address *</label>
                    <textarea name="address" rows="3" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">{{ old('address', $chamber->address) }}</textarea>
                    @error('address')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Phone *</label>
                    <input type="text" name="phone" value="{{ old('phone', $chamber->phone) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                    @error('phone')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-4">Visiting Hours *</label>
                    <div id="visiting-hours-container" class="space-y-3">
                        @foreach(old('visiting_hours', $chamber->visiting_hours) as $index => $schedule)
                            <div class="visiting-hour-row flex gap-3">
                                <input type="text" name="visiting_hours[{{ $index }}][day]" value="{{ $schedule['day'] }}" placeholder="Day" required
                                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
                                <input type="text" name="visiting_hours[{{ $index }}][time]" value="{{ $schedule['time'] }}" placeholder="Time" required
                                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
                                <button type="button" onclick="removeRow(this)" class="px-4 py-3 bg-red-100 text-red-600 rounded-lg hover:bg-red-200">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addVisitingHour()" class="mt-3 text-cyan-700 hover:text-cyan-800">
                        <i class="fas fa-plus mr-2"></i>Add Another Day
                    </button>
                    @error('visiting_hours')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $chamber->is_active) ? 'checked' : '' }} class="mr-2">
                        <span class="text-gray-700">Active</span>
                    </label>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-cyan-700 text-white px-8 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
                        <i class="fas fa-save mr-2"></i>Update Chamber
                    </button>
                    <a href="{{ route('admin.chambers.index') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-medium hover:bg-gray-300 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        let rowIndex = {{ count($chamber->visiting_hours) }};

        function addVisitingHour() {
            const container = document.getElementById('visiting-hours-container');
            const newRow = document.createElement('div');
            newRow.className = 'visiting-hour-row flex gap-3';
            newRow.innerHTML = `
        <input type="text" name="visiting_hours[${rowIndex}][day]" placeholder="Day" required
               class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
        <input type="text" name="visiting_hours[${rowIndex}][time]" placeholder="Time" required
               class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
        <button type="button" onclick="removeRow(this)" class="px-4 py-3 bg-red-100 text-red-600 rounded-lg hover:bg-red-200">
            <i class="fas fa-trash"></i>
        </button>
    `;
            container.appendChild(newRow);
            rowIndex++;
        }

        function removeRow(button) {
            const container = document.getElementById('visiting-hours-container');
            if (container.children.length > 1) {
                button.closest('.visiting-hour-row').remove();
            }
        }
    </script>
@endsection

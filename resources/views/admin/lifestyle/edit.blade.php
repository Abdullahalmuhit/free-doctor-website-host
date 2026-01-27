{{-- resources/views/admin/lifestyle/edit.blade.php --}}
@extends('layouts.admin')

@section('page-title', 'Edit Lifestyle Item')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-lg shadow p-8">
            <form action="{{ route('admin.lifestyle.update', $lifestyle) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Category *</label>
                    <select name="category" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                        <option value="nutrition" {{ old('category', $lifestyle->category) == 'nutrition' ? 'selected' : '' }}>Nutrition</option>
                        <option value="exercise" {{ old('category', $lifestyle->category) == 'exercise' ? 'selected' : '' }}>Exercise</option>
                        <option value="habits" {{ old('category', $lifestyle->category) == 'habits' ? 'selected' : '' }}>Habits</option>
                    </select>
                    @error('category')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Title *</label>
                    <input type="text" name="title" value="{{ old('title', $lifestyle->title) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                    @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Icon (FontAwesome class)</label>
                    <input type="text" name="icon" value="{{ old('icon', $lifestyle->icon) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                    @error('icon')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Description *</label>
                    <textarea name="description" rows="4" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">{{ old('description', $lifestyle->description) }}</textarea>
                    @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-4">Bullet Points</label>
                    <div id="points-container" class="space-y-3">
                        @if($lifestyle->points && count($lifestyle->points) > 0)
                            @foreach($lifestyle->points as $point)
                                <div class="point-row flex gap-3">
                                    <input type="text" name="points[]" value="{{ $point }}"
                                           class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
                                    <button type="button" onclick="removePoint(this)" class="px-4 py-3 bg-red-100 text-red-600 rounded-lg hover:bg-red-200">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="point-row flex gap-3">
                                <input type="text" name="points[]" placeholder="Point 1"
                                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
                                <button type="button" onclick="removePoint(this)" class="px-4 py-3 bg-red-100 text-red-600 rounded-lg hover:bg-red-200">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" onclick="addPoint()" class="mt-3 text-cyan-700 hover:text-cyan-800">
                        <i class="fas fa-plus mr-2"></i>Add Point
                    </button>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Display Order</label>
                        <input type="number" name="order" value="{{ old('order', $lifestyle->order) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                        @error('order')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-end">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $lifestyle->is_active) ? 'checked' : '' }} class="mr-2">
                            <span class="text-gray-700">Active</span>
                        </label>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-cyan-700 text-white px-8 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
                        <i class="fas fa-save mr-2"></i>Update Item
                    </button>
                    <a href="{{ route('admin.lifestyle.index') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-medium hover:bg-gray-300 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        let pointIndex = {{ $lifestyle->points ? count($lifestyle->points) : 1 }};

        function addPoint() {
            const container = document.getElementById('points-container');
            const newRow = document.createElement('div');
            newRow.className = 'point-row flex gap-3';
            newRow.innerHTML = `
        <input type="text" name="points[]" placeholder="Point ${pointIndex + 1}"
               class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
        <button type="button" onclick="removePoint(this)" class="px-4 py-3 bg-red-100 text-red-600 rounded-lg hover:bg-red-200">
            <i class="fas fa-trash"></i>
        </button>
    `;
            container.appendChild(newRow);
            pointIndex++;
        }

        function removePoint(button) {
            const container = document.getElementById('points-container');
            if (container.children.length > 1) {
                button.closest('.point-row').remove();
            }
        }
    </script>
@endsection

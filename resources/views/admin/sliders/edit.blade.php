@extends('layouts.admin')

@section('page-title', 'Edit Slider')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-lg shadow p-8">
            <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Title *</label>
                    <input type="text" name="title" value="{{ old('title', $slider->title) }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
                    @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Description</label>
                    <textarea name="description" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">{{ old('description', $slider->description) }}</textarea>
                    @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Current Image</label>
                    <div class="w-full max-w-md mb-4">
                        <img src="{{ $slider->image_url }}" alt="{{ $slider->title }}" class="rounded-lg shadow">
                    </div>

                    <label class="block text-gray-700 font-medium mb-2">Upload New Image (Leave empty to keep current)</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                    <p class="text-sm text-gray-500 mt-1">Recommended size: 1920x600 pixels</p>
                    @error('image')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Button Text (Optional)</label>
                        <input type="text" name="button_text" value="{{ old('button_text', $slider->button_text) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Button URL (Optional)</label>
                        <input type="url" name="button_url" value="{{ old('button_url', $slider->button_url) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="button_new_tab" value="1" {{ old('button_new_tab', $slider->button_new_tab) ? 'checked' : '' }} class="mr-2">
                        <span class="text-gray-700">Open button link in new tab</span>
                    </label>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Display Order</label>
                        <input type="number" name="order" value="{{ old('order', $slider->order) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
                    </div>

                    <div class="pt-8">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $slider->is_active) ? 'checked' : '' }} class="mr-2">
                            <span class="text-gray-700">Active</span>
                        </label>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-cyan-700 text-white px-8 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
                        <i class="fas fa-save mr-2"></i>Update Slider
                    </button>
                    <a href="{{ route('admin.sliders.index') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-medium hover:bg-gray-300 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

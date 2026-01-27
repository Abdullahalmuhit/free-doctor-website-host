@extends('layouts.admin')

@section('page-title', 'Add Slider')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-lg shadow p-8">
            <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500"
                           placeholder="e.g., Welcome to Our Clinic">
                    @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Description</label>
                    <textarea name="description" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500"
                              placeholder="Brief description for the slider...">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Slider Image *</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <input type="file" name="image" accept="image/*" id="image-input" class="hidden" onchange="previewImage(event)" required>
                        <label for="image-input" class="cursor-pointer">
                            <div id="image-preview">
                                <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 mb-3"></i>
                                <p class="text-gray-600 mb-2">Click to upload slider image</p>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                                <p class="text-xs text-gray-500 mt-2">Recommended size: 1920x600 pixels</p>
                            </div>
                        </label>
                    </div>
                    @error('image')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Button Text (Optional)</label>
                        <input type="text" name="button_text" value="{{ old('button_text') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500"
                               placeholder="e.g., Learn More">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Button URL (Optional)</label>
                        <input type="url" name="button_url" value="{{ old('button_url') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500"
                               placeholder="https://example.com/page">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="button_new_tab" value="1" {{ old('button_new_tab') ? 'checked' : '' }} class="mr-2">
                        <span class="text-gray-700">Open button link in new tab</span>
                    </label>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Display Order</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
                        <p class="text-sm text-gray-500 mt-1">Lower numbers appear first</p>
                    </div>

                    <div class="pt-8">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="mr-2">
                            <span class="text-gray-700">Active</span>
                        </label>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-cyan-700 text-white px-8 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
                        <i class="fas fa-save mr-2"></i>Add Slider
                    </button>
                    <a href="{{ route('admin.sliders.index') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-medium hover:bg-gray-300 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('image-preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="max-w-full max-h-64 mx-auto rounded-lg">`;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

{{-- resources/views/admin/gallery/create.blade.php --}}
@extends('layouts.admin')

@section('page-title', 'Add Gallery Item')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-lg shadow p-8">
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" id="gallery-form">
                @csrf

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Type *</label>
                    <div class="flex gap-4">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="type" value="image" {{ old('type', 'image') === 'image' ? 'checked' : '' }}
                            onchange="toggleTypeFields()" class="mr-2">
                            <span class="text-gray-700"><i class="fas fa-image mr-2"></i>Image</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="type" value="video" {{ old('type') === 'video' ? 'checked' : '' }}
                            onchange="toggleTypeFields()" class="mr-2">
                            <span class="text-gray-700"><i class="fas fa-video mr-2"></i>Video</span>
                        </label>
                    </div>
                    @error('type')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500"
                           placeholder="e.g., International Neurology Conference 2024">
                    @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Category *</label>
                    <select name="category" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
                        <option value="">Select Category</option>
                        <option value="conference" {{ old('category') === 'conference' ? 'selected' : '' }}>Conferences & Seminars</option>
                        <option value="clinic" {{ old('category') === 'clinic' ? 'selected' : '' }}>Clinic & Practice</option>
                        <option value="awards" {{ old('category') === 'awards' ? 'selected' : '' }}>Awards & Recognition</option>
                        <option value="events" {{ old('category') === 'events' ? 'selected' : '' }}>Events & Activities</option>
                        <option value="other" {{ old('category') === 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('category')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Image Upload --}}
                <div id="image-fields" class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Upload Image *</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <input type="file" name="file" accept="image/*" id="image-input" class="hidden" onchange="previewImage(event)">
                        <label for="image-input" class="cursor-pointer">
                            <div id="image-preview">
                                <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 mb-3"></i>
                                <p class="text-gray-600 mb-2">Click to upload image</p>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                            </div>
                        </label>
                    </div>
                    @error('file')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Video Fields --}}
                <div id="video-fields" class="hidden">
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Video URL * (YouTube or Vimeo)</label>
                        <input type="url" name="video_url" value="{{ old('video_url') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500"
                               placeholder="https://www.youtube.com/watch?v=...">
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Supported: YouTube, Vimeo
                        </p>
                        @error('video_url')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Custom Thumbnail (Optional)</label>
                        <input type="file" name="thumbnail" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
                        <p class="text-sm text-gray-500 mt-1">Leave empty to use automatic YouTube/Vimeo thumbnail</p>
                        @error('thumbnail')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Description</label>
                    <textarea name="description" rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500"
                              placeholder="Brief description...">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Display Order</label>
                        <input type="number" name="order" value="{{ old('order', 0) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
                        <p class="text-sm text-gray-500 mt-1">Lower numbers appear first</p>
                    </div>

                    <div class="space-y-3 pt-8">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="mr-2">
                            <span class="text-gray-700"><i class="fas fa-star text-yellow-500 mr-1"></i>Feature on Homepage</span>
                        </label>

                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="mr-2">
                            <span class="text-gray-700">Active</span>
                        </label>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-cyan-700 text-white px-8 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
                        <i class="fas fa-save mr-2"></i>Add to Gallery
                    </button>
                    <a href="{{ route('admin.gallery.index') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-medium hover:bg-gray-300 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleTypeFields() {
            const type = document.querySelector('input[name="type"]:checked').value;
            const imageFields = document.getElementById('image-fields');
            const videoFields = document.getElementById('video-fields');
            const imageInput = document.getElementById('image-input');
            const videoUrlInput = document.querySelector('input[name="video_url"]');

            if (type === 'image') {
                imageFields.classList.remove('hidden');
                videoFields.classList.add('hidden');
                imageInput.required = true;
                videoUrlInput.required = false;
            } else {
                imageFields.classList.add('hidden');
                videoFields.classList.remove('hidden');
                imageInput.required = false;
                videoUrlInput.required = true;
            }
        }

        function previewImage(event) {
            const preview = document.getElementById('image-preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="max-w-md max-h-64 mx-auto rounded-lg">`;
                }
                reader.readAsDataURL(file);
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleTypeFields();
        });
    </script>
@endsection

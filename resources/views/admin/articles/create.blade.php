{{-- resources/views/admin/articles/create.blade.php --}}
@extends('layouts.admin')

@section('page-title', 'Create Article')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-lg shadow p-8">
            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                           placeholder="Article title">
                    @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Category</label>
                    <input type="text" name="category" value="{{ old('category') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                           placeholder="e.g., CT Scan, Research">
                    @error('category')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Content *</label>
                    <textarea name="content" rows="15" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                              placeholder="Article content (HTML supported)">{{ old('content') }}</textarea>
                    @error('content')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Read Time (minutes) *</label>
                        <input type="number" name="read_time" value="{{ old('read_time', 5) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                        @error('read_time')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Featured Image</label>
                        <input type="file" name="image" accept="image/*"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                        @error('image')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="mr-2">
                        <span class="text-gray-700">Publish immediately</span>
                    </label>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-cyan-700 text-white px-8 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
                        <i class="fas fa-save mr-2"></i>Create Article
                    </button>
                    <a href="{{ route('admin.articles.index') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-medium hover:bg-gray-300 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

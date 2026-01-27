{{-- resources/views/admin/research/create.blade.php --}}
@extends('layouts.admin')

@section('page-title', 'Add Research Paper')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-lg shadow p-8">
            <form action="{{ route('admin.research.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                           placeholder="Research paper title">
                    @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Authors *</label>
                    <input type="text" name="authors" value="{{ old('authors') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                           placeholder="e.g., M.A. Haleem, K.L. Breen, G. Borges">
                    @error('authors')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Journal *</label>
                    <input type="text" name="journal" value="{{ old('journal') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                           placeholder="Journal name">
                    @error('journal')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Publication Date *</label>
                        <input type="text" name="publication_date" value="{{ old('publication_date') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                               placeholder="e.g., December 2008">
                        @error('publication_date')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Volume/Issue</label>
                        <input type="text" name="volume_issue" value="{{ old('volume_issue') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                               placeholder="e.g., Vol 21, Issue 6, pages 539-546">
                        @error('volume_issue')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Type *</label>
                    <select name="type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                        <option value="">Select Type</option>
                        <option value="article" {{ old('type') == 'article' ? 'selected' : '' }}>Research Article</option>
                        <option value="case_report" {{ old('type') == 'case_report' ? 'selected' : '' }}>Case Report</option>
                    </select>
                    @error('type')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="mr-2">
                        <span class="text-gray-700">Publish immediately</span>
                    </label>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-cyan-700 text-white px-8 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
                        <i class="fas fa-save mr-2"></i>Add Research Paper
                    </button>
                    <a href="{{ route('admin.research.index') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg font-medium hover:bg-gray-300 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

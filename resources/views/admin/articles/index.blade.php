{{-- resources/views/admin/articles/index.blade.php --}}
@extends('layouts.admin')

@section('page-title', 'Articles Management')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.articles.create') }}" class="bg-cyan-700 text-white px-6 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
            <i class="fas fa-plus mr-2"></i>Add New Article
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse($articles as $article)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <p class="font-medium text-gray-800">{{ $article->title }}</p>
                        <p class="text-sm text-gray-600">{{ $article->slug }}</p>
                    </td>
                    <td class="px-6 py-4">
                        @if($article->category)
                            <span class="px-3 py-1 bg-cyan-100 text-cyan-800 text-xs font-medium rounded-full">
                        {{ $article->category }}
                    </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($article->is_published)
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Published</span>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">Draft</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-700">{{ $article->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('articles.show', $article) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.articles.edit', $article) }}" class="text-cyan-600 hover:text-cyan-800">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        No articles found. <a href="{{ route('admin.articles.create') }}" class="text-cyan-700">Create one now</a>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($articles->hasPages())
        <div class="mt-6">
            {{ $articles->links() }}
        </div>
    @endif
@endsection

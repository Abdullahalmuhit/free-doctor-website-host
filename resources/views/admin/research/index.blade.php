{{-- resources/views/admin/research/index.blade.php --}}
@extends('layouts.admin')

@section('page-title', 'Research Management')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.research.create') }}" class="bg-cyan-700 text-white px-6 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
            <i class="fas fa-plus mr-2"></i>Add Research Paper
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Authors</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse($papers as $paper)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <p class="font-medium text-gray-800 line-clamp-2">{{ $paper->title }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-gray-600 line-clamp-1">{{ Str::limit($paper->authors, 50) }}</p>
                    </td>
                    <td class="px-6 py-4">
                        @if($paper->type === 'article')
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Article</span>
                        @else
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">Case Report</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-700">{{ $paper->publication_date }}</td>
                    <td class="px-6 py-4">
                        @if($paper->is_published)
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Published</span>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">Draft</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.research.edit', $paper) }}" class="text-cyan-600 hover:text-cyan-800">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.research.destroy', $paper) }}" method="POST" class="inline">
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
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        No research papers found. <a href="{{ route('admin.research.create') }}" class="text-cyan-700">Add one now</a>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($papers->hasPages())
        <div class="mt-6">
            {{ $papers->links() }}
        </div>
    @endif
@endsection

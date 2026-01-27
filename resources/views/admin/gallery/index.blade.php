{{-- resources/views/admin/gallery/index.blade.php --}}
@extends('layouts.admin')

@section('page-title', 'Gallery Management')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.gallery.create') }}" class="bg-cyan-700 text-white px-6 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
            <i class="fas fa-plus mr-2"></i>Add New Item
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preview</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse($items as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        @if($item->type === 'image')
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-20 h-20 object-cover rounded">
                        @else
                            <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                                <i class="fas fa-video text-3xl text-gray-400"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <p class="font-medium text-gray-800">{{ $item->title }}</p>
                        <p class="text-sm text-gray-600">{{ Str::limit($item->description, 50) }}</p>
                    </td>
                    <td class="px-6 py-4">
                        @if($item->type === 'image')
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                            <i class="fas fa-image mr-1"></i>Image
                        </span>
                        @else
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">
                            <i class="fas fa-video mr-1"></i>Video
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                    <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                        {{ ucfirst($item->category) }}
                    </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col gap-1">
                            @if($item->is_active)
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded">Active</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded">Inactive</span>
                            @endif

                            @if($item->is_featured)
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded">
                                <i class="fas fa-star"></i> Featured
                            </span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <form action="{{ route('admin.gallery.toggleFeatured', $item) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-yellow-600 hover:text-yellow-800" title="Toggle Featured">
                                    <i class="fas fa-star"></i>
                                </button>
                            </form>

                            <a href="{{ route('admin.gallery.edit', $item) }}" class="text-cyan-600 hover:text-cyan-800">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" class="inline">
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
                        No gallery items found. <a href="{{ route('admin.gallery.create') }}" class="text-cyan-700">Add one now</a>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($items->hasPages())
        <div class="mt-6">
            {{ $items->links() }}
        </div>
    @endif
@endsection

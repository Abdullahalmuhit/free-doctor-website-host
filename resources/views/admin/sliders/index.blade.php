@extends('layouts.admin')

@section('page-title', 'Slider Management')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.sliders.create') }}" class="bg-cyan-700 text-white px-6 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
            <i class="fas fa-plus mr-2"></i>Add New Slider
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preview</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Button</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse($sliders as $slider)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <img src="{{ $slider->image_url }}" alt="{{ $slider->title }}" class="w-20 h-20 object-cover rounded">
                    </td>
                    <td class="px-6 py-4">
                        <p class="font-medium text-gray-800">{{ $slider->title }}</p>
                        <p class="text-sm text-gray-600">{{ Str::limit($slider->description, 50) }}</p>
                    </td>
                    <td class="px-6 py-4">
                        @if($slider->button_text)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-100 text-green-800">
                        {{ $slider->button_text }}
                                @if($slider->button_new_tab)
                                    <i class="fas fa-external-link-alt ml-1"></i>
                                @endif
                    </span>
                        @else
                            <span class="text-gray-500 text-sm">No button</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                    <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">
                        {{ $slider->order }}
                    </span>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.sliders.toggleActive', $slider) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="relative inline-flex items-center cursor-pointer">
                                <div class="w-12 h-6 rounded-full {{ $slider->is_active ? 'bg-green-500' : 'bg-gray-300' }} transition">
                                    <div class="absolute top-1 {{ $slider->is_active ? 'left-7' : 'left-1' }} bg-white w-4 h-4 rounded-full transition-all"></div>
                                </div>
                                <span class="ml-2 text-sm {{ $slider->is_active ? 'text-green-600' : 'text-gray-600' }}">
                                {{ $slider->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.sliders.edit', $slider) }}" class="text-cyan-600 hover:text-cyan-800">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure? This will permanently delete the slider.')" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        No sliders found. <a href="{{ route('admin.sliders.create') }}" class="text-cyan-700">Add one now</a>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    @if($sliders->hasPages())
        <div class="mt-6">
            {{ $sliders->links() }}
        </div>
    @endif
@endsection

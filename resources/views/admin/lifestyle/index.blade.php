{{-- resources/views/admin/lifestyle/index.blade.php --}}
@extends('layouts.admin')

@section('page-title', 'Lifestyle Management')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.lifestyle.create') }}" class="bg-cyan-700 text-white px-6 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
            <i class="fas fa-plus mr-2"></i>Add Lifestyle Item
        </a>
    </div>

    {{-- Nutrition Items --}}
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-apple-alt text-orange-500 mr-3"></i>
            Nutrition Items
        </h2>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse($items->where('category', 'nutrition') as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <i class="{{ $item->icon ?? 'fas fa-leaf' }} text-orange-500 mr-3"></i>
                                <span class="font-medium text-gray-800">{{ $item->title }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-700">{{ $item->order }}</td>
                        <td class="px-6 py-4">
                            @if($item->is_active)
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Active</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.lifestyle.edit', $item) }}" class="text-cyan-600 hover:text-cyan-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.lifestyle.destroy', $item) }}" method="POST" class="inline">
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
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">No nutrition items</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Exercise Items --}}
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-dumbbell text-cyan-700 mr-3"></i>
            Exercise Items
        </h2>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse($items->where('category', 'exercise') as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <i class="{{ $item->icon ?? 'fas fa-running' }} text-cyan-700 mr-3"></i>
                                <span class="font-medium text-gray-800">{{ $item->title }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-700">{{ $item->order }}</td>
                        <td class="px-6 py-4">
                            @if($item->is_active)
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Active</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.lifestyle.edit', $item) }}" class="text-cyan-600 hover:text-cyan-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.lifestyle.destroy', $item) }}" method="POST" class="inline">
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
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">No exercise items</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Habit Items --}}
    <div>
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-heart text-purple-600 mr-3"></i>
            Habit Items
        </h2>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse($items->where('category', 'habits') as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <i class="{{ $item->icon ?? 'fas fa-moon' }} text-purple-600 mr-3"></i>
                                <span class="font-medium text-gray-800">{{ $item->title }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-700">{{ $item->order }}</td>
                        <td class="px-6 py-4">
                            @if($item->is_active)
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Active</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.lifestyle.edit', $item) }}" class="text-cyan-600 hover:text-cyan-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.lifestyle.destroy', $item) }}" method="POST" class="inline">
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
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">No habit items</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

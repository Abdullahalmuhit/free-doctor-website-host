{{-- resources/views/admin/chambers/index.blade.php --}}
@extends('layouts.admin')

@section('page-title', 'Chambers Management')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.chambers.create') }}" class="bg-cyan-700 text-white px-6 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
            <i class="fas fa-plus mr-2"></i>Add New Chamber
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Chamber Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Address</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse($chambers as $chamber)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <p class="font-medium text-gray-800">{{ $chamber->name }}</p>
                        @if($chamber->room_number)
                            <p class="text-sm text-gray-600">{{ $chamber->room_number }}</p>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-gray-700">{{ Str::limit($chamber->address, 50) }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-gray-700">{{ $chamber->phone }}</p>
                    </td>
                    <td class="px-6 py-4">
                        @if($chamber->is_active)
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Active</span>
                        @else
                            <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.chambers.edit', $chamber) }}" class="text-cyan-600 hover:text-cyan-800">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.chambers.destroy', $chamber) }}" method="POST" class="inline">
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
                        No chambers found. <a href="{{ route('admin.chambers.create') }}" class="text-cyan-700">Add one now</a>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

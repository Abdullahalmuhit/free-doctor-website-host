@extends('layouts.app')
<?php
$doctor = \App\Models\User::where('role', 'doctor')->first();
$name = $doctor->getFullNameAttribute();
?>

@section('title', 'Chamber Locations -' . $name)

@section('content')
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-cyan-700 font-medium text-sm uppercase tracking-wide">Visit Us</span>
                <h1 class="text-4xl font-bold text-gray-800 mt-2 mb-4">Chamber Locations</h1>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    Convenient locations in Dhaka's premier healthcare facilities. Choose the chamber and time that works best for you.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
                @forelse($chambers as $chamber)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="bg-gradient-to-r from-cyan-700 to-cyan-800 p-6 text-white">
                            <div class="flex items-start">
                                <div class="w-16 h-16 bg-white/20 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-hospital text-3xl"></i>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold mb-2">{{ $chamber->name }}</h2>
                                    @if($chamber->room_number)
                                        <p class="text-cyan-100">{{ $chamber->room_number }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            {{-- Address --}}
                            <div class="mb-6">
                                <div class="flex items-start text-gray-700">
                                    <i class="fas fa-map-marker-alt text-orange-500 mt-1 mr-3"></i>
                                    <p>{{ $chamber->address }}</p>
                                </div>
                            </div>

                            {{-- Visiting Hours --}}
                            <div class="mb-6">
                                <h3 class="font-bold text-gray-800 mb-3 flex items-center">
                                    <i class="far fa-clock text-cyan-700 mr-2"></i>
                                    Visiting Hours
                                </h3>
                                <div class="space-y-2">
                                    @foreach($chamber->visiting_hours as $schedule)
                                        <div class="flex justify-between items-center bg-gray-50 p-3 rounded">
                                            <span class="font-medium text-gray-700">{{ $schedule['day'] }}</span>
                                            <span class="text-cyan-700 font-medium">{{ $schedule['time'] }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Contact --}}
                            <div class="mb-6">
                                <a href="tel:{{ $chamber->phone }}" class="flex items-center text-gray-700 hover:text-cyan-700 transition">
                                    <i class="fas fa-phone text-orange-500 mr-3"></i>
                                    <span class="font-medium">{{ $chamber->phone }}</span>
                                </a>
                            </div>

                            {{-- Actions --}}
                            <div class="flex gap-3">
                                <a href="{{ route('appointment.create') }}" class="flex-1 btn-primary text-white px-6 py-3 rounded-lg font-medium text-center">
                                    <i class="fas fa-calendar-check mr-2"></i>Book Appointment
                                </a>
                                <a href="https://t.me/" target="_blank" class="w-12 h-12 bg-cyan-700 text-white rounded-lg flex items-center justify-center hover:bg-cyan-800 transition">
                                    <i class="fab fa-telegram-plane text-xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-12">
                        <i class="fas fa-hospital text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg">No chambers available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

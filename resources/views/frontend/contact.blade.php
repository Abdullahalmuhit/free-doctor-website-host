{{-- resources/views/frontend/contact.blade.php --}}
@extends('layouts.app')

<?php
    $doctor = \App\Models\User::where('role', 'doctor')->first();
$name = $doctor->getFullNameAttribute();
    ?>

@section('title', 'Contact Us -' . $name)

@section('content')
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Contact Us</h1>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Get in touch with us for appointments, inquiries, or any questions you may have
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
                {{-- Contact Form --}}
                <div class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Send Us a Message</h2>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Your Name *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                   placeholder="Bayazid Hasan">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Email *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                   placeholder="support@allnextver.com">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Phone Number *</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                   placeholder="01XXXXXXXXX">
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Message *</label>
                            <textarea name="message" rows="5" required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                      placeholder="Hello, I am Bayazid Hasan...">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="w-full btn-primary text-white px-8 py-4 rounded-lg font-medium text-lg">
                            <i class="fas fa-paper-plane mr-2"></i>Send Message
                        </button>
                    </form>
                </div>

                {{-- Chamber Information --}}
                <div class="space-y-6">
                    @foreach($chambers as $chamber)
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-start mb-4">
                                <div class="w-12 h-12 bg-cyan-700 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-hospital text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">{{ $chamber->name }}</h3>
                                    @if($chamber->room_number)
                                        <p class="text-gray-600">{{ $chamber->room_number }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-start text-gray-700">
                                    <i class="fas fa-map-marker-alt text-orange-500 mt-1 mr-3"></i>
                                    <p>{{ $chamber->address }}</p>
                                </div>

                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-phone text-orange-500 mr-3"></i>
                                    <a href="tel:{{ $chamber->phone }}" class="hover:text-cyan-700">{{ $chamber->phone }}</a>
                                </div>

                                <div>
                                    <p class="font-medium text-gray-800 mb-2">
                                        <i class="far fa-clock text-cyan-700 mr-2"></i>Visiting Hours
                                    </p>
                                    <div class="ml-6 space-y-1">
                                        @foreach($chamber->visiting_hours as $schedule)
                                            <div class="flex justify-between text-sm">
                                                <span class="text-gray-600">{{ $schedule['day'] }}</span>
                                                <span class="text-cyan-700 font-medium">{{ $schedule['time'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <a href="{{ route('appointment.create') }}" class="block w-full btn-primary text-white px-6 py-3 rounded-lg font-medium text-center mt-4">
                                    <i class="fas fa-calendar-check mr-2"></i>Book Appointment
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- resources/views/frontend/about.blade.php --}}
@extends('layouts.app')

@section('title', 'About ' . $doctor->full_name)

@section('content')

    {{-- Hero Section with Doctor Profile --}}
    <section class="py-16 bg-gradient-to-br from-gray-50 to-cyan-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-6">
                <span class="text-cyan-700 font-medium text-sm uppercase tracking-wide">About The Doctor</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
                {{-- Profile Image --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg p-8 sticky top-24">
                        <div class="text-center">
                            <img src="{{ $doctor->profile_photo_url }}"
                                 alt="{{ $doctor->full_name }}"
                                 class="w-48 h-48 rounded-full mx-auto mb-6 object-cover border-4 border-cyan-100">

                            <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $doctor->full_name }}</h1>
                            <p class="text-cyan-700 font-medium mb-4">{{ $doctor->designation }}</p>

                            <div class="border-t border-gray-200 pt-4 mb-4">
                                <div class="flex items-center justify-center text-gray-600 mb-2">
                                    <i class="fas fa-graduation-cap mr-2"></i>
                                    <span class="text-sm">{{ $doctor->qualifications->first()->degree ?? 'MD Neurology' }}</span>
                                </div>
                                <div class="flex items-center justify-center text-gray-600">
                                    <i class="fas fa-clock mr-2"></i>
                                    <span class="text-sm">{{ $doctor->years_of_experience }}+ Years Experience</span>
                                </div>
                            </div>

                            <a href="{{ route('appointment.create') }}"
                               class="block w-full btn-primary text-white px-6 py-3 rounded-lg font-medium mb-3">
                                <i class="fas fa-calendar-check mr-2"></i>Book Appointment
                            </a>

                            <a href="#contact"
                               class="block w-full bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-200 transition">
                                <i class="fas fa-phone mr-2"></i>Contact Now
                            </a>
                        </div>
                    </div>
                </div>

                {{-- About Content --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-6">Dedicated to Neurological Excellence</h2>
                        <div class="prose max-w-none text-gray-600 leading-relaxed">
                            <p class="mb-4">{{ $doctor->about }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Qualifications & Training --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Qualifications & Training</h2>
            </div>

            <div class="max-w-4xl mx-auto">
                {{-- Academic Qualifications --}}
                <div class="mb-12">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-graduation-cap text-cyan-700 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Academic Qualification</h3>
                    </div>

                    <div class="relative">
                        <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gray-200"></div>

                        @foreach($doctor->qualifications as $qual)
                            <div class="relative pl-16 pb-8 last:pb-0">
                                <div class="absolute left-0 w-12 h-12 bg-cyan-700 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ $qual->completion_year }}
                                </div>
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-xl font-bold text-gray-800 mb-2">{{ $qual->degree }}</h4>
                                    @if($qual->specialization)
                                        <p class="text-cyan-700 font-medium mb-2">{{ $qual->specialization }}</p>
                                    @endif
                                    <p class="text-gray-600 mb-1">{{ $qual->institution }}</p>
                                    @if($qual->location)
                                        <p class="text-sm text-gray-500">{{ $qual->location }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Training Programs --}}
                @if($doctor->trainingPrograms->count() > 0)
                    <div>
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-certificate text-orange-500 text-xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800">Training</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($doctor->trainingPrograms as $training)
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <div class="flex items-start">
                                        <i class="fas fa-check-circle text-orange-500 mt-1 mr-3"></i>
                                        <div>
                                            <h4 class="font-bold text-gray-800 mb-1">{{ $training->program_name }}</h4>
                                            <p class="text-sm text-gray-600">{{ $training->institution }}</p>
                                            @if($training->location)
                                                <p class="text-sm text-gray-500">{{ $training->location }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Patient-Centered Care --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-cyan-700 font-medium text-sm uppercase tracking-wide">Our Approach</span>
                <h2 class="text-3xl font-bold text-gray-800 mt-2 mb-4">Patient-Centered Neurological Care</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="bg-white rounded-lg p-8 text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-heart text-cyan-700 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Compassionate Care</h3>
                    <p class="text-gray-600">Every patient is treated with empathy, respect, and individualized attention to their unique needs.</p>
                </div>

                <div class="bg-white rounded-lg p-8 text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-microscope text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Precision Diagnosis</h3>
                    <p class="text-gray-600">Utilizing the latest diagnostic tools and techniques to ensure accurate identification of neurological conditions.</p>
                </div>

                <div class="bg-white rounded-lg p-8 text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-pills text-orange-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Evidence-Based Treatment</h3>
                    <p class="text-gray-600">Treatment plans are developed based on the latest medical research and evidence to achieve the best outcomes.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Professional Memberships --}}
    @if($doctor->memberships->count() > 0)
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-award text-orange-500 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Professional Memberships</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($doctor->memberships->where('is_active', true) as $membership)
                            <div class="bg-gray-50 rounded-lg p-6 flex items-center">
                                <i class="fas fa-check-circle text-green-500 text-xl mr-4"></i>
                                <div>
                                    <h4 class="font-bold text-gray-800">{{ $membership->organization_name }}</h4>
                                    @if($membership->membership_type)
                                        <p class="text-sm text-gray-600">{{ $membership->membership_type }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Areas of Specialization --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-cyan-700 font-medium text-sm uppercase tracking-wide">Expertise</span>
                <h2 class="text-3xl font-bold text-gray-800 mt-2 mb-4">Areas of Specialization</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    Comprehensive expertise across the full spectrum of neurological conditions, from common disorders to complex cases requiring specialized care.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                @foreach($doctor->specializations->where('is_active', true) as $spec)
                    <div class="bg-white rounded-lg p-6 hover:shadow-lg transition">
                        <div class="w-12 h-12 bg-gradient-to-br from-cyan-100 to-cyan-200 rounded-lg flex items-center justify-center mb-4">
                            <i class="{{ $spec->icon ?? 'fas fa-stethoscope' }} text-cyan-700 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $spec->name }}</h3>
                        @if($spec->description)
                            <p class="text-sm text-gray-600">{{ $spec->description }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Work Experience Timeline --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Work Experience</h2>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="relative">
                    <div class="absolute left-6 top-0 bottom-0 w-0.5 bg-gray-200"></div>

                    @foreach($doctor->workExperiences as $exp)
                        <div class="relative pl-16 pb-10 last:pb-0">
                            <div class="absolute left-0 w-12 h-12 {{ $exp->is_current ? 'bg-gradient-to-br from-orange-400 to-orange-600' : 'bg-cyan-700' }} rounded-full flex items-center justify-center">
                                <i class="fas fa-{{ $exp->is_current ? 'star' : 'briefcase' }} text-white"></i>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition">
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="text-xl font-bold text-gray-800">{{ $exp->position }}</h3>
                                    @if($exp->is_current)
                                        <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-medium">Current</span>
                                    @endif
                                </div>
                                <p class="text-cyan-700 font-medium mb-2">{{ $exp->institution }}</p>
                                @if($exp->department)
                                    <p class="text-gray-600 text-sm mb-2">{{ $exp->department }}</p>
                                @endif
                                <p class="text-sm text-gray-500 mb-3">
                                    <i class="far fa-calendar mr-2"></i>{{ $exp->duration }}
                                </p>
                                @if($exp->responsibilities)
                                    <p class="text-gray-600 text-sm">{{ $exp->responsibilities }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection

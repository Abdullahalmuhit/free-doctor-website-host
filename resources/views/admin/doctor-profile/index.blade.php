@extends('layouts.admin')

@section('page-title', 'Doctor Profile Management')

@section('content')
    <div class="max-w-6xl">
        {{-- Basic Information --}}
        <div class="bg-white rounded-lg shadow p-8 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Basic Information</h3>

            <form action="{{ route('admin.doctor-profile.updateBasicInfo', $doctor) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Current Profile Photo Display --}}
                @if($doctor->profile_photo)
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Current Profile Photo</label>
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('storage/' . $doctor->profile_photo) }}"
                                 alt="{{ $doctor->name }}"
                                 class="w-32 h-32 rounded-full object-cover border-4 border-gray-200">
                            <div>
                                <p class="text-sm text-gray-600">{{ basename($doctor->profile_photo) }}</p>
                                <p class="text-xs text-gray-500">Upload a new image to replace</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Profile Photo Upload --}}
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">
                        {{ $doctor->profile_photo ? 'Change Profile Photo' : 'Upload Profile Photo' }}
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <input type="file" name="profile_photo" accept="image/*" id="profile_photo"
                               class="hidden" onchange="previewImage(event)">
                        <label for="profile_photo" class="cursor-pointer">
                            <div id="image-preview" class="mb-4">
                                <i class="fas fa-cloud-upload-alt text-5xl text-gray-400"></i>
                            </div>
                            <p class="text-gray-600 mb-2">Click to upload or drag and drop</p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                        </label>
                    </div>
                    @error('profile_photo')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Full Name *</label>
                        <input type="text" name="name" value="{{ old('name', $doctor->name) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
                        @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Email *</label>
                        <input type="email" name="email" value="{{ old('email', $doctor->email) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
                        @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Title *</label>
                        <input type="text" name="title" value="{{ old('title', $doctor->title) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500"
                               placeholder="Prof. Dr.">
                        @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Designation *</label>
                        <input type="text" name="designation" value="{{ old('designation', $doctor->designation) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500"
                               placeholder="Senior Consultant - Neurology">
                        @error('designation')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Specialization</label>
                        <input type="text" name="specialization" value="{{ old('specialization', $doctor->specialization) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500"
                               placeholder="Neurology">
                        @error('specialization')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Years of Experience</label>
                        <input type="number" name="years_of_experience" value="{{ old('years_of_experience', $doctor->years_of_experience) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
                        @error('years_of_experience')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $doctor->phone) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500">
                        @error('phone')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Consultation Fee (BDT)</label>
                        <input type="text" name="consultation_fee" value="{{ old('consultation_fee', $doctor->consultation_fee) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500"
                               placeholder="1500">
                        @error('consultation_fee')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Short Bio</label>
                    <textarea name="bio" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500"
                              placeholder="Brief professional summary...">{{ old('bio', $doctor->bio) }}</textarea>
                    @error('bio')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">About (Detailed)</label>
                    <textarea name="about" rows="6"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500"
                              placeholder="Detailed professional background...">{{ old('about', $doctor->about) }}</textarea>
                    @error('about')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-cyan-700 text-white px-8 py-3 rounded-lg hover:bg-cyan-800 transition">
                    <i class="fas fa-save mr-2"></i>Update Basic Info
                </button>
            </form>
        </div>

        <script>
            function previewImage(event) {
                const preview = document.getElementById('image-preview');
                const file = event.target.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.innerHTML = `<img src="${e.target.result}" class="w-32 h-32 rounded-full object-cover mx-auto border-4 border-cyan-200">`;
                    }
                    reader.readAsDataURL(file);
                }
            }
        </script>

        {{-- Qualifications --}}
        <div class="bg-white rounded-lg shadow p-8 mb-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Qualifications</h3>

            <div class="space-y-3 mb-6">
                @foreach($doctor->qualifications as $qual)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-800">{{ $qual->degree }}</p>
                            <p class="text-sm text-gray-600">{{ $qual->institution }} - {{ $qual->completion_year }}</p>
                        </div>
                        <form action="{{ route('admin.doctor-profile.qualifications.destroy', $qual) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <p class="text-sm text-gray-600 mb-4">Add qualifications, work experiences, and other details from the doctor profile section in the sidebar.</p>
        </div>

        {{-- Quick Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm mb-1">Qualifications</p>
                <p class="text-3xl font-bold text-cyan-700">{{ $doctor->qualifications->count() }}</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm mb-1">Work Experience</p>
                <p class="text-3xl font-bold text-cyan-700">{{ $doctor->workExperiences->count() }}</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm mb-1">Specializations</p>
                <p class="text-3xl font-bold text-cyan-700">{{ $doctor->specializations->count() }}</p>
            </div>
        </div>
    </div>
@endsection

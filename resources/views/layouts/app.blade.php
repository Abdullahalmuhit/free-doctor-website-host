{{-- resources/views/layouts/app.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $doctor = \App\Models\User::where('role', 'doctor')->first();
    $name = $doctor?->getFullNameAttribute();
    $designation = $doctor?->designation;
    ?>
    <title>@yield('title',  $name . $designation)</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #0c4a6e 0%, #075985 100%);
        }

        .btn-primary {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(249, 115, 22, 0.3);
        }

        .nav-link {
            position: relative;
            transition: color 0.3s;
        }

        .nav-link:after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #f97316;
            transition: width 0.3s;
        }

        .nav-link:hover:after,
        .nav-link.active:after {
            width: 100%;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50">
{{-- Header/Navigation --}}
<?php
$doctor = \App\Models\User::where('role', 'doctor')->first();
$name = $doctor?->getFullNameAttribute();
$designation = $doctor?->designation;
?>
<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
                <div class="w-12 h-12 gradient-bg rounded-lg flex items-center justify-center">
                    @if($doctor->profile_photo)

                        <img src="{{ asset('storage/' . $doctor->profile_photo) }}"
                             alt="{{ $doctor->name }}"
                             class="w-32 rounded-full object-cover border-4 border-gray-200">
                    @endif
                </div>




                <div>
                    <h1 class="text-xl font-bold text-gray-800">{{$name}}</h1>
                    <p class="text-sm text-gray-600">{{$designation}}</p>
                </div>
            </a>

            {{-- Desktop Navigation --}}
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="nav-link text-gray-700 hover:text-cyan-700 {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="nav-link text-gray-700 hover:text-cyan-700 {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('articles.index') }}" class="nav-link text-gray-700 hover:text-cyan-700 {{ request()->routeIs('articles.*') ? 'active' : '' }}">Articles</a>
                <a href="{{ route('research.index') }}" class="nav-link text-gray-700 hover:text-cyan-700 {{ request()->routeIs('research.*') ? 'active' : '' }}">Research</a>
                <a href="{{ route('lifestyle.index') }}" class="nav-link text-gray-700 hover:text-cyan-700 {{ request()->routeIs('lifestyle.*') ? 'active' : '' }}">Lifestyle</a>
                <a href="{{ route('chambers.index') }}" class="nav-link text-gray-700 hover:text-cyan-700 {{ request()->routeIs('chambers.*') ? 'active' : '' }}">Chambers</a>
                <a href="{{ route('gallery.index') }}" class="nav-link text-gray-700 hover:text-cyan-700 {{ request()->routeIs('gallery.*') ? 'active' : '' }}">Gallery</a>
                <a href="{{ route('contact.index') }}" class="nav-link text-gray-700 hover:text-cyan-700 {{ request()->routeIs('contact.*') ? 'active' : '' }}">Contact</a>
            </nav>

            {{-- Book Appointment Button --}}
            <a href="{{ route('appointment.create') }}" class="hidden md:inline-block btn-primary text-white px-6 py-2.5 rounded-lg font-medium">
                <i class="fas fa-calendar-check mr-2"></i>Book Appointment
            </a>

            {{-- Mobile Menu Button --}}
            <button id="mobile-menu-btn" class="md:hidden text-gray-700">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        {{-- Mobile Navigation --}}
        <nav id="mobile-menu" class="hidden md:hidden pb-4">
            <div class="flex flex-col space-y-3">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-cyan-700 py-2">Home</a>
                <a href="{{ route('about') }}" class="text-gray-700 hover:text-cyan-700 py-2">About</a>
                <a href="{{ route('articles.index') }}" class="text-gray-700 hover:text-cyan-700 py-2">Articles</a>
                <a href="{{ route('research.index') }}" class="text-gray-700 hover:text-cyan-700 py-2">Research</a>
                <a href="{{ route('lifestyle.index') }}" class="text-gray-700 hover:text-cyan-700 py-2">Lifestyle</a>
                <a href="{{ route('chambers.index') }}" class="text-gray-700 hover:text-cyan-700 py-2">Chambers</a>
                <a href="{{ route('chambers.index') }}" class="text-gray-700 hover:text-cyan-700 py-2">Gallery</a>
                <a href="{{ route('contact.index') }}" class="text-gray-700 hover:text-cyan-700 py-2">Contact</a>
                <a href="{{ route('appointment.create') }}" class="btn-primary text-white px-6 py-2.5 rounded-lg font-medium text-center">
                    <i class="fas fa-calendar-check mr-2"></i>Book Appointment
                </a>
            </div>
        </nav>
    </div>
</header>

{{-- Main Content --}}
<main>
    @yield('content')
</main>

{{-- Footer --}}
<footer class="gradient-bg text-white mt-20">
    <div class="container mx-auto px-4 py-12">
        {{-- QR Code & CTA Section --}}
        <div class="text-center mb-8">
            <div class="inline-block bg-white p-4 rounded-lg mb-4">
                <img src="/images/qr-code.png" alt="QR Code" class="w-32 h-32">
            </div>
            <p class="text-sm mb-6">Scan QR code to get visiting card</p>

            <h3 class="text-3xl font-bold mb-6">Need Urgent Consultation?</h3>

            {{-- Social Links --}}
            <div class="flex justify-center space-x-4 mb-8">
                <a href="#" class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="#" class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition">
                    <i class="fab fa-youtube"></i>
                </a>



            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('chambers.index') }}" class="bg-white text-cyan-800 px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition">
                    <i class="fas fa-map-marker-alt mr-2"></i>Visit Chambers
                </a>
                <a href="{{ route('appointment.create') }}" class="bg-orange-500 text-white px-8 py-3 rounded-lg font-medium hover:bg-orange-600 transition">
                    <i class="fas fa-calendar-check mr-2"></i>Book Appointment
                </a>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="border-t border-white/20 pt-8 text-center">
            <p class="text-sm">&copy; 2026 {{$name}}. All rights reserved | Developed By CogniThrone</p>
        </div>
    </div>
</footer>

{{-- Scripts --}}
<script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>

@stack('scripts')
</body>
</html>

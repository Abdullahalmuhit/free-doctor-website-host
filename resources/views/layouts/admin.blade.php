{{-- resources/views/layouts/admin.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $doctor = \App\Models\User::where('role', 'doctor')->first();
    $name = $doctor?->getFullNameAttribute();
    $designation = $doctor?->designation;
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - {{$name}}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-100">
<div class="flex h-screen">
    {{-- Sidebar --}}
    <?php
    $doctor = \App\Models\User::where('role', 'doctor')->first();
    $name = $doctor?->getFullNameAttribute();
    $designation = $doctor?->designation;
    ?>
    <aside class="w-64 bg-cyan-900 text-white flex-shrink-0">
        <div class="p-6">
            <h1 class="text-xl font-bold">{{$name}}</h1>
            <p class="text-cyan-300 text-sm">Management Panel</p>
        </div>

        <nav class="px-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-cyan-800' : 'hover:bg-cyan-800' }} transition">
                <i class="fas fa-chart-line mr-3"></i>Dashboard
            </a>

            <a href="{{ route('admin.doctor-profile.index') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.doctor-profile.*') ? 'bg-cyan-800' : 'hover:bg-cyan-800' }} transition">
                <i class="fas fa-user-md mr-3"></i>Doctor Profile
            </a>

            <a href="{{ route('admin.articles.index') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.articles.*') ? 'bg-cyan-800' : 'hover:bg-cyan-800' }} transition">
                <i class="fas fa-newspaper mr-3"></i>Articles
            </a>

            <a href="{{ route('admin.research.index') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.research.*') ? 'bg-cyan-800' : 'hover:bg-cyan-800' }} transition">
                <i class="fas fa-flask mr-3"></i>Research
            </a>

            <a href="{{ route('admin.chambers.index') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.chambers.*') ? 'bg-cyan-800' : 'hover:bg-cyan-800' }} transition">
                <i class="fas fa-hospital mr-3"></i>Chambers
            </a>

            <a href="{{ route('admin.appointments.index') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.appointments.*') ? 'bg-cyan-800' : 'hover:bg-cyan-800' }} transition">
                <i class="fas fa-calendar-check mr-3"></i>Appointments
            </a>

            <a href="{{ route('admin.lifestyle.index') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.lifestyle.*') ? 'bg-cyan-800' : 'hover:bg-cyan-800' }} transition">
                <i class="fas fa-heartbeat mr-3"></i>Lifestyle
            </a>

            <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-cyan-800' : 'hover:bg-cyan-800' }} transition">
                <i class="fas fa-cog mr-3"></i>Settings
            </a>
            

            <a href="{{ route('admin.gallery.index')  }}" class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.gallery.*') ? 'bg-cyan-800' : 'hover:bg-cyan-800' }} transition">
                <i class="fas fa-images mr-3"></i>Gallery
            </a>

            <a href="{{ route('admin.sliders.index')  }}" class="flex items-center px-4 py-3 mb-2 rounded-lg {{ request()->routeIs('admin.sliders.*') ? 'bg-cyan-800' : 'hover:bg-cyan-800' }} transition">
                <i class="fas fa-images mr-3"></i>Homepage Slider
            </a>

            <div class="border-t border-cyan-800 my-4"></div>

            <a href="{{ route('home') }}" target="_blank" class="flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-cyan-800 transition">
                <i class="fas fa-external-link-alt mr-3"></i>View Website
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 mb-2 rounded-lg hover:bg-cyan-800 transition text-left">
                    <i class="fas fa-sign-out-alt mr-3"></i>Logout
                </button>
            </form>
        </nav>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col overflow-hidden">
        {{-- Top Bar --}}
        <header class="bg-white shadow-sm">
            <div class="flex items-center justify-between px-8 py-4">
                <h2 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>

                <div class="flex items-center">
                    <span class="text-gray-600 mr-4">{{ auth()->user()->name }}</span>
                    <div class="w-10 h-10 bg-cyan-700 rounded-full flex items-center justify-center text-white font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </div>
        </header>

        {{-- Content Area --}}
        <main class="flex-1 overflow-y-auto p-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>

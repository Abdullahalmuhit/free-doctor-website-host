{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-cyan-50 via-white to-cyan-100 py-12">
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <a href="{{ route('home') }}" class="inline-block">
                    <h1 class="text-4xl font-bold text-cyan-800 mb-4">
                        {{ $name ?? 'Doctor Portal' }}
                    </h1>
                </a>
                <p class="text-gray-600 text-lg">
                    {{ $designation ?? 'Medical Professional Portal' }}
                </p>
            </div>

            <!-- Login Card -->
            <div class="max-w-md mx-auto">
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                    <!-- Card Header with Gradient -->
                    <div class="bg-gradient-to-r from-cyan-700 to-cyan-900 py-8 px-8 text-center">
                        <h2 class="text-3xl font-bold text-white mb-2">Welcome Back</h2>
                        <p class="text-cyan-100">Sign in to your account</p>
                    </div>

                    <!-- Card Body -->
                    <div class="p-8">
                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf

                            <!-- Email Field -->
                            <div class="space-y-2">
                                <label for="email" class="flex items-center text-gray-700 font-medium">
                                    <i class="fas fa-envelope mr-2 text-cyan-600"></i>
                                    Email Address
                                </label>
                                <div class="relative">
                                    <input id="email"
                                           name="email"
                                           type="email"
                                           value="{{ old('email') }}"
                                           required
                                           autofocus
                                           autocomplete="email"
                                           class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:outline-none transition"
                                           placeholder="Enter your email">
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                        <i class="far fa-envelope text-gray-400"></i>
                                    </div>
                                </div>
                                @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="space-y-2">
                                <label for="password" class="flex items-center text-gray-700 font-medium">
                                    <i class="fas fa-lock mr-2 text-cyan-600"></i>
                                    Password
                                </label>
                                <div class="relative">
                                    <input id="password"
                                           name="password"
                                           type="password"
                                           required
                                           autocomplete="current-password"
                                           class="w-full px-4 py-3 pl-12 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:outline-none transition"
                                           placeholder="Enter your password">
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                        <i class="fas fa-key text-gray-400"></i>
                                    </div>
                                    <button type="button"
                                            onclick="togglePassword()"
                                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-cyan-600">
                                        <i class="far fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input id="remember_me"
                                           name="remember"
                                           type="checkbox"
                                           class="w-4 h-4 text-cyan-600 border-gray-300 rounded focus:ring-cyan-500">
                                    <label for="remember_me" class="ml-2 text-gray-700">
                                        Remember me
                                    </label>
                                </div>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                       class="text-cyan-700 hover:text-cyan-800 font-medium text-sm">
                                        Forgot password?
                                    </a>
                                @endif
                            </div>

                            <!-- Login Button -->
                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-cyan-700 to-cyan-800 text-white py-4 px-6 rounded-lg font-medium text-lg hover:from-cyan-800 hover:to-cyan-900 focus:outline-none focus:ring-4 focus:ring-cyan-500/30 transition-all duration-300 transform hover:-translate-y-1">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Sign In
                            </button>

                            <!-- Divider -->
                            <div class="relative flex items-center justify-center">
                                <div class="flex-grow border-t border-gray-300"></div>
                                <span class="mx-4 text-gray-500 text-sm">Or continue with</span>
                                <div class="flex-grow border-t border-gray-300"></div>
                            </div>

                            <!-- Alternative Login Options -->
                            <div class="grid grid-cols-2 gap-4">
                                @if(Route::has('register'))
                                    <a href="{{ route('register') }}"
                                       class="flex items-center justify-center gap-2 bg-white border border-gray-300 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-50 transition">
                                        <i class="fas fa-user-plus text-cyan-600"></i>
                                        Register
                                    </a>
                                @endif

                                <a href="{{ route('home') }}"
                                   class="flex items-center justify-center gap-2 bg-white border border-gray-300 text-gray-700 py-3 px-4 rounded-lg hover:bg-gray-50 transition">
                                    <i class="fas fa-home text-cyan-600"></i>
                                    Back Home
                                </a>
                            </div>
                        </form>

                        <!-- Demo Credentials (Optional - remove in production) -->
                        @if(app()->environment('local'))
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <p class="text-sm text-gray-600 mb-2">Demo Credentials:</p>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm"><span class="font-medium">Email:</span> admin@example.com</p>
                                    <p class="text-sm"><span class="font-medium">Password:</span> password</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Card Footer -->
                    <div class="bg-gray-50 px-8 py-6 text-center">
                        <p class="text-gray-600 text-sm">
                            Secure login powered by
                            <span class="font-bold text-cyan-700">{{ config('app.name') }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-12 text-center">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                    <div class="p-6 bg-white/80 backdrop-blur-sm rounded-xl shadow-sm">
                        <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shield-alt text-cyan-600 text-xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">Secure Access</h3>
                        <p class="text-gray-600 text-sm">Protected by advanced encryption</p>
                    </div>

                    <div class="p-6 bg-white/80 backdrop-blur-sm rounded-xl shadow-sm">
                        <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user-md text-cyan-600 text-xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">Professional Portal</h3>
                        <p class="text-gray-600 text-sm">Access medical resources & research</p>
                    </div>

                    <div class="p-6 bg-white/80 backdrop-blur-sm rounded-xl shadow-sm">
                        <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-headset text-cyan-600 text-xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-2">Support</h3>
                        <p class="text-gray-600 text-sm">Need help? Contact our support team</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .gradient-bg {
                background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 50%, #bae6fd 100%);
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in-up {
                animation: fadeInUp 0.6s ease-out forwards;
            }

            .card-shadow {
                box-shadow: 0 20px 60px rgba(6, 182, 212, 0.15);
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Toggle password visibility
            function togglePassword() {
                const passwordInput = document.getElementById('password');
                const toggleIcon = document.getElementById('toggleIcon');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            }

            // Form validation animation
            document.querySelector('form').addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Signing In...';
                submitBtn.disabled = true;
            });

            // Add some subtle animations
            document.addEventListener('DOMContentLoaded', function() {
                const elements = document.querySelectorAll('.p-6, .max-w-md');
                elements.forEach((el, index) => {
                    el.style.animationDelay = `${index * 0.1}s`;
                    el.classList.add('animate-fade-in-up');
                });
            });

            // Handle Enter key press
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && e.target.type !== 'textarea') {
                    e.preventDefault();
                    const submitBtn = document.querySelector('button[type="submit"]');
                    if (submitBtn) submitBtn.click();
                }
            });
        </script>
    @endpush
@endsection

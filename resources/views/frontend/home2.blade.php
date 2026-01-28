{{-- resources/views/frontend/home2.blade.php --}}
@extends('layouts.app')
<?php
$doctor = \App\Models\User::where('role', 'doctor')->first();
$name = $doctor?->getFullNameAttribute();
$designation = $doctor?->designation;
?>

@section('title', $name . $designation)

@section('content')

    {{-- Hero Slider Section --}}
    @if($sliders->count() > 0)
        <section class="relative">
            <!-- Slider Container -->
            <div class="slider-container relative h-[600px] overflow-hidden">
                @foreach($sliders as $slider)
                    <div class="slider-slide absolute inset-0 w-full h-full transition-opacity duration-1000 ease-in-out opacity-0">
                        <!-- Background Image with Overlay -->
                        <div class="absolute inset-0">
                            <img src="{{ $slider->image_url }}"
                                 alt="{{ $slider->title }}"
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/30"></div>
                        </div>

                        <!-- Content -->
                        <div class="relative h-full flex items-center">
                            <div class="container mx-auto px-4">
                                <div class="max-w-3xl">
                                    <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 animate-slide-up">
                                        {{ $slider->title }}
                                    </h1>
                                    @if($slider->description)
                                        <p class="text-xl text-gray-200 mb-8 animate-slide-up delay-300">
                                            {{ $slider->description }}
                                        </p>
                                    @endif
                                    @if($slider->button_text && $slider->button_url)
                                        <div class="animate-slide-up delay-500">
                                            <a href="{{ $slider->button_url }}"
                                               @if($slider->button_new_tab) target="_blank" @endif
                                               class="inline-block bg-cyan-600 hover:bg-cyan-700 text-white px-8 py-4 rounded-lg font-medium text-lg transition-all duration-300 transform hover:scale-105">
                                                {{ $slider->button_text }}
                                                <i class="fas fa-arrow-right ml-2"></i>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Slider Controls -->
            <button class="slider-prev absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white w-12 h-12 rounded-full flex items-center justify-center transition z-10">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="slider-next absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white w-12 h-12 rounded-full flex items-center justify-center transition z-10">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Slider Dots -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex gap-2 z-10">
                @foreach($sliders as $index => $slider)
                    <button class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition {{ $index === 0 ? 'bg-white' : '' }}"
                            data-index="{{ $index }}"></button>
                @endforeach
            </div>
        </section>
    @else
        {{-- Default Hero Section if no sliders --}}
        <section class="relative bg-gradient-to-br from-cyan-900 via-cyan-800 to-cyan-700 py-20">
            <div class="container mx-auto px-4 text-center text-white">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">
                    Welcome to {{ $name }}'s Portal
                </h1>
                <p class="text-xl mb-8 max-w-3xl mx-auto">
                    {{ $designation }} - Dedicated to excellence in pediatric medicine and research
                </p>
                <a href="#contact" class="inline-block bg-white text-cyan-700 px-8 py-4 rounded-lg font-medium text-lg hover:bg-gray-100 transition">
                    Get in Touch <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </section>
    @endif

    {{-- Research & Publications Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Research & Publications</h2>
                <p class="text-gray-600">Peer-reviewed research contributions in pediatric medicine and child health</p>
            </div>

            {{-- Research Articles --}}
            <div class="mb-12">
                <div class="flex items-center mb-6">
                    <i class="fas fa-file-alt text-2xl text-cyan-700 mr-3"></i>
                    <h3 class="text-2xl font-bold text-gray-800">Research Articles</h3>
                </div>

                <div class="space-y-4">
                    @forelse($recentResearch->where('type', 'article') as $index => $paper)
                        <div class="bg-gray-50 p-6 rounded-lg hover:shadow-md transition">
                            <h4 class="font-semibold text-gray-800 mb-2">
                                {{ $index + 1 }}. {{ $paper->title }}
                            </h4>
                            <p class="text-sm text-gray-600 mb-1">Authors: {{ $paper->authors }}</p>
                            <p class="text-sm text-gray-500">
                                {{ $paper->journal }}, {{ $paper->volume_issue }}, {{ $paper->publication_date }}
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">No research articles available.</p>
                    @endforelse
                </div>
            </div>

            {{-- Case Reports --}}
            <div>
                <div class="flex items-center mb-6">
                    <i class="fas fa-notes-medical text-2xl text-cyan-700 mr-3"></i>
                    <h3 class="text-2xl font-bold text-gray-800">Case Reports</h3>
                </div>

                <div class="space-y-4">
                    @forelse($recentResearch->where('type', 'case_report') as $index => $paper)
                        <div class="bg-gray-50 p-6 rounded-lg hover:shadow-md transition">
                            <h4 class="font-semibold text-gray-800 mb-2">
                                {{ $index + 1 }}. {{ $paper->title }}
                            </h4>
                            <p class="text-sm text-gray-600 mb-1">Authors: {{ $paper->authors }}</p>
                            <p class="text-sm text-gray-500">
                                {{ $paper->journal }}, {{ $paper->publication_date }}
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-8">No case reports available.</p>
                    @endforelse
                </div>
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('research.index') }}" class="inline-block bg-cyan-700 text-white px-8 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
                    View All Research
                </a>
            </div>
        </div>
    </section>

    {{-- Education & Research Articles --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Education & Research Article</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($recentArticles as $article)
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition">
                        @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-cyan-100 to-cyan-200 flex items-center justify-center">
                                <i class="fas fa-brain text-6xl text-cyan-700"></i>
                            </div>
                        @endif

                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                @if($article->category)
                                    <span class="bg-cyan-100 text-cyan-700 px-3 py-1 rounded-full text-xs font-medium mr-3">
                            {{ $article->category }}
                        </span>
                                @endif
                                <span><i class="far fa-clock mr-1"></i>{{ $article->read_time }} min read</span>
                            </div>

                            <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $article->title }}</h3>

                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($article->content), 150) }}
                            </p>

                            <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">
                            <i class="far fa-calendar mr-1"></i>{{ $article->created_at->format('F d, Y') }}
                        </span>
                                <a href="{{ route('articles.show', $article) }}" class="text-cyan-700 font-medium hover:text-cyan-800">
                                    Read More <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500">No articles available at the moment.</p>
                    </div>
                @endforelse
            </div>

            @if($recentArticles->count() > 0)
                <div class="text-center mt-8">
                    <a href="{{ route('articles.index') }}" class="inline-block bg-cyan-700 text-white px-8 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
                        View All Articles
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- Gallery Section on Homepage --}}
    @if($featuredGallery && $featuredGallery->count() > 0)
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Gallery</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Highlights from conferences, events, and memorable moments
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    @foreach($featuredGallery->take(8) as $item)
                        @if($item->type === 'image')
                            <div class="group cursor-pointer" onclick="openLightbox('{{ $item->image_url }}', '{{ $item->title }}')">
                                <div class="relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition">
                                    <img src="{{ $item->image_url }}"
                                         alt="{{ $item->title }}"
                                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition">
                                        <div class="absolute bottom-0 p-4 text-white">
                                            <h3 class="font-bold">{{ $item->title }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="relative cursor-pointer" onclick="playVideo('{{ $item->embed_url }}', '{{ $item->title }}')">
                                <img src="{{ $item->thumbnail_url }}"
                                     alt="{{ $item->title }}"
                                     class="w-full h-64 object-cover rounded-lg">
                                <div class="absolute inset-0 flex items-center justify-center bg-black/30 hover:bg-black/40 transition rounded-lg">
                                    <div class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center">
                                        <i class="fas fa-play text-red-600 text-2xl ml-1"></i>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="text-center">
                    <a href="{{ route('gallery.index') }}" class="inline-block bg-cyan-700 text-white px-8 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
                        View Full Gallery <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>

        {{-- Include lightbox and video modal scripts --}}
        <div id="lightbox" class="fixed inset-0 z-50 hidden bg-black/90 flex items-center justify-center p-4" onclick="closeLightbox()">
            <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-4xl">
                <i class="fas fa-times"></i>
            </button>
            <div class="max-w-5xl w-full" onclick="event.stopPropagation()">
                <img id="lightbox-image" src="" alt="" class="w-full rounded-lg">
                <h3 id="lightbox-title" class="text-white text-center text-xl mt-4"></h3>
            </div>
        </div>

        <div id="video-modal" class="fixed inset-0 z-50 hidden bg-black/90 flex items-center justify-center p-4" onclick="closeVideoModal()">
            <button onclick="closeVideoModal()" class="absolute top-4 right-4 text-white text-4xl">
                <i class="fas fa-times"></i>
            </button>
            <div class="max-w-5xl w-full" onclick="event.stopPropagation()">
                <div class="aspect-video bg-black rounded-lg overflow-hidden">
                    <iframe id="video-iframe" src="" frameborder="0" allowfullscreen class="w-full h-full"></iframe>
                </div>
                <h3 id="video-title" class="text-white text-center text-xl mt-4"></h3>
            </div>
        </div>

        @push('styles')
            <style>
                @keyframes slide-up {
                    from {
                        opacity: 0;
                        transform: translateY(30px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .animate-slide-up {
                    animation: slide-up 0.8s ease-out forwards;
                }

                .delay-300 {
                    animation-delay: 0.3s;
                }

                .delay-500 {
                    animation-delay: 0.5s;
                }

                .slider-slide.active {
                    opacity: 1;
                    z-index: 1;
                }

                .slider-slide:not(.active) {
                    pointer-events: none;
                }
            </style>
        @endpush

        @push('scripts')
            <script>
                function openLightbox(imageUrl, title) {
                    document.getElementById('lightbox-image').src = imageUrl;
                    document.getElementById('lightbox-title').textContent = title;
                    document.getElementById('lightbox').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }
                function closeLightbox() {
                    document.getElementById('lightbox').classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }
                function playVideo(embedUrl, title) {
                    document.getElementById('video-iframe').src = embedUrl + '?autoplay=1';
                    document.getElementById('video-title').textContent = title;
                    document.getElementById('video-modal').classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }
                function closeVideoModal() {
                    document.getElementById('video-iframe').src = '';
                    document.getElementById('video-modal').classList.add('hidden');
                    document.body.style.overflow = 'auto';
                }
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') { closeLightbox(); closeVideoModal(); }
                });

                document.addEventListener('DOMContentLoaded', function() {
                    const sliderContainer = document.querySelector('.slider-container');
                    const slides = document.querySelectorAll('.slider-slide');
                    const dots = document.querySelectorAll('.slider-dot');
                    const prevBtn = document.querySelector('.slider-prev');
                    const nextBtn = document.querySelector('.slider-next');

                    let currentSlide = 0;
                    const totalSlides = slides.length;

                    // Initialize first slide
                    if (slides.length > 0) {
                        slides[0].classList.add('active');
                    }

                    // Function to show specific slide
                    function showSlide(index) {
                        // Hide all slides
                        slides.forEach(slide => {
                            slide.classList.remove('active');
                        });

                        // Update active dot
                        dots.forEach(dot => {
                            dot.classList.remove('bg-white');
                            dot.classList.add('bg-white/50');
                        });

                        // Show current slide
                        currentSlide = index;
                        slides[currentSlide].classList.add('active');
                        dots[currentSlide].classList.remove('bg-white/50');
                        dots[currentSlide].classList.add('bg-white');
                    }

                    // Next slide
                    function nextSlide() {
                        let next = currentSlide + 1;
                        if (next >= totalSlides) next = 0;
                        showSlide(next);
                    }

                    // Previous slide
                    function prevSlide() {
                        let prev = currentSlide - 1;
                        if (prev < 0) prev = totalSlides - 1;
                        showSlide(prev);
                    }

                    // Auto slide
                    let slideInterval = setInterval(nextSlide, 5000);

                    // Pause on hover
                    sliderContainer.addEventListener('mouseenter', () => {
                        clearInterval(slideInterval);
                    });

                    sliderContainer.addEventListener('mouseleave', () => {
                        slideInterval = setInterval(nextSlide, 5000);
                    });

                    // Button events
                    prevBtn.addEventListener('click', prevSlide);
                    nextBtn.addEventListener('click', nextSlide);

                    // Dot events
                    dots.forEach(dot => {
                        dot.addEventListener('click', function() {
                            const index = parseInt(this.getAttribute('data-index'));
                            showSlide(index);
                        });
                    });

                    // Keyboard navigation
                    document.addEventListener('keydown', function(e) {
                        if (e.key === 'ArrowLeft') prevSlide();
                        if (e.key === 'ArrowRight') nextSlide();
                    });
                });


            </script>
        @endpush
    @endif
@endsection

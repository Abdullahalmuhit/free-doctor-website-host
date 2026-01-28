{{-- resources/views/frontend/home.blade.php --}}
@extends('layouts.app')

<?php
$doctor = \App\Models\User::where('role', 'doctor')->first();
$name = $doctor?->getFullNameAttribute();
$designation = $doctor?->designation;
?>

@section('title', $name . ' - ' . $designation)

@section('content')

    {{-- Hero Slider Section --}}
    @if($sliders->count() > 0)
        <section class="relative bg-black">
            <div class="slider-container relative h-[500px] md:h-[600px] overflow-hidden">
                @foreach($sliders as $index => $slider)
                    <div class="slider-slide absolute inset-0 w-full h-full transition-all duration-1000 ease-in-out {{ $index === 0 ? 'active' : '' }}">
                        <div class="absolute inset-0">
                            <img src="{{ $slider->image_url }}" alt="{{ $slider->title }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/30"></div>
                        </div>

                        <div class="relative h-full flex items-center">
                            <div class="container mx-auto px-4">
                                <div class="max-w-3xl">
                                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 transform translate-y-8 transition-all duration-700 slide-content">
                                        {{ $slider->title }}
                                    </h1>
                                    @if($slider->description)
                                        <p class="text-xl text-gray-200 mb-8 transform translate-y-8 transition-all duration-700 delay-300 slide-content">
                                            {{ $slider->description }}
                                        </p>
                                    @endif
                                    @if($slider->button_text && $slider->button_url)
                                        <div class="transform translate-y-8 transition-all duration-700 delay-500 slide-content">
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

            <button class="slider-prev absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white w-12 h-12 rounded-full flex items-center justify-center transition z-30">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="slider-next absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white w-12 h-12 rounded-full flex items-center justify-center transition z-30">
                <i class="fas fa-chevron-right"></i>
            </button>

            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-2 z-30">
                @foreach($sliders as $index => $slider)
                    <button class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all {{ $index === 0 ? 'bg-white w-8' : '' }}" data-index="{{ $index }}"></button>
                @endforeach
            </div>
        </section>
    @else
        <section class="relative bg-gradient-to-br from-cyan-900 via-cyan-800 to-cyan-700 py-20 text-center text-white">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">Welcome to {{ $name }}'s Portal</h1>
            <p class="text-xl mb-8 max-w-3xl mx-auto">{{ $designation }}</p>
            <a href="#contact" class="inline-block bg-white text-cyan-700 px-8 py-4 rounded-lg font-medium hover:bg-gray-100 transition">Get in Touch</a>
        </section>
    @endif

    {{-- Research Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Research & Publications</h2>
                <p class="text-gray-600">Peer-reviewed research contributions in pediatric medicine</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                {{-- Research Articles --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-file-alt text-cyan-700 mr-3"></i> Research Articles
                    </h3>
                    <div class="space-y-4">
                        @forelse($recentResearch->where('type', 'article') as $index => $paper)
                            <div class="bg-gray-50 p-6 rounded-lg hover:shadow-md transition">
                                <h4 class="font-semibold text-gray-800">{{ $index + 1 }}. {{ $paper->title }}</h4>
                                <p class="text-sm text-gray-600 mt-2">Authors: {{ $paper->authors }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $paper->journal }}, {{ $paper->volume_issue }}, {{ $paper->publication_date }}</p>
                            </div>
                        @empty
                            <p class="text-gray-500 italic">No research articles available.</p>
                        @endforelse
                    </div>
                </div>

                {{-- Case Reports --}}
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-notes-medical text-cyan-700 mr-3"></i> Case Reports
                    </h3>
                    <div class="space-y-4">
                        @forelse($recentResearch->where('type', 'case_report') as $index => $paper)
                            <div class="bg-gray-50 p-6 rounded-lg hover:shadow-md transition">
                                <h4 class="font-semibold text-gray-800">{{ $index + 1 }}. {{ $paper->title }}</h4>
                                <p class="text-sm text-gray-600 mt-2">Authors: {{ $paper->authors }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $paper->journal }}, {{ $paper->publication_date }}</p>
                            </div>
                        @empty
                            <p class="text-gray-500 italic">No case reports available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('research.index') }}" class="bg-cyan-700 text-white px-8 py-3 rounded-lg hover:bg-cyan-800 transition">View All Research</a>
            </div>
        </div>
    </section>

    {{-- Education & Articles --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-gray-800 mb-12 text-center">Education & Research Article</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($recentArticles as $article)
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition flex flex-col">
                        <div class="h-48 overflow-hidden bg-cyan-100 flex items-center justify-center">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                            @else
                                <i class="fas fa-brain text-6xl text-cyan-700"></i>
                            @endif
                        </div>
                        <div class="p-6 flex-grow">
                            <div class="flex items-center text-xs text-gray-500 mb-3">
                                @if($article->category)
                                    <span class="bg-cyan-100 text-cyan-700 px-3 py-1 rounded-full font-medium mr-3">{{ $article->category }}</span>
                                @endif
                                <span><i class="far fa-clock mr-1"></i>{{ $article->read_time }} min read</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $article->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit(strip_tags($article->content), 150) }}</p>
                        </div>
                        <div class="p-6 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-xs text-gray-500"><i class="far fa-calendar mr-1"></i>{{ $article->created_at->format('M d, Y') }}</span>
                            <a href="{{ route('articles.show', $article) }}" class="text-cyan-700 font-medium hover:text-cyan-800">Read More <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-gray-500">No articles available.</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Gallery Section --}}
    @if($featuredGallery && $featuredGallery->count() > 0)
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Gallery</h2>
                    <p class="text-gray-600">Moments from conferences and research events</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    @foreach($featuredGallery->take(8) as $item)
                        <div class="relative group cursor-pointer overflow-hidden rounded-lg h-64 shadow-md"
                             onclick="{{ $item->type === 'image' ? "openLightbox('$item->image_url', '$item->title')" : "playVideo('$item->embed_url', '$item->title')" }}">
                            <img src="{{ $item->type === 'image' ? $item->image_url : $item->thumbnail_url }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <div class="text-center p-4">
                                    <i class="fas {{ $item->type === 'image' ? 'fa-search-plus' : 'fa-play' }} text-white text-3xl mb-2"></i>
                                    <p class="text-white font-bold text-sm">{{ $item->title }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center">
                    <a href="{{ route('gallery.index') }}" class="inline-block bg-cyan-700 text-white px-8 py-3 rounded-lg hover:bg-cyan-800 transition">View Full Gallery <i class="fas fa-arrow-right ml-2"></i></a>
                </div>
            </div>
        </section>
    @endif

    {{-- Modals --}}
    <div id="lightbox" class="fixed inset-0 z-[100] hidden bg-black/90 flex items-center justify-center p-4" onclick="closeLightbox()">
        <button class="absolute top-5 right-5 text-white text-4xl">&times;</button>
        <div class="max-w-5xl w-full" onclick="event.stopPropagation()">
            <img id="lightbox-image" src="" class="w-full rounded-lg shadow-2xl">
            <h3 id="lightbox-title" class="text-white text-center mt-4 text-xl"></h3>
        </div>
    </div>

    <div id="video-modal" class="fixed inset-0 z-[100] hidden bg-black/90 flex items-center justify-center p-4" onclick="closeVideoModal()">
        <button class="absolute top-5 right-5 text-white text-4xl">&times;</button>
        <div class="max-w-4xl w-full aspect-video" onclick="event.stopPropagation()">
            <iframe id="video-iframe" src="" class="w-full h-full rounded-lg" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        .slider-slide { opacity: 0 !important; visibility: hidden; z-index: 0; pointer-events: none; transition: all 1s ease-in-out; }
        .slider-slide.active { opacity: 1 !important; visibility: visible; z-index: 10; pointer-events: auto; }
        .slider-slide.active .slide-content { transform: translateY(0); opacity: 1; }
        .slide-content { opacity: 0; }
    </style>
@endpush

@push('scripts')
    <script>
        function openLightbox(src, title) {
            document.getElementById('lightbox-image').src = src;
            document.getElementById('lightbox-title').innerText = title;
            document.getElementById('lightbox').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function closeLightbox() {
            document.getElementById('lightbox').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        function playVideo(url, title) {
            document.getElementById('video-iframe').src = url + "?autoplay=1";
            document.getElementById('video-modal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function closeVideoModal() {
            document.getElementById('video-modal').classList.add('hidden');
            document.getElementById('video-iframe').src = "";
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slider-slide');
            const dots = document.querySelectorAll('.slider-dot');
            const nextBtn = document.querySelector('.slider-next');
            const prevBtn = document.querySelector('.slider-prev');
            let current = 0;
            let slideInterval;

            function showSlide(index) {
                slides.forEach(s => s.classList.remove('active'));
                dots.forEach(d => {
                    d.classList.remove('bg-white', 'w-8');
                    d.classList.add('bg-white/50');
                });

                current = (index + slides.length) % slides.length;
                slides[current].classList.add('active');
                dots[current].classList.add('bg-white', 'w-8');
                dots[current].classList.remove('bg-white/50');
            }

            function startAutoSlide() {
                clearInterval(slideInterval);
                slideInterval = setInterval(() => showSlide(current + 1), 5000);
            }

            if(slides.length > 0) {
                nextBtn.addEventListener('click', () => { showSlide(current + 1); startAutoSlide(); });
                prevBtn.addEventListener('click', () => { showSlide(current - 1); startAutoSlide(); });
                dots.forEach((dot, i) => {
                    dot.addEventListener('click', () => { showSlide(i); startAutoSlide(); });
                });
                startAutoSlide();
            }
        });
    </script>
@endpush

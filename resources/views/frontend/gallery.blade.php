{{-- resources/views/frontend/gallery.blade.php --}}
@extends('layouts.app')

@section('title', 'Gallery - Prof. Dr. Aftab Haleem')

@section('content')
    {{-- Header --}}
    <section class="py-16 bg-gradient-to-br from-gray-50 to-cyan-50">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Gallery</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Explore our journey through conferences, clinics, awards, and memorable moments
            </p>
        </div>
    </section>

    {{-- Category Filter --}}
    <section class="py-8 bg-white border-b">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ route('gallery.index') }}"
                   class="px-6 py-2 rounded-full bg-cyan-700 text-white hover:bg-cyan-800 transition">
                    All
                </a>
                @foreach($categories as $cat => $label)
                    <a href="{{ route('gallery.category', $cat) }}"
                       class="px-6 py-2 rounded-full bg-white border-2 border-gray-300 text-gray-700 hover:border-cyan-700 hover:text-cyan-700 transition">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Images Section --}}
    @if($images->count() > 0)
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex items-center mb-8">
                    <i class="fas fa-images text-3xl text-cyan-700 mr-4"></i>
                    <h2 class="text-3xl font-bold text-gray-800">Photos</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($images as $image)
                        <div class="group cursor-pointer" onclick="openLightbox('{{ $image->image_url }}', '{{ $image->title }}')">
                            <div class="relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                                <img src="{{ $image->image_url }}"
                                     alt="{{ $image->title }}"
                                     class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                        <h3 class="font-bold mb-1">{{ $image->title }}</h3>
                                        @if($image->description)
                                            <p class="text-sm text-gray-200">{{ Str::limit($image->description, 50) }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="absolute top-4 right-4 bg-cyan-600 text-white px-3 py-1 rounded-full text-xs font-medium">
                                    {{ ucfirst($image->category) }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($images->hasPages())
                    <div class="mt-8">
                        {{ $images->links() }}
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- Videos Section --}}
    @if($videos->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="flex items-center mb-8">
                    <i class="fas fa-video text-3xl text-purple-600 mr-4"></i>
                    <h2 class="text-3xl font-bold text-gray-800">Videos</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($videos as $video)
                        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition">
                            <div class="relative" onclick="playVideo('{{ $video->embed_url }}', '{{ $video->title }}')">
                                <img src="{{ $video->thumbnail_url }}"
                                     alt="{{ $video->title }}"
                                     class="w-full h-48 object-cover cursor-pointer">
                                <div class="absolute inset-0 flex items-center justify-center bg-black/30 hover:bg-black/40 transition cursor-pointer">
                                    <div class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center hover:bg-white transition">
                                        <i class="fas fa-play text-red-600 text-2xl ml-1"></i>
                                    </div>
                                </div>
                                <div class="absolute top-4 right-4 bg-purple-600 text-white px-3 py-1 rounded-full text-xs font-medium">
                                    {{ ucfirst($video->category) }}
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-gray-800 mb-2">{{ $video->title }}</h3>
                                @if($video->description)
                                    <p class="text-sm text-gray-600">{{ Str::limit($video->description, 100) }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($videos->hasPages())
                    <div class="mt-8">
                        {{ $videos->links() }}
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- Image Lightbox Modal --}}
    <div id="lightbox" class="fixed inset-0 z-50 hidden bg-black/90 flex items-center justify-center p-4" onclick="closeLightbox()">
        <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300 transition">
            <i class="fas fa-times"></i>
        </button>
        <div class="max-w-5xl w-full" onclick="event.stopPropagation()">
            <img id="lightbox-image" src="" alt="" class="w-full h-auto rounded-lg shadow-2xl">
            <h3 id="lightbox-title" class="text-white text-center text-xl font-bold mt-4"></h3>
        </div>
    </div>

    {{-- Video Modal --}}
    <div id="video-modal" class="fixed inset-0 z-50 hidden bg-black/90 flex items-center justify-center p-4" onclick="closeVideoModal()">
        <button onclick="closeVideoModal()" class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300 transition">
            <i class="fas fa-times"></i>
        </button>
        <div class="max-w-5xl w-full" onclick="event.stopPropagation()">
            <div class="aspect-video bg-black rounded-lg overflow-hidden">
                <iframe id="video-iframe" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full h-full"></iframe>
            </div>
            <h3 id="video-title" class="text-white text-center text-xl font-bold mt-4"></h3>
        </div>
    </div>

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

        // Close modals on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
                closeVideoModal();
            }
        });
    </script>
@endsection

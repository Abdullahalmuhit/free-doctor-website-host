@extends('layouts.app')

@section('title', $categoryName . ' - Gallery - Prof. Dr. Aftab Haleem')

@section('content')
    {{-- Header --}}
    <section class="py-16 bg-gradient-to-br from-gray-50 to-cyan-50">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $categoryName }}</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Browse through our {{ strtolower($categoryName) }} collection
            </p>
        </div>
    </section>

    {{-- Category Filter --}}
    <section class="py-8 bg-white border-b">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ route('gallery.index') }}"
                   class="px-6 py-2 rounded-full bg-gray-100 text-gray-700 hover:bg-cyan-700 hover:text-white transition">
                    All
                </a>
                @foreach($categories as $cat => $label)
                    <a href="{{ route('gallery.category', $cat) }}"
                       class="px-6 py-2 rounded-full {{ $cat === $category ? 'bg-cyan-700 text-white' : 'bg-white border-2 border-gray-300 text-gray-700 hover:border-cyan-700 hover:text-cyan-700' }} transition">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Items Grid --}}
    @if($items->count() > 0)
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="mb-8 flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ $items->total() }} {{ $categoryName }} Item{{ $items->total() > 1 ? 's' : '' }}
                    </h2>
                    <div class="text-sm text-gray-600">
                        Showing {{ $items->firstItem() }}-{{ $items->lastItem() }} of {{ $items->total() }}
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($items as $item)
                        <div class="group cursor-pointer" onclick="{{ $item->type === 'image' ? "openLightbox('{$item->image_url}', '{$item->title}')" : "playVideo('{$item->embed_url}', '{$item->title}')" }}">
                            <div class="relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                                @if($item->type === 'image')
                                    <img src="{{ $item->image_url }}"
                                         alt="{{ $item->title }}"
                                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <img src="{{ $item->thumbnail_url }}"
                                         alt="{{ $item->title }}"
                                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/30">
                                        <div class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center">
                                            <i class="fas fa-play text-red-600 text-2xl ml-1"></i>
                                        </div>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                        <h3 class="font-bold mb-1">{{ $item->title }}</h3>
                                        @if($item->description)
                                            <p class="text-sm text-gray-200">{{ Str::limit($item->description, 50) }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="absolute top-4 right-4 {{ $item->type === 'image' ? 'bg-cyan-600' : 'bg-purple-600' }} text-white px-3 py-1 rounded-full text-xs font-medium flex items-center gap-1">
                                    @if($item->type === 'image')
                                        <i class="fas fa-image"></i>
                                    @else
                                        <i class="fas fa-video"></i>
                                    @endif
                                    <span>{{ ucfirst($item->type) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($items->hasPages())
                    <div class="mt-8">
                        {{ $items->links() }}
                    </div>
                @endif
            </div>
        </section>
    @else
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4 text-center">
                <div class="max-w-md mx-auto">
                    <i class="fas fa-images text-5xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-medium text-gray-700 mb-2">No {{ strtolower($categoryName) }} items yet</h3>
                    <p class="text-gray-500 mb-6">Check back later or browse other categories.</p>
                    <a href="{{ route('gallery.index') }}" class="bg-cyan-700 text-white px-6 py-3 rounded-lg hover:bg-cyan-800 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Back to All Gallery
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- Include the same modals as in gallery.blade.php --}}
    <div id="lightbox" class="fixed inset-0 z-50 hidden bg-black/90 flex items-center justify-center p-4" onclick="closeLightbox()">
        <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300 transition">
            <i class="fas fa-times"></i>
        </button>
        <div class="max-w-5xl w-full" onclick="event.stopPropagation()">
            <img id="lightbox-image" src="" alt="" class="w-full h-auto rounded-lg shadow-2xl">
            <h3 id="lightbox-title" class="text-white text-center text-xl font-bold mt-4"></h3>
        </div>
    </div>

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

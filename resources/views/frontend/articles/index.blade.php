{{-- resources/views/frontend/articles/index.blade.php --}}
@extends('layouts.app')
<?php
$doctor = \App\Models\User::where('role', 'doctor')->first();
$name = $doctor?->getFullNameAttribute();
$designation = $doctor?->designation;
?>
@section('title', 'Articles - ' . $name . $designation)

@section('content')
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Articles</h1>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Expert insights on neurological conditions, treatment options, and maintaining optimal brain health
                </p>
            </div>

            {{-- Category Filter --}}
            @if($categories->count() > 0)
                <div class="flex flex-wrap justify-center gap-3 mb-12">
                    <a href="{{ route('articles.index') }}"
                       class="px-6 py-2 rounded-full {{ !request('category') ? 'bg-cyan-700 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }} transition">
                        All Articles
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('articles.category', $cat) }}"
                           class="px-6 py-2 rounded-full {{ request()->segment(3) == $cat ? 'bg-cyan-700 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }} transition">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            @endif

            {{-- Articles Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles as $article)
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

                            <h2 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">{{ $article->title }}</h2>

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
                        <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg">No articles found.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($articles->hasPages())
                <div class="mt-12">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection

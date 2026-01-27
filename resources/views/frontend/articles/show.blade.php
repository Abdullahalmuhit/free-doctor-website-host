{{-- resources/views/frontend/articles/show.blade.php --}}
@extends('layouts.app')
<?php
$doctor = \App\Models\User::where('role', 'doctor')->first();
$name = $doctor?->getFullNameAttribute();
$designation = $doctor?->designation;
?>
@section('title', $article->title . ' - ' . $name . $designation)

@section('content')
    <article class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                {{-- Breadcrumb --}}
                <nav class="mb-8 text-sm">
                    <a href="{{ route('home') }}" class="text-cyan-700 hover:text-cyan-800">Home</a>
                    <span class="mx-2 text-gray-400">/</span>
                    <a href="{{ route('articles.index') }}" class="text-cyan-700 hover:text-cyan-800">Articles</a>
                    <span class="mx-2 text-gray-400">/</span>
                    <span class="text-gray-600">{{ $article->title }}</span>
                </nav>

                {{-- Article Header --}}
                <header class="mb-8">
                    @if($article->category)
                        <span class="inline-block bg-cyan-100 text-cyan-700 px-4 py-1 rounded-full text-sm font-medium mb-4">
                    {{ $article->category }}
                </span>
                    @endif

                    <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $article->title }}</h1>

                    <div class="flex items-center text-gray-600 text-sm">
                    <span class="mr-4">
                        <i class="far fa-calendar mr-2"></i>{{ $article->created_at->format('F d, Y') }}
                    </span>
                        <span>
                        <i class="far fa-clock mr-2"></i>{{ $article->read_time }} min read
                    </span>
                    </div>
                </header>

                {{-- Featured Image --}}
                @if($article->image)
                    <div class="mb-8 rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-96 object-cover">
                    </div>
                @endif

                {{-- Article Content --}}
                <div class="prose prose-lg max-w-none mb-12">
                    {!! $article->content !!}
                </div>

                {{-- Share Buttons --}}
                <div class="border-t border-gray-200 pt-8 mb-12">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Share this article</h3>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center hover:bg-sky-600 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-700 text-white rounded-full flex items-center justify-center hover:bg-blue-800 transition">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                {{-- Related Articles --}}
                @if($relatedArticles->count() > 0)
                    <div class="border-t border-gray-200 pt-12">
                        <h3 class="text-2xl font-bold text-gray-800 mb-8">Related Articles</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($relatedArticles as $related)
                                <div class="bg-gray-50 rounded-lg overflow-hidden hover:shadow-md transition">
                                    @if($related->image)
                                        <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}" class="w-full h-40 object-cover">
                                    @else
                                        <div class="w-full h-40 bg-gradient-to-br from-cyan-100 to-cyan-200 flex items-center justify-center">
                                            <i class="fas fa-brain text-4xl text-cyan-700"></i>
                                        </div>
                                    @endif

                                    <div class="p-4">
                                        <h4 class="font-bold text-gray-800 mb-2 line-clamp-2">{{ $related->title }}</h4>
                                        <a href="{{ route('articles.show', $related) }}" class="text-cyan-700 text-sm font-medium hover:text-cyan-800">
                                            Read More <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </article>
@endsection

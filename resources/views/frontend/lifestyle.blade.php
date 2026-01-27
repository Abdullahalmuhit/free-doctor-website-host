{{-- resources/views/frontend/lifestyle.blade.php --}}
@extends('layouts.app')
<?php
$doctor = \App\Models\User::where('role', 'doctor')->first();
$name = $doctor?->getFullNameAttribute();
$designation = $doctor?->designation;
?>
@section('title', 'Lifestyle -' . $name . $designation)

@section('content')
    {{-- Brain-Healthy Nutrition Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <i class="fas fa-apple-alt text-5xl text-orange-500 mb-4"></i>
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Brain-Healthy Nutrition</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    What you eat directly impacts your brain health. Follow these dietary guidelines for optimal cognitive function.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($nutritionItems as $item)
                    <div class="bg-gray-50 rounded-lg p-8 hover:shadow-lg transition">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="{{ $item->icon ?? 'fas fa-leaf' }} text-orange-500 text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $item->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ $item->description }}</p>
                                @if($item->points && count($item->points) > 0)
                                    <ul class="space-y-2">
                                        @foreach($item->points as $point)
                                            <li class="text-gray-600 flex items-start">
                                                <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                                <span>{{ $point }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Exercise for Neurological Health Section --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <i class="fas fa-dumbbell text-5xl text-cyan-700 mb-4"></i>
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Exercise for Neurological Health</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    Regular physical activity is one of the most effective ways to protect your brain and enhance cognitive function.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($exerciseItems as $item)
                    <div class="bg-white rounded-lg p-8 hover:shadow-lg transition">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="{{ $item->icon ?? 'fas fa-running' }} text-cyan-700 text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $item->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ $item->description }}</p>
                                @if($item->points && count($item->points) > 0)
                                    <ul class="space-y-2">
                                        @foreach($item->points as $point)
                                            <li class="text-gray-600 flex items-start">
                                                <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                                <span>{{ $point }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Essential Lifestyle Habits Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Essential Lifestyle Habits</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    Beyond diet and exercise, these daily habits play a crucial role in maintaining neurological wellness.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($habitItems as $item)
                    <div class="bg-gray-50 rounded-lg p-8 hover:shadow-lg transition">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="{{ $item->icon ?? 'fas fa-moon' }} text-purple-600 text-2xl"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $item->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ $item->description }}</p>
                                @if($item->points && count($item->points) > 0)
                                    <ul class="space-y-2">
                                        @foreach($item->points as $point)
                                            <li class="text-gray-600 flex items-start">
                                                <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                                                <span>{{ $point }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Healthy Lifestyle Articles Section --}}
    @if($lifestyleArticles->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">Healthy Lifestyle Article</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($lifestyleArticles as $article)
                        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                                    <i class="fas fa-heartbeat text-6xl text-green-700"></i>
                                </div>
                            @endif

                            <div class="p-6">
                                <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium mr-3">
                            Healthy Lifestyle
                        </span>
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
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

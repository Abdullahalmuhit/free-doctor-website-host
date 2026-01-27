{{-- resources/views/frontend/research.blade.php --}}

@extends('layouts.app')
<?php
$doctor = \App\Models\User::where('role', 'doctor')->first();
$name = $doctor?->getFullNameAttribute();
$designation = $doctor?->designation;
?>
@section('title', 'Research & Publications - ' . $name . $designation)

@section('content')
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Research & Publications</h1>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    Peer-reviewed research contributions in pediatric medicine and child health
                </p>
            </div>

            {{-- Research Articles --}}
            <div class="mb-16">
                <div class="flex items-center mb-8">
                    <i class="fas fa-file-alt text-3xl text-cyan-700 mr-4"></i>
                    <h2 class="text-3xl font-bold text-gray-800">Research Articles</h2>
                </div>

                <div class="space-y-6">
                    @forelse($articles as $index => $paper)
                        <div class="bg-gray-50 p-6 rounded-lg hover:shadow-md transition">
                            <h3 class="font-semibold text-gray-800 mb-3 text-lg">
                                {{ $index + 1 }}. {{ $paper->title }}
                            </h3>
                            <p class="text-sm text-gray-600 mb-2">
                                <i class="fas fa-users mr-2"></i><strong>Authors:</strong> {{ $paper->authors }}
                            </p>
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-book mr-2"></i>{{ $paper->journal }}
                                @if($paper->volume_issue), {{ $paper->volume_issue }}@endif, {{ $paper->publication_date }}
                            </p>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <i class="fas fa-file-alt text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 text-lg">No research articles available.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Case Reports --}}
            <div>
                <div class="flex items-center mb-8">
                    <i class="fas fa-notes-medical text-3xl text-cyan-700 mr-4"></i>
                    <h2 class="text-3xl font-bold text-gray-800">Case Reports</h2>
                </div>

                <div class="space-y-6">
                    @forelse($caseReports as $index => $paper)
                        <div class="bg-gray-50 p-6 rounded-lg hover:shadow-md transition">
                            <h3 class="font-semibold text-gray-800 mb-3 text-lg">
                                {{ $index + 1 }}. {{ $paper->title }}
                            </h3>
                            <p class="text-sm text-gray-600 mb-2">
                                <i class="fas fa-users mr-2"></i><strong>Authors:</strong> {{ $paper->authors }}
                            </p>
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-book mr-2"></i>{{ $paper->journal }}
                                @if($paper->volume_issue), {{ $paper->volume_issue }}@endif
                                @if($paper->publication_date), {{ $paper->publication_date }}@endif
                            </p>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <i class="fas fa-notes-medical text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 text-lg">No case reports available.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection

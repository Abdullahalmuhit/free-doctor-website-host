{{-- resources/views/admin/settings/index.blade.php --}}
@extends('layouts.admin')

@section('page-title', 'Site Settings')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white rounded-lg shadow p-8">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf

                {{-- General Settings --}}
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">General Settings</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Site Name</label>
                            <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name']) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                   placeholder="Dr. Aftab Haleem">
                            @error('site_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Site Email</label>
                            <input type="email" name="site_email" value="{{ old('site_email', $settings['site_email']) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                   placeholder="info@drhaleem.com">
                            @error('site_email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Site Phone</label>
                            <input type="text" name="site_phone" value="{{ old('site_phone', $settings['site_phone']) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                   placeholder="10647">
                            @error('site_phone')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Site Address</label>
                            <input type="text" name="site_address" value="{{ old('site_address', $settings['site_address']) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                   placeholder="Dhaka, Bangladesh">
                            @error('site_address')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Fee Settings --}}
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Fee Settings</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Consultation Fee (BDT)</label>
                            <input type="text" name="consultation_fee" value="{{ old('consultation_fee', $settings['consultation_fee']) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                   placeholder="1500">
                            @error('consultation_fee')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Follow-up Fee (BDT)</label>
                            <input type="text" name="follow_up_fee" value="{{ old('follow_up_fee', $settings['follow_up_fee']) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                   placeholder="1000">
                            @error('follow_up_fee')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Social Media --}}
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Social Media Links</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">
                                <i class="fab fa-facebook text-blue-600 mr-2"></i>Facebook URL
                            </label>
                            <input type="url" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url']) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                   placeholder="https://facebook.com/...">
                            @error('facebook_url')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">
                                <i class="fab fa-linkedin text-blue-700 mr-2"></i>LinkedIn URL
                            </label>
                            <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $settings['linkedin_url']) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                   placeholder="https://linkedin.com/in/...">
                            @error('linkedin_url')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">
                                <i class="fab fa-twitter text-sky-500 mr-2"></i>Twitter URL
                            </label>
                            <input type="url" name="twitter_url" value="{{ old('twitter_url', $settings['twitter_url']) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                   placeholder="https://twitter.com/...">
                            @error('twitter_url')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">
                                <i class="fab fa-instagram text-pink-600 mr-2"></i>Instagram URL
                            </label>
                            <input type="url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url']) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                   placeholder="https://instagram.com/...">
                            @error('instagram_url')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">
                                <i class="fab fa-youtube text-red-600 mr-2"></i>YouTube URL
                            </label>
                            <input type="url" name="youtube_url" value="{{ old('youtube_url', $settings['youtube_url']) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                   placeholder="https://youtube.com/...">
                            @error('youtube_url')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- SEO Settings --}}
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">SEO Settings</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Meta Description</label>
                            <textarea name="meta_description" rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                      placeholder="Brief description for search engines">{{ old('meta_description', $settings['meta_description']) }}</textarea>
                            @error('meta_description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Meta Keywords</label>
                            <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $settings['meta_keywords']) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                   placeholder="neurologist, brain health, stroke care">
                            @error('meta_keywords')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- About Content --}}
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">About Content</h3>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">About Text</label>
                        <textarea name="about_content" rows="6"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                  placeholder="About the doctor...">{{ old('about_content', $settings['about_content']) }}</textarea>
                        @error('about_content')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-cyan-700 text-white px-8 py-3 rounded-lg font-medium hover:bg-cyan-800 transition">
                        <i class="fas fa-save mr-2"></i>Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

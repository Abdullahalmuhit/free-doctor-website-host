<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $table = 'gallery';

    protected $fillable = [
        'title',
        'description',
        'type',
        'category',
        'file_path',
        'video_url',
        'thumbnail',
        'order',
        'is_featured',
        'is_active'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active items
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for featured items
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('is_active', true);
    }

    /**
     * Scope for images only
     */
    public function scopeImages($query)
    {
        return $query->where('type', 'image');
    }

    /**
     * Scope for videos only
     */
    public function scopeVideos($query)
    {
        return $query->where('type', 'video');
    }

    /**
     * Scope by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get image URL
     */
    public function getImageUrlAttribute()
    {
        if ($this->type === 'image' && $this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return null;
    }

    /**
     * Get thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }

        // For YouTube videos, extract video ID and get thumbnail
        if ($this->type === 'video' && $this->video_url) {
            $videoId = $this->extractYouTubeVideoId();
            if ($videoId) {
                return "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
            }
        }

        return asset('images/video-placeholder.png');
    }

    /**
     * Extract YouTube video ID from URL
     */
    public function extractYouTubeVideoId()
    {
        if (!$this->video_url) {
            return null;
        }

        // Handle different YouTube URL formats
        $patterns = [
            '/youtube\.com\/watch\?v=([^\&\?\/]+)/',
            '/youtube\.com\/embed\/([^\&\?\/]+)/',
            '/youtu\.be\/([^\&\?\/]+)/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $this->video_url, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }

    /**
     * Get embeddable video URL
     */
    public function getEmbedUrlAttribute()
    {
        if ($this->type !== 'video' || !$this->video_url) {
            return null;
        }

        $videoId = $this->extractYouTubeVideoId();
        if ($videoId) {
            return "https://www.youtube.com/embed/{$videoId}";
        }

        // If it's a Vimeo URL
        if (preg_match('/vimeo\.com\/(\d+)/', $this->video_url, $matches)) {
            return "https://player.vimeo.com/video/{$matches[1]}";
        }

        return $this->video_url;
    }

    /**
     * Check if it's a YouTube video
     */
    public function isYouTubeVideo()
    {
        return $this->type === 'video' && strpos($this->video_url, 'youtube.com') !== false || strpos($this->video_url, 'youtu.be') !== false;
    }

    /**
     * Check if it's a Vimeo video
     */
    public function isVimeoVideo()
    {
        return $this->type === 'video' && strpos($this->video_url, 'vimeo.com') !== false;
    }

    /**
     * Delete associated files when model is deleted
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($item) {
            // Delete image file
            if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }

            // Delete thumbnail
            if ($item->thumbnail && Storage::disk('public')->exists($item->thumbnail)) {
                Storage::disk('public')->delete($item->thumbnail);
            }
        });
    }
}

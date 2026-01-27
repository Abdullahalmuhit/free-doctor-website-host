<?php
namespace App\Http\Controllers;

use App\Models\GalleryItem;

class GalleryController extends Controller
{
    public function index()
    {
        $images = GalleryItem::active()
            ->images()
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $videos = GalleryItem::active()
            ->videos()
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $categories = [
            'conference' => 'Conferences & Seminars',
            'clinic' => 'Clinic & Practice',
            'awards' => 'Awards & Recognition',
            'events' => 'Events & Activities',
            'other' => 'Other'
        ];

        return view('frontend.gallery', compact('images', 'videos', 'categories'));
    }

    public function category($category)
    {
        $items = GalleryItem::active()
            ->byCategory($category)
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categories = [
            'conference' => 'Conferences & Seminars',
            'clinic' => 'Clinic & Practice',
            'awards' => 'Awards & Recognition',
            'events' => 'Events & Activities',
            'other' => 'Other'
        ];

        $categoryName = $categories[$category] ?? ucfirst($category);

        return view('frontend.gallery-category', compact('items', 'category', 'categoryName', 'categories'));
    }
}

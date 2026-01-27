<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    public function index()
    {
        $items = GalleryItem::latest()->paginate(20);
        return view('admin.gallery.index', compact('items'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:image,video',
            'category' => 'required|in:conference,clinic,awards,events,other',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];

        if ($request->type === 'image') {
            $rules['file'] = 'required|image|mimes:jpeg,jpg,png,gif|max:5120'; // 5MB
        } else {
            $rules['video_url'] = 'required|url';
            $rules['thumbnail'] = 'nullable|image|mimes:jpeg,jpg,png|max:2048';
        }

        $validated = $request->validate($rules);

        // Handle image upload
        if ($request->type === 'image' && $request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('gallery', 'public');
        }

        // Handle video thumbnail upload
        if ($request->type === 'video' && $request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('gallery/thumbnails', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        GalleryItem::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery item added successfully.');
    }

    public function edit(GalleryItem $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, GalleryItem $gallery)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:image,video',
            'category' => 'required|in:conference,clinic,awards,events,other',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];

        if ($request->type === 'image') {
            $rules['file'] = 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120';
        } else {
            $rules['video_url'] = 'required|url';
            $rules['thumbnail'] = 'nullable|image|mimes:jpeg,jpg,png|max:2048';
        }

        $validated = $request->validate($rules);

        // Handle new image upload
        if ($request->type === 'image' && $request->hasFile('file')) {
            // Delete old file
            if ($gallery->file_path && Storage::disk('public')->exists($gallery->file_path)) {
                Storage::disk('public')->delete($gallery->file_path);
            }
            $validated['file_path'] = $request->file('file')->store('gallery', 'public');
        }

        // Handle new thumbnail upload
        if ($request->type === 'video' && $request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($gallery->thumbnail && Storage::disk('public')->exists($gallery->thumbnail)) {
                Storage::disk('public')->delete($gallery->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('gallery/thumbnails', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(GalleryItem $gallery)
    {
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery item deleted successfully.');
    }

    public function toggleFeatured(GalleryItem $gallery)
    {
        $gallery->update(['is_featured' => !$gallery->is_featured]);

        return back()->with('success', 'Featured status updated.');
    }
}

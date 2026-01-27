<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LifestyleItem;
use Illuminate\Http\Request;

class AdminLifestyleController extends Controller
{
    public function index()
    {
        $items = LifestyleItem::orderBy('category')->orderBy('order')->get();
        return view('admin.lifestyle.index', compact('items'));
    }

    public function create()
    {
        return view('admin.lifestyle.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:nutrition,exercise,habits',
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'description' => 'required|string',
            'points' => 'nullable|array',
            'points.*' => 'string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        LifestyleItem::create($validated);

        return redirect()->route('admin.lifestyle.index')
            ->with('success', 'Lifestyle item added successfully.');
    }

    public function edit(LifestyleItem $lifestyle)
    {
        return view('admin.lifestyle.edit', compact('lifestyle'));
    }

    public function update(Request $request, LifestyleItem $lifestyle)
    {
        $validated = $request->validate([
            'category' => 'required|in:nutrition,exercise,habits',
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'description' => 'required|string',
            'points' => 'nullable|array',
            'points.*' => 'string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $lifestyle->update($validated);

        return redirect()->route('admin.lifestyle.index')
            ->with('success', 'Lifestyle item updated successfully.');
    }

    public function destroy(LifestyleItem $lifestyle)
    {
        $lifestyle->delete();

        return redirect()->route('admin.lifestyle.index')
            ->with('success', 'Lifestyle item deleted successfully.');
    }
}

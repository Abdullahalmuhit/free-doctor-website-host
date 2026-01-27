<?php
// app/Http/Controllers/Admin/AdminSliderController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->latest()->paginate(20);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:5120',
            'button_text' => 'nullable|string|max:50',
            'button_url' => 'nullable|url',
            'button_new_tab' => 'boolean',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }

        $validated['button_new_tab'] = $request->has('button_new_tab');
        $validated['is_active'] = $request->has('is_active');

        Slider::create($validated);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider added successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:5120',
            'button_text' => 'nullable|string|max:50',
            'button_url' => 'nullable|url',
            'button_new_tab' => 'boolean',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old file
            if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }

        $validated['button_new_tab'] = $request->has('button_new_tab');
        $validated['is_active'] = $request->has('is_active');

        $slider->update($validated);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider deleted successfully.');
    }

    public function toggleActive(Slider $slider)
    {
        $slider->update(['is_active' => !$slider->is_active]);

        return back()->with('success', 'Slider status updated.');
    }
}

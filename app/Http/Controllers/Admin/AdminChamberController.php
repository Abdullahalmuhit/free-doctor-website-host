<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chamber;
use Illuminate\Http\Request;

class AdminChamberController extends Controller
{
    public function index()
    {
        $chambers = Chamber::withCount('appointments')->latest()->get();
        return view('admin.chambers.index', compact('chambers'));
    }

    public function create()
    {
        return view('admin.chambers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'room_number' => 'nullable|string|max:50',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'visiting_hours' => 'required|array|min:1',
            'visiting_hours.*.day' => 'required|string',
            'visiting_hours.*.time' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Chamber::create($validated);

        return redirect()->route('admin.chambers.index')
            ->with('success', 'Chamber created successfully.');
    }

    public function edit(Chamber $chamber)
    {
        return view('admin.chambers.edit', compact('chamber'));
    }

    public function update(Request $request, Chamber $chamber)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'room_number' => 'nullable|string|max:50',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'visiting_hours' => 'required|array|min:1',
            'visiting_hours.*.day' => 'required|string',
            'visiting_hours.*.time' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $chamber->update($validated);

        return redirect()->route('admin.chambers.index')
            ->with('success', 'Chamber updated successfully.');
    }

    public function destroy(Chamber $chamber)
    {
        // Check if chamber has appointments
        if ($chamber->appointments()->count() > 0) {
            return back()->with('error', 'Cannot delete chamber with existing appointments.');
        }

        $chamber->delete();

        return redirect()->route('admin.chambers.index')
            ->with('success', 'Chamber deleted successfully.');
    }

    public function toggle(Chamber $chamber)
    {
        $chamber->update(['is_active' => !$chamber->is_active]);

        $status = $chamber->is_active ? 'activated' : 'deactivated';

        return back()->with('success', "Chamber {$status} successfully.");
    }
}

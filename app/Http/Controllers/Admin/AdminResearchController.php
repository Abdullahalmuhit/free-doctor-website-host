<?php
// app/Http/Controllers/Admin/AdminResearchController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResearchPaper;
use Illuminate\Http\Request;

class AdminResearchController extends Controller
{
    public function index()
    {
        $papers = ResearchPaper::latest()->paginate(15);
        return view('admin.research.index', compact('papers'));
    }

    public function create()
    {
        return view('admin.research.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:500',
            'authors' => 'required|string',
            'journal' => 'required|string|max:255',
            'publication_date' => 'required|string|max:100',
            'volume_issue' => 'nullable|string|max:100',
            'type' => 'required|in:article,case_report',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');

        ResearchPaper::create($validated);

        return redirect()->route('admin.research.index')
            ->with('success', 'Research paper added successfully.');
    }

    public function edit(ResearchPaper $research)
    {
        return view('admin.research.edit', compact('research'));
    }

    public function update(Request $request, ResearchPaper $research)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:500',
            'authors' => 'required|string',
            'journal' => 'required|string|max:255',
            'publication_date' => 'required|string|max:100',
            'volume_issue' => 'nullable|string|max:100',
            'type' => 'required|in:article,case_report',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->has('is_published');

        $research->update($validated);

        return redirect()->route('admin.research.index')
            ->with('success', 'Research paper updated successfully.');
    }

    public function destroy(ResearchPaper $research)
    {
        $research->delete();

        return redirect()->route('admin.research.index')
            ->with('success', 'Research paper deleted successfully.');
    }
}

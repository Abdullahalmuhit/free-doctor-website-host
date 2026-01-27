<?php

// app/Http/Controllers/ResearchController.php
namespace App\Http\Controllers;

use App\Models\ResearchPaper;

class ResearchController extends Controller
{
    public function index()
    {
        $articles = ResearchPaper::published()
            ->articles()
            ->latest()
            ->get();

        $caseReports = ResearchPaper::published()
            ->caseReports()
            ->latest()
            ->get();

        return view('frontend.research', compact('articles', 'caseReports'));
    }
}

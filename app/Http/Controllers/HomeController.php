<?php
// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ResearchPaper;
use App\Models\User;
use App\Models\GalleryItem;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $featuredGallery = GalleryItem::featured()
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        $recentArticles = Article::published()
            ->latest()
            ->take(3)
            ->get();

        $recentResearch = ResearchPaper::published()
            ->latest()
            ->take(5)
            ->get();

        // Get active sliders ordered by display order
        $sliders = Slider::active()->ordered()->get();

        // Get the main doctor profile
        $doctor = User::doctors()->first();

        return view('frontend.home2', compact('recentArticles', 'recentResearch', 'doctor', 'featuredGallery', 'sliders'));
    }

    public function about()
    {
        // Get the doctor with all relationships
        $doctor = User::doctors()
            ->with([
                'qualifications',
                'workExperiences',
                'certifications',
                'memberships',
                'specializations',
                'awards',
                'trainingPrograms'
            ])
            ->first();

        if (!$doctor) {
            abort(404, 'Doctor profile not found');
        }

        return view('frontend.about', compact('doctor'));
    }
}

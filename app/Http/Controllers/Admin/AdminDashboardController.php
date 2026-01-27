<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Appointment;
use App\Models\Chamber;
use App\Models\ResearchPaper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $stats = [
            'total_articles' => Article::count(),
            'published_articles' => Article::published()->count(),
            'total_research' => ResearchPaper::count(),
            'total_chambers' => Chamber::count(),
            'pending_appointments' => Appointment::pending()->count(),
            'confirmed_appointments' => Appointment::confirmed()->count(),
            'total_appointments' => Appointment::count(),
            'today_appointments' => Appointment::whereDate('appointment_date', Carbon::today())->count(),
        ];

        // Recent Appointments
        $recentAppointments = Appointment::with('chamber')
            ->latest()
            ->take(10)
            ->get();

        // Monthly Appointment Chart Data
        $monthlyAppointments = Appointment::select([
            DB::raw('EXTRACT(YEAR FROM appointment_date) as year'),
            DB::raw('EXTRACT(MONTH FROM appointment_date) as month'),
            DB::raw('COUNT(*) as count')
        ])
            ->where('appointment_date', '>=', Carbon::now()->subMonths(6))
            ->groupBy(['year', 'month'])
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Recent Articles
        $recentArticles = Article::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentAppointments',
            'monthlyAppointments',
            'recentArticles'
        ));
    }
}

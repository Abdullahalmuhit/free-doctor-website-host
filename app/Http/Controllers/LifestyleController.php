<?php

namespace App\Http\Controllers;

use App\Models\LifestyleItem;
use App\Models\Article;

class LifestyleController extends Controller
{
    public function index()
    {
        $nutritionItems = LifestyleItem::active()
            ->byCategory('nutrition')
            ->get();

        $exerciseItems = LifestyleItem::active()
            ->byCategory('exercise')
            ->get();

        $habitItems = LifestyleItem::active()
            ->byCategory('habits')
            ->get();

        $lifestyleArticles = Article::published()
            ->where('category', 'Healthy Lifestyle')
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.lifestyle', compact(
            'nutritionItems',
            'exerciseItems',
            'habitItems',
            'lifestyleArticles'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::published()
            ->latest()
            ->paginate(9);

        $categories = Article::published()
            ->distinct()
            ->pluck('category')
            ->filter();

        return view('frontend.articles.index', compact('articles', 'categories'));
    }

    public function show(Article $article)
    {
        if (!$article->is_published) {
            abort(404);
        }

        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->where('category', $article->category)
            ->take(3)
            ->get();

        return view('frontend.articles.show', compact('article', 'relatedArticles'));
    }

    public function category($category)
    {
        $articles = Article::published()
            ->where('category', $category)
            ->latest()
            ->paginate(9);

        return view('frontend.articles.category', compact('articles', 'category'));
    }
}

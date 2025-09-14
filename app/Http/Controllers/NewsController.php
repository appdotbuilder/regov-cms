<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NewsController extends Controller
{
    /**
     * Display a listing of news articles.
     */
    public function index()
    {
        $news = News::published()
            ->with(['author', 'department'])
            ->latest('published_at')
            ->paginate(12);

        return Inertia::render('news/index', [
            'news' => $news
        ]);
    }

    /**
     * Display the specified news article.
     */
    public function show(string $slug)
    {
        $article = News::where('slug', $slug)
            ->published()
            ->with(['author', 'department'])
            ->firstOrFail();

        // Increment view count
        $article->increment('views_count');

        return Inertia::render('news/show', [
            'article' => $article
        ]);
    }
}
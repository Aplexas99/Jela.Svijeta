<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{

    public function index()
    {
        $articles = Article::latest()->get();
        return view('blog')
            ->with('articles', $articles);
    }
    
    public function show($title)
    {
        // This is the only difference you need be aware of
        $article = Article::whereTranslation('title', $title)->firstOrFail();

        return view('article')
            ->with('article', $article);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Article;
use App\Models\GeneralInfo;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $generalInfo = GeneralInfo::first();
        $aboutInfo = About::first();

        return view('articles.index', compact('generalInfo', 'aboutInfo'));
    }

    // public function singleArticle($id)
    // {
    //     $article = Article::findOrFail($id);

    //     //dd($article);

    //     $generalInfo = GeneralInfo::first();
    //     $aboutInfo = About::first();

    //     return view('articles.single-article', compact('article', 'generalInfo', 'aboutInfo'));
    // }

    public function singleArticle($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        // Additional information retrieval
        $generalInfo = GeneralInfo::first();
        $aboutInfo = About::first();

        return view('articles.single-article', compact('article', 'generalInfo', 'aboutInfo'));
    }
}

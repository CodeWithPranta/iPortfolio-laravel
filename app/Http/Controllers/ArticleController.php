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
}

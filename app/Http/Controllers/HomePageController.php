<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\GeneralInfo;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $generalInfo = GeneralInfo::first();

        $aboutInfo = About::first();

        return view('index', [
            'generalInfo' => $generalInfo,
            'aboutInfo' => $aboutInfo,
        ]);
    }
}

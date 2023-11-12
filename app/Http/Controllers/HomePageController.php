<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Skill;
use App\Models\GeneralInfo;
use App\Models\Resume;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $generalInfo = GeneralInfo::first();

        $aboutInfo = About::first();

        $skillInfo = Skill::first();

        $resumeInfo = Resume::first();

        return view('index', [
            'generalInfo' => $generalInfo,
            'aboutInfo' => $aboutInfo,
            'skillInfo' => $skillInfo,
            'resumeInfo' => $resumeInfo,
        ]);
    }
}

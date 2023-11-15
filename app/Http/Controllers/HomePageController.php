<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Contact;
use App\Models\Fact;
use App\Models\Skill;
use App\Models\GeneralInfo;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Resume;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $generalInfo = GeneralInfo::first();

        $aboutInfo = About::first();

        $skillInfo = Skill::first();

        $resumeInfo = Resume::first();

        $contactInfo = Contact::first();

        $pCategories = PortfolioCategory::get();

        $portfolios = Portfolio::latest()->get();
        //dd($portfolios);

        $services = Service::get();

        $testimonials = Testimonial::get();

        $fact = Fact::first();

        return view('index', [
            'generalInfo' => $generalInfo,
            'aboutInfo' => $aboutInfo,
            'skillInfo' => $skillInfo,
            'resumeInfo' => $resumeInfo,
            'contactInfo' => $contactInfo,
            'pCategories' => $pCategories,
            'portfolios' => $portfolios,
            'services' => $services,
            'testimonials' => $testimonials,
            'fact' => $fact,
        ]);
    }
}

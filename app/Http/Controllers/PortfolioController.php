<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Portfolio;
use App\Models\GeneralInfo;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function singleRecord($id){
        $generalInfo = GeneralInfo::first();
        $aboutInfo = About::first();
        $portfolio = Portfolio::findOrFail($id);
        //dd($portfolio);
        return view('portfolio-details', compact('portfolio', 'generalInfo', 'aboutInfo'));
    }
}

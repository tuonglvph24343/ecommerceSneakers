<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $sliders =  Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        return view(
            'frontend.home.home',
            compact(
                'sliders'
            )
        );
    }
}

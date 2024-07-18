<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        return view(
            'frontend.home.home',
            compact(
                'sliders',
                'flashSaleDate',
                'flashSaleItems',
            )
        );
    }
}

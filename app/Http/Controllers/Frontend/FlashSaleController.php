<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;

class FlashSaleController extends Controller
{
    public function index()
    {
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('status', 1)->orderBy('id', 'ASC')->pluck('product_id')->toArray();
        return view('frontend.pages.flash-sale', compact('flashSaleDate', 'flashSaleItems'));
    }
    //làm lại hiển thị flash sale cho chuẩn
}

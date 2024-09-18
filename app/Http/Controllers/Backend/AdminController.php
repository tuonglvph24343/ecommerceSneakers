<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\NewsletterSubscriber;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ProductReview;
use App\Models\User;
use App\Models\Vendor;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Stripe\Review;

class AdminController extends Controller
{
    public function dashboard()
    {
        $todaysOrder = Order::whereDate('created_at', Carbon::today())->count();
        $todaysPendingOrder = Order::whereDate('created_at', Carbon::today())
            ->where('order_status', 'pending')->count();
        $totalOrders = Order::count();
        $totalPendingOrders = Order::where('order_status', 'pending')->count();
        $totalCanceledOrders = Order::where('order_status', 'canceled')->count();
        $totalCompleteOrders = Order::where('order_status', 'delivered')->count();

        $todaysEarnings = Order::where('order_status', '!=', 'canceled')
            ->where('payment_status', 1)
            ->whereDate('created_at', Carbon::today())
            ->sum('sub_total');

        $weekEarnings = Order::where('order_status', '!=', 'canceled')
            ->where('payment_status', 1)
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('sub_total');

        $monthEarnings = Order::where('order_status', '!=', 'canceled')
            ->where('payment_status', 1)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('sub_total');

        $yearEarnings = Order::where('order_status', '!=', 'canceled')
            ->where('payment_status', 1)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('sub_total');

        $totalReview = ProductReview::count();

        $totalBrands = Brand::count();
        $totalCategories = Category::count();
        //   $totalBlogs = Blog::count();
        $totalSubscriber = NewsletterSubscriber::count();
        $totalVendors = User::where('role', 'vendor')->count();
        $totalUsers = User::where('role', 'user')->count();

        // Get monthly earnings for the last 12 months
        $monthlyEarnings = Order::where('order_status', '!=', 'canceled')
            ->where('payment_status', 1)
            ->selectRaw('MONTH(created_at) as month, SUM(sub_total) as total')
            ->groupBy('month')
            ->pluck('total', 'month')->toArray();

        // Create an array with 12 months and fill missing months with 0
        $revenueData = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenueData[$i] = isset($monthlyEarnings[$i]) ? $monthlyEarnings[$i] : 0;
        }

        // Top-selling products
        $topSellingProducts = OrderProduct::select('product_id', DB::raw('SUM(qty) as total_sold'))
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->with('product') // assuming you have a relation 'product' in OrderItem model
            ->take(5)
            ->get();

        // Top-selling products
        $topSellingProducts = OrderProduct::select('product_id', DB::raw('SUM(qty) as total_sold'))
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->with('product') // assuming you have a relation 'product' in OrderItem model
            ->take(5)
            ->get();

        $totalReview = ProductReview::count();
        $totalBrands = Brand::count();
        $totalCategories = Category::count();
        $totalSubscriber = NewsletterSubscriber::count();
        $totalVendors = User::where('role', 'vendor')->count();
        $totalUsers = User::where('role', 'user')->count();

        return view('admin.dashboard', compact(
            'todaysOrder',
            'todaysPendingOrder',
            'totalOrders',
            'totalPendingOrders',
            'totalCanceledOrders',
            'totalCompleteOrders',
            'todaysEarnings',
            'weekEarnings',
            'monthEarnings',
            'yearEarnings',
            'topSellingProducts',
            'totalReview',
            'totalBrands',
            'totalCategories',
            // 'totalBlogs',
            'totalSubscriber',
            'totalVendors',
            'totalUsers',
            'revenueData',
            'topSellingProducts'
        ));
    }

    public function login()
    {
        return view('admin.auth.login');
    }
}

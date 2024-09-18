<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistProducts = Wishlist::with('product')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        // Kiểm tra xem sản phẩm trong wishlist có tồn tại hay không
        foreach ($wishlistProducts as $wishlist) {
            if (!$wishlist->product) {
                // Xóa sản phẩm khỏi wishlist nếu nó không còn tồn tại
                $wishlist->delete();
            }
        }

        // Lấy lại danh sách wishlist sau khi xóa các sản phẩm không tồn tại
        $wishlistProducts = Wishlist::with('product')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();

        return view('frontend.pages.wishlist', compact('wishlistProducts'));
    }

    public function addToWishlist(Request $request)
    {
        if (!Auth::check()) {
            return response(['status' => 'error', 'message' => 'đăng nhập trước khi thêm sản phẩm vào yêu thích!']);
        }

        $wishlistCount = Wishlist::where(['product_id' => $request->id, 'user_id' => Auth::user()->id])->count();
        if ($wishlistCount > 0) {
            return response(['status' => 'error', 'message' => 'Sản phẩm đã có trong yêu thích!']);
        }

        $wishlist = new Wishlist();
        $wishlist->product_id = $request->id;
        $wishlist->user_id = Auth::user()->id;
        $wishlist->save();

        $count = Wishlist::where('user_id', Auth::user()->id)->count();

        return response(['status' => 'success', 'message' => 'Sản phẩm đã được thêm vào yêu thích!', 'count' => $count]);
    }

    public function destory(string $id)
    {

        $wishlistProduct = Wishlist::where('id', $id)->firstOrFail();

        if (!$wishlistProduct->product) {
            $wishlistProduct->delete();
            toastr('Sản phẩm đã bị xóa khỏi danh sách yêu thích vì không còn tồn tại nữa.', 'warning', 'Product Removed');
            return redirect()->back();
        }

        if ($wishlistProduct->user_id !== Auth::user()->id) {
            return redirect()->back();
        }

        $wishlistProduct->delete();

        toastr('Product removed successfully', 'success', 'Success');
        return redirect()->back();
    }
}

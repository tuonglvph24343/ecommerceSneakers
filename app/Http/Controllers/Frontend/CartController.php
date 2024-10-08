<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    /** Show cart page  */
    public function cartDetails()
    {
        $cartItems = Cart::content();
        // $cartItems = Cart::store('name');

        if (count($cartItems) === 0) {
            Session::forget('coupon');
            toastr('Vui lòng thêm một số sản phẩm vào giỏ hàng của bạn để xem trang giỏ hàng', 'warning', 'Giỏ hàng trống!');
            return redirect()->route('home');
        }
        // Duyệt qua tất cả các sản phẩm trong giỏ hàng
        foreach ($cartItems as $item) {
            $product = Product::find($item->id);

            // Nếu sản phẩm không tồn tại, xóa khỏi giỏ hàng
            if (!$product) {
                Cart::remove($item->rowId);
                toastr("Sản phẩm  '{$item->name}'  đã được xóa khỏi giỏ hàng của bạn vì nó không còn khả dụng", 'warning', ' Sản phẩm đã bị xóa.');
            } else {
                // Nếu sản phẩm tồn tại, cập nhật giá (nếu cần)
                $currentPrice = checkDiscount($product) ? $product->offer_price : $product->price;

                if ($item->price != $currentPrice) {
                    Cart::update($item->rowId, [
                        'price' => $currentPrice
                    ]);
                }
            }
        }
        $cartItems = Cart::content();
        $cartpage_banner_section = Advertisement::where('key', 'cartpage_banner_section')->first();
        $cartpage_banner_section = json_decode($cartpage_banner_section?->value);

        return view('frontend.pages.cart-detail', compact('cartItems', 'cartpage_banner_section'));
    }

    /** Add item to cart */
    public function addToCart(Request $request)
    {

        $product = Product::findOrFail($request->product_id);

        // check product quantity
        if ($product->qty === 0) {
            return response(['status' => 'error', 'message' => 'Sản phẩm hết hàng']);
        } elseif ($product->qty < $request->qty) {
            return response(['status' => 'error', 'message' => 'Số lượng không có sẵn trong kho của chúng tôi.']);
        }

        $variants = [];
        $variantTotalAmount = 0;

        if ($request->has('variants_items')) {
            foreach ($request->variants_items as $item_id) {
                $variantItem = ProductVariantItem::find($item_id);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                $variantTotalAmount += $variantItem->price;
            }
        }


        /** check discount */
        $productPrice = 0;

        if (checkDiscount($product)) {
            $productPrice = $product->offer_price;
        } else {
            $productPrice = $product->price;
        }

        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantTotalAmount;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;

        Cart::add($cartData);

        return response(['status' => 'success', 'message' => 'Added to cart successfully!SSS']);
    }

    /** Update product quantity */
    public function updateProductQty(Request $request)
{
    $productId = Cart::get($request->rowId)->id;
    $product = Product::findOrFail($productId);

    // check product quantity
    if ($product->qty === 0) {
        return response(['status' => 'error', 'message' => 'Sản phẩm hết hàng']);
    } elseif ($product->qty < $request->qty) {
        return response(['status' => 'error', 'message' => 'Số lượng không có sẵn trong kho của chúng tôi.']);
    }

    // Cập nhật số lượng trong giỏ hàng
    Cart::update($request->rowId, $request->qty);  // Sử dụng 'qty' để cập nhật chính xác
    $productTotal = $this->getProductTotal($request->rowId);

    // Phản hồi về thành công và cập nhật tổng tiền cho sản phẩm
    return response([
        'status' => 'success', 
        'message' => 'Product Quantity Updated!', 
        'product_total' => $productTotal
    ]);
}

    /** get product total */
    public function getProductTotal($rowId)
    {
        $product = Cart::get($rowId);
        $total = ($product->price + $product->options->variants_total) * $product->qty;
        return $total;
    }

    /** get cart total amount */
    public function cartTotal()
    {
        $total = 0;
        foreach (Cart::content() as $product) {
            $total += $this->getProductTotal($product->rowId);
        }

        return $total;
    }

    /** clear all cart products */
    public function clearCart()
    {
        Cart::destroy();

        return response(['status' => 'success', 'message' => 'Cart cleared successfully']);
    }

    /** Remove product form cart */
    public function removeProduct($rowId)
    {
        Cart::remove($rowId);
        toastr('Product removed succesfully!', 'success', 'Success');
        return redirect()->back();
    }

    /** Get cart count */
    public function getCartCount()
    {
        return Cart::content()->count();
    }

    /** Get all cart products */
    public function getCartProducts()
    {
        return Cart::content();
    }

    /** Romve product form sidebar cart */
    public function removeSidebarProduct(Request $request)
    {
        Cart::remove($request->rowId);

        return response(['status' => 'success', 'message' => 'Product removed successfully!']);
    }

    /** Apply coupon */
    public function applyCoupon(Request $request)
    {
        if ($request->coupon_code === null) {
            return response(['status' => 'error', 'message' => 'Coupon filed is required']);
        }

        $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();

        if ($coupon === null) {
            return response(['status' => 'error', 'message' => 'Coupon not exist!']);
        } elseif ($coupon->start_date > date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon not exist!']);
        } elseif ($coupon->end_date < date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon is expired']);
        } elseif ($coupon->total_used >= $coupon->quantity) {
            return response(['status' => 'error', 'message' => 'bạn không thể áp dụng phiếu giảm giá này']);
        }

        if ($coupon->discount_type === 'amount') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'amount',
                'discount' => $coupon->discount
            ]);
        } elseif ($coupon->discount_type === 'percent') {
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'percent',
                'discount' => $coupon->discount
            ]);
        }

        return response(['status' => 'success', 'message' => 'Coupon applied successfully!']);
    }

    /** Calculate coupon discount */
    public function couponCalculation()
    {
        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            $subTotal = getCartTotal();
            if ($coupon['discount_type'] === 'amount') {
                $total = $subTotal - $coupon['discount'];
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon['discount']]);
            } elseif ($coupon['discount_type'] === 'percent') {
                $discount = $subTotal - ($subTotal * $coupon['discount'] / 100);
                $total = $subTotal - $discount;
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $discount]);
            }
        } else {
            $total = getCartTotal();
            return response(['status' => 'success', 'cart_total' => $total, 'discount' => 0]);
        }
    }

    /** Store the cart when logging out */
    public function storeCartOnLogout()
    {
        if (Auth::check()) {
            Cart::store(Auth::user()->id);
        }
    }

    // /** Restore the cart when logging in */
    public function restoreCartOnLogin()
    {
        if (Auth::check()) {
            Cart::restore(Auth::user()->id);
        }
    }

}

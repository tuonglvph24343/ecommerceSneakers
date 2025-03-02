<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProductTrackController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\NotificationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');

/** Product route */
Route::get('products', [FrontendProductController::class, 'productsIndex'])->name('products.index');
Route::get('product-detail/{slug}', [FrontendProductController::class, 'showProduct'])->name('product-detail');
Route::get('change-product-list-view', [FrontendProductController::class, 'chageListView'])->name('change-product-list-view');

/** Cart routes */
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('cart-details', [CartController::class, 'cartDetails'])->name('cart-details');
Route::post('cart/update-quantity', [CartController::class, 'updateProductQty'])->name('cart.update-quantity');
Route::get('clear-cart', [CartController::class, 'clearCart'])->name('clear.cart');
Route::get('cart/remove-product/{rowId}', [CartController::class, 'removeProduct'])->name('cart.remove-product');
Route::get('cart-count', [CartController::class, 'getCartCount'])->name('cart-count');
Route::get('cart-products', [CartController::class, 'getCartProducts'])->name('cart-products');
Route::post('cart/remove-sidebar-product', [CartController::class, 'removeSidebarProduct'])->name('cart.remove-sidebar-product');
Route::get('cart/sidebar-product-total', [CartController::class, 'cartTotal'])->name('cart.sidebar-product-total');

Route::get('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
Route::get('coupon-calculation', [CartController::class, 'couponCalculation'])->name('coupon-calculation');

/** Newsletter routes */
Route::post('newsletter-request', [NewsletterController::class, 'newsLetterRequset'])->name('newsletter-request');
Route::get('newsletter-verify/{token}', [NewsletterController::class, 'newsLetterEmailVarify'])->name('newsletter-verify');

/** about page route */
Route::get('about', [PageController::class, 'about'])->name('about');
/** terms and conditions page route */
Route::get('terms-and-conditions', [PageController::class, 'termsAndCondition'])->name('terms-and-conditions');
/** contact route */
Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::post('contact', [PageController::class, 'handleContactForm'])->name('handle-contact-form');
/** vorcher route */

Route::get('voucher', [PageController::class, 'voucher'])->name('voucher');

/** Product track route */
Route::get('product-traking', [ProductTrackController::class, 'index'])->name('product-traking.index');
/** Product routes */
Route::get('show-product-modal/{id}', [HomeController::class, 'ShowProductModal'])->name('show-product-modal');



Route::get('wishlist/add-product', [WishlistController::class, 'addToWishlist'])->name('wishlist.store');



Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update'); // user.profile.update
    Route::post('profile', [UserProfileController::class, 'updatePassword'])->name('profile.update.password');

    /** User Address Route */
    Route::resource('address', UserAddressController::class);

    /** Order Routes */
    Route::get('orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/show/{id}', [UserOrderController::class, 'show'])->name('orders.show');
    // web.php hoặc api.php
    Route::post('/cancel-order', [UserOrderController::class, 'cancelOrder'])->name('order.cancel');


    /** Wishlist routes */
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('wishlist/remove-product/{id}', [WishlistController::class, 'destory'])->name('wishlist.destory');

    /** product review routes */
    Route::post('review', [ReviewController::class, 'create'])->name('review.create');
    Route::get('reviews', [ReviewController::class, 'index'])->name('review.index');

    /** Checkout routes */
    Route::get('checkout', [CheckOutController::class, 'index'])->name('checkout');
    Route::post('checkout/address-create', [CheckOutController::class, 'createAddress'])->name('checkout.address.create');
    Route::put('checkout/address-update', [CheckOutController::class, 'updateAddress'])->name('checkout.address.update');
    Route::put('checkout/address-update/{id}', [CheckOutController::class, 'updateAddress'])->name('checkout.address.update');
    Route::post('checkout/form-submit', [CheckOutController::class, 'checkOutFormSubmit'])->name('checkout.form-submit');

    /** Payment Routes */
    Route::get('payment', [PaymentController::class, 'index'])->name('payment');
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

    /** Paypal routes */
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');




    /** Razorpay routes */
    Route::post('razorpay/payment', [PaymentController::class, 'payWithRazorPay'])->name('razorpay.payment');
    Route::get('cod/payment', [PaymentController::class, 'payWithCod'])->name('cod.payment');
    /** VNPay routes */
    Route::get('vnpay/payment', [PaymentController::class, 'vnpayPayment'])->name('vnpay.payment');
    Route::get('vnpay/return', [PaymentController::class, 'vnpayReturn'])->name('vnpay.return');
/** Notification */
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/clear', [NotificationController::class, 'clearNotifications'])->name('notifications.clear');
    Route::post('/notifications/clear', [NotificationController::class, 'clearNotifications'])->name('notifications.clear');
    Route::delete('/notifications/{id}/delete', [NotificationController::class, 'deleteNotification'])->name('notifications.delete');
});
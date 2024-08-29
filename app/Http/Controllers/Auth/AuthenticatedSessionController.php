<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->regenerateToken();

        $request->authenticate();

        $request->session()->regenerate();

        // Thêm logic khôi phục giỏ hàng tại đây
        $cartController = new CartController();
        $cartController->restoreCartOnLogin();

        if($request->user()->status === 'inactive'){
            Auth::guard('web')->logout();
            $request->session()->regenerateToken();
            toastr('account has been banned from website please connect with support!', 'error', 'Account Banned!');
            return redirect('/');
        }

        if($request->user()->role === 'admin'){
            return redirect()->intended('/admin/dashboard');
        }elseif($request->user()->role === 'vendor'){
            return redirect()->intended('/vendor/dashboard');
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Thêm logic lưu giỏ hàng trước khi đăng xuất
        $cartController = new CartController();
        $cartController->storeCartOnLogout();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

@extends('frontend.layouts.master')

@section('title', $settings->site_name . ' || Payment')

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb" class="wsus__breadcrumb_section">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Payment</h4>
                        <ul class="breadcrumb_list">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><span>Payment</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->

    <!--============================
        PAYMENT PAGE START
    ==============================-->
    <section id="wsus__cart_view" class="wsus__payment_section">
        <div class="container">
            <div class="wsus__pay_info_area">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1>Thanh toán thành công</h1>
                        <p>Thanh toán của bạn đã được xử lý thành công.Cảm ơn bạn đã mua hàng.</p>
                        <a href="{{ route('user.orders.index') }}" class="common_btn">Xem đơn hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        PAYMENT PAGE END
    ==============================-->
@endsection


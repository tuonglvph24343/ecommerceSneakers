@extends('frontend.layouts.master')

@section('title', $settings->site_name . ' || Payment')

@section('content')

<section id="wsus__404">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-md-10 col-lg-8 col-xxl-5 m-auto">
                <div class="wsus__404_text">
                    <h2>404</h2>
                    <h4><span>Ối!!!</span> Có gì không ổn ở đây</h4>
                    <p>Có thể có lỗi chính tả trong URL đã nhập hoặc trang bạn đang tìm kiếm có thể không còn tồn tại</p>
                    <a href="{{ route('home') }}" class="common_btn">Quay lại trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

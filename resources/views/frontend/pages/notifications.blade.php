@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} || Payment
@endsection

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4> Danh sách Thông báo</h4>
                        <ul>
                            <li><a href="#">trang chủ</a></li>
                            <li><a href="#">Thông báo</a></li>
                            <li><a href="#"> Danh sách thông báo </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__login_register" class="py-5">
        <div class="container">
            <div class="wsus__track_area">
                <div class="row">
                    <div class="col-xl-5 col-md-8 col-lg-6 mx-auto">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white text-center">
                                <h4>Thông báo</h4>
                                <p class="mb-0">Theo dõi thông báo đơn hàng của bạn!</p>
                            </div>
                            <div class="card-body">
                                <div class="wsus__track_input">
                                    @if (count($notifications) > 0)
                                        <ul class="list-group list-group-flush mb-3">
                                            @foreach ($notifications as $notification)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <span class="text-dark fw-bold">{{ $notification->decodedData->message }}</span>
                                                </div>
                                                <div class="d-flex">
                                                    <a href="{{ route('user.orders.show', $notification->decodedData->order_id) }}" class="btn btn-outline-info btn-sm me-2">Xem chi tiết</a>
                                                    
                                                    <!-- Form để xóa thông báo -->
                                                    <form action="{{ route('user.notifications.delete', $notification->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">Xóa</button>
                                                    </form>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                            
                                    @else
                                        <div class="alert alert-info text-center">
                                            Không có thông báo mới.
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection

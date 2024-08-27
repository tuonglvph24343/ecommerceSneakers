@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} || Kiểm tra
@endsection

@section('content')
    <!--============================
                BREADCRUMB START
            ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>kiểm tra</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">trang chủ</a></li>
                            <li><a href="javascript:;">kiểm tra</a></li>
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
                CHECK OUT PAGE START
            ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="wsus__check_form">
                        <div class="d-flex">
                            <h5>Chi tiết vận chuyển </h5>
                            <a href="javascript:;" style="margin-left:auto;" class="common_btn" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">thêm địa chỉ mới</a>
                        </div>

                        <div class="row">
                            @foreach ($addresses as $address)
                                <div class="col-xl-6">
                                    <div class="wsus__checkout_single_address">
                                        <div class="form-check">
                                            <input class="form-check-input shipping_address" data-id="{{ $address->id }}"
                                                type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                chọn địa chỉ
                                            </label>
                                        </div>
                                        <ul>
                                            <li><span>tên :</span> {{ $address->name }}</li>
                                            <li><span>số điện thoại :</span> {{ $address->phone }}</li>
                                            <li><span>Email :</span> {{ $address->email }}</li>
                                            <li><span>quốc gia :</span> {{ $address->country }}</li>
                                            <li><span>thanh phố :</span> {{ $address->city }}</li>
                                            <li><span>mã zip :</span> {{ $address->zip }}</li>
                                            <li><span>địa chỉ :</span> {{ $address->address }}</li>
                                        </ul>
                                        <a href="javascript:;" class="common_btn center btn-small" data-bs-toggle="modal"
                                            data-bs-target="#exampleModals">sửa địa chỉ </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="wsus__order_details" id="sticky_sidebar">
                        <p class="wsus__product">phương thức vận chuyển</p>
                        @foreach ($shippingMethods as $method)
                            @if ($method->type === 'min_cost' && getCartTotal() >= $method->min_cost)
                                <div class="form-check">
                                    <input class="form-check-input shipping_method" type="radio" name="exampleRadios"
                                        id="exampleRadios1" value="{{ $method->id }}" data-id="{{ $method->cost }}">
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{ $method->name }}
                                        <span>chi phí: ({{ $settings->currency_icon }}{{ $method->cost }})</span>
                                    </label>
                                </div>
                            @elseif ($method->type === 'flat_cost')
                                <div class="form-check">
                                    <input class="form-check-input shipping_method" type="radio" name="exampleRadios"
                                        id="exampleRadios1" value="{{ $method->id }}" data-id="{{ $method->cost }}">
                                    <label class="form-check-label" for="exampleRadios1">
                                        {{ $method->name }}
                                        <span>chi phí: ({{ $settings->currency_icon }}{{ $method->cost }})</span>
                                    </label>
                                </div>
                            @endif
                        @endforeach

                        <div class="wsus__order_details_summery">
                            <p>tổng cộng: <span>{{ $settings->currency_icon }}{{ getCartTotal() }}</span></p>
                            <p>chi phí vận chuyển(+): <span id="shipping_fee">{{ $settings->currency_icon }}0</span></p>
                            <p>phiếu giảm giá(-): <span>{{ $settings->currency_icon }}{{ getCartDiscount() }}</span></p>
                            <p><b>tổng:</b> <span><b id="total_amount"
                                        data-id="{{ getMainCartTotal() }}">{{ $settings->currency_icon }}{{ getMainCartTotal() }}</b></span>
                            </p>
                        </div>
                        <div class="terms_area">
                            <div class="form-check">
                                <input class="form-check-input agree_term" type="checkbox" value=""
                                    id="flexCheckChecked3" checked>
                                <label class="form-check-label" for="flexCheckChecked3">
                                    Tôi đã đọc và đồng ý với các điều khoản và điều kiện của trang web *</a>
                                </label>
                            </div>
                        </div>
                        <form action="" id="checkOutForm">
                            <input type="hidden" name="shipping_method_id" value="" id="shipping_method_id">
                            <input type="hidden" name="shipping_address_id" value="" id="shipping_address_id">


                        </form>
                        {{-- <a href="" id="submitCheckoutForm" class="common_btn">đặt hàng</a> --}}
                        <a class="nav-link common_btn text-center" href="{{ route('user.paypal.payment') }}"
                            id="submitCheckoutOnline">Thanh toán online</a>
                        <br>
                        <a class="nav-link common_btn text-center" href="{{ route('user.cod.payment') }}"
                            id="submitCheckoutCOD">Thanh toán khi nhận hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="wsus__popup_address">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">thêm địa chỉ mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="wsus__check_form p-3">
                            <form action="{{ route('user.checkout.address.create') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="tên *" name="name"
                                                value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="số điện thoại *" name="phone"
                                                value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="email" placeholder="Email *" name="email"
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <select class="select_2" name="country">
                                                <option value="">quốc gia / khu vực *</option>
                                                @foreach (config('settings.country_list') as $key => $county)
                                                    <option {{ $county === old('country') ? 'selected' : '' }}
                                                        value="{{ $county }}">{{ $county }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="trạng thái *" name="state"
                                                value="{{ old('state') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="thị trấn / thành phố *" name="city"
                                                value="{{ old('city') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="mã zip *" name="zip"
                                                value="{{ old('zip') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="địa chỉ *" name="address"
                                                value="{{ old('address') }}">
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="wsus__check_single_form">
                                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wsus__popup_address">
        <div class="modal fade" id="exampleModals" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cập nhật địa chỉ </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="wsus__check_form p-3">
                            <form action="{{ route('user.checkout.address.update',$address->id) }}" method="POST">
                                @csrf
                                @method('PUT') <!-- Chuyển đổi từ POST thành PUT -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="tên *" name="name"
                                            value="{{$address->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="số điện thoại *" name="phone"
                                            value="{{$address->phone}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="email" placeholder="Email *" name="email"
                                            value="{{$address->email}}">
                                        </div>
                                    </div>
                            
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <select class="select_2" name="country">
                                                <option value="">quốc gia / khu vực *</option>
                                                @foreach (config('settings.country_list') as $country)
                                                <option {{$country === $address->country ? 'selected' : ''}} value="{{$country}}">{{$country}}</option>
                                            @endforeach
                            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="trạng thái *" name="state"
                                            value="{{$address->state}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="thị trấn / thành phố *" name="city"
                                            value="{{$address->city}}">
                                        </div>
                                    </div>
                            
                                    <div class="col-md-6">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="mã zip *" name="zip"
                                            value="{{$address->zip}}">
                                        </div>
                                    </div>
                            
                                    <div class="col-md-12">
                                        <div class="wsus__check_single_form">
                                            <input type="text" placeholder="địa chỉ *" name="address"
                                            value="{{$address->address}}">
                                        </div>
                                    </div>
                            
                                    <div class="col-xl-12">
                                        <div class="wsus__check_single_form">
                                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .common_btn.btn-small {
            font-size: 14px;
            /* Kích thước chữ nhỏ hơn */
            padding: 5px 15px;
            /* Giảm khoảng cách bên trong nút */
            display: center;
            margin: 0 auto;
            /* Tạo căn giữa cho nút */
            margin-top: 5px;
        }

        .center {
            text-align: center;
            /* Căn giữa phần tử cha */
            display: block;
        }
    </style>
    <!--============================
                CHECK OUT PAGE END
            ==============================-->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('input[type="radio"]').prop('checked', false);
            $('#shipping_method_id').val("");
            $('#shipping_address_id').val("");

            $('.shipping_method').on('click', function() {
                let shippingFee = $(this).data('id');
                let currentTotalAmount = $('#total_amount').data('id');
                let totalAmount = currentTotalAmount + shippingFee;

                $('#shipping_method_id').val($(this).val());
                $('#shipping_fee').text("{{ $settings->currency_icon }}" + shippingFee);
                $('#total_amount').text("{{ $settings->currency_icon }}" + totalAmount);
            });

            $('.shipping_address').on('click', function() {
                $('#shipping_address_id').val($(this).data('id'));
            });

            // submit checkout form for online payment
            $('#submitCheckoutOnline').on('click', function(e) {
                e.preventDefault();
                if ($('#shipping_method_id').val() == "") {
                    toastr.error('Shipping method is required');
                } else if ($('#shipping_address_id').val() == "") {
                    toastr.error('Shipping address is required');
                } else if (!$('.agree_term').prop('checked')) {
                    toastr.error('You have to agree to website terms and conditions');
                } else {
                    // Nếu các điều kiện được thỏa mãn, chuyển hướng đến trang thanh toán của PayPal
                    let form = $('#checkOutForm');
                    form.attr('action', "{{ route('user.paypal.payment') }}"); // Đặt lại action của form
                    form.submit(); // Gửi form để chuyển hướng đến PayPal
                }
            });

            // submit checkout form for COD payment
            $('#submitCheckoutCOD').on('click', function(e) {
                e.preventDefault();
                // Here you can skip shipping method validation if COD doesn't require it
                if ($('#shipping_address_id').val() == "") {
                    toastr.error('Shipping address is required');
                } else if (!$('.agree_term').prop('checked')) {
                    toastr.error('You have to agree to website terms and conditions');
                } else {
                     // Nếu các điều kiện được thỏa mãn, chuyển hướng đến trang thanh toán của PayPal
                     let form = $('#checkOutForm');
                    form.attr('action', "{{ route('user.cod.payment') }}"); // Đặt lại action của form
                    form.submit(); // Gửi form để chuyển hướng đến PayPal
                }
            });
        });
    </script>
@endpush

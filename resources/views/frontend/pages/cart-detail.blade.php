@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} || Cart Details
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
                        <h4>xem giỏ hàng</h4>
                        <ul>
                            <li><a href="#">trang chủ</a></li>
                            <li><a href="#">sản phẩm</a></li>
                            <li><a href="#">xem giỏ hàng</a></li>
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
                                            CART VIEW PAGE START
                                        ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            Mục sản phẩm
                                        </th>

                                        <th class="wsus__pro_name">
                                            Chi tiết sản phẩm
                                        </th>

                                        <th class="wsus__pro_tk">
                                            Giá
                                        </th>

                                        <th class="wsus__pro_tk">
                                            Tổng
                                        </th>

                                        <th class="wsus__pro_select">
                                            Số lượng
                                        </th>

                                        <th class="wsus__pro_icon">
                                            <a href="#" class="common_btn clear_cart">Xoá giỏ hàng</a>
                                        </th>
                                    </tr>
                                    @foreach ($cartItems as $item)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img"><img src="{{ asset($item->options->image) }}"
                                                    alt="product" class="img-fluid w-100">
                                            </td>

                                            <td class="wsus__pro_name">
                                                <p>{!! $item->name !!}</p>
                                                @foreach ($item->options->variants as $key => $variant)
                                                    <span>{{ $key }}: {{ $variant['name'] }}
                                                        ({{ $settings->currency_icon . $variant['price'] }})
                                                    </span>
                                                @endforeach

                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6>{{ number_format($item->price, 0, ',', '.') }}&nbsp;{{ $settings->currency_icon }}
                                                </h6>
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6 id="{{ $item->rowId }}">
                                                    &nbsp;{{ number_format(($item->price + $item->options->variants_total) * $item->qty, 0, ',', '.') }}&nbsp;{{ $settings->currency_icon }}
                                                </h6>
                                            </td>

                                            <td class="wsus__pro_select">
                                                <div class="product_qty_wrapper">
                                                    <button class="btn btn-danger product-decrement">-</button>
                                                    <input class="product-qty" data-rowid="{{ $item->rowId }}"
                                                        type="text" min="1" max="100"
                                                        value="{{ $item->qty }}" readonly />
                                                    <button class="btn btn-success product-increment">+</button>
                                                </div>
                                            </td>

                                            <td class="wsus__pro_icon">
                                                <a href="{{ route('cart.remove-product', $item->rowId) }}"><i
                                                        class="far fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @if (count($cartItems) === 0)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_icon" rowspan="2" style="width:100%">
                                                Giỏ hàng trống!
                                            </td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>Tổng tiền giỏ hàng</h6>
                        <p>Tổng cộng: <span
                                id="sub_total">{{ number_format(getCartTotal(), 0, ',', '.') }}{{ $settings->currency_icon }}</span>
                        </p>
                        <p>Phiếu giảm giá(-): <span
                                id="discount">{{ number_format(getCartDiscount(), 0, ',', '.') }}{{ $settings->currency_icon }}</span>
                        </p>
                        <p class="total"><span>Tổng tiền:</span> <span
                                id="cart_total">{{ number_format(getMainCartTotal(), 0, ',', '.') }}</span></p>
                        <form id="coupon_form">
                            <input type="text" placeholder="Coupon Code" name="coupon_code"
                                value="{{ session()->has('coupon') ? session()->get('coupon')['coupon_code'] : '' }}">
                            <button type="submit" class="common_btn">áp dụng</button>
                        </form>
                        <a class="common_btn mt-4 w-100 text-center" href="{{ route('user.checkout') }}">Kiểm tra</a>
                        <a class="common_btn mt-1 w-100 text-center" href="{{ route('home') }}"><i
                                class="fab fa-shopify"></i> Tiếp tục mua sắm</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        @if ($cartpage_banner_section->banner_one->status == 1)
                            <a href="{{ $cartpage_banner_section->banner_one->banner_url }}">
                                <img class="img-gluid"
                                    src="{{ asset($cartpage_banner_section->banner_one->banner_image) }}" alt="">
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        @if ($cartpage_banner_section->banner_two->status == 1)
                            <a href="{{ $cartpage_banner_section->banner_two->banner_url }}">
                                <img class="img-gluid"
                                    src="{{ asset($cartpage_banner_section->banner_two->banner_image) }}" alt="">
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                                              CART VIEW PAGE END
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

            // Function to format number with thousands separator
            function formatCurrency(amount) {
                return parseInt(amount).toLocaleString('vi-VN');
            }

            // Increment product quantity
            $('.product-increment').on('click', function() {
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) + 1;
                let rowId = input.data('rowid');
                let maxQuantity = parseInt(input.attr('max')); // Lấy số lượng tồn kho từ thuộc tính max

                // Kiểm tra nếu số lượng vượt quá tồn kho
                if (quantity > maxQuantity) {
                    toastr.error('Số lượng vượt quá số lượng có sẵn trong kho!');
                    return;
                }

                updateCartQuantity(rowId, quantity, input);
            });

            // Decrement product quantity
            $('.product-decrement').on('click', function() {
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) - 1;
                let rowId = input.data('rowid');

                // Không cho giảm xuống nhỏ hơn 1
                if (quantity < 1) {
                    quantity = 1;
                }

                updateCartQuantity(rowId, quantity, input);
            });

            // Function to update cart quantity
            function updateCartQuantity(rowId, quantity, input) {
                input.val(quantity); // Cập nhật giá trị input trước khi gửi request

                $.ajax({
                    url: "{{ route('cart.update-quantity') }}",
                    method: 'POST',
                    data: {
                        rowId: rowId,
                        qty: quantity // Truyền số lượng mới (qty)
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            let productId = '#' + rowId;
                            let totalAmount =
                                formatCurrency(data.product_total) +
                                "{{ $settings->currency_icon }}";
                            $(productId).text(totalAmount); // Cập nhật tổng tiền cho sản phẩm

                            renderCartSubTotal(); // Cập nhật tổng tiền của giỏ hàng
                            calculateCouponDiscount(); // Nếu có áp dụng mã giảm giá

                            toastr.success(data.message);
                        } else if (data.status === 'error') {
                            toastr.error(data.message);
                        }
                    },
                    error: function(data) {
                        toastr.error('Error updating cart.');
                    }
                });
            }

            // Get subtotal of cart and put it on DOM
            function renderCartSubTotal() {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('cart.sidebar-product-total') }}",
                    success: function(data) {
                        $('#sub_total').text(formatCurrency(data) + " {{ $settings->currency_icon }}");
                    },
                    error: function(data) {
                        toastr.error('Error fetching cart subtotal.');
                    }
                });
            }

            // Calculate discount amount if coupon is applied
            function calculateCouponDiscount() {
                $.ajax({
                    method: 'GET',
                    url: "{{ route('coupon-calculation') }}",
                    success: function(data) {
                        if (data.status === 'success') {
                            $('#discount').text(
                                `${formatCurrency(data.discount)} {{ $settings->currency_icon }}`);
                            $('#cart_total').text(
                                `${formatCurrency(data.cart_total)} {{ $settings->currency_icon }}`
                            );
                        }
                    },
                    error: function(data) {
                        toastr.error('Error calculating coupon discount.');
                    }
                });
            }
            // clear cart
            $('.clear_cart').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Bạn có chắc chắn không?',
                    text: "Hành động này sẽ xóa giỏ hàng của bạn!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, clear it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'get',
                            url: "{{ route('clear.cart') }}",
                            success: function(data) {
                                if (data.status === 'success') {
                                    window.location.reload();
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        })
                    }
                })
            })
            // applay coupon on cart
            $('#coupon_form').on('submit', function(e){
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                method: 'GET',
                url: "{{ route('apply-coupon') }}",
                data: formData,
                success: function(data) {
                   if(data.status === 'error'){
                    toastr.error(data.message)
                   }else if (data.status === 'success'){
                    calculateCouponDiscount()
                    toastr.success(data.message)
                   }
                },
                error: function(data) {
                    console.log(data);
                }
            })

        })
        });
    </script>
@endpush

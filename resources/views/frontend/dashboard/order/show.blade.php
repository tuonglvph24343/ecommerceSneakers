@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ $settings->site_name }} || Đơn hàng
@endsection

@section('content')
    @php
        // Kiểm tra và giải mã JSON, nếu không có dữ liệu, tạo đối tượng trống
        $address = $order->order_address ? json_decode($order->order_address) : (object) [];
        $shipping = $order->shpping_method ? json_decode($order->shpping_method) : (object) [];
        $coupon = $order->coupon ? json_decode($order->coupon) : (object) [];
    @endphp
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layouts.sidebar')

            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> Chi tiết đơn hàng</h3>
                        <div class="wsus__dashboard_profile">

                            <section id="" class="invoice-print">
                                <div class="">
                                    <div class="wsus__invoice_area">
                                        <div class="wsus__invoice_header">
                                            <div class="wsus__invoice_content">
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                        <div class="wsus__invoice_single">
                                                            <h5>Thông tin thanh toán</h5>
                                                            <h6>{{ $address->name }}</h6>
                                                            <p>{{ $address->email }}</p>
                                                            <p>{{ $address->phone }}</p>
                                                            <p>{{ $address->address }}, {{ $address->city }},
                                                                {{ $address->state }}, {{ $address->zip }}</p>
                                                            <p>{{ $address->country }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                                        <div class="wsus__invoice_single text-md-center">
                                                            <h5>Thông tin vận chuyển</h5>
                                                            <h6>{{ $address->name }}</h6>
                                                            <p>{{ $address->email }}</p>
                                                            <p>{{ $address->phone }}</p>
                                                            <p>{{ $address->address }}, {{ $address->city }},
                                                                {{ $address->state }}, {{ $address->zip }}</p>
                                                            <p>{{ $address->country }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4">
                                                        <div class="wsus__invoice_single text-md-end">
                                                            <h5>Mã đơn hàng: #{{ $order->invocie_id }}</h5>
                                                            <h6>Trạng thái đơn hàng:
                                                                {{ config('order_status.order_status_admin')[$order->order_status]['status'] }}
                                                            </h6>
                                                            <p>Phương thức thanh toán: {{ $order->payment_method }}</p>
                                                            <p>Trạng thái thanh toán:
                                                                @if ($order->payment_status === 0)
                                                                    Đang chờ xử lý
                                                                @elseif($order->payment_status === 1)
                                                                    Đã hoàn thành
                                                                @else
                                                                    Không xác định
                                                                @endif
                                                            </p>
                                                            <p>Mã giao dịch id: {{ $order->transaction->transaction_id }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wsus__invoice_description">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th class="name">
                                                                Sản phẩm
                                                            </th>
                                                            <th class="wsus__pro_img">
                                                                Hình ảnh
                                                            </th>

                                                            <th class="amount">
                                                                Giá
                                                            </th>
                                                            <th class="quentity">
                                                                Số lượng
                                                            </th>
                                                            <th class="total">
                                                                Tổng
                                                            </th>
                                                            <th class="amount">
                                                                Đánh giá
                                                            </th>
                                                        </tr>
                                                        @foreach ($order->orderProducts as $product)
                                                            @php
                                                                $variants = json_decode($product->variants);
                                                                $productUrl = route(
                                                                    'product-detail',
                                                                    $product->product->slug,
                                                                );
                                                            @endphp
                                                            <tr>
                                                                <td class="name">
                                                                    <p><a
                                                                            href="{{ $productUrl }}">{{ $product->product_name }}</a>
                                                                    </p>
                                                                    @foreach ($variants as $key => $item)
                                                                        <span>{{ $key }} : {{ $item->name }}
                                                                            ({{ number_format($item->price, 0, ',', '.') }}{{ $settings->currency_icon }})
                                                                        </span>
                                                                    @endforeach
                                                                </td>
                                                                <td class="wsus__pro_img"><img
                                                                        src="{{ asset($product->product->thumb_image) }}"
                                                                        alt="product" class="img-fluid w-100">
                                                                </td>

                                                                <td class="amount">
                                                                    {{ number_format($product->unit_price, 0, ',', '.') }}
                                                                    {{ $settings->currency_icon }}
                                                                </td>
                                                                <td class="quentity">{{ $product->qty }}</td>
                                                                <td class="total">
                                                                    {{ number_format($product->unit_price * $product->qty, 0, ',', '.') }}
                                                                    {{ $settings->currency_icon }}
                                                                </td>
                                                                <td class="amount"><a href="{{ $productUrl }}"><button
                                                                            class="nav-link">Đánh giá </button></a></td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wsus__invoice_footer">
                                            <p><span>Tổng :</span>
                                                {{ number_format(@$order->sub_total, 0, ',', '.') }}{{ @$settings->currency_icon }}
                                            </p>
                                            <p><span>Chi phí vận chuyển(+):</span>
                                                {{ number_format(@$shipping->cost, 0, ',', '.') }}
                                                {{ @$settings->currency_icon }}
                                            </p>
                                            <p><span>Phiếu giảm giá(-):</span>
                                                {{ number_format(@$coupon->discount ? $coupon->discount : 0, 0, ',', '.') }}
                                                {{ @$settings->currency_icon }}
                                            </p>
                                            <p><span>Tổng giá :</span>
                                                {{ number_format(@$order->amount, 0, ',', '.') }}{{ @$settings->currency_icon }}
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- Nút hủy đơn hàng -->
                            <div class="mt-3 text-center">
                                @if (
                                    $order->order_status !== 'canceled' &&
                                        $order->order_status !== 'delivered' &&
                                        $order->order_status !== 'dropped_off' &&
                                        $order->order_status !== 'shipped' &&
                                        $order->order_status !== 'out_for_delivery')
                                    <button id="cancel_order" class="btn btn-danger">Hủy đơn hàng</button>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#cancel_order').on('click', function() {
                if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')) {
                    let orderId = "{{ $order->id }}";

                    $.ajax({
                        url: "{{ route('user.order.cancel') }}", // Sử dụng route Laravel
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: orderId,
                            status: 'canceled' // Chuyển trạng thái đơn hàng thành 'canceled'
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                alert(response.message);
                                location.reload(); // Tải lại trang để cập nhật giao diện
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText); // Kiểm tra lỗi từ server
                            alert('Có lỗi xảy ra, vui lòng thử lại!');
                        }
                    });
                }
            });
        });
    </script>
@endpush

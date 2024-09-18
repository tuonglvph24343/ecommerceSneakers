@php
    $address = json_decode($order->order_address);
    $shipping = json_decode($order->shpping_method);
    $coupon = json_decode($order->coupon);

@endphp
@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">

        <div class="section-header">
            <h1>Đơn hàng</h1>
        </div>
        {{-- <div class="mb-3">
            <a href="{{ route('admin.order.index') }}" class="btn btn-primary">Thoát</a>
        </div> --}}
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2></h2>
                                <div class="invoice-number">Đơn hàng #{{ $order->invocie_id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Người nhận hóa đơn:</strong><br>
                                        <b>Tên:</b> {{ $address->name }}<br>
                                        <b>Email: </b> {{ $address->email }}<br>
                                        <b>Số điện thoại:</b> {{ $address->phone }}<br>
                                        <b>Địa chỉ:</b> {{ $address->address }},<br>
                                        {{ $address->city }}, {{ $address->state }}, {{ $address->zip }}<br>
                                        {{ $address->country }}
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Người nhận hóa đơn:</strong><br>
                                        <b>Tên:</b> {{ $address->name }}<br>
                                        <b>Email: </b> {{ $address->email }}<br>
                                        <b>Số điện thoại:</b> {{ $address->phone }}<br>
                                        <b>Địa chỉ:</b> {{ $address->address }},<br>
                                        {{ $address->city }}, {{ $address->state }}, {{ $address->zip }}<br>
                                        {{ $address->country }}
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Thông tin thanh toánn:</strong><br>
                                        <b>Phương thức:</b> {{ $order->payment_method }}<br>
                                        <b>Mã giao dịch: </b>{{ @$order->transaction->transaction_id }} <br>
                                        <b>Trạng thái: </b> {{ $order->payment_status === 1 ? 'Hoàn thành' : 'Chờ xử lý' }}
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Ngày đặt hàng:</strong><br>
                                        {{ date('d F, Y', strtotime($order->created_at)) }}<br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Tóm tắt đơn hàng</div>
                            <p class="section-lead">Tất cả các mục ở đây không thể bị xóa.</p>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th data-width="40">#</th>
                                        <th>Sản phẩm</th>
                                        <th>Biến thể</th>
                                        <th>Tên nhà cung cấp</th>
                                        <th class="text-center">Giá</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-right"> Tổng cộng</th>
                                    </tr>
                                    @foreach ($order->orderProducts as $product)
                                        @php
                                            $variants = json_decode($product->variants);
                                        @endphp
                                        <tr>
                                            <td>{{ ++$loop->index }}</td>
                                            @if (isset($product->product->slug))
                                                <td><a target="_blank"
                                                        href="{{ route('product-detail', $product->product->slug) }}">{{ $product->product_name }}</a>
                                                </td>
                                            @else
                                                <td>{{ $product->product_name }}</td>
                                            @endif
                                            <td>
                                                @foreach ($variants as $key => $variant)
                                                    <b>{{ $key }}:</b> {{ $variant->name }} (
                                                    {{ $settings->currency_icon }}{{ $variant->price }} )
                                                @endforeach
                                            </td>
                                            <td>{{ $product->vendor->shop_name }}</td>

                                            <td class="text-center">
                                                {{ $settings->currency_icon }}{{ $product->unit_price }} </td>
                                            <td class="text-center">{{ $product->qty }}</td>
                                            <td class="text-right">
                                                {{ $settings->currency_icon }}{{ $product->unit_price * $product->qty + $product->variant_total }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for=""> Trạng thái thanh toán</label>

                                            <select name="" id="payment_status" class="form-control"
                                                data-id="{{ $order->id }}">
                                                <option {{ $order->payment_status === 0 ? 'selected' : '' }} value="0">
                                                    Đang chờ xử lý</option>
                                                <option {{ $order->payment_status === 1 ? 'selected' : '' }} value="1">
                                                    Đã hoàn thành</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for=""> Trạng thái đơn hàng</label>
                                            <select name="order_status" id="order_status" data-id="{{ $order->id }}"
                                                class="form-control">
                                                @foreach (config('order_status.order_status_admin') as $key => $orderStatus)
                                                    <option {{ $order->order_status === $key ? 'selected' : '' }}
                                                        value="{{ $key }}">{{ $orderStatus['status'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Tổng phụ</div>
                                        <div class="invoice-detail-value">{{ $settings->currency_icon }}
                                            {{ $order->sub_total }}</div>
                                    </div>
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Vận chuyển (+)</div>
                                        <div class="invoice-detail-value">{{ $settings->currency_icon }}
                                            {{ @$shipping->cost }}</div>
                                    </div>
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Mã giảm giá (-)</div>
                                        <div class="invoice-detail-value">{{ $settings->currency_icon }}
                                            {{ @$coupon->discount ? @$coupon->discount : 0 }}</div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Tổng cộng</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">
                                            {{ $settings->currency_icon }} {{ $order->amount }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    <button class="btn btn-warning btn-icon icon-left print_invoice"><i class="fas fa-print"></i>
                        In</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('#order_status').on('change', function() {
                let status = $(this).val();
                let id = $(this).data('id');

                // Check if the current order status is 'delivered' or 'canceled'
                let currentStatus = "{{ $order->order_status }}";
                if (currentStatus === 'delivered' || currentStatus === 'canceled') {
                    toastr.warning('Trạng thái đơn hàng đã giao hoặc đã hủy không thể thay đổi.');
                    $(this).val(currentStatus); // Reset to the original status
                    return;
                }
                

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.order.status') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message)
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            })

            $('#payment_status').on('change', function() {
                let status = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.payment.status') }}",
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message)
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            })

            $('.print_invoice').on('click', function() {
                let printBody = $('.invoice-print');
                let originalContents = $('body').html();

                $('body').html(printBody.html());

                window.print();

                $('body').html(originalContents);

            })
        })
    </script>
@endpush

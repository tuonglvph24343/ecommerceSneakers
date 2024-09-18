@extends('frontend.layouts.master')

@section('title')
    {{$settings->site_name}} || Phiếu giảm giá
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
                        <h4>Phiếu giảm giá</h4>
                        <ul>
                            <li><a href="{{route('home')}}">Trang chủ</a></li>
                            <li><a href="javascript:;">Phiếu giảm giá</a></li>
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
        VOUCHER SECTION START
    ==============================-->
    <section id="voucher_section" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-primary text-white text-center">
                            <h4>Thông tin phiếu giảm giá</h4>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="mb-3"><strong>Tên phiếu giảm giá:</strong> {!!@$voucher->name!!}</h5>
                            <p><strong>Số lượng có hạn hãy nhanh tay!!!</strong></p>
                            <p><strong>Ngày bắt đầu:</strong> {!!@$voucher->start_date!!}</p>
                            <p><strong>Ngày kết thúc:</strong> {!!@$voucher->end_date!!}</p>

                            <!-- Mã giảm giá và nút sao chép -->
                            <div class="form-group mt-4">
                                <label for="voucherCode" class="form-label"><strong>Mã giảm giá:</strong></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="voucherCode" value="{!!@$voucher->code!!}" readonly>
                                    <button class="btn btn-success" onclick="copyVoucherCode()">Sao chép</button>
                                </div>
                            </div>

                            <!-- Thông báo sao chép thành công -->
                            <div id="copySuccess" class="alert alert-success mt-3" style="display: none;">
                                Đã sao chép mã: <span id="copiedCode"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        VOUCHER SECTION END
    ==============================-->

    <!-- Script sao chép mã giảm giá -->
    <script>
        function copyVoucherCode() {
            // Lấy phần tử input chứa mã giảm giá
            var copyText = document.getElementById("voucherCode");

            // Chọn nội dung của input
            copyText.select();
            copyText.setSelectionRange(0, 99999); // Cho thiết bị di động

            // Sao chép nội dung vào clipboard
            document.execCommand("copy");

            // Hiển thị thông báo đã sao chép
            document.getElementById("copySuccess").style.display = "block";
            document.getElementById("copiedCode").innerText = copyText.value;
        }
    </script>
@endsection

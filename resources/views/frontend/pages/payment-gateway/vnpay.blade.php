<div class="tab-pane fade" id="v-pills-vnpay" role="tabpanel"
aria-labelledby="v-pills-home-tab">
    <div class="row">
        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">
                <form action="{{ route('user.vnpay.payment') }}" method="GET">
                    @csrf
                    <a href="{{ route('user.vnpay.payment') }}" class="btn btn-primary">Thanh toán bằng VNPay</a>
                </form>
            </div>
        </div>
    </div>
</div>
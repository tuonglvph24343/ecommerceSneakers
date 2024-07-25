<div class="tab-pane fade" id="v-pills-razorpay" role="tabpanel"
aria-labelledby="v-pills-home-tab">
    <div class="row">
        <div class="col-xl-12 m-auto">
            <div class="wsus__payment_area">
                {{-- @php
                    $razorpaySetting = \App\Models\RazorpaySetting::first();
                    $total = getFinalPayableAmount();
                    $payableAmount = round($total * $razorpaySetting->currency_rate, 2);

                @endphp --}}
                <form action="{{route('user.vnpay.payment')}}" method="POST">
                    @csrf
                    <a class="nav-link common_btn text-center" href="{{route('user.vnpay.payment')}}">Pay with VnPay</a>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
<div class="card border">
    <div class="card-body">
        <form action="{{route('admin.paypal-setting.update', 1)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Trạng thái paypal</label>
                <select name="status" id="" class="form-control">
                    <option {{$paypalSetting->status === 1 ? 'selected' : ''}} value="1">Khích hoạt</option>
                    <option {{$paypalSetting->status === 0 ? 'selected' : ''}} value="0">Vô hiệu hoá</option>
                </select>
            </div>

            <div class="form-group">
                <label>Chế độ tài khoản</label>
                <select name="mode" id="" class="form-control">
                    <option {{$paypalSetting->mode === 0 ? 'selected' : ''}} value="0">Sandbox</option>
                    <option {{$paypalSetting->mode === 1 ? 'selected' : ''}} value="1">Live</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tên quốc gia</label>
                <select name="country_name" id="" class="form-control select2">
                    <option value="">Select</option>
                    @foreach (config('settings.country_list') as $country)
                        <option {{$country === $paypalSetting->country_name ? 'selected' : ''}} value="{{$country}}">{{$country}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Tên tiền tệ</label>
                <select name="currency_name" id="" class="form-control select2">
                    <option value="">Select</option>
                    @foreach (config('settings.currecy_list') as $key => $currency)
                        <option {{$currency === $paypalSetting->currency_name ? 'selected' : ''}} value="{{$currency}}">{{$key}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Tỷ giá tiền tệ ( Theo {{$settings->currency_name}} )</label>
                <input type="text" class="form-control" name="currency_rate" value="{{$paypalSetting->currency_rate}}">
            </div>
            <div class="form-group">
                <label>Paypal Client Id</label>
                <input type="text" class="form-control" name="client_id" value="{{$paypalSetting->client_id}}">
            </div>
            <div class="form-group">
                <label>Khóa bí mật PayPal</label>
                <input type="text" class="form-control" name="secret_key" value="{{$paypalSetting->secret_key}}">
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>
</div>

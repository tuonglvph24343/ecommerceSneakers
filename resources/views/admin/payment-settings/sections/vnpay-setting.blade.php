<div class="tab-pane fade " id="list-vnpay" role="tabpanel" aria-labelledby="list-vnpay-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.vnpay-setting.update', 1)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Trạng thái Vnpay</label>
                    <select name="status" id="" class="form-control">
                        <option {{$vnpaySetting->status === 1 ? 'selected' : ''}} value="1">Kích hoạt</option>
                        <option {{$vnpaySetting->status === 0 ? 'selected' : ''}} value="0">Vô hiệu hoá</option>
                    </select>
                </div>
    
    
                <div class="form-group">
                    <label>Tên quốc gia</label>
                    <select name="country_name" id="" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('settings.country_list') as $country)
                            <option {{$country === $vnpaySetting->country_name ? 'selected' : ''}} value="{{$country}}">{{$country}}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="form-group">
                    <label>Tên tiền tệ</label>
                    <select name="currency_name" id="" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('settings.currecy_list') as $key => $currency)
                            <option {{$currency === $vnpaySetting->currency_name ? 'selected' : ''}} value="{{$currency}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="form-group">
                    <label>Tỷ giá tiền tệ ( Theo {{$settings->currency_name}} )</label>
                    <input type="text" class="form-control" name="currency_rate" value="{{$vnpaySetting->currency_rate}}">
                </div>
    
                <div class="form-group">
                    <label>Vnpay Key</label>
                    <input type="text" class="form-control" name="vnpay_key" value="{{$vnpaySetting->vnpay_key}}">
                </div>
                <div class="form-group">
                    <label>Vnpay Secret Key</label>
                    <input type="text" class="form-control" name="vnpay_secret_key" value="{{$vnpaySetting->vnpay_secret_key}}">
                </div>
    
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
    </div>
    
    @push('scripts')
        <script>
            $('.select2').select2()
        </script>
    @endpush
    
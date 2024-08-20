<div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.cod-setting.update', 1)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Trạng thái thanh toán khi giao hàng</label>
                    <select name="status" id="" class="form-control">
                        <option {{$codSetting->status === 1 ? 'selected' : ''}} value="1">Khích hoạt</option>
                        <option {{$codSetting->status === 0 ? 'selected' : ''}} value="0">Vô hiệu hoá</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
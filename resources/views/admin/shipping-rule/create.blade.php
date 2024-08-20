@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Quy tắc vận chuyển</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tạo quy tắt vận chuyển</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.shipping-rule.store')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>

                        <div class="form-group">
                            <label for="inputState">Kiểu</label>
                            <select id="" class="form-control shipping-type" name="type">
                              <option value="flat_cost">Số tiền cố định</option>
                              <option value="min_cost">Số tiền đặt hàng tối thiểu</option>
                            </select>
                        </div>

                        <div class="form-group min_cost d-none">
                            <label>Số tiền tối thiểu</label>
                            <input type="text" class="form-control" name="min_cost" value="">
                        </div>

                        <div class="form-group">
                            <label> Chi phí</label>
                            <input type="text" class="form-control" name="cost" value="">
                        </div>


                        <div class="form-group">
                            <label for="inputState">Trạng thái</label>
                            <select id="inputState" class="form-control" name="status">
                              <option value="1">Hoạt động</option>
                              <option value="0">Không hoạt động</option>
                            </select>
                        </div>
                        <button type="submmit" class="btn btn-primary">Create</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $('body').on('change', '.shipping-type', function(){
            let value = $(this).val();

            if(value != 'min_cost'){
                $('.min_cost').addClass('d-none')
            }else {
                $('.min_cost').removeClass('d-none')
            }
        })
    })
</script>
@endpush

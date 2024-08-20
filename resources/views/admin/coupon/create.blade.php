@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Phiếu giảm giá</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tạo phiếu giảm giá</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.coupons.store')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>

                        <div class="form-group">
                            <label>Mã code</label>
                            <input type="text" class="form-control" name="code" value="">
                        </div>


                        <div class="form-group">
                            <label>Số lượng</label>
                            <input type="text" class="form-control" name="quantity" value="">
                        </div>

                        <div class="form-group">
                            <label>Số lần sử dụng tối đa trên mỗi người</label>
                            <input type="text" class="form-control" name="max_use" value="">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ngày bắt đầu</label>
                                        <input type="text" class="form-control datepicker" name="start_date" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ngày kết thúc</label>
                                    <input type="text" class="form-control datepicker" name="end_date" value="">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputState">Loại giảm giá</label>
                                    <select id="inputState" class="form-control sub-category" name="discount_type">
                                      <option value="percent">Phần trăm (%)</option>
                                      <option value="amount">Số tiền ({{$settings->currency_icon}})</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Giá trị giảm giá</label>
                                    <input type="text" class="form-control" name="discount" value="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputState">Trạng thái</label>
                            <select id="inputState" class="form-control" name="status">
                              <option value="1">Hoạt động</option>
                              <option value="0">Không hoạt động</option>
                            </select>
                        </div>
                        <button type="submmit" class="btn btn-primary">Tạo</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection

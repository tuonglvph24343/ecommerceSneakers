@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Các mục biến thể</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tạo mục biến thể</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.products-variant-item.store')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Tên biến thể</label>
                            <input type="text" class="form-control" name="variant_name" value="{{$variant->name}}" readonly>
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" name="variant_id" value="{{$variant->id}}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="product_id" value="{{$product->id}}">
                        </div>

                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>

                        <div class="form-group">
                            <label>Giá <code>(Đặt giá là 0 để làm cho nó miễn phí)</code></label>
                            <input type="text" class="form-control" name="price" value="">
                        </div>

                        <div class="form-group">
                            <label for="inputState">Mặc định</label>
                            <select id="inputState" class="form-control" name="is_default">
                                <option value="">Select</option>
                              <option value="1">Có</option>
                              <option value="0">Không</option>
                            </select>
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

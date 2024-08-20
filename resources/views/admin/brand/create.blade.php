@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Thương hiệu</h1>

          </div>

          <div class="section-body">
            <div class="mb-3">
              <a href="{{ route('admin.brand.index') }}" class="btn btn-primary">Thoát</a>
          </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tạo thương hiệu</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.brand.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" class="form-control" name="logo">
                        </div>

                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>

                        <div class="form-group">
                            <label for="inputState">Nổi bậc</label>
                            <select id="inputState" class="form-control" name="is_featured">
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

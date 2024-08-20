@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Hãng</h1>

          </div>

          <div class="section-body">
            <div class="mb-3">
              <a href="{{ route('admin.brand.index') }}" class="btn btn-primary">Thoát</a>
          </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Cập nhật hãng</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.brand.update', $brand->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Xem trước</label>
                            <br>
                            <img width="200" src="{{asset($brand->logo)}}" alt="">
                        </div>
                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" class="form-control" name="logo">
                        </div>

                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" value="{{$brand->name}}">
                        </div>

                        <div class="form-group">
                            <label for="inputState">Nổi bật</label>
                            <select id="inputState" class="form-control" name="is_featured">
                              <option value="">Select</option>
                              <option {{$brand->is_featured == 1 ? 'selected': ''}} value="1">Có</option>
                              <option {{$brand->is_featured == 0 ? 'selected': ''}} value="0">Không</option>
                            </select>
                          </div>
                        <div class="form-group">
                            <label for="inputState">Trạng thái</label>
                            <select id="inputState" class="form-control" name="status">
                                <option {{$brand->status == 1 ? 'selected' : ''}} value="1">Hoạt động</option>
                                <option {{$brand->status == 0 ? 'selected' : ''}} value="0">Không hoạt động</option>
                            </select>
                        </div>
                        <button type="submmit" class="btn btn-primary">Cập nhật</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>
@endsection

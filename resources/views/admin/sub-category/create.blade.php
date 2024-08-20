@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Danh mục phụ</h1>
          </div>
          <div class="mb-3">
            <a href="{{ route('admin.sub-category.index') }}" class="btn btn-primary">Thoát</a>
        </div>
          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tạo danh mục phụ </h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.sub-category.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="inputState">Danh mục</label>
                            <select id="inputState" class="form-control" name="category">
                              <option value="">Select</option>
                              @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" value="">
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

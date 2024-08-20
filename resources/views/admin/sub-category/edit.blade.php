@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Danh mục phụ</h1>
          </div>

          <div class="section-body">
            <div class="mb-3">
              <a href="{{ route('admin.sub-category.index') }}" class="btn btn-primary">Thoát</a>
          </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Cập nhật danh mục phụ</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.sub-category.update', $subCategory->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="inputState">Danh mục </label>
                            <select id="inputState" class="form-control" name="category">
                              <option value="">Select</option>
                              @foreach ($categories as $category)
                                <option {{$category->id == $subCategory->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" value="{{$subCategory->name}}">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Trạng thái</label>
                            <select id="inputState" class="form-control" name="status">
                              <option {{$subCategory->status == 1 ? 'selected': ''}} value="1">Hoạt động</option>
                              <option {{$subCategory->status == 0 ? 'selected': ''}} value="0">Không hoạt động</option>
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

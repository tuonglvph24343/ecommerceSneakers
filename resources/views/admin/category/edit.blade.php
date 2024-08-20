@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Danh mục</h1>
        </div>

        <div class="section-body">
            <div class="mb-3">
                <a href="{{ route('admin.category.index') }}" class="btn btn-primary">Thoát</a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sửa danh mục</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Icon</label>
                                    <div>
                                        <button class="btn btn-primary" data-icon="{{ $category->icon }}"
                                            data-selected-class="btn-danger" data-unselected-class="btn-info"
                                            role="iconpicker" name="icon"></button>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Trạng thái</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $category->status == 1 ? 'selected' : '' }} value="1">Hoạt động</option>
                                        <option {{ $category->status == 0 ? 'selected' : '' }} value="0">Không hoạt động
                                        </option>
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

@extends('admin.layouts.master')

@section('content')
<!-- Nội Dung Chính -->
<section class="section">
    <div class="section-header">
        <h1>Sản phẩm</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tạo Sản Phẩm</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Hình Ảnh</label>
                                <input type="file" class="form-control" name="image">
                            </div>

                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" class="form-control" name="name" value="{{old('name')}}">
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputState">Danh Mục</label>
                                        <select id="inputState" class="form-control main-category" name="category">
                                            <option value="">Chọn</option>
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputState">Danh Mục Con</label>
                                        <select id="inputState" class="form-control sub-category" name="sub_category">
                                            <option value="">Chọn</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputState">Danh Mục Cháu</label>
                                        <select id="inputState" class="form-control child-category" name="child_category">
                                            <option value="">Chọn</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputState">Thương Hiệu</label>
                                <select id="inputState" class="form-control" name="brand">
                                    <option value="">Chọn</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>SKU</label>
                                <input type="text" class="form-control" name="sku" value="{{old('sku')}}">
                            </div>

                            <div class="form-group">
                                <label>Giá</label>
                                <input type="text" class="form-control" name="price" value="{{old('price')}}">
                            </div>

                            <div class="form-group">
                                <label>Giá Ưu Đãi</label>
                                <input type="text" class="form-control" name="offer_price" value="{{old('offer_price')}}">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ngày Bắt Đầu Ưu Đãi</label>
                                        <input type="text" class="form-control datepicker" name="offer_start_date" value="{{old('offer_start_date')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ngày Kết Thúc Ưu Đãi</label>
                                        <input type="text" class="form-control datepicker" name="offer_end_date" value="{{old('offer_end_date')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Số Lượng Trong Kho</label>
                                <input type="number" min="0" class="form-control" name="qty" value="{{old('qty')}}">
                            </div>

                            <div class="form-group">
                                <label>Link Video</label>
                                <input type="text" class="form-control" name="video_link" value="{{old('video_link')}}">
                            </div>

                            <div class="form-group">
                                <label>Mô Tả Ngắn</label>
                                <textarea name="short_description" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Mô Tả Dài</label>
                                <textarea name="long_description" class="form-control summernote"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="inputState">Loại Sản Phẩm</label>
                                <select id="inputState" class="form-control" name="product_type">
                                    <option value="">Chọn</option>
                                    <option value="new_arrival">Hàng Mới</option>
                                    <option value="featured_product">Nổi Bật</option>
                                    <option value="top_product">Sản Phẩm Top</option>
                                    <option value="best_product">Sản Phẩm Tốt Nhất</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tiêu Đề Seo</label>
                                <input type="text" class="form-control" name="seo_title" value="{{old('seo_title')}}">
                            </div>

                            <div class="form-group">
                                <label>Mô Tả Seo</label>
                                <textarea name="seo_description" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="inputState">Trạng Thái</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option value="1">Hoạt Động</option>
                                    <option value="0">Không Hoạt Động</option>
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

@push('scripts')
<script>
    $(document).ready(function() {
        $('body').on('change', '.main-category', function(e) {
            let id = $(this).val();
            $.ajax({
                method: 'GET',
                url: "{{route('admin.product.get-subcategories')}}",
                data: {
                    id: id
                },
                success: function(data) {
                    $('.sub-category').html('<option value="">Chọn</option>')

                    $.each(data, function(i, item) {
                        $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                    })
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        })

        /** lấy danh mục con **/
        $('body').on('change', '.sub-category', function(e) {
            let id = $(this).val();
            $.ajax({
                method: 'GET',
                url: "{{route('admin.product.get-child-categories')}}",
                data: {
                    id: id
                },
                success: function(data) {
                    $('.child-category').html('<option value="">Chọn</option>')

                    $.each(data, function(i, item) {
                        $('.child-category').append(`<option value="${item.id}">${item.name}</option>`)
                    })
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        })
    })
</script>
@endpush
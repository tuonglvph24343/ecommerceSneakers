@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Thư viện ảnh sản phẩm</h1>
          </div>
         <div class="mb-3">
            <a href="{{route('admin.products.index')}}" class="btn btn-primary">Quay lại</a>
         </div>
          <div class="section-body">
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h4>Sản phẩm: {{$product->name}}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.products-image-gallery.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Hình ảnh <code>(Hỗ trợ nhiều hình ảnh!)</code></label>
                                <input type="file" name="image[]" class="form-control" multiple>
                                <input type="hidden" name="product" value="{{$product->id}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Tải lên</button>
                        </form>
                    </div>

                  </div>
                </div>
              </div>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tất cả hình ảnh</h4>
                  </div>
                  <div class="card-body">
                    {{ $dataTable->table() }}
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

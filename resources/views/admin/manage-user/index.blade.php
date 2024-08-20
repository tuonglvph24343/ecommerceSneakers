@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Quản lí người dùng</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Tạo người dùng</h4>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.manage-user.create')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="">
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <input type="password" class="form-control" name="password" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Xác nhận mật khẩu</label>
                                    <input type="password" class="form-control" name="password_confirmation" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputState">Vai trò</label>
                            <select id="inputState" class="form-control" name="role">
                                <option value="">Select</option>
                              <option value="user">Người dùng</option>
                              <option value="vendor">Nhà cung cấp</option>
                              <option value="admin">Admin</option>

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

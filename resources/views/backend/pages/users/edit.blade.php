@extends('backend.layouts.app')

@section('title')
Sửa người dùng
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
    <section class="col-lg-6">
      <div class="mb-3">
        <a class="btn btn-danger btn-icon-left m-b-10" href="{{route('users.index')}}" type="button"><i
            class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
      </div>
    </section>
    <section class="col-lg-6"></section>
    <section class="col-lg-12 connectedSortable">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-user-edit mr-1"></i>
            CHỈNH SỬA THÀNH VIÊN
          </h3>
          <div class="card-tools">
            <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize">
              <i class="fas fa-expand"></i>
            </button>
            <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="card-body">
              <div class="row">
                  <div class="form-group col-6">
                      <label>Tên</label>
                      <input class="form-control" value="{{ $user->name }}" type="text" name="name">
                  </div>
                  <div class="form-group col-6">
                      <label>Email</label>
                      <input class="form-control" value="{{ $user->email }}" type="email" name="email" readonly>
                  </div>
                  
                  <div class="form-group col-6">
                      <label>Tổng thanh toán</label>
                      <input type="text" readonly class="text-bold form-control fs-bold text-success" value="{{number_format($user->totalPayment)}} đ"></input>
                    </div>
                  <div class="form-group col-6">
                      <label>Gói sử dụng</label>
                      {{ $user->package->name }}
                      <p>Tổng: <span class="text-success">{{$user->subscription->total_capacity}} MB</span>
                      <br>Đã dùng: <span class="text-danger">{{$user->subscription->used_capacity}} MB</span>
                      </p>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Vai Trò</label>
                          <select class="form-control select2bs4" name="rule">
                              <option value="user" {{ $user->rule == 'user' ? 'selected' : '' }}>Người dùng</option>
                              <option value="admin" {{ $user->rule == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                          </select>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Trạng thái</label>
                          <select class="form-control select2bs4" name="banned">
                              <option value="0" {{ $user->banned == 0 ? 'selected' : '' }}>Hoạt động</option>
                              <option value="1" {{ $user->banned == 1 ? 'selected' : '' }}>Vô hiệu</option>
                          </select>
                      </div>
                  </div>
              </div>
              <br />
          </div>
          <div class="card-footer clearfix">
              <button class="btn btn-info btn-icon-left m-b-10" type="submit">
                  <i class="fas fa-save mr-1"></i>Lưu Ngay
              </button>
          </div>
      </form>
      
      </div>
    </section>
  
  </div>
</div>
@endsection
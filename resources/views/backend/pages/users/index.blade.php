@extends('backend.layouts.app')
@section('title')
Quản lí người dùng
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tổng thành viên</span>
                    <span class="info-box-number">{{$totalUsers}} thành viên</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Thành viên hoạt động</span>
                    <span class="info-box-number">{{$totalUserActives}}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-cog"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Thành viên ưu tú</span>
                    <span class="info-box-number">{{$userStars}}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-lock"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Tài khoản bị vô hiệu hoá</span>
                    <span class="info-box-number">{{$totalUserBanneds}} tài khoản</span>
                </div>
            </div>
        </div>
        <section class="col-lg-12 connectedSortable">
            <div class="card card-primary card-outline">
                <div class="card-header ">
                    <h3 class="card-title">
                        <i class="fas fa-users mr-1"></i>
                        DANH SÁCH THÀNH VIÊN
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i
                                class="fas fa-expand"></i>
                        </button>
                        <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">


                    <div class="table-responsive p-0">
                        <table id="" class=" datatable table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="5px;"></th>
                                    <th>Tài khoản</th>
                                    <th>Gói sử dụng</th>
                                    <th>Tổng thanh toán</th>
                                    <th>Tình trạng</th>
                                    <th>Thời gian tạo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                <tr>
                                    <td>
                                        {{$key}}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->package->name }}
                                        <p>Tổng: <span class="text-success">{{$user->subscription->total_capacity}} MB</span>
                                        <br>Đã dùng: <span class="text-danger">{{$user->subscription->used_capacity}} MB</span>
                                        </p>
                                        
                                    </td>
                                    <td>
                                        <span class="text-bold fs-bold text-success">{{number_format($user->totalPayment)}} đ</span>
                                    </td>
                                    <td>
                                        @if ($user->banned == 0)
                                        <span class="badge badge-success">Hoạt động</span>
                                        @else
                                        <span class="badge badge-error">Vô hiệu</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $user->created_at }}
                                    </td>
                                    <td>
                                        <a aria-label="" href="{{ route('users.edit', $user->id) }}"
                                            style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10"
                                            type="button">
                                            <i class="fas fa-edit mr-1"></i><span class="">Chỉnh sửa</span>
                                        </a>
                                       
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
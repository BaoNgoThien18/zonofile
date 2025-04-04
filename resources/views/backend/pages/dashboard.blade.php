@extends('backend.layouts.app')

@section('title')
    Dashboard
@endsection
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ number_format($totalRevenue) }}Đ</h3>
                        <p>Tổng doanh thu</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalUsers }}</h3>
                        <p>Tổng thành viên</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ number_format($totalUsedCapacity / 1024, 2) }}GB</h3>
                        <p>Tổng dung lượng đã sử dụng</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $totalFiles }}</h3>
                        <p>Tổng file trong hệ thống</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <!-- Thống kê hôm nay -->
            <div class="col-lg-4 col-6">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Thống kê hôm nay</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-success text-xl">
                                <i class="ion ion-ios-refresh-empty"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold"> {{ number_format($todayRevenue) }} Đ </span>
                                <span class="text-muted">DOANH THU</span>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold"> {{ $todayNewUsers }} </span>
                                <span class="text-muted">THÀNH VIÊN MỚI</span>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-info text-xl">
                                <i class="ion ion-card"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold"> {{ $todayNewFiles }}</span>
                                <span class="text-muted">SỐ LƯỢNG FILE</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Thống kê tuần -->
            <div class="col-lg-4 col-6">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Thống kê tuần</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-success text-xl">
                                <i class="ion ion-ios-refresh-empty"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold"> {{ number_format($weeklyRevenue) }} Đ </span>
                                <span class="text-muted">DOANH THU</span>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold"> {{ $weeklyNewUsers }} </span>
                                <span class="text-muted">THÀNH VIÊN MỚI</span>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-info text-xl">
                                <i class="ion ion-card"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold"> {{ $weeklyNewFiles }}</span>
                                <span class="text-muted">SỐ LƯỢNG FILE</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Thống kê tháng -->
            <div class="col-lg-4 col-6">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Thống kê tháng {{ \Carbon\Carbon::now()->month }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                            <p class="text-success text-xl">
                                <i class="ion ion-ios-refresh-empty"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold"> {{ number_format($monthlyRevenue) }} Đ </span>
                                <span class="text-muted">DOANH THU</span>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border-bottom mb-0">
                            <p class="text-danger text-xl">
                                <i class="ion ion-ios-people-outline"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold"> {{ $monthlyNewUsers }} </span>
                                <span class="text-muted">THÀNH VIÊN MỚI</span>
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-0">
                            <p class="text-info text-xl">
                                <i class="ion ion-card"></i>
                            </p>
                            <p class="d-flex flex-column text-right">
                                <span class="font-weight-bold"> {{ $monthlyNewFiles }}</span>
                                <span class="text-muted">SỐ LƯỢNG FILE</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <section class="col-lg-12 connectedSortable">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-history mr-1"></i>
                            500 THANH TOÁN GẦN ĐÂY
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
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table id="" class="datatable table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Username</th>
                                        <th>Số tiền</th>
                                        <th>Phương thức</th>
                                        <th>Trạng thái</th>
                                        <th>Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($historyPayments as $key => $payment)
                                        <tr>
                                            <td>
                                                {{ $key }}
                                            </td>
                                            <td>
                                                {{ $payment->username }}
                                            </td>
                                            <td>
                                                {{ number_format($payment->amount) }}
                                            </td>
                                            <td>
                                                {{ $payment->payment_method }}
                                            </td>
                                            <td>
                                                {{ $payment->status == 'success' ? 'Thành công' : 'Thất bại' }}
                                            </td>
                                            <td>
                                                {{ $payment->created_at }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <section class="col-lg-12 connectedSortable">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-history mr-1"></i>
                            500 NHẬT KÝ HOẠT ĐỘNG GẦN ĐÂY
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
                    <div class="card-body">
                        <div class="table-responsive p-0">
                            <table id="" class=" datatable table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Username</th>
                                        <th width="40%">Action</th>
                                        <th>Thời gian</th>
                                        <th>Ip</th>
                                        <th width="25%">Thiết bị </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($historyLogs as $key => $log)
                                        <tr>
                                            <td>
                                                {{ $key }}
                                            </td>
                                            <td>
                                                {{ $log->username }}
                                            </td>

                                            <td>
                                                {{ $log->action }}
                                            </td>
                                            <td>
                                                {{ $log->created_at }}
                                            </td>
                                            <td>
                                                {{ $log->ip }}
                                            </td>

                                            <td>
                                                {{ $log->device }}
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

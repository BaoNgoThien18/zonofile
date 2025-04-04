@extends('backend.layouts.app')

@section('title')
Quản lí dòng tiền
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">

        <section class="col-lg-12 connectedSortable">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-history mr-1"></i>
                        Lịch sử thanh toán
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
                                        {{$key}}
                                    </td>
                                    <td>
                                        {{$payment->username}}
                                    </td>
                                    <td>
                                        {{number_format($payment->amount)}}
                                    </td>
                                    <td>
                                        {{$payment->payment_method}}
                                    </td>
                                    <td>
                                        @if ($payment->status == 'success')
                                        <span class="badge badge-success">Thành công</span>
                                        @elseif (($payment->status == 'error'))
                                        <span class="badge badge-error">Thất bại</span>
                                        @endif

                                    </td>
                                    <td>
                                        {{$payment->created_at}}
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
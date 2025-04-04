@extends('backend.layouts.app')

@section('title')
Nhật ký hoạt động
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">

        <section class="col-lg-12 connectedSortable">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-history mr-1"></i>
                        Nhật ký hoạt động
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize">
                            <i class="fas fa-expand"></i>
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
                                @foreach ($logs as $key => $log)
                                <tr>
                                    <td>
                                        {{$key}}
                                    </td>
                                    <td>
                                        {{$log->username}}
                                    </td>

                                    <td>
                                        {{$log->action}}
                                    </td>
                                    <td>
                                        {{$log->created_at}}
                                    </td>
                                    <td>
                                        {{$log->ip}}
                                    </td>

                                    <td>
                                        {{$log->device}}
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
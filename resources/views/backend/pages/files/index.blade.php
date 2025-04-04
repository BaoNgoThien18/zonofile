@extends('backend.layouts.app')

@section('title')
Quản lí tệp
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Tổng số file</span>
                    <span class="info-box-number">{{$totalFiles}} file</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-trash-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">File bị xóa</span>
                    <span class="info-box-number">{{$totalFilesIsDeleted}} file</span>
                </div>
            </div>
        </div>
        <section class="col-lg-12 connectedSortable">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-file-alt mr-1"></i>
                        Danh Sách Files
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
                        <table id="" class="datatable table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="5px;"></th>
                                    <th>File</th>
                                    <th>Dung lượng</th>
                                    <th>Lượt Tải</th>
                                    <th>Ngày Tải Lên</th>
                                    <th>Người Tải Lên</th>
                                    <th>Trạng thái</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($files as $key => $file)
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>
                                        {{$file->title}}
                                    </td>
                                    <td> {{ $file->size }}</td>
                                    <td>{{ $file->count_downloads }}</td>
                                    <td>{{$file->created_at}}</td>
                                    <td>{{$file->user->email}}</td>
                                    <td>
                                        @if ($file->is_deleted == 0)
                                        <span class="badge badge-success">Hoạt động</span>
                                        @elseif ($file->is_deleted == 1)
                                        <span class="badge badge-error">Đã xóa</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('files.edit',1)}}"
                                            class="btn btn-info btn-sm btn-icon-left m-b-10">
                                            <i class="fas fa-edit mr-1"></i>Edit
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
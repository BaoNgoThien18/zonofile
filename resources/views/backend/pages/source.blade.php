@extends('backend.layouts.app')

@section('title')
    Quản lí tài nguyên
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <section class="col-lg-12 connectedSortable">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-archive mr-1"></i>
                        TỔNG HỢP TÀI NGUYÊN
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
                        <table id="datatable2" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Tên Tài Khoản</th>
                                    <th>Tên Tài Nguyên</th>
                                    <th>Tổng Tài Nguyên Hiện Có</th>
                                    <th>Tài Nguyên Đã Sử Dụng</th>
                                    <th>Tài Nguyên Còn Lại</th>
                                    <th width="10%">Chỉnh Sửa Phân Bổ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>0</td>
                                    <td>admin</td>
                                    <td><a href="https://example.com/admin/resource-edit/1">Băng thông</a></td>
                                    <td>1000 GB</td>
                                    <td>700 GB</td>
                                    <td>300 GB</td>
                                    <td>
                                        <a href="https://example.com/admin/resource-edit/1" class="btn btn-primary btn-sm">
                                            Chỉnh sửa
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>user123</td>
                                    <td><a href="https://example.com/admin/resource-edit/2">Lưu trữ dữ liệu</a></td>
                                    <td>500 GB</td>
                                    <td>200 GB</td>
                                    <td>300 GB</td>
                                    <td>
                                        <a href="https://example.com/admin/resource-edit/2" class="btn btn-primary btn-sm">
                                            Chỉnh sửa
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>server_manager</td>
                                    <td><a href="https://example.com/admin/resource-edit/3">Máy chủ</a></td>
                                    <td>10</td>
                                    <td>8</td>
                                    <td>2</td>
                                    <td>
                                        <a href="https://example.com/admin/resource-edit/3" class="btn btn-primary btn-sm">
                                            Chỉnh sửa
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>dev_team</td>
                                    <td><a href="https://example.com/admin/resource-edit/4">RAM</a></td>
                                    <td>64 GB</td>
                                    <td>48 GB</td>
                                    <td>16 GB</td>
                                    <td>
                                        <a href="https://example.com/admin/resource-edit/4" class="btn btn-primary btn-sm">
                                            Chỉnh sửa
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection


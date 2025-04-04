@extends('backend.layouts.app')

@section('title')
    Thêm gói
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                            <i class="fas fa-image mr-1"></i>
                            Danh sách gói
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
                            <div class="d-flex mb-2 justify-content-end">
                                <a class="btn btn-primary btn-sm" href="{{ route('packages.create') }}">
                                    <i class="fas fa-plus mr-1"></i> Thêm gói
                                </a>
                            </div>
                            <table id="datatable1" class="table table-bordered table-striped table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Giá</th>
                                        <th>Thời gian</th>
                                        <th>Dung lượng gói</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $row)
                                        <tr>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ number_format($row->price) }}Đ</td>
                                            <td>{{ $row->capacity }} MB</td>
                                            <td>{{ $row->duration }} Ngày</td>
                                            <td>{{ $row->status == 1 ? 'Hiển thị' : 'Ẩn' }}</td>
                                            <td style="white-space:nowrap">
                                                <a aria-label="" href="{{ route('packages.edit', $row->id) }}"
                                                    style="color:white;" class="btn btn-info btn-sm btn-icon-left m-b-10"
                                                    type="button">
                                                    <i class="fas fa-edit mr-1"></i><span class="">Chỉnh sửa</span>
                                                </a>
                                                <form action="{{ route('packages.destroy', $row->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button style="color:white;"
                                                        class="btn btn-danger btn-sm btn-icon-left m-b-10" type="submit">
                                                        <i class="fas fa-trash mr-1"></i><span class="">Xóa</span>
                                                    </button>
                                                </form>
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

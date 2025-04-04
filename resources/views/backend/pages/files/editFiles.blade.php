@extends('backend.layouts.app')

@section('title')
    Chỉnh sửa tệp
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-6">
                <div class="mb-3">
                    <a class="btn btn-danger btn-icon-left m-b-10" href="{{ route('files.index') }}" type="button"><i
                            class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
                </div>
            </section>
            <section class="col-lg-6"></section>
            <section class="col-lg-12 connectedSortable">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-file mr-1"></i>
                            CHỈNH SỬA FILES
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
                    <form action="{{ route('files.update', $file->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tên file (*)</label>
                                        <input type="text" class="form-control" value="{{ $file->title }}"
                                            name="title" readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dung lượng</label>
                                        <input type="text" class="form-control" value="{{ $file->size }}"
                                            name="size" readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Lượt Tải</label>
                                        <input type="text" class="form-control" value="30" name="downloads"
                                            readonly />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Lượt Xem</label>
                                        <input type="text" class="form-control" value="200" name="views" readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ngày Tải Lên</label>
                                        <input type="text" class="form-control" value="{{ $file->created_at }}"
                                            name="created_at" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Người Tải Lên</label>
                                        <input type="text" class="form-control" value="{{ $file->user->email }}"
                                            name="user_email" readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <select class="form-control" name="is_deleted">
                                            <option value="0" {{ $file->is_deleted == 0 ? 'selected' : '' }}>Hoạt động
                                            </option>
                                            <option value="1" {{ $file->is_deleted == 1 ? 'selected' : '' }}>Khóa
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer clearfix">
                            <button aria-label="" class="btn btn-info btn-icon-left m-b-10" type="submit">
                                <i class="fas fa-save mr-1"></i>Lưu Ngay
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection

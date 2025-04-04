@extends('backend.layouts.app')

@section('title')
Thêm gói
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <section class="col-lg-6">
            <div class="mb-3">
              <a class="btn btn-danger btn-icon-left m-b-10" href="{{route('packages.index')}}" type="button"><i class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
            </div>
          </section>
        <section class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">
                        <i class="fas fa-image mr-1"></i>
                        Thêm gói </h3>
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
                <form action="{{ route('packages.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label>Nhập tên gói:</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="col-12">
                            <label>Mô tả:</label>
                            <textarea name="description" class="form-control summernote"></textarea>
                        </div>
                        <div class="col-12">
                            <label>Giá:</label>
                            <input type="number" name="price" class="form-control">
                        </div>
                        <div class="col-12">
                            <label>Thời gian (Ngày):</label>
                            <input type="number" name="duration" class="form-control">
                        </div>
                        <div class="col-12">
                            <label>Dung lượng (MB): </label>
                            <input type="number" name="capacity" class="form-control">
                        </div>
                        <div class="col-12">
                            <label>Trạng thái:</label>
                            <select class="form-control select2bs4" name="status">
                                <option value="1">
                                    Hiện</option>
                                <option value="0">
                                    Ẩn</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info btn-icon-left mt-3 m-b-10">
                        <i class="fas fa-save mr-1"></i>Lưu Ngay
                    </button>
                </form>
               </div>
            </div>
        </section>
    </div>
</div>

@endsection
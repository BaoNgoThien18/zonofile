@extends('backend.layouts.app')

@section('title')
Quản lí giao diện
@endsection
@php

use App\Models\Setting;

@endphp
@section('content')
<div class="container-fluid">
    <div class="row">
        <section class="col-lg-12 connectedSortable">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-image mr-1"></i>
                        THAY ĐỔI GIAO DIỆN WEBSITE
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
                <form action="{{ route('settings.updateAllSetting') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="form-group">
                                    <p><img width="100px" src="{{ asset((Setting::findByName('logo_light') ?? '')) }}" /></p>
                                    <label for="logo_light">Logo Light</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="logo_light">
                                            <label class="custom-file-label" for="logo_light">Chọn file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="form-group">
                                    
                                    <p><img width="100px" src="{{ asset((Setting::findByName('logo_dark') ?? '')) }}" /></p>
                                    <label for="logo_dark">Logo Dark</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="logo_dark">
                                            <label class="custom-file-label" for="logo_dark">Chọn file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="form-group">
                                    
                                    <p><img width="16px" src="{{asset((Setting::findByName('favicon') ?? '')) }}" /></p>
                                    <label for="favicon">Favicon</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="favicon">
                                            <label class="custom-file-label" for="favicon">Chọn file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="form-group">
                                    <p><img width="16px" src="{{asset((Setting::findByName('logo_icon') ?? '')) }}" /></p>
                                    <label for="logo_icon">Logo Icon</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="logo_icon">
                                            <label class="custom-file-label" for="logo_icon">Chọn file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <button name="SaveSettings" class="btn btn-info btn-icon-left m-b-10" type="submit">
                            <i class="fas fa-save mr-1"></i>Lưu Ngay
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
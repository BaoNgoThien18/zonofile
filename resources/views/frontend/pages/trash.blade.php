@extends('frontend.layouts.app')
@section('title')
Thùng rác
@endsection
@section('content')


<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">

        <div class="col-12">
            <div class="alert alert-light-dark light  fade show text-dark border-left-wrapper" style="display: none"
                role="alert" id="upload-status">
                <p><b id="upload-fileTitle"></b></p>
                <p><b id="upload-uploaded"></b></p>
                <p>
                <div class="progress sm-progress-bar overflow-visible progress-border-primary">
                    <div id="upload-percentage"
                        class="progress-bar-animated small-progressbar bg-primary rounded-pill progress-bar-striped"
                        role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"><span
                            class="animate-circle"></span></div>
                </div>
                </p>
            </div>
        </div>
        <div class="col-xl-12 col-md-12 box-col-12">
            <div class="file-content">
                <div class="card py-3">
                    <div class="card-body">
                        <ul class="list-group list-group-flush" id="fileItems">
                            <table class="project-summary table dataTable" id="basic-6">
                                <thead>
                                    <tr>
                                        <th scope="col" class="">Tên</th>
                                        <th scope="col" class="">Thời gian xóa</th>
                                        <th scope="col" class="text-end">Thao tác</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($files as $fileItem)
                                    <tr>
                                        <td>
                                            {{ $fileItem->title }}
                                        </td>

                                        <td>{{ $fileItem->updated_at }}</td>

                                        <td class="text-end">

                                            <button class="btn btn-light" onclick="restore({{ $fileItem->id }})"
                                                title="Khôi phục">
                                                <span>
                                                    <i data-feather="arrow-left-circle"></i>
                                                </span>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
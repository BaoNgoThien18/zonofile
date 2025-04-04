@extends('frontend.components.files')
@section('title')
Tất cả File
@endsection
@section('contentFiles')

<div class="card-body file-manager">
    <h5 class="mt-4 mb-2 f-w-700">Folders</h5>
    <ul class="folder" id="folders">
        @if ($folders->isEmpty())
            <p>Không có thư mục nào.</p>
        @else
            @foreach ($folders as $folder)
            <li class="folder-box">
                <a href="{{ url('folder' , [$folder->id]) }}">
                    <div class="d-block">
                        <i class="f-44 fa fa-folder txt-warning"></i>
                        <i class="fa fa-ellipsis-v me-0 f-14 ellips"></i>
                        <div class="mt-3">
                            <h6>{{ $folder->name }}</h6>
                            <p>{{ $folder->fileCounts }} files<span class="pull-right"> <i class="fa fa-clock-o"> </i> {{ $folder->timeAgo }}</span></p>
                        </div>
                    </div>
                </a>
            </li>
            @endforeach
        @endif
    </ul>

    <h5 class="mt-4 mb-2 f-w-700">Files</h5>
    <ul class="d-flex flex-wrap files-content">
        @if ($files->isEmpty())
            <p>Không có tệp tin nào.</p>
        @else
            @foreach ($files as $file)
            <li class="folder-box d-flex align-items-center me-0 col-12 col-sm-6 col-md-4">
                <div class="d-flex align-items-center files-list">
                    <div class="flex-shrink-0 file-left">
                        {!! $file->icon !!}
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="file-title">{{ $file->title }}</h6>
                        <p>{{ $file->timeAgo }}, {{ $file->realSize }}</p>
                    </div>
                </div>
            </li>
            @endforeach
        @endif
    </ul>
</div>

@endsection

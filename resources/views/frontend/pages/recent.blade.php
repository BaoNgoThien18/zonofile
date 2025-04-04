@extends('frontend.components.files')
@section('title')
Gần đây
@endsection
@section('contentFiles')


<div class="card-body file-manager">
    <h5 class="mt-4 mb-2 f-w-700">Folders</h5>
    <ul class="folder" id="folders">
        @foreach ($folders as $folder)


        <li class="folder-box">
            <a href="{{ url('folder' , [$folder->id]) }}">
                <div class="d-block"><i class="f-44 fa fa-folder txt-warning"></i><i class="fa fa-ellipsis-v me-0 f-14 ellips"></i>
                    <div class="mt-3">
                        <h6>{{ $folder->name }}</h6>
                        <p>{{ $folder->fileCounts }} files<span class="pull-right"> <i class="fa fa-clock-o"> </i> {{ $folder->timeAgo }}</span></p>
                    </div>
                </div>
            </a>
        </li>


        @endforeach
    </ul>


    <h5 class="mt-4 mb-2 f-w-700">Files</h5>
    <ul class="d-flex flex-row files-content folder" id="files">
        @foreach ($files as $file)
        <li class="folder-box d-flex align-items-center">
            <div class="d-flex align-items-center files-list">
                <div class="flex-shrink-0 file-left">{!! $file->icon !!}</i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6>{{ $file->title }}</h6>
                    <p>{{ $file->timeAgo }}</p>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>

@endsection

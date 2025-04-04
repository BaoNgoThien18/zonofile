@extends('frontend.layouts.app')
@section('content')


<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">

        <div class="col-12">
            <div class="alert alert-light-dark light  fade show text-dark border-left-wrapper" style="display: none" role="alert" id="upload-status">

                <p><b id="upload-fileTitle"></b></p>
                <p><b id="upload-uploaded"></b></p>
                <p>
                    <div class="progress sm-progress-bar overflow-visible progress-border-primary">
                        <div id="upload-percentage" class="progress-bar-animated small-progressbar bg-primary rounded-pill progress-bar-striped" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                    </div>
                </p>
            </div>
        </div>


        <div class="col-xl-3 box-col-12">
            <div class="md-sidebar job-sidebar"><a class="btn btn-primary md-sidebar-toggle" href="javascript:void(0)">
                    Chức năng</a>
                <div class="md-sidebar-aside custom-scrollbar">
                    <div class="file-sidebar">
                        <div class="card">
                            <div class="card-body custom-scrollbar">
                                <ul>
                                    <li>
                                        <a href="{{url('file')}}">
                                            <div class="btn btn-light"><i data-feather="home"> </i>Home </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('recent')}}">
                                            <div class="btn btn-light"><i data-feather="clock"></i>Gần đây </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{url('trash')}}">
                                            <div class="btn btn-light"><i data-feather="trash-2"></i>Đã xóa </div>
                                        </a>
                                    </li>
                                </ul>
                                <hr>
                                <ul>
                                    <li>
                                        <div class="m-t-15">
                                            <div class="progress sm-progress-bar mb-3">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $subscription->used_capacity / $subscription->total_capacity * 100 }}%" aria-valuemax="100"></div>
                                            </div>
                                            <span class="fs-6">Đã dùng <span class="fs-3 used-capacity">{{
                                                    round($subscription->used_capacity / 1024, 2) }} GB</span> / <span class="total-capacity">{{ round($subscription->total_capacity /
                                                    1024, 2) }} GB</span></span>
                                        </div>
                                    </li>
                                </ul>
                                <hr>
                                <ul>
                                    <li>
                                        <a class="" href="{{url('upgrade')}}">
                                            <div class="btn btn-outline-primary"><i data-feather="grid"> </i>Xem các gói
                                            </div>
                                        </a>
                                    </li>
                                    @if(!$subscription)
                                    <li>
                                        <div class="pricing-plan">
                                            <h6>Phiên bản dùng thử</h6>
                                            <h5>Miễn Phí</h5>
                                            <p>5 GB</p>
                                        </div>
                                    </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-md-12 box-col-12">
            <div class="file-content">
                <div class="card">
                    <div class="card-header">
                        <div class="d-md-flex d-sm-block">
                            <form class="form-inline" action="#" method="get">
                                <div class="form-group d-flex align-items-center mb-0"> <i class="fa fa-search"></i>
                                    <input class="form-control-plaintext" id="search" type="text" placeholder="Tìm kiếm...">
                                </div>
                            </form>
                            <div class="flex-grow-1 text-end">
                                <form method="POST" enctype="multipart/form-data" id="">
                                    <div class="btn btn-primary" onclick="storeFoler()"> <i data-feather="plus-square"></i>Folder mới</div>
                                    @csrf
                                    <div class="d-inline-flex">
                                        <label class="btn btn-outline-primary ms-2" for="inpuUploadFiles" style="cursor: pointer;">
                                            <input class="form-control" id="inpuUploadFiles" type="file" required multiple style="display: none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload upload-files">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                <polyline points="17 8 12 3 7 8"></polyline>
                                                <line x1="12" y1="3" x2="12" y2="15">
                                                </line>
                                            </svg>
                                            Tệp mới
                                        </label>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    @yield('contentFiles')
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUploadFolder" tabindex="-1" role="dialog" aria-labelledby="modalUploadFolder" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-toggle-wrapper social-profile text-start dark-sign-up">
                <h3 class="modal-header justify-content-center txt-dark">Tải lên Folder</h3>
                <div class="modal-body">

                    <div class="col-md-12">
                        <div class="py-3">
                            <label class="form-label txt-dark" for="">Tên Foler</label>
                            <input class="form-control" id="modalUploadFolder-name" type="text">
                            <input type="hidden" id="modalUploadFolder-parent_id" value="{{ isset($folder) ? $folder->id : '' }}">
                        </div>
                        <button class="btn btn-primary" id="btnUploadFolder">Tải lên</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@section('script')
<script type="module">
    window.Echo.channel('RealtimeUploadPercentage')
                .listen('.RealtimeUploadPercentage', (data) => {

                    $('#upload-fileTitle').html(data.data.fileTitle)
                    $('#upload-uploaded').html(`${data.data.uploaded} / ${data.data.fileSize} ${data.data.percentage}%`)
                    $('#upload-percentage').css('width', data.data.percentage + '%')
                    $('#upload-status').css('display', 'block')

                });
</script>
@endsection


<!-- Chức năng Upload Folder -->
<script>
    $('#btnUploadFolder').click(function() {

        $.ajax({
            url: "{{ route('folder.store') }}"
            , type: 'POST'
            , data: {
                _token: '{{ csrf_token() }}'
                , parent_id: null
                , name: $('#modalUploadFolder-name').val()
            }
            , success: function(response) {
                if (response.status == 'error') {
                    alertError(response.msg);
                } else {
                    alertSuccess(response.msg, 1000);
                }
            }
            , error: function() {
                alertError('Có lỗi xảy ra');
            }
        });


    });

</script>
<script>
    $(document).ready(function() {
        $('#inpuUploadFiles').change(function() {
            var files = $('#inpuUploadFiles').prop('files');
            var formData = new FormData();

            for (var i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            formData.append('_token', '{{ csrf_token() }}');
            $('#upload-status').show();

            $.ajax({
                url: '{{ route('file.store') }}', 
                type: 'POST', 
                data: formData, 
                contentType: false, 
                processData: false,

                success: function(response) {
                    if (response.status == 'success') {
                        alertSuccess(response.message);
                        setTimeout(function() {
                            location.reload(); // Reload lại trang
                        }, 2000); // 2 giây
                    } else {
                        alertError(response.message);
                    }
                }
                , error: function() {
                    alertError('Có lỗi xảy ra');
                }
            });
            $('#upload-status').css('display', 'none')

        });
    });

</script>
<script>
    function storeFoler() {
        $('#modalUploadFolder').modal('show')
    }

</script>



@endsection


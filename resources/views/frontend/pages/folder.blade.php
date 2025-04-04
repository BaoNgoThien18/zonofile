@extends('frontend.layouts.app')
@section('title')
Folder
@endsection
@section('content')


<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">

        <div class="col-12">
            <div class="alert alert-light-dark light rounded shadow fade show text-dark border-left-wrapper" style="display: none"
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
                <div class="card">
                    <div class="card-header">
                        <div class="d-md-flex d-sm-block">
                          
                            <div class="flex-grow-1 text-end">
                                <form method="POST" enctype="multipart/form-data" id="">
                                    <div class="btn btn-primary" onclick="storeFoler()"> <i
                                            data-feather="plus-square"></i>Folder mới</div>
                                    @csrf
                                    <div class="d-inline-flex">
                                        <label class="btn btn-outline-primary ms-2" for="inpuUploadFiles"
                                            style="cursor: pointer;">
                                            <input class="form-control" id="inpuUploadFiles" type="file" required
                                                multiple style="display: none">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-upload upload-files">
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
                    <div class="card  mb-0">

                        <div class="card-body">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    @foreach ($breadcrumbs as $breadcrumbsItem)
                                    @if ($loop->last)
                                    <li class="fs-4 breadcrumb-item active">
                                        {{ $breadcrumbsItem->name }}
                                    </li>
                                    @else
                                    <li class=" fs-4 breadcrumb-item">
                                        <a class=" fs-4 "
                                            href="{{ url('folder', $breadcrumbsItem->id) }}">{{ $breadcrumbsItem->name }}</a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ol>
                            </nav>
                          
                            <ul class="list-group list-group-flush" id="fileItems">
                                <div class="table-responsive">
                                <table class="table" id="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 3%"><input type="checkbox" id="select-all" class="select-all-checkbox"></th>
                                            <th scope="col" class="" style="width: 20%">Tên</th>
                                            <th scope="col" class="" style="width: 20%">Thời gian</th>
                                            <th scope="col" class="" style="width: 20%">Kích thước</th>
                                            <th scope="col" class="" style="width: 10%"></th>
                                            <th scope="col" class="text-end">Thao tác</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        
                                            @foreach ($folders as $folderItem)
                                            <tr>
                                            <td style="width: 3%"></td>
                                           
                                                <td>
                                                    <a href="{{ url('folder', [$folderItem->id]) }}">
                                                        <i class="icon-folder"></i>
                                                        {{ $folderItem->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $folderItem->updated_at }}</td>
                                                <td>...</td>
                                                <td></td>
                                                <td></td>

                                            </tr>
                                        @endforeach

                                        @foreach ($files as $fileItem)
                                        <tr>
                                        <td style="width:3%"><input type="checkbox" data-id="{{$fileItem->id}}" class="row-select"></td>
                                            <td>
                                            {{ $fileItem->title }}
                                            </td>

                                            <td>{{ $fileItem->updated_at }}</td>
                                            <td>{{ $fileItem->realSize }}</td>
                                            <td>{!! $fileItem->iconRule !!}</td>

                                            <td class="text-end text-nowrap">

                                                <button class="btn btn-light" onclick="remove({{ $fileItem->id }})">
                                                    <span>
                                                        <i data-feather="trash-2"></i>
                                                    </span>
                                                </button>

                                                <button id="btn-share"
                                                    data-clipboard-text="{{ url('shared/' . $fileItem->shared_id) }}"
                                                    class=" copy-btn btn btn-light"><span class=""><i
                                                            data-feather="link-2"></i></span></button>
                                                <button class="btn btn-light" onclick="options({{ $fileItem->id }})">
                                                    <span class="">
                                                    <i
                                                            data-feather="list"></i></span>
                                                        </button>
                                                </td>
                                        @endforeach
                                     
                                      
                                        </tbody>
                                    </table>

                                    </div>
                                    <div>
                                        <button style="display:none" class="btn btn-light  mt-3" id="removeAllFileBtn" onclick="removeAllFileTemplate()">Xóa đã chọn</button>
                                    </div>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Lắng nghe sự kiện trả về tốc độ tải file  --}}
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

<div class="modal fade" id="modalUploadFolder" tabindex="-1" role="dialog" aria-labelledby="modalUploadFolder"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-toggle-wrapper social-profile text-start dark-sign-up">
                <h3 class="modal-header justify-content-center txt-dark">Tải lên Folder</h3>
                <div class="modal-body">

                    <div class="col-md-12">
                        <div class="py-3">
                            <label class="form-label txt-dark" for="">Tên Foler</label>
                            <input class="form-control" id="modalUploadFolder-name" type="text">
                            <input type="hidden" id="modalUploadFolder-parent_id" value="{{ $folder->id }}">
                        </div>
                        <button class="btn btn-primary" id="btnUploadFolder">Tải lên</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


{{-- modal remove file --}}
<div class="modal fade" id="modal-remove" tabindex="-1" aria-labelledby="modal-remove" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-6" id="">Xác nhận xoá <span id="modal-remove-name" class="text-danger"></span>
                </h2>
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-toggle-wrapper">
                    <p class="text-center">Sau khi xoá file sẽ còn giữ lại 30 ngày </p>
                    <div class="text-center">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Huỷ bỏ</button>
                        <button class="btn btn-primary " id="modal-remove-btn-confirm" data-fileId="" type="button">Xác
                            nhận</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  {{-- modal options  --}}
  <div class="modal fade" id="modal-options" tabindex="-1" aria-labelledby="modal-options" style="display: none;"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h2 class="modal-title fs-6" id=""><span id="modal-options-title"
                      class="text-danger"></span></h2>
              <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">


            {{-- data --}}
            <input type="hidden" id="modal-options-fileId" value="">

              <div class="modal-toggle-wrapper">
                  <p type="button" class="fs-6 " onclick="remove()">
                      <i class="icon-trash"></i> Xoá file 
                  </p>
                  <hr>
                  <p type="button" class="fs-6  hover" onclick="download()">
                      <i class="icon-cloud-down"></i> Tải xuống
                  </p>
                  <hr>

                  <p type="button" class="fs-6 " onclick="share()">
                      <i class="icon-share"></i> Chia sẻ
                  </p>
                  <hr>


                  <p type="button" class="fs-6 " onclick="rename()">
                      <i class="icon-pencil-alt2"></i> Đổi tên
                  </p>
              </div>
          </div>
      </div>
  </div>
</div>

{{-- modal share  --}}
<div class="modal fade" id="modal-share" tabindex="-1" aria-labelledby="modal-share" style="display: none;"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title fs-6" id=""><span id="modal-share-title"
                    class="text-danger"></span></h2>
            <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">


          {{-- data --}}

            <div class="modal-toggle-wrapper">

                <div class="d-flex">
                    <input type="text" id="modal-share-email" class="form-control" placeholder="Nhập email muốn gửi file">
                    {{-- <i class="fa fa-spinner fa-spin"></i> --}}
                    <button type="button" class="btn btn-primary ms-2" onclick="shareFileToMail()">GỬI</button>
                </div>

                <div class="mt-5">
                   <div class="row">
                    <div class="col-12">
                    <h5 class="py-2 mt-2">Quyền truy cập</h5>
                    </div>
                    <div class="col-md-8 col-12">
                        <select class="form-control"name="" id="onchangeRule">
                            <option value="view">Có thể xem</option>
                            <option value="download">Có thể tải xuống</option>
                            <option value="0">Chỉ mình tôi</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-12">
                            <button id="modal-share-btn-link"
                                data-clipboard-text=""
                                class=" copy-btn btn btn-light"><span class=""><i
                                        data-feather="link-2"></i></span></button>
                    </div>
                   </div>
                    
                </div>
               
            </div>
        </div>

    </div>
</div>
</div>

{{-- modal rename  --}}
<div class="modal fade" id="modal-rename" tabindex="-1" aria-labelledby="modal-rename" style="display: none;"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title fs-6" id=""><span id="modal-rename-title"
                    class="text-danger"></span></h2>
            <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">


          {{-- data --}}
            <div class="modal-toggle-wrapper">

                <div class="d-flex">
                    <input type="text" id="modal-rename-newFileName" class="form-control" placeholder="Nhập tên file mới cần đổi">
                    {{-- <i class="fa fa-spinner fa-spin"></i> --}}
                    <button type="button" class="btn btn-primary ms-2" id="modal-rename-btnSubmit" >GỬI</button>
                </div>
               
            </div>
        </div>

    </div>
</div>
</div>



{{-- Chức năng lựa chọn nhiều chức năng  --}}
<script>
    function options(fileId) {

        // Gửi yêu cầu Ajax để lấy file
        $.ajax({
            url: "{{ url('/getFile') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Thêm CSRF token vào dữ liệu
                id: fileId
            },
            success: function(response) {
                $('#modal-options-title').html(response.data.title)
                $('#modal-options-fileId').val(fileId);
                $('#modal-options').modal('show');

                
            },
            error: function() {
                alertError('Có lỗi xảy ra');
            }
        });
    }
</script>




<script>

 

    $(document).ready(function() {

        var table = $("#table").DataTable({
            columnDefs: [
                {
                    orderable: false,
                    targets: 0
                }
            ],
            order: [],
            pageLength: 20,

            language: {
                search: "Tìm kiếm:",
                paginate: {
                    next: "Tiếp theo",
                    previous: "Trước đó"
                },
                info: "Hiển thị _START_ đến _END_ của _TOTAL_ mục",
                lengthMenu: "Hiển thị _MENU_ mục",
                zeroRecords: "Không tìm thấy dữ liệu nào",
                infoEmpty: "Không có dữ liệu để hiển thị",
                infoFiltered: "(lọc từ tổng số _MAX_ mục)"
            }
        });


        $('#select-all').on('click', function() {
        let isChecked = $(this).is(':checked');
        
        $('input[type="checkbox"]').each(function() {
            $(this).prop('checked', isChecked);
        });
        
        toggleRemoveButton();
    });

    $('input[type="checkbox"]').on('change', function() {
        toggleRemoveButton();
    });

    function toggleRemoveButton() {
        if ($('input[type="checkbox"]:checked').length > 0) {
            $('#removeAllFileBtn').css('display', 'block'); 
        } else {
            $('#removeAllFileBtn').css('display', 'none');  
        }
    }
});

function removeAllFileTemplate() {
    fileId = [];

    $('input[type="checkbox"]:checked').each(function() {
        fileId.push($(this).attr('data-id'));
    });
    console.log(fileId);
    removeAllFile(fileId);
}

</script>





<!-- Chức năng Upload Folder -->
<script>
$('#btnUploadFolder').click(function() {

    $.ajax({
        url: "{{ route('folder.store') }}",
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            parent_id: $('#modalUploadFolder-parent_id').val(),
            name: $('#modalUploadFolder-name').val()
        },
        success: function(response) {
            if (response.status == 'error') {
                alertError(response.msg);
            } else {
                alertSuccess(response.msg, 500);
            }
        },
        error: function() {
            alertError('Có lỗi xảy ra');
        }
    });


});
</script>

<script>
function storeFoler() {
    $('#modalUploadFolder').modal('show')
}
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
        formData.append('folder_id', '{{ $folder->id }}');
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
            },
            error: function() {
                alertError('Có lỗi xảy ra');
            }
        });
        $('#upload-status').css('display', 'none')

    });
});
</script>


@endsection
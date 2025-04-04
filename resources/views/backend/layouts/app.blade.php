<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>

    <base href="{{ env('APP_URL') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}" />

    <!-- Toast Alert -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/toastr/toastr.min.css') }}">

    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/jqvmap/jqvmap.min.css') }}" />
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.css') }}" />
    <!-- Sparkline -->
    <script src="{{ asset('backend/plugins/sparklines/sparkline.js') }}  "></script>
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/codemirror/codemirror.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/plugins/codemirror/theme/monokai.css') }}" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />

    @vite('resources/js/app.js')

</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper mt-3">
        <nav class="main-header navbar navbar-expand navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('') }}" class="nav-link">TRANG KHÁCH</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">ĐĂNG XUẤT</button>
                    </form>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ url('admin/dashboard') }}" class="brand-link">
                <center>
                    <img width="100px"
                        src="{{ isset($settings['logo_light']) ? asset($settings['logo_light']->value) : '' }}"
                        alt="Admin" />
                </center>
            </a>
            <div class="sidebar">

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item has-treeview">
                            <a href="{{ url('admin/dashboard') }}" class="nav-link {{ set_active('Dashboard') }} ">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Bảng Điều Khiển</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/users') }}" class="nav-link  {{ set_active('users.index') }}">
                                <i class="nav-icon fas fa-user-alt"></i>
                                <p>Thành Viên</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/files') }}" class="nav-link   {{ set_active('files.index') }}">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Quản Lý File
                                </p>
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/packages') }}"
                                class="nav-link   {{ set_active('packages.index') }}">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Quản Lý Gói
                                </p>
                            </a>

                        </li>
                        <li li class="nav-item">
                            <a href="" class="nav-link  {{ set_active('history.index') }}">
                                <i class="nav-icon fas fa-history"></i>
                                <p>
                                    Quản Lí Lịch Sử
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/logs') }}"
                                        class="nav-link  {{ set_active('history.index') }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nhật Ký Hoạt Động</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/topups') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lịch sử thanh toán</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/themes') }}" class="nav-link  {{ set_active('admin/themes') }}">
                                <i class="nav-icon fas fa-image"></i>
                                <p>Quản Lí Giao Diện</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('admin/settings') }}"
                                class="nav-link  {{ set_active('admin/settings') }}">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Cài Đặt Hệ Thống</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">

            <div class="content pt-3">
                @if (session('success'))
                    <script>
                        $(document).ready(function() {
                            $(document).Toasts('create', {
                                class: 'bg-success',
                                title: 'Thành Công!',
                                body: '{{ session('success') }}',
                                autohide: true,
                                delay: 3000
                            });
                        });
                    </script>
                @endif

                @if (session('error'))
                    <script>
                        $(document).ready(function() {
                            $(document).Toasts('create', {
                                class: 'bg-danger',
                                title: 'Lỗi',
                                body: '{{ session('error') }}',
                                autohide: true,
                                delay: 3000
                            });
                        });
                    </script>
                @endif

                @yield('content')

            </div>
        </div>
        {{--
      <script>
        $.ajax({
          url: "/update.php",
          type: "GET",
          dateType: "text",
          data: {},
          success: function (result) {},
        });
        $(function () {
          $("#datatable1").DataTable();
          $("#datatable2").DataTable();
        });
      </script> --}}

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.codeMirror').forEach(function(el) {
                CodeMirror.fromTextArea(el, {
                    mode: 'javascript', // Chế độ ngôn ngữ (ví dụ: 'javascript')
                    lineNumbers: true, // Hiển thị số dòng
                    theme: 'monokai', // Chủ đề giao diện (có thể tùy chỉnh)
                    lineWrapping: true, // Tự động xuống dòng khi hết chiều rộng
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300, // Chiều cao của trình soạn thảo
                minHeight: null, // Chiều cao tối thiểu
                maxHeight: null, // Chiều cao tối đa
                focus: true // Đặt focus vào trình soạn thảo khi khởi tạo
            });

            $('.datatable').DataTable({
                paging: true, // Bật phân trang
                searching: true, // Bật tìm kiếm
                ordering: true, // Bật sắp xếp cột
                info: true, // Hiển thị thông tin bảng
                autoWidth: false, // Không tự động tính toán chiều rộng cột
                dom: '<"d-flex justify-content-between mb-3"Bf>tip', // Đặt nút và ô tìm kiếm trong cùng một hàng
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
            });

            $('.toast').toast('show');
        });
    </script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge("uibutton", $.ui.button);
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('backend/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('backend/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
    <!-- CodeMirror -->
    <script src="{{ asset('backend/plugins/codemirror/codemirror.js') }}"></script>
    <script src="{{ asset('backend/plugins/codemirror/mode/css/css.js') }}"></script>
    <script src="{{ asset('backend/plugins/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('backend/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
</body>

</html>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ isset($settings['description']) && isset($settings['description']->value) ? $settings['description']->value : '' }}">
    <meta name="keywords" content="{{ isset($settings['keywords']) && isset($settings['keywords']->value) ? $settings['keywords']->value : '' }}">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ isset($settings['logo_icon']->value) ? asset($settings['logo_icon']->value) : '' }}" type="image/x-icon">
    <link rel="icon" href="{{ isset($settings['logo_icon']->value) ? asset($settings['logo_icon']->value) : '' }}" type="image/x-icon">
    <title>@yield('title')</title>
    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/themify.css')}}">
    <!-- Flag icon-->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/flag-icon.css')}}"> -->
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/feather-icon.css')}}">
    <!-- Plugins css start-->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/slick.css')}}"> -->

    <!-- Sweetalert -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/sweetalert2.css')}}">

    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owlcarousel.css')}}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{ asset('frontend/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/responsive.css')}}">
    <!-- latest jquery-->
    <script src="{{ asset('frontend/js/jquery.min.js')}}"></script>

    <!-- apex chart  -->
    <script src="{{ asset('frontend/js/apex-chart.js')}}"></script>

    {{-- Main js  --}}
    <script>
        const csrfToken = '{{ csrf_token() }}';
    </script>

    <style>
        .loader-wrapper {
            background: none;
        }
        th {
            text-transform: uppercase;
        }

        div#basic-6_paginate, div#basic-6_info
        { 
            padding-top: 20px !important; 
        }
        @media (max-width: 575px) {
            div.dataTables_wrapper div.dataTables_filter {
                left: 176px;
                margin-top: -1px;
                right: unset;
            }
            div.dataTables_wrapper div.dataTables_filter input[type="search"] 
             {
                width: 60px !important;
            }
        }
     
    </style>


    @vite('resources/js/app.js')
    @yield('script')

</head>


@include('frontend.layouts.sidebar')
<!-- ======= Main Content ======= -->
@yield('content')
<!-- ======= End Main Content  ======= -->
</div>
<!-- footer start-->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 p-0 footer-copyright">
                <p class="mb-0">Copyright 2024 © team</p>
            </div>
            <div class="col-md-6 p-0">
                <p class="heart mb-0">Dự án tốt nghiệp 
                    {{ isset($settings['author']) && isset($settings['author']->value) ? $settings['author']->value : '' }}
                    <svg class="footer-icon">
                        <use href="{{ asset('frontend/images/icon-sprite.svg#heart')}}"></use>
                    </svg>
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- footer end-->
</div>
</div>


{{-- ngobao script --}}







{{-- end --}}

<script>
$(document).ready(function() {
    $('.datatable').DataTable({
        // Bạn có thể thêm các tùy chọn ở đây nếu cần
        paging: true, // Bật phân trang
        searching: false, // Bật tìm kiếm
        ordering: true, // Bật sắp xếp cột
        info: false, // Hiển thị thông tin bảng (ví dụ: "Hiển thị 1-10 của 50 bản ghi")
    });
});
</script>

<!-- Bootstrap js-->
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
<!-- feather icon js-->
<script src="{{ asset('frontend/js/feather.min.js')}}"></script>
<script src="{{ asset('frontend/js/feather-icon.js')}}"></script>
<!-- scrollbar js-->
<script src="{{ asset('frontend/js/simplebar.js')}}"></script>
<script src="{{ asset('frontend/js/custom.js')}}"></script>
<!-- Sidebar jquery-->
<script src="{{ asset('frontend/js/config.js')}}"></script>
<!-- Plugins JS start-->
<script src="{{ asset('frontend/js/sidebar-menu.js')}}"></script>
{{-- <script src="{{ asset('frontend/js/sidebar-pin.js')}}"></script> --}}
<!-- <script src="{{ asset('frontend/js/slick.min.js')}}"></script> -->
<!-- <script src="{{ asset('frontend/js/slick.js')}}"></script> -->
<!-- <script src="{{ asset('frontend/js/header-slick.js')}}"></script> -->
<!-- <script src="{{ asset('frontend/js/raphael.js')}}"></script> -->
<!-- <script src="{{ asset('frontend/js/morris.js')}}"></script> -->
<!-- <script src="{{ asset('frontend/js/prettify.min.js')}}"></script> -->
<!-- <script src="{{ asset('frontend/js/stock-prices.js')}}"></script> -->
<!-- <script src="{{ asset('frontend/js/moment.min.js')}}"></script> -->
<script src="{{ asset('frontend/js/bootstrap-notify.min.js')}}"></script>
<!-- <script src="{{ asset('frontend/js/default.js')}}"></script> -->
<!-- <script src="frontend/js/index.js"></script> -->
<script src="{{ asset('frontend/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('frontend/js/datatable.custom.js')}}"></script>
<script src="{{ asset('frontend/js/datatable.custom1.js')}}"></script>
<script src="{{ asset('frontend/js/owl.carousel.js')}}"></script>
<script src="{{ asset('frontend/js/owl-custom.js')}}"></script>
<script src="{{ asset('frontend/js/handlebars_1.js')}}"></script>
<script src="{{ asset('frontend/js/typeahead.bundle.js')}}"></script>
<script src="{{ asset('frontend/js/typeahead.custom.js')}}"></script>
<script src="{{ asset('frontend/js/sweetalert.min.js')}}"></script>
{{-- <script src="{{ asset('frontend/js/sweetalert-app.js')}}"></script> --}}
<script src="{{ asset('frontend/js/typeahead.custom.js')}}"></script>
<script src="{{ asset('frontend/js/handlebars.js')}}"></script>
<script src="{{ asset('frontend/js/typeahead-custom.js')}}"></script>
<!-- <script src="{{ asset('frontend/js/height-equal.js')}}"></script> -->
<!-- Plugins JS Ends-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
<!-- Theme js-->
<script src="{{ asset('frontend/js/script.js')}}"></script>
<!-- <script src="{{ asset('frontend/js/customizer.js')}}"></script> -->
<!-- Plugin used-->


@if (session('success'))
<script>
swal("Thành Công!", "{{ session('success') }}", "success");
</script>
@endif

@if (session('error'))
<script>
swal("Có Lỗi!", "{{ session('error') }}", "error");
</script>
@endif

@if ($errors->any())
<script>
document.addEventListener("DOMContentLoaded", function() {
    @foreach($errors->all() as $error)
    alertError("{{ $error }}");
    @endforeach
});
</script>
@endif

<script>
new ClipboardJS('.copy-btn').on('success', function(e) {
    alertSuccess('Đã sao chép vào clipboard!');
    e.clearSelection();
});
</script>
<script>
    function addLoader() {
        $('#addLoader').html(`
        <div class="loader-wrapper">
            <div class="theme-loader">
                <div class="loader-p"></div>
            </div>
        </div>
        `)
    }
    function removeLoader() {
        $('.loader-wrapper').fadeOut('slow', function() {
            $(this).remove();
        });
    }
</script>

</body>

</html>
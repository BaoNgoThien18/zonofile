<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Zono admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Zono admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('frontend/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.png') }}" type="image/x-icon">
    <title>Chia sẻ File</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Outfit:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Courgette&amp;family=Montserrat:wght@200;300;400;500;600;700;800&amp;family=Nunito:wght@200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Courgette&amp;family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700;9..40,800&amp;family=Montserrat:wght@200;300;400;500;600;700;800&amp;family=Nunito:wght@200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/icofont.css') }}">
    <link rel="icon" href="images/landing-icons.svg">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/animate.css') }}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owlcarousel.css') }}">
</head>

<body class="landing-page">
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="landing-page">
        <!-- Page Body Start-->
        <header class="landing-header">
            <div class="custom-container">
                <div class="row">
                    <div class="col-12 p-0">
                        <nav class="navbar navbar-light p-0" id="navbar-example2"><a class="navbar-brand"
                                href="{{ url('') }}"><img class="img-fluid"
                                    src="{{ asset('frontend/images/shared_page/landing-logo') }}.png" alt=""></a>


                            @if ($fileRule->rule == 'download' || $fileRule->rule == 'me')
                            <div class="buy-block"><a class="btn-landing bg-secondary text-white" href="{{ url("/download/" . $file->shared_id) }}" target="_blank">Tải xuống ngay
                                </a>
                                <div class="toggle-menu"><i class="fa fa-bars') }} "></i></div>
                            </div>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- header end-->
        <!-- landing home start-->
        <div class="landing-home section-py-space pb-0">
            <div class="home-bg" id="home">
                <ul class="bg-icon-images">
                    <li><img src="{{ asset('frontend/images/shared_page/3.png') }}" alt=""></li>
                    <li> <img src="{{ asset('frontend/images/shared_page/2.png') }}" alt=""></li>
                    <li><img src="{{ asset('frontend/images/shared_page/4.png') }}" alt=""></li>
                    <li><img src="{{ asset('frontend/images/shared_page/1.png') }}" alt=""></li>
                </ul>
                <div class="row align-items-center justify-content-center">
                    <div class="col-12">
                        <div class="home-text">
                            <div class="main-title">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="d-flex gap-2 align-items-center"><img class="img-fluid"
                                            src="{{ asset('frontend/images/shared_page/rocket.png') }}" alt="rocket">
                                        <p class="m-0 project-name">Quản lí file và lưu trữ với ZONO FILE</p>
                                    </div>
                                </div>
                            </div>
                            <h2>Zono files storage<img class="line-text img-fluid"
                                    src="{{ asset('frontend/images/shared_page/line.png') }}" alt="line"></h2>
                            <p class="description-name">{{ $file->title }}</p>
                            <div class="docutment-button">
                                 <a class="btn bg-secondary" onclick="viewFileModal()"
                                    target="_blank">Xem trực tiếp</a>
                                 @if ($fileRule->rule == 'download' || $fileRule->rule == 'me')
                                <a class="btn bg-light txt-dark" href="{{ url("/download/" . $file->shared_id) }}"
                                    target="_blank">Tải xuống ngay</a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="wave-vibe">
                <div class="wave-img"><img src="{{ asset('frontend/images/shared_page/7.png') }}" alt="">
                </div>
            </div>
        </div>
        <!-- landing home end -->

        <!--footer start-->
        <footer class="footer-bg " style="margin-top: 300px">
            <div class="container-fluid">
                <div class="landing-center">
                    <div class="feature-content">
                        <div>
                            <h2>Quản lí file và lưu trữ với ZONO FILE</h2>
                            <div class="footer-rating">
                                <svg class="fill-warning">
                                    <use href="images/icon-sprite.svg#fill-star"></use>
                                </svg>
                                <svg class="fill-warning">
                                    <use href="images/icon-sprite.svg#fill-star"></use>
                                </svg>
                                <svg class="fill-warning">
                                    <use href="images/icon-sprite.svg#fill-star"></use>
                                </svg>
                                <svg class="fill-warning">
                                    <use href="images/icon-sprite.svg#fill-star"></use>
                                </svg>
                                <svg class="stroke-warning">
                                    <use href="images/icon-sprite.svg#fill-star"></use>
                                </svg>
                            </div>
                        </div>
                        <!-- <a class="btn bg-primary btn-hover-effect txt-light"
                                href="https://themeforest.net/user/pixelstrap/portfolio" target="_blank">Xem ngay</a> -->
                    </div>
                </div>
                <div class="sub-footer row g-md-2 g-3">
                    <div class="col-md-6">
                        <div class="left-subfooter"> <img class="img-fluid"
                                src="{{ asset('frontend/images/shared_page/logo_dark.png') }}" alt="logo">
                            <p class="mb-0">Copyright 2024 © </p>
                        </div>
                    </div>

                </div>
            </div>
        </footer>
    </div>

    <div class="modal fade show" id="viewFileModal" tabindex="-1" aria-labelledby="viewFileModalLabel"
        style="display: none;" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewFileModalLabel">{{ $file->title }}</h1>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal" >
                    <iframe width="100%" height="100%" id="viewFileModalContent"></iframe>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('frontend/js/jquery.min.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }} "></script>
    <!-- feather icon js-->
    <script src="{{ asset('frontend/js/feather.min.js') }} "></script>
    <script src="{{ asset('frontend/js/feather-icon.js') }} "></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('frontend/js/tooltip-init.js') }} "></script>
    <script src="{{ asset('frontend/js/wow.min.js') }} "></script>
    <script src="{{ asset('frontend/js/landing_sticky.js') }} "></script>
    <script src="{{ asset('frontend/js/landing.js') }} "></script>
    <script src="{{ asset('frontend/js/libs.min.js') }} "></script>
    <script src="{{ asset('frontend/js/slick.min.js') }} "></script>
    <script src="{{ asset('frontend/js/slick.js') }} "></script>
    <script src="{{ asset('frontend/js/landing-slick.js') }} "></script>
    <!-- Plugins JS Ends-->
    <script src="{{ asset('frontend/js/owl.carousel.js') }} "></script>
    <script src="{{ asset('frontend/js/owl-custom.js') }} "></script>

    <script>
        var filePath = "{{ env('SERVER_VIEW_FILE') . $file->path }}";
        function viewFileModal() {
                $('#viewFileModalContent').attr('src', filePath);
                $('#viewFileModal').modal('show');
         } ;
        </script>

</body>

</html>
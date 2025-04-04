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
    <title>Đăng nhập</title>
    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/feather-icon.css') }}">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('frontend/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/responsive.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite('resources/js/app.js')

    <style>
        .small-icon {
            width: 20px;
            height: 20px;
            cursor: pointer;
            color: #6c757d;
            /* Optional: Adjust the color of the icon */
        }

        .form-input .show-hide {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
        }
    </style>
</head>

<body>
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card login-dark">
                    <div>
                        <div><a class="logo" href="{{ url('/') }}"><img class="img-fluid for-light"
                                    src="{{ asset('frontend/images/logo.png') }}" alt="looginpage"><img
                                    class="img-fluid for-dark" src="{{ asset('frontend/images/logo_dark.png') }}"
                                    alt="looginpage"></a></div>
                        <div class="login-main">
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                          @endif
                            <form class="theme-form" action="{{ route('login') }}" method="POST">
                                @csrf

                                <h3>Đăng nhập vào tài khoản</h3>
                                <p>Nhập email &amp; mật khẩu của bạn để đăng nhập</p>
                                <div class="form-group">
                                    <label class="col-form-label">Email</label>
                                    <input class="form-control" type="email" name="email" required=""
                                        placeholder="example@gmail.com">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Mật Khẩu</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="password" name="password" id="password"
                                            required="" placeholder="*********">
                                        <div class="show-hide" onclick="togglePassword()">
                                            <i data-feather="eye" id="togglePasswordIcon" class="small-icon"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" type="checkbox">
                                    </div><a class="link" href="{{ route('forgot-password.form') }}">Quên Mật
                                        Khẩu?</a>
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100" type="submit">Đăng
                                            Nhập</button>
                                    </div>
                                </div>
                                <h6 class="text-muted mt-4 or">Hoặc Đăng Nhập Với</h6>

                                <div class="social mt-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <a class="btn btn-light w-100" href="{{ route('auth.google') }}"
                                                target="_blank">
                                                <i class="fab fa-google"></i> Google
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <p class="mt-4 mb-0 text-center">Không có tài khoản?<a class="ms-2"
                                        href="{{ route('register') }}">Tạo tài
                                        khoản</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- latest jquery-->
        <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
        <!-- Bootstrap js-->
        <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
        <!-- feather icon js-->
        <script src="{{ asset('frontend/js/feather.min.js') }}"></script>
        <script src="{{ asset('frontend/js/feather-icon.js') }}"></script>
        <!-- scrollbar js-->
        <!-- Sidebar jquery-->
        <script src="{{ asset('frontend/js/config.js') }}"></script>
        <!-- Plugins JS start-->
        <!-- Plugins JS Ends-->
        <!-- Theme js-->
        <script src="{{ asset('frontend/js/script.js') }}"></script>
        <!-- Plugin used-->

        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js')}}"></script>
        <script>
            feather.replace();
        </script>

    </div>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var toggleIcon = document.getElementById("togglePasswordIcon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.setAttribute("data-feather", "eye-off"); // Change to "eye-off"
            } else {
                passwordField.type = "password";
                toggleIcon.setAttribute("data-feather", "eye"); // Change back to "eye"
            }

            // Replacing the feather icons to apply the new icon
            feather.replace();
        }
    </script>

    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @foreach ($errors->all() as $error)
                    alertError("{{ $error }}");
                @endforeach
            });
        </script>
    @endif

</body>

</html>

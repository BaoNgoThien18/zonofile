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
    <title>Đăng Ký</title>
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
    <style>
      .small-icon {
          width: 20px;
          height: 20px;
          cursor: pointer;
          color: #6c757d; /* Optional: Adjust the color of the icon */
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
                        <div class="login-main">
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <i class="fas fa-exclamation-circle"></i> 
                              <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                                @endforeach
                              </ul>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                          @endif
                            <form class="theme-form" action="{{ route('register') }}" method="POST">
                                @csrf
                                <h4>Tạo tài khoản của bạn</h4>
                                <p>Nhập thông tin cá nhân của bạn để tạo tài khoản</p>
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Tên Người Dùng</label>
                                    <div class="row g-2">
                                        <div class="col-12">
                                            <input class="form-control" type="text" name="name" required=""
                                                placeholder="Nhập tên">
                                        </div>

                                    </div>
                                </div>
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
                                    </div>
                                    <button class="btn btn-primary btn-block w-100" type="submit">Tạo Tài
                                        Khoản</button>
                                </div>
                                <h6 class="text-muted mt-4 or">Hoặc đăng ký với</h6>
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
                                <p class="mt-4 mb-0">Đã có tài khoản?<a class="ms-2" href="{{ route('login') }}">Đăng nhập</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- latest jquery-->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap js-->
        <script src="js/bootstrap.bundle.min.js"></script>
        <!-- feather icon js-->
        <script src="js/feather.min.js"></script>
        <script src="js/feather-icon.js"></script>
        <!-- scrollbar js-->
        <!-- Sidebar jquery-->
        <script src="js/config.js"></script>
        <!-- Plugins JS start-->
        <!-- Plugins JS Ends-->
        <!-- Theme js-->
        <script src="js/script.js"></script>
        <!-- Plugin used-->

        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script>
            feather.replace();
        </script>

    </div>

</body>


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


</html>

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
  <link rel="icon" href="{{asset('frontend/images/favicon.png')}}" type="image/x-icon">
  <link rel="shortcut icon" href="{{asset('frontend/images/favicon.png')}}" type="image/x-icon">
  <title>Quên mật khẩu</title>
  <!-- Google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
    rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/font-awesome.css')}}">
  <!-- ico-font-->
  <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/icofont.css')}}">
  <!-- Themify icon-->
  <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/themify.css')}}">
  <!-- Flag icon-->
  <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/flag-icon.css')}}">
  <!-- Feather icon-->
  <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/feather-icon.css')}}">
  <!-- Plugins css start-->
  <!-- Plugins css Ends-->
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bootstrap.css')}}">
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}">
  <link id="color" rel="stylesheet" href="{{asset('frontend/css/color-1.css')}}" media="screen">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/responsive.css')}}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>

<body>
    <div class="page-wrapper">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">     
                    <div class="login-card login-dark">
                        <div>
                            <div class="login-main">
                              <!-- Success Message -->
                              @if (session('status'))
                              <div class="alert alert-success alert-dismissible fade show" role="alert">
                                  <i class="fas fa-check-circle"></i> {{ session('status') }}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert"
                                      aria-label="Close"></button>
                              </div>
                          @endif

                          <!-- Error Messages -->
                          @if ($errors->any())
                              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                  <i class="fas fa-exclamation-circle"></i>
                                  <ul>
                                      @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                                  <button type="button" class="btn-close" data-bs-dismiss="alert"
                                      aria-label="Close"></button>
                              </div>
                          @endif

                                <form class="theme-form" method="POST" action="{{ route('forgot-password.send') }}">
                                    @csrf
                                    <h4>Đặt lại mật khẩu</h4>
                                    
                                    <div class="form-group">
                                        <label class="col-form-label">Nhập Email</label>
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-between align-items-center">
                                                <div class="flex-grow-1 me-2">
                                                    <input class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
                                                </div>
                                                <div>
                                                    <button class="btn btn-primary" type="submit">Gửi</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror --}}

                                    <div class="mt-4 mb-4">
                                        <form action="" method="POST">
                                            @csrf
                                            <span class="reset-password-link">
                                                Nếu không nhận được email? 
                                                <button type="submit" class="btn btn-light btn-sm mx-1 text-danger">Gửi lại</button>
                                            </span>
                                        </form>
                                    </div>

                                    <p class="mt-4 mb-0 text-center">
                                        Đã có mật khẩu? <a class="ms-2" href="{{ route('login') }}">Đăng Nhập</a>
                                    </p>
                                </form>
                            </div>
                        </div>
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

</body>

</html>
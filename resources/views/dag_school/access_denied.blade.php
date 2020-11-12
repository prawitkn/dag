<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Project Title</title>
    <meta name="description" content="">
    <meta name="robots" content="all,follow">
	
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ url('public/templates/bootstrap-4-material-admin/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ url('public/templates/bootstrap-4-material-admin/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="{{ url('public/templates/bootstrap-4-material-admin/css/fontastic.css') }}">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="{{ url('public/templates/bootstrap-4-material-admin/css/grasp_mobile_progress_circle-1.0.0.min.css') }}">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="{{ url('public/templates/bootstrap-4-material-admin/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ url('public/templates/bootstrap-4-material-admin/css/style.default.premium.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ url('public/templates/bootstrap-4-material-admin/css/custom.css') }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ url('public/templates/bootstrap-4-material-admin/img/favicon.ico') }}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="container-fluid px-3">
      <div class="row min-vh-100">
        <div class="col-md-5 col-lg-6 col-xl-4 px-lg-5 d-flex align-items-center">
          <div class="w-100 py-5">          
            <div class="text-center"><img src="{{ url('public/img/brand/brand-1.svg') }}" alt="..." style="max-width: 6rem;" class="img-fluid mb-4">
              <h1 class="display-4 mb-3">404</h1>
            </div>

            <form method="POST" action="{{ route('login') }}">
                        @csrf
              <div class="form-group">
              </div>
              <div class="form-group mb-4">
                
             </div>
              <!-- Link-->
              <p class="text-center"><medium class="text-muted text-center"> มีบางอย่างผิดพลาด <a href="{{ url('/online_store') }}"> คลิกที่นี่</a> เพื่อกลับไปสู่หน้าแรก.</medium></p>
            </form>
          </div>
        </div>
        <div class="col-12 col-md-7 col-lg-6 col-xl-8 d-none d-lg-block">
          <!-- Image-->
          <div style="background-image: url('public/assets/images/background/sb.jpg');" class="bg-cover h-100 mr-n3"></div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{ url('public/templates/bootstrap-4-material-admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('public/templates/bootstrap-4-material-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('public/templates/bootstrap-4-material-admin/js/grasp_mobile_progress_circle-1.0.0.min.js') }}"></script>
    <script src="{{ url('public/templates/bootstrap-4-material-admin/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ url('public/templates/bootstrap-4-material-admin/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ url('public/templates/bootstrap-4-material-admin/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ url('public/templates/bootstrap-4-material-admin/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Main File-->
    <script src="{{ url('public/templates/bootstrap-4-material-admin/js/front.js') }}"></script>
  </body>
</html>

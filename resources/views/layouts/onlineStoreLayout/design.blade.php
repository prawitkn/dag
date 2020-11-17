<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ศูนย์บริการแบบเบ็ดเสร็จ บก.ทท.</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="author" content="prawit.kn@gmail.com">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- JQuery -->
    <script src="{{ asset('public/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- <link href="{{ asset('public/fonts/thsarabunnew/thsarabunnew.css') }}" rel="stylesheet"> -->

    <!-- Bootstrap tether Core JavaScript -->
     <script src="{{ asset('public/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('public/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('public/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/extra-libs/sparkline/sparkline.js') }}"></script>

    <!--Wave Effects -->
    <script src="{{ asset('public/dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('public/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('public/dist/js/custom.min.js') }}"></script>

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('public/templates/bootstrap-4-material-admin/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('public/templates/bootstrap-4-material-admin/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="{{ asset('public/templates/bootstrap-4-material-admin/css/fontastic.css') }}">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="{{ asset('public/templates/bootstrap-4-material-admin/css/grasp_mobile_progress_circle-1.0.0.min.css') }}">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="{{ asset('public/templates/bootstrap-4-material-admin/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('public/templates/bootstrap-4-material-admin/css/style.green.premium.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('public/templates/bootstrap-4-material-admin/css/custom.css') }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.png') }}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
@yield('head')
    

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <style>
    section header { padding-top: 0.5rem; padding-bottom: 0.5rem; }
    .breadcrumb-holder .breadcrumb { padding: 5px 0; }
    .form-group-material { padding-bottom: 5px; }
    input::placeholder {
      color: white;
    }
    input:focus::placeholder {
      color: red;
    }
    div.form-group .form-group-material { padding-bottom: 5px; }

	/*Customer From*/
	/* blue 2b90d9 */
	label.label-material-select { font-size: 0.8rem; top: -10px; color: #2b90d9; position: absolute; }
	select.select-material { width: 100px; position: absolute; top: 10px; }

	/*table*/
	table tr { margin: 5px; }
    </style>
</head>
<body>
    @include('layouts.onlineStoreLayout.sidebar')  
    <div class="page">
    @include('layouts.onlineStoreLayout.header')

    @yield('content')   

    @include('layouts.onlineStoreLayout.footer')

    </div>      

    <!-- JavaScript files-->
    <!-- <script src="{{ asset('public/templates/bootstrap-4-material-admin/vendor/jquery/jquery.min.js') }}"></script> -->
    <script src="{{ asset('public/templates/bootstrap-4-material-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/templates/bootstrap-4-material-admin/js/grasp_mobile_progress_circle-1.0.0.min.js') }}"></script>
    <script src="{{ asset('public/templates/bootstrap-4-material-admin/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
<!--     <script src="{{ asset('public/templates/bootstrap-4-material-admin/vendor/chart.js/Chart.min.js') }}"></script> -->
    <script src="{{ asset('public/templates/bootstrap-4-material-admin/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/templates/bootstrap-4-material-admin/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- <script src="{{ asset('public/templates/bootstrap-4-material-admin/js/charts-home.js') }}"></script> -->
    <!-- Notifications-->
    <script src="{{ asset('public/templates/bootstrap-4-material-admin/vendor/messenger-hubspot/build/js/messenger.min.js') }}">   </script>
    <script src="{{ asset('public/templates/bootstrap-4-material-admin/vendor/messenger-hubspot/build/js/messenger-theme-flat.js') }}">       </script>
    <script src="{{ asset('public/templates/bootstrap-4-material-admin/js/home-premium.js') }}"> </script>
    <!-- Main File-->
    <script src="{{ asset('public/templates/bootstrap-4-material-admin/js/front.js') }}"></script>
</body>
@yield('footer')
</html>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ env('APP_NAME') }}">
    <meta name="keywords" content="{{ env('APP_NAME') }}">
    <meta name="author" content="{{ env('APP_NAME') }}">
    <title>@yield('title') | {{ env('APP_NAME') }} </title>
    <!-- Favicon icon-->
    <link rel="icon" href="{{ url('/admin/assets') }}/images/icon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ url('/admin/assets') }}/images/icon.png" type="image/x-icon">
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&amp;display=swap" rel="stylesheet">
    <!-- Flag icon css -->
    <link rel="stylesheet" href="{{ url('/admin/assets') }}/css/vendors/flag-icon.css">
    <!-- iconly-icon-->
    <link rel="stylesheet" href="{{ url('/admin/assets') }}/css/iconly-icon.css">
    <link rel="stylesheet" href="{{ url('/admin/assets') }}/css/bulk-style.css">
    <!-- iconly-icon-->
    <link rel="stylesheet" href="{{ url('/admin/assets') }}/css/themify.css">
    <!--fontawesome-->
    <link rel="stylesheet" href="{{ url('/admin/assets') }}/css/fontawesome-min.css">
    <!-- Whether Icon css-->
    <link rel="stylesheet" type="text/css" href="{{ url('/admin/assets') }}/css/vendors/weather-icons/weather-icons.min.css">
    <!-- App css -->
    <link id="color" rel="stylesheet" href="{{ url('/admin/assets') }}/css/color-1.css" media="screen">
    <link rel="stylesheet" href="{{ url('/admin/assets') }}/css/style.css">
  </head>
  <body>
    <!-- tap on top starts-->
    <div class="tap-top"><i class="iconly-Arrow-Up icli"></i></div>
    <!-- tap on tap ends-->
    <!-- loader-->
    <div class="loader-wrapper">
      <div class="loader"><span></span><span></span><span></span><span></span><span></span></div>
    </div>
    <!-- login page start-->
    @yield('content')

    <!-- jquery-->
    <script src="{{ url('/admin/assets') }}/js/vendors/jquery/jquery.min.js"></script>
    <!-- bootstrap js-->
    <script src="{{ url('/admin/assets') }}/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js" defer=""></script>
    <script src="{{ url('/admin/assets') }}/js/vendors/bootstrap/dist/js/popper.min.js" defer=""></script>
    <!--fontawesome-->
    <script src="{{ url('/admin/assets') }}/js/vendors/font-awesome/fontawesome-min.js"></script>
    <!-- custom script -->
    <script src="{{ url('/admin/assets') }}/js/script.js"></script>
  </body>
</html>
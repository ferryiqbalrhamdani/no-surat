<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90680653-2"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-90680653-2');
  </script>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Twitter -->
  <!-- <meta name="twitter:site" content="@bootstrapdash">
    <meta name="twitter:creator" content="@bootstrapdash">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Azia">
    <meta name="twitter:description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="twitter:image" content="https://www.bootstrapdash.com/azia/img/azia-social.png"> -->

  <!-- Facebook -->
  <!-- <meta property="og:url" content="https://www.bootstrapdash.com/azia">
    <meta property="og:title" content="Azia">
    <meta property="og:description" content="Responsive Bootstrap 4 Dashboard Template">

    <meta property="og:image" content="https://www.bootstrapdash.com/azia/img/azia-social.png">
    <meta property="og:image:secure_url" content="https://www.bootstrapdash.com/azia/img/azia-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600"> -->

  <!-- Meta -->
  <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
  <meta name="author" content="BootstrapDash">

  <title>{{$title ?? 'Login'}}</title>

  <!-- vendor css -->
  <link href="{{asset('vendor/azia/lib/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/azia/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/azia/lib/typicons.font/typicons.css')}}" rel="stylesheet">

  <!-- azia CSS -->
  <link rel="stylesheet" href="{{asset('vendor/azia/css/azia.css')}}">

</head>

<body class="az-body">

  {{$slot}}

  @include('sweetalert::alert')

  <script src="{{asset('vendor/azialib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/azialib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('vendor/azialib/ionicons/ionicons.js')}}"></script>
  <script src="{{asset('vendor/aziajs/jquery.cookie.js')}}" type="text/javascript"></script>
  <script src="{{asset('vendor/aziajs/jquery.cookie.js')}}" type="text/javascript"></script>

  <script src="{{asset('vendor/aziajs/azia.js')}}"></script>
  <script>
    $(function(){
        'use strict'

      });
  </script>
</body>

</html>
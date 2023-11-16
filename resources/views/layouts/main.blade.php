<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{$generalInfo ? $generalInfo->title : 'My Portfolio'}}</title>
  <meta content="{{$generalInfo ? $generalInfo->meta_description : ''}}" name="description">
  <meta content="{{$generalInfo ? $generalInfo->keywords : ''}}" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('storage/'.$generalInfo->favicon)}}" rel="icon">
  <link href="{{asset('storage/'.$generalInfo->apple_touch_icon)}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: iPortfolio
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style>
    .height{

    height: 14vh;
    }

    .form{

    position: relative;
    }

    .form .bi-search{

    position: absolute;
    top:16px;
    left: 20px;
    color: #9ca3af;

    }

    .form span{

    position: absolute;
    right: 17px;
    top: 13px;
    padding: 2px;
    border-left: 1px solid #d1d5db;

    }

    .left-pan{
    padding-left: 7px;
    }

    .left-pan i{

    padding-left: 10px;
    }

    .form-input{

    height: 55px;
    text-indent: 33px;
    border-radius: 10px;
    }

    .form-input:focus{

    box-shadow: none;
    border:none;
    }
  </style>
</head>

<body>
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    @livewireScripts
</body>
</html>

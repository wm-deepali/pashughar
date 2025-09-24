<!DOCTYPE html>
<html lang="en">
    
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <meta name="author" content="Pashughar">
 
    
    @yield('metatags')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('before-styles')
   

    <!--=====================================
                CSS LINK PART START
    =======================================-->
    <!-- FAVICON -->
    <link rel="icon" href="{{asset('front/images/favicona.ico')}}">

    <!-- FONTS -->
    <link rel="stylesheet" href="{{asset('front/fonts/flaticon/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('front/fonts/font-awesome/fontawesome.css')}}">

    <!-- VENDOR -->
    <link rel="stylesheet" href="{{asset('front/css/vendor/slick.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/vendor/bootstrap.min.css')}}">

    <!-- CUSTOM -->
    <link rel="stylesheet" href="{{asset('front/css/custom/main.css')}}">
    @stack('after-styles')
    <style>
    .feature-thumb img{
        width:146px;
        height:105px;
    }
    .feature-img img{
        width:585px;
        height:416px;
    }
    .product-img img{
        width:256px;
        height:182px;
    }
</style>
    <!--=====================================
                CSS LINK PART END
    =======================================-->
    
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7729262106028233"
     crossorigin="anonymous"></script>
</head>
<body>
@include('front.layouts.includes.header')
@include('front.layouts.includes.sidebar')
@include('front.layouts.includes.mobile-nav')

@yield('content')
@include('front.layouts.includes.footer')
@include('front.layouts.includes.currency-modal') 
@include('front.layouts.includes.language-modal')
<!--=====================================
                JS LINK PART START
    =======================================-->
    <!-- VENDOR -->
    <script src="{{asset('front/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('front/js/vendor/popper.min.js')}}"></script>
    <script src="{{asset('front/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/js/vendor/slick.min.js')}}"></script>

    <!-- CUSTOM -->
    <script src="{{asset('front/js/custom/slick.js')}}"></script>
    <script src="{{asset('front/js/custom/main.js')}}"></script>
    @stack('after-script')
    <!--=====================================
                JS LINK PART END
    =======================================-->
</body>


</html?>







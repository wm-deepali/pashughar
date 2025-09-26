<!DOCTYPE html>
<html lang="en">
    
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        <!--=====================================
                    META-TAG PART START
        =======================================-->
        <!-- REQUIRE META -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        

        <!-- FOR WEBPAGE TITLE -->
        <meta name="author" content="Welcome to Pashughar">
    
        <title>
            Pashughar
          
        </title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @stack('before-styles')
        

        <!--=====================================
                    CSS LINK PART START
        =======================================-->
        <!-- FAVICON -->
        <link rel="icon" href="{{asset('front/images/favicon-new.ico')}}">

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
            
            .product-img img{
                width:253px;
                height:180px;
            }
        </style>
        
        <!--=====================================
                    CSS LINK PART END
        =======================================-->
    </head>
    <body>
        <!--=====================================
                    HEADER PART START
        =======================================-->
        @include('front.layouts.includes.header-main')
        <!--=====================================
                    HEADER PART END
        =======================================-->


        <!--=====================================
                    SIDEBAR PART START
        =======================================-->
        @include('front.layouts.includes.sidebar')
        <!--=====================================
                    SIDEBAR PART END
        =======================================-->


        <!--=====================================
                    MOBILE-NAV PART START
        =======================================-->
        @include('front.layouts.includes.mobile-nav')
        <!--=====================================
                    MOBILE-NAV PART END
        =======================================-->


        <!--=====================================
                  SINGLE BANNER PART START
        =======================================-->
        @include('front.layouts.includes.user-banner')
        <!--=====================================
                  SINGLE BANNER PART END
        =======================================-->


        <!--=====================================
                DASHBOARD HEADER PART START
        =======================================-->
        @include('front.layouts.includes.user-header')
        @include('front.layouts.includes.messages')
        @include('front.layouts.includes.errors')
        <!--=====================================
                DASHBOARD HEADER PART END
        =======================================-->
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
        
        <script src="{{asset('front/js/custom/main.js')}}"></script>
        @stack('after-script')
        
        
        <!--=====================================
                    JS LINK PART END
        =======================================-->
    </body>


</html>







<!DOCTYPE html>
<html lang="en">
    
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <meta name="author" content="AVH Click">
    
    <title>
        Reset Password
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('before-styles')
    @stack('after-styles')
   
    <!--=====================================
                CSS LINK PART START
    =======================================-->
    <!-- FAVICON -->
    <link rel="icon" href="{{asset('front/images/favicon.png')}}">

    <!-- FONTS -->
    <link rel="stylesheet" href="{{asset('front/fonts/font-awesome/fontawesome.css')}}">

        <!-- FOR BOOTSTRAP -->
        <link rel="stylesheet" href="{{asset('front/css/vendor/bootstrap.min.css')}}">

        <!-- FOR COMMON STYLE -->
        <link rel="stylesheet" href="{{asset('front/css/custom/main.css')}}">

        <!-- FOR USER FORM PAGE STYLE -->
        <link rel="stylesheet" href="{{asset('front/css/custom/user-form.css')}}">
        <!--=====================================
                    CSS LINK PART END
        =======================================-->
    </head>
   
    <body>
        <!--=====================================
                    USER-FORM PART START
        =======================================-->
        <section class="user-form-part">
            <div class="user-form-banner">
                <div class="user-form-content">
                    <a href="#"><img src="{{asset('front/images/logo.png')}}" alt="logo"></a>
                    <h1>Advertise your assets <span>Buy what are you needs.</span></h1>
                    <p>Biggest Online Advertising Marketplace in the World.</p>
                </div>
            </div>

            <div class="user-form-category">
                <div class="user-form-header">
                    <a href="#"><img src="{{asset('front/images/logo.png')}}" alt="logo"></a>
                    <a href="{{URL::to('/')}}"><i class="fas fa-arrow-left"></i></a>
                </div>
                <div class="user-form-category-btn">
                    
                </div>
                
                
                @if (session('success'))
                  <h5 class="alert alert-success text-center">{{ Session::get('success') }}</h5><br>
                  <?php Session::forget('success');?>
                @endif
                @if (session('error'))
                  <h5 class="alert alert-danger text-center">{{ Session::get('error') }}</h5><br>
                  <?php Session::forget('error');?>
                @endif
                @if($errors->any())
                  <h5 class="alert alert-danger text-center">  {{ implode('', $errors->all(':message')) }} </h5><br>
                @endif 
                

                <div class="tab-pane active" id="register-tab">
                    <div class="user-form-title">
                        <h2>Add New Password</h2>
                    </div>
                    <form id="passwordForm" method="post" action="{{ route('reset.password.post') }}" enctype="multipart/form-data">
                    @csrf
                   
                    
                        <div class="row">
                            
                            <div class="col-12">
                                <input type="hidden" name="token" value="{{ $token }}">
                                
                                <div class="form-group">
                                    <input type="password" autocomplete="off" name="password" id="password" class="form-control" placeholder="New Password" required/>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <input type="password" autocomplete="off" name="password_confirmation" id="password-confirm" class="form-control " placeholder="Confirm New Password" required/>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                                
                            </div>
                            
                            
                            <div class="col-12 price-btn">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-inline">
                                        <i class="fas fa-user-check"></i>
                                        <span>Submit</span>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group text-right">
                                    <a href="{{route('user.login')}}" class="form-forgot">Sign In</a>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                    
                </div>
            </div>
        </section>

    <!-- VENDOR -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src="{{asset('front/js/vendor/popper.min.js')}}"></script>
    <script src="{{asset('front/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/js/custom/main.js')}}"></script>
        <!--=====================================
                    JS LINK PART END
        =======================================-->
</body>

</html>

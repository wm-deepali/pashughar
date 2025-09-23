<!DOCTYPE html>
<html lang="en">
    
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <meta name="author" content="AVH Click">
    
    <title>
        @if (trim($__env->yieldContent('title')))
        @yield('title') | {{ config('app.name', 'Laravel') }}
        @else
        {{ config('app.name', 'Laravel') }}
        @endif
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('before-styles')
    @stack('after-styles')
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

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
   <style>
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.4); /* Semi-transparent white */
        backdrop-filter: blur(5px); /* Frosted glass effect */
        z-index: 9998; /* Below the form card */
        pointer-events: all; /* Block clicks */
    }
    #scrollToTopBtn {
        display: none; /* Hidden by default */
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 9999; /* Ensure it's above other elements */
        background-color: #007bff; /* Primary color */
        color: white; /* Text color */
        border: none; /* Remove borders */
        border-radius: 50%; /* Rounded corners */
        padding: 10px; /* Adjust padding for SVG */
        cursor: pointer; /* Pointer cursor on hover */
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Optional: add shadow */
        width: 50px; /* Set a fixed width */
        height: 50px; /* Set a fixed height */
        display: flex; /* Center the SVG */
        align-items: center; /* Center the SVG */
        justify-content: center; /* Center the SVG */
    }
    
    #scrollToTopBtn svg {
        fill: white; /* Set the fill color of the SVG path */
        width: 24px; /* Adjust the size of the SVG */
        height: 24px; /* Adjust the size of the SVG */
    }
    
    #scrollToTopBtn:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }

    /* Ensure the form card is above the overlay */
    .log {
        position: relative;
        z-index: 9999; /* Above the overlay */
    }
    .swal2-container{
        z-index: 10000;
    }
    .get-start {
        margin-top: 30px;
        font-size: 22px;
        font-weight: 600;
    }
    .continue-w {
        padding-top: 10px;
    }
    .form-login-reg.comment-form.modal-l {
        margin-top: 20px;
    }
    /* .inner-frm 
    {
        text-align: center;
    } */
    .form-login-reg.comment-form {
        padding: 20px;
        border: 1px solid #c6c3c3;
        border-radius: 8px;
    }
    .comment-form .form-group input[type="text"], .comment-form .form-group input[type="password"], .comment-form .form-group input[type="tel"], .comment-form .form-group input[type="email"], .comment-form .form-group input[type="date"], .comment-form .form-group input[type="file"], .comment-form .form-group select, .comment-form .form-group .ui-selectmenu-button.ui-button {
        position: relative;
        display: block;
        width: 100%;
        line-height: 28px;
        padding: 10px 25px;
        height: 60px;
        border-radius: 0px;
        -webkit-transition: all 300ms ease;
        -ms-transition: all 300ms ease;
        -o-transition: all 300ms ease;
        -moz-transition: all 300ms ease;
        transition: all 300ms ease;
        background-color: rgb(247, 247, 246);        ;
        border: 1px solid rgba(0,0,0, 0.06);
    }
    .user-form-category
    {
        z-index: 9999;
    }
    #hiddenInput {
        margin-bottom: 30px;
    }
    .otp-input {
        width: 50px;
        margin-right: 20px;
    }
    .cus-btn-osd {
        text-align: center;
        background: linear-gradient(136deg, #307cf5 2%, #3b8ee5 64%);
        color: #fff;
        border-radius: 3px;
        font-size: 16px;
        height: 50px;
        align-content: center;
    }
    a:visited {
        text-decoration: none;
        outline: none !important;
    }
    </style>
    <body>
        <!--=====================================
                    USER-FORM PART START
        =======================================-->
        <section class="user-form-part">
            <div class="user-form-banner">
                <div class="user-form-content">
                    <a href="{{URL::to('/')}}"><img src="{{asset('front/images/logo.png')}}" alt="logo"></a>
                    <h1>Advertise your assets <span>Buy what are you needs.</span></h1>
                    <p>Biggest Online Advertising Marketplace in the World.</p>
                </div>
            </div>

            <div class="user-form-category">
                
                
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
                        <h2>Register</h2>
                        <p>Setup a new account in a minute.</p>
                    </div>
                    <form id="registerForm" method="post" action="{{ route('first.details.store') }}" enctype="multipart/form-data">
                    @csrf
                   
                    
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="full_name" value="{{$user->full_name}}" placeholder="Full Name"  required>
                                    <small class="form-alert">example - John Deo</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" autocomplete="off" value="{{$user->email}}" name="email" id="email_id_register" placeholder="Email"  required>
                                    <small class="form-alert">Please follow this example - abc@example.com</small>
                                    <span id="email_feedback" style="display:none; color:red;">Email already exists</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="tel" onkeypress="return isNumber(event)" autocomplete="off" class="form-control" name="mobile"  minlength="10" maxlength="10" placeholder="Moblie number" id="mobile_number" required>
                                    <small class="form-alert">Please follow this example - 01XXXXXXXXX</small>
                                    <!--p id="verified_badge" style="color:green;display:none;">Verified</p-->
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="tel" name="mobile" id="mob_in" class="form-control" style="display:none;"/>
                                <input type="text" name="isValid" id="is_valid_number" value="1" class="form-control" style="display:none;"/>
                                <!--div class="form-group mb-2" id="otp_field" style="display: none;">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="otp"
                                        name="otp"
                                        placeholder="Enter OTP"
                                        maxlength="6"
                                    />
                                </div>
                                <button type="button" class="btn btn-primary mb-2" id="send-otp-bt" onclick="sendOTP()">Send OTP</button>
                                <button type="button" class="btn btn-primary mb-2" id="verify-otp-bt" style="display: none;" onclick="verifyOTP()">Verify</button-->
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="pass" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                    <button class="form-icon"><i class="eye fas fa-eye"></i></button>
                                    <small class="form-alert">Password must be 8 characters</small>
                                </div>
                            </div>
                            @php $adminsetting = \App\Models\OtherSetting::first();  @endphp
                            @if($adminsetting->is_referral_enable == "1")
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control referralCode" name="referralto" placeholder="Enter Referral Code" >
                                    <span id="errors" style="color:brown"></span>
                                    <input type="text" name="isRef" id="is_valid_refer" value="0" class="form-control" style="display:none;"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter Referral Name" id="names" value="" readonly>
                                    
                                </div>
                            </div>
                            
                            @endif
                            
                           
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-inline">
                                        <i class="fas fa-user-check"></i>
                                        <span>Create new account</span>
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                    
                </div>
            </div>
        </section>

    <!-- VENDOR -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js
    "></script>
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css
    " rel="stylesheet">
    <script src="{{asset('front/js/vendor/popper.min.js')}}"></script>
    <script src="{{asset('front/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/js/custom/main.js')}}"></script>
        <!--=====================================
                    JS LINK PART END
        =======================================-->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to show the overlay
        function showOverlay() {
            const overlay = document.createElement('div');
            overlay.className = 'overlay';
            document.body.appendChild(overlay);
        }
    
        // Function to hide the overlay
        function hideOverlay() {
            const overlay = document.querySelector('.overlay');
            if (overlay) {
                overlay.remove();
            }
        }
    
        // Assuming you want to show the overlay when the page loads or a specific action occurs
        showOverlay();
    
        // Optional: Add logic to hide the overlay based on some condition or event
        // hideOverlay();
    });
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        const scrollToTopBtn = document.getElementById("scrollToTopBtn");
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollToTopBtn.style.display = "block";
        } else {
            scrollToTopBtn.style.display = "none";
        }
    }
    
    // When the user clicks on the button, scroll to the top of the document
    function scrollToTop() {
        window.scrollTo({top: 200, behavior: 'smooth'});
    }
</script>

<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css
" rel="stylesheet">

<script>
     let referral = '{{ session('referralCode') }}';
    let referralCodeElement = $(".referralCode");
    referralCodeElement.val(referral);
    if (referral) {
        setTimeout(function() {
            referralCodeElement.trigger('keyup'); // Trigger the keyup event
            console.log(referral);
        }, 100);
    }
    $(".referralCode").keyup(function() {
        let referralValue = $(this).val();
        if (referralValue !== "") {
            $.ajax({
                type: "GET",
                url: "{{ url('getusername') }}/" + referralValue,
                success: function(data) {
                    if (data.status == 1) {
                        document.getElementById('is_valid_refer').value = '1';
                        $("#names").val(data.name);
                        $("#errors").html("");
                    } else if (data.status == 3) {
                        document.getElementById('is_valid_refer').value = '1';
                        $("#names").val("");
                        $(".referralCode").val("");
                        $("#errors").html("This referral code(" + referralValue + ") does not fulfill the Active Paid Subscription criteria.");
                    } else {
                        document.getElementById('is_valid_refer').value = '0';
                        $("#names").val("");
                        $("#errors").html("Not Found");
                    }
                }
            });
        } else {
            document.getElementById('is_valid_refer').value = '0';
            $("#names").val("");
            $("#errors").html("");
        }
    });
    
  /*  function sendOTP() {
        var mobileNumber = document.getElementById('mobile_number').value;
        document.getElementById('mob_in').value = mobileNumber;
        var token = '{{ csrf_token() }}';
        $.post('{{ route("mobileVerify") }}', { _token: token,mobile: mobileNumber }, function(data) {
            // Show OTP field if OTP is sent successfully
            if (data.success) {
                document.getElementById('otp_field').style.display = 'block';
                document.getElementById('send-otp-bt').style.display = 'none';
                document.getElementById('verify-otp-bt').style.display = 'block';
                Swal.fire({
                  title: "OTP Sent!",
                  text: "OTP sent to the entered mobile number...",
                  icon: "success"
                });
            }else{
                document.getElementById('otp_field').style.display = 'none';
                document.getElementById('send-otp-bt').style.display = 'block';
                document.getElementById('verify-otp-bt').style.display = 'none';
                Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "Please retry after sometime.."
                });
            }
        }).fail(function(response) {
            // Handle server-side validation errors
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: response.responseJSON.error
            });
        });
    }
    function verifyOTP() {
        var otp = $('#otp').val();
        var mobileNumber = document.getElementById('mobile_number').value;
        $.ajax({
            url: '{{ route("verifyOTP") }}',
            type: 'POST',
            data: {
                otp: otp,
                mobile: mobileNumber,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                if (data.success) {
                    document.getElementById('is_valid_number').value = '1';
                    document.getElementById('mobile_number').classList.add('verified');
                    document.getElementById('otp_field').style.display = 'none';
                    document.getElementById('send-otp-bt').style.display = 'none';
                    document.getElementById('verify-otp-bt').style.display = 'none';
                    document.getElementById('mobile_number').disabled = true;
                    document.getElementById('verified_badge').style.display = 'block';
                    Swal.fire({
                          title: "OTP Verified!",
                          icon: "success"
                        });
                } else {
                     Swal.fire({
                      icon: "error",
                      title: "Oops...",
                      text: "You entered incorrect otp.."
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }*/
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    $('#registerForm').submit(function(event) {
        if (document.getElementById('is_valid_number').value == '0') {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Phone Number Not Verified',
                text: 'Please verify your phone number before submitting the form.'
            });
        }
        if($('#is_valid_refer').val()==0 && $('.referralCode').val().trim() !== ''){
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Not a valid referral code!',
                text: 'Please check the entered referral code'
            });
        }
    });
</script>
<button onclick="scrollToTop()" id="scrollToTopBtn" title="Go to top"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2 160 448c0 17.7 14.3 32 32 32s32-14.3 32-32l0-306.7L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"/></svg></button>
    </body>

</html>
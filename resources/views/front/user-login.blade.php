<!DOCTYPE html>
<html lang="en">
    
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <meta name="author" content="Welcome to Pashughar">
    
    <title>
        Welcome to Pashughar
    </title>
    {!! getCommomPageMetaTag('user/login'); !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('before-styles')
    @stack('after-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>


    <!--=====================================
                CSS LINK PART START
    =======================================-->
    <!-- FAVICON -->

  <link rel="icon" href="{{asset('front/images/favicona.ico')}}">
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
                    <a href="{{URL::to('/')}}"><img src="{{asset('front/images/afarlogo.png')}}" alt="logo" style="border-radius:3px;"></a>
                    <h1>Post your Logistics, Cattles, and Products <span>Buy what you need.</span></h1>
                    <p>Biggest Online Marketplace to Sell & Buy Cattle, and Dairy Product in the Afar Region.</p>
                </div>
            </div>

            <div class="user-form-category">
                <div class="user-form-header">
                    <a href="#"><img src="{{asset('front/images/afarlogo.png')}}" alt="logo"></a>
                    <a href="{{URL::to('/')}}"><i class="fas fa-arrow-left"></i></a>
                </div>
                <div class="user-form-category-btn">
                    <ul class="nav nav-tabs">
                        <li><a href="#login-tab" class="nav-link active" data-toggle="tab">sign in</a></li>
                        <li><a href="#register-tab" class="nav-link" data-toggle="tab">sign up</a></li>
                        
                    </ul>
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
                <div class="tab-pane active" id="login-tab">
                    <div class="user-form-title">
                        <h2>Welcome!</h2>
                        <p>Use credentials to access your account.</p>
                    </div>
                    <form id="loginForm" method="post" action="{{ route('user.authenticate') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="email" autocomplete="off" class="form-control" name="email" id="email_id" placeholder="Email Id" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" title="Enter email address" required="">
                                    <small class="form-alert">Please follow this example - abc@example.com</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="pass" placeholder="Password" required>
                                    <button type="button" class="form-icon"><i class="eye fas fa-eye"></i></button>
                                    <small class="form-alert">Password must be 6 characters</small>
                                </div>
                            </div>
                            
                            
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="signin-check">
                                        <label class="custom-control-label" for="signin-check">Remember me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group text-right">
                                    <a href="{{route('forget.password.get')}}" class="form-forgot">Forgot password?</a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group price-btn">
                                    <button type="submit" class="btn btn-inline">
                                        <i class="fas fa-unlock"></i>
                                        <span>Enter Your Dashboard</span>
                                    </button>
                                </div>
                            </div>
                            <!--<div class="col-12" id="otpLoginDiv">-->
                            <!--    <div class="form-group">-->
                            <!--        <button type="button"  data-toggle="modal" data-target="#lr" class="btn btn-inline">-->
                            <!--            <i class="fas fa-unlock"></i>-->
                            <!--            <span>Login With OTP</span>-->
                            <!--        </button>-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                        </div>
                    </form>
                    <div class="user-form-direction">
                        <p>Don't have an account? click on the <span><a href="#register-tab" class="nav-link-register" data-toggle="tab">( Sign up )</a></span> button above.</p>
                    </div>
                </div>

                <div class="tab-pane" id="register-tab">
                    <div class="user-form-title">
                        <h2>Register</h2>
                        <p>Setup a new account in a minute.</p>
                    </div>
                    <ul class="user-form-option">
                        
                        <li>
                            <!--a id="google-signup-link" href="#">
                                <i class="fab fa-google"></i>
                                <span>google</span>
                            </a-->
                        </li>
                    </ul>
                    <!--div class="user-form-devider">
                        <p>or</p>
                    </div-->
                    <form id="registerForm" method="post" action="{{ route('user.register') }}" enctype="multipart/form-data">
                    @csrf
                   
                    
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="full_name" placeholder="Full Name"  required>
                                    <small class="form-alert">example - John Deo</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" autocomplete="off" name="email" id="email_id_register" placeholder="Email"  required>
                                    <small class="form-alert">Please follow this example - abc@example.com</small>
                                    <span id="email_feedback" style="display:none; color:red;">Email already exists</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="tel" onkeypress="return isNumber(event)" autocomplete="off" class="form-control" name="mobile"  minlength="10" maxlength="10" placeholder="Moblie number" id="phone_number" required>
                                    <small class="form-alert">Please follow this example - 01XXXXXXXXX</small>
                                    <!--p id="verified_badge" style="color:green;display:none;">Verified</p-->
                                </div>
                            </div>
                            <div class="col-12">
                                <!--input type="tel" name="mobile" id="mob_in" class="form-control" style="display:none;"/-->
                                <!--input type="text" name="isValid" id="is_valid_number" value="1" class="form-control" style="display:none;"/-->
                                <!--div class="form-group mb-2" id="otp_field" style="display: none;">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="otp"
                                        name="otp"
                                        placeholder="Enter OTP"
                                        maxlength="6"
                                    />
                                </div-->
                                <!--button type="button" class="btn btn-primary mb-2" id="send-otp-bt" onclick="sendOTP()">Send OTP</button>
                                <button type="button" class="btn btn-primary mb-2" id="verify-otp-bt" style="display: none;" onclick="verifyOTP()">Verify</button-->
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="pass2" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                    <button class="form-icon"><i class="eye fas fa-eye"></i></button>
                                    <small class="form-alert">Password must be 8 characters</small>
                                </div>
                            </div>
                            @php $adminsetting = \App\Models\OtherSetting::first();  @endphp
                            @if($adminsetting->is_referral_enable == "1")
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control referralCode" name="referralto" placeholder="Enter Referral Code">
                                    <span id="errors" style="color:brown"></span>
                                    <input type="text" name="isRef" id="is_valid_refer" value="0" class="form-control" style="display:none;"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter Referral Name" id="names" value="{{ Session::get('name') ?? '' }}" readonly>
                                    
                                </div>
                            </div>
                            
                            @endif
                            
                           
                            <div class="col-12">
                                <div class="form-group price-btn">
                                    <button type="submit" class="btn btn-inline">
                                        <i class="fas fa-user-check"></i>
                                        <span>Create new account</span>
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                    <div class="user-form-direction">
                        <p>Already have an account? click on the <span><a href="#login-tab" class="nav-link-login" data-toggle="tab">( Sign in )</a></span> button above.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal -->
<div class="modal fade" id="lr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
			</div>
			<div class="modal-body">
				<div class="logo modals"><a href="{{url('/')}}"><img src="{{asset('front/images/logo.png')}}" alt="" title="" style="width: 200px;"></a></div>
				<div class="get-start">
					Get started with Afar Logistics & Trade Market!
				</div>
				<div class="continue-w">Continue with your mobile number</div>
				<div class="form-login-reg comment-form modal-l">
					<div class="inner-frm contact-form">
						<div class="form-group" id="otpform">
							<input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Your Mobile Number*" >
                            <div class="text-danger" id="mobile_number-err"></div>
                            <div class="text-success" id="mobile_number-success"></div>
						</div>
						<div  id="hiddenInput" style="display: none;">
                            <h6 class=" my-3" style="color: #8B2025">OTP</h6>
                            <div class=" d-flex justify-content-between">
                                
                                <input type="text" class="form-control col-2 otp-input" maxlength="1" autofocus >
                                <input type="text" class="form-control col-2 otp-input" maxlength="1" >
                                <input type="text" class="form-control col-2 otp-input" maxlength="1" >
                                <input type="text" class="form-control col-2 otp-input" maxlength="1" >
                                
                            </div> 
                            <div class="text-danger" id="otp-err"></div>
                        </div>
					
                        <a href="#" class="osd-cus">
                            <div class="cus-btn-osd btn btn-primary" id="verify-btn">Continue</div>
                            <button type="button" class="btn btn-primary" style="display:none" id="validate-otp">Verify Now</button>
                        </a>
                    </div>
					
				</div>
			<div class="alredy-aacount"></div>
		</div>
	</div>
</div>
        <!--=====================================
                    USER-FORM PART END
        =======================================-->

        
        <!--=====================================
                    JS LINK PART START
        =======================================-->
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
                function getUrlParameter(name) {
                    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
                    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                    var results = regex.exec(location.search);
                    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
                }
                $(document).ready(function() {
                $('#email_id_register').on('input change', function() {
                    checkEmailExists();
                });
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
            });
            function checkEmailExists() {
                var email = $('#email_id_register').val();
                var emailFeedback = $('#email_feedback');
                
                // Simple email validation regex
                var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            
                if (emailPattern.test(email)) {
                    $.ajax({
                        url: '{{ route("check-email") }}',
                        method: 'POST',
                        data: {
                            email: email,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if (data.exists) {
                                emailFeedback.text('Email already exists').show();
                                $('#email_id').removeClass('is-valid').addClass('is-invalid');
                            } else {
                                emailFeedback.hide();
                                $('#email_id').removeClass('is-invalid').addClass('is-valid');
                            }
                        }
                    });
                } else {
                    emailFeedback.text('Invalid email address').show();
                    $('#email_id').removeClass('is-valid').addClass('is-invalid');
                }
            }

           /* function sendOTP() {
                var mobileNumber = document.getElementById('phone_number').value;
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
                var mobileNumber = document.getElementById('phone_number').value;
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
                            document.getElementById('phone_number').classList.add('verified');
                            document.getElementById('otp_field').style.display = 'none';
                            document.getElementById('send-otp-bt').style.display = 'none';
                            document.getElementById('verify-otp-bt').style.display = 'none';
                            document.getElementById('phone_number').disabled = true;
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
            }
            document.addEventListener('DOMContentLoaded', function() {
                const otpInputs = document.querySelectorAll('.otp-input');

                otpInputs.forEach((input, index) => {
                    input.addEventListener('input', (event) => {
                        const currentValue = event.target.value;
                        const maxLength = parseInt(event.target.getAttribute('maxlength'));
                        
                        if (currentValue.length >= maxLength) {
                            // Move to the next input field if available
                            const nextIndex = index + 1;
                            if (nextIndex < otpInputs.length) {
                                otpInputs[nextIndex].focus();
                            }
                        }
                    });

                    // Allow only numeric input
                    input.addEventListener('keydown', (event) => {
                        const key = event.key;
                        const isValidInput = /^\d$/.test(key); // Only allow numeric input
                        if (!isValidInput && key !== 'Backspace' && key !== 'Delete') {
                            event.preventDefault();
                        }
                    });
                });
            });
            $("#verify-btn").click(function(){
                $("#mobile_number-err").html('');
                var data = $(this)
                var mobilenumber = $("#mobile_number").val();
                let formData = new FormData();
                formData.append('mobile_number', mobilenumber);
                formData.append('_token', "{{csrf_token()}}");
                $.ajax({
                        url: "{{ URL::to('send/otp') }}",
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        data: formData,
                        context: this,
                        success: function(result) {
                            if (result.success) {
                                $(`#mobile_number-success`).html(result.message);
                                $("#hiddenInput").removeAttr("style")
                                $("#verify-btn").css("display","none")
                                $("#validate-otp").removeAttr("style")
                            } else {
                                $(this).attr('disabled', false);
                                if(result.code == 402){
                                }
                                if (result.code == 422) {
                                    for (const key in result.errors) {
                                        $(`#${key}-err`).html(result.errors[key][0]);
                                    }
                                } else {
                                    console.log(result);
                                }
                            }
                        }
                    });
            })
            
            $(document).on("click","#validate-otp",function(){
                $(".validation-err").html('');
                var mobilenumber = $("#mobile_number").val();
            let otp = ''; 
                    $('.otp-input').each(function() {
                        otp += $(this).val();
                    });
                let formData = new FormData();
                formData.append('mobile_number', mobilenumber);
                formData.append('otp', otp);
                formData.append('_token', "{{csrf_token()}}");
                $.ajax({
                        url: "{{ URL::to('verify/otp') }}",
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        data: formData,
                        context: this,
                        success: function(result) {
                            if (result.success) {
                                alert("Verified Suceessfully")
                                $("#otpform").remove();
                                if(result.profile == 1)
                                {
                                    location.reload();
                                }
                                else{
                                    window.location.href= `{{url('/user/login')}}`
                                }
                                
                            //location.reload();
                                sessionStorage.setItem('otpVerified', 'true');
                            
                            
                            } else {
                                $(this).attr('disabled', false);
                                if (result.code == 422) {
                                    for (const key in result.errors) {
                                        $(`#${key}-err`).html(result.errors[key][0]);
                                    }
                                } else {
                                    $(`#otp-err`).html(result.message);
                                }
                            }
                        }
                    });
            })*/
            function isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            }
            const phoneInputField = document.querySelector("#mobile_number");
            const phoneInput = window.intlTelInput(phoneInputField, {
            initialCountry: "in",
                separateDialCode: true,
            utilsScript:
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });
    </script>
<script>
    $(document).ready(function() {
        var referralCode = getUrlParameter('referralCode');
        if (referralCode) {
            $('.referralCode').val(referralCode);
            setTimeout(function() {
                $(".referralCode").trigger('keyup');
            }, 100);
        }
        $(".referralCode").keyup(function() {
            let referral = $(this).val();
            if (referral !== "") {
                $.ajax({
                    type: "GET",
                    url: "{{url('getusername')}}/" + referral,
                    success: function(data) {
                        if (data.status == 1) {
                            document.getElementById('is_valid_refer').value = '1';
                            $("#names").val(data.name);
                            $("#errors").html("");
                        }else if(data.status == 3){
                            document.getElementById('is_valid_refer').value = '1';
                            $("#names").val("")
                            $(".referralCode").val("")
                            $("#errors").html("This referral code("+referral+") does not fulfill the Active Paid Subscription criteria.");
                        }
                        else {
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
        var googleSignupLink = document.getElementById('google-signup-link');

        // Set the URL for the Google signup link
        if (referralCode) {
            var googleSignupUrl = '{{ route('google.redirect') }}' + '?referralCode=' + referralCode;
        } else {
            var googleSignupUrl = '{{ route('google.redirect') }}';
        }
        
        // Update the href attribute of the Google signup link
        googleSignupLink.href = googleSignupUrl;
    });
    $(document).on("click",".nav-link-register",function(){
        $('.registerlink').addClass('active');
        $('.loginlink').removeClass('active');
        $('.nav-link-login ').removeClass('active');
    });

    $(document).on("click",".nav-link-login",function(){
        $('.loginlink').addClass('active');
        $('.registerlink').removeClass('active');
        $('.nav-link-register ').removeClass('active');
    });
</script>
    </body>

</html>
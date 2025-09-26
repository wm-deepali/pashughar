<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <meta name="author" content="Welcome to Afar Logistic & Trade Marketing | Afar Region | Ethiopia">

    <title>
        Welcome to Pashugha.com | Livestock Market | India
    </title>
    {!! getCommomPageMetaTag('submit-bulk-stock-request') !!}

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('before-styles')
    @stack('after-styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>


    <!--=====================================
                CSS LINK PART START
    =======================================-->
    <!-- FAVICON -->
    <link rel="icon" href="{{asset('front/images/favicon-new.ico')}}">

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

    .comment-form .form-group input[type="text"],
    .comment-form .form-group input[type="password"],
    .comment-form .form-group input[type="tel"],
    .comment-form .form-group input[type="email"],
    .comment-form .form-group input[type="date"],
    .comment-form .form-group input[type="file"],
    .comment-form .form-group select,
    .comment-form .form-group .ui-selectmenu-button.ui-button {
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
        background-color: rgb(247, 247, 246);
        ;
        border: 1px solid rgba(0, 0, 0, 0.06);
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
                <a href="{{URL::to('/')}}"><img src="{{asset('front/images/afarlogo.png')}}" alt="logo"
                        style="border-radius:3px;"></a>
                <h1>List your assets <span>Buy what are you needs.</span></h1>
                <p>Biggest Online Livestock Marketplace in India.</p>
            </div>
        </div>

        <div class="user-form-category">
            <div class="user-form-header">
                <a href="#"><img src="{{asset('front/images/afarlogo.png')}}" alt="logo"></a>
                <a href="{{URL::to('/')}}"><i class="fas fa-arrow-left"></i></a>
            </div>
            <!--<div class="user-form-category-btn">-->
            <!--    <ul class="nav nav-tabs">-->

            <!--        <li><a href="#register-tab" class="nav-link active" data-toggle="tab">Bulk Enquiry form</a></li>-->

            <!--    </ul>-->
            <!--</div>-->
            @if (session('success'))
                <h5 class="alert-success text-center">{{ Session::get('success') }}</h5><br>
                <?php    Session::forget('success');?>
            @endif
            @if (session('error'))
                <h5 class="alert-danger text-center">{{ Session::get('error') }}</h5><br>
                <?php    Session::forget('error');?>
            @endif
            @if($errors->any())
                <h5 style="color: red;text-align: center;"> {{ implode('', $errors->all(':message')) }} </h5><br>
            @endif


            <div class="tab-pane active" id="register-tab">
                <div class="user-form-title1">
                    <h2 style="text-align:center;margin-top:20px;">Bulk Enquiry form</h2>

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
                <form id="enquiryForm" method="post" action="{{route('enquiry.add')}}" enctype="multipart/form-data">
                    @csrf


                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Full Name"
                                    value="{{old('name')}}" required>
                                <small class="form-alert">example - John Deo</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control" autocomplete="off" name="email"
                                    id="email_id_register" value="{{old('email')}}" placeholder="Email" required>
                                <small class="form-alert">Please follow this example - abc@example.com</small>
                                <span id="email_feedback" style="display:none; color:red;">Email already exists</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <div style="display:flex;">
                                    <input type="text" class="form-control" value="+91" readonly
                                        style="width:70px; text-align:center; margin-right:5px;">
                                    <input type="tel" class="form-control" name="mobile" id="phone_number"
                                        placeholder="Enter 10-digit number" maxlength="10" required>
                                </div>
                                <small class="form-alert">Enter 10-digit Indian mobile number</small>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{old('telephones')}}" name="telephones"
                                    placeholder="Telegram Id (if any)" required>
                                <button class="form-icon"></button>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="number" class="form-control" value="{{old('order_qty')}}" name="order_qty"
                                    placeholder="Min. Order Quantity" required>
                                <button class="form-icon"></button>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{old('detail')}}" name="detail"
                                    placeholder="Enter Detail" required>
                                <button class="form-icon"></button>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="form-control custom-select" id="category_id" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categorys as $category)
                                        <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="form-control custom-select" id="state_id" name="state_id">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{$state->id}}" {{old('state_id') == $state->id ? 'selected' : ''}}>
                                            {{$state->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <select class="form-control custom-select" id="city_id" name="city_id">
                                    <option value="">Select City</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="code" value="{{old('code')}}" id="code"
                                    placeholder="Enter Zip Code" required>
                                <button class="form-icon"><i class="eye fas fa-eye"></i></button>
                            </div>
                        </div>

                        {{-- <div class="col-12">
                            <div class="form-group">

                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}">
                                </div>


                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="g-recaptcha mb-2" data-sitekey={{ config('services.recaptcha.key') }}></div>
                        </div>

                        <div class="col-12">
                            <div class="form-group price-btn">
                                <button type="submit" class="btn btn-inline">
                                    <i class="fas fa-user-check"></i>
                                    <span>Send Enquiry</span>
                                </button>
                            </div>
                        </div>

                    </div>
                </form>

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
                    <div class="logo modals"><a href="{{url('/')}}"><img src="{{asset('front/images/logo.png')}}" alt=""
                                title="" style="width: 200px;"></a></div>
                    <div class="get-start">
                        Get started with AVH CLICKS!
                    </div>
                    <div class="continue-w">Continue with your mobile number</div>
                    <div class="form-login-reg comment-form modal-l">
                        <div class="inner-frm contact-form">
                            <div class="form-group" id="otpform">
                                <input type="text" class="form-control" name="mobile_number" id="mobile_number"
                                    placeholder="Your Mobile Number*">
                                <div class="text-danger" id="mobile_number-err"></div>
                                <div class="text-success" id="mobile_number-success"></div>
                            </div>


                            <div id="hiddenInput" style="display: none;">
                                <h6 class=" my-3" style="color: #8B2025">OTP</h6>
                                <div class=" d-flex justify-content-between">

                                    <input type="text" class="form-control col-2 otp-input" maxlength="1" autofocus>
                                    <input type="text" class="form-control col-2 otp-input" maxlength="1">
                                    <input type="text" class="form-control col-2 otp-input" maxlength="1">
                                    <input type="text" class="form-control col-2 otp-input" maxlength="1">

                                </div>
                                <div class="text-danger" id="otp-err"></div>
                            </div>

                            <a href="#" class="osd-cus">
                                <div class="cus-btn-osd btn btn-primary" id="verify-btn">Continue</div>
                                <button type="button" class="btn btn-primary" style="display:none"
                                    id="validate-otp">Verify Now</button>
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
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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

        {{--
        <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}


        {{-- v3 --}}

        {{--
        <script
            src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
        <script>
            grecaptcha.ready(function () {
                grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', { action: 'submit' }).then(function (token) {
                    // Add the token to a hidden input field for validation in the backend
                    let input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'recaptcha_token';
                    input.value = token;
                    document.querySelector('form').appendChild(input);
                });
            });
        </script> --}}


        <!--=====================================
                    JS LINK PART END
        =======================================-->
        <script>
            function isValidEmail(email) {
                var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                return emailPattern.test(email);
            }

            $('#enquiryForm').submit(function (e) {
                let email = $('#email_id_register').val().trim();
                let phone = $('#phone_number').val().trim();

                // Validate email
                if (!isValidEmail(email)) {
                    e.preventDefault();
                    Swal.fire('Invalid Email', 'Please enter a valid email address.', 'error');
                    return false;
                }

                // Validate phone
                if (!/^\d{10}$/.test(phone)) {
                    e.preventDefault();
                    Swal.fire('Invalid Mobile', 'Please enter a 10-digit mobile number.', 'error');
                    return false;
                }

                // Validate reCAPTCHA
                if (grecaptcha.getResponse() == "") {
                    e.preventDefault();
                    Swal.fire('Captcha Required', 'Please verify that you are not a robot.', 'error');
                    return false;
                }
            });


            function getUrlParameter(name) {
                name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
                var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                var results = regex.exec(location.search);
                return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
            }
            $(document).ready(function () {
                $('#email_id_register').on('input change', function () {
                    checkEmailExists();
                });
                $('#registerForm').submit(function (event) {
                    if (document.getElementById('is_valid_number').value == '0') {
                        event.preventDefault();
                        Swal.fire({
                            icon: 'error',
                            title: 'Phone Number Not Verified',
                            text: 'Please verify your phone number before submitting the form.'
                        });
                    }
                    if ($('#is_valid_refer').val() == 0 && $('.referralCode').val().trim() !== '') {
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
                        success: function (data) {
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
            $(document).ready(function () {
                var referralCode = getUrlParameter('referralCode');
                if (referralCode) {
                    $('.referralCode').val(referralCode);
                    setTimeout(function () {
                        $(".referralCode").trigger('keyup');
                    }, 100);
                }
                $(".referralCode").keyup(function () {
                    let referral = $(this).val();
                    if (referral !== "") {
                        $.ajax({
                            type: "GET",
                            url: "{{url('getusername')}}/" + referral,
                            success: function (data) {
                                if (data.status == 1) {
                                    document.getElementById('is_valid_refer').value = '1';
                                    $("#names").val(data.name);
                                    $("#errors").html("");
                                } else if (data.status == 3) {
                                    document.getElementById('is_valid_refer').value = '1';
                                    $("#names").val("")
                                    $(".referralCode").val("")
                                    $("#errors").html("This referral code(" + referral + ") does not fulfill the Active Paid Subscription criteria.");
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
            $(document).on("click", ".nav-link-register", function () {
                $('.registerlink').addClass('active');
                $('.loginlink').removeClass('active');
                $('.nav-link-login ').removeClass('active');
            });

            $(document).on("click", ".nav-link-login", function () {
                $('.loginlink').addClass('active');
                $('.registerlink').removeClass('active');
                $('.nav-link-register ').removeClass('active');
            });
        </script>


        <script>
            $(document).ready(function () {

                var stateid = @JSON(old('state_id'));
                var cityid = @JSON(old('city_id'));

                if (stateid) {
                    $.ajax({
                        url: "{{ route('get-cites') }}",
                        method: 'post',
                        data: { "_token": "{{csrf_token()}}", 'id': id },
                        success: function (data) {
                            console.log(data)
                            $('#city_id').empty();
                            $('#city_id').append('<option value"">Select City By State</option>');
                            if (data) {
                                $.each(data, function (index, value) {
                                    // Apply selected attribute to the matching city ID
                                    if (value.id == cityid) {
                                        $('#city_id').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
                                    } else {
                                        $('#city_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                                    }
                                });
                            }
                        }
                    });
                }
            })

            $(document).on('change', '#state_id', function () {
                const id = $(this).val(); // Get the current value of the input
                console.log(id);
                $.ajax({
                    url: "{{ route('get-cites') }}",
                    method: 'post',
                    data: { "_token": "{{csrf_token()}}", 'id': id },
                    success: function (data) {
                        console.log(data)
                        $('#city_id').empty();
                        $('#city_id').append('<option value"">Select City By State</option>');
                        if (data) {
                            $.each(data, function (index, value) {
                                $('#city_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    }
                });
            })
        </script>
</body>

</html>
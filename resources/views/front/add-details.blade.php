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

    <link rel="icon" href="{{asset('front/images/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('front/fonts/font-awesome/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/custom/main.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/custom/user-form.css')}}">
    
</head>

<style>
    :root{
        --accent: #1f4b3f;
        --accent-light: #2c6b57;
        --bg-soft: #f7f7f6;
        --radius: 50px;
    }
    body{ background: var(--bg-soft); }
    .auth-shell{ max-width: 460px; margin: 60px auto; padding: 0 20px; }
    .auth-logo{ text-align:center; margin-bottom: 18px; }
    .auth-logo img{ max-height: 46px; }
    .auth-card{
        background:#fff;
        border:1px solid #e7e5e2;
        border-radius: 18px;
        padding: 32px 28px;
        box-shadow: 0 10px 30px rgba(0,0,0,.05);
    }
    .auth-title{ text-align:center; font-size:22px; font-weight:700; margin-bottom:4px; }
    .auth-subtitle{ text-align:center; color:#8a8a8a; font-size:14px; margin-bottom:26px; }

    .pill-input{
        width:100%; height:56px;
        border-radius: var(--radius);
        border:1px solid #e2e0dc;
        background: var(--bg-soft);
        padding: 0 22px; font-size:15px; outline:none;
        transition: border-color .2s ease;
    }
    .pill-input:focus{ border-color: var(--accent-light); background:#fff; }
    .pill-input[readonly]{ color:#888; }

    select.pill-input{
        appearance:none; -webkit-appearance:none;
        background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23888' stroke-width='2' fill='none'/%3E%3C/svg%3E");
        background-repeat:no-repeat; background-position: right 20px center;
    }

    .pill-btn{
        width:100%; height:54px;
        border-radius: var(--radius);
        border:none; background: var(--accent); color:#fff;
        font-size:16px; font-weight:600; cursor:pointer;
        transition: background .2s ease, opacity .2s ease;
    }
    .pill-btn:hover{ background: var(--accent-light); }
    .pill-btn:disabled{ opacity:.6; cursor:not-allowed; }

    .field-group{ margin-bottom:16px; }
    .field-error{ color:#c0392b; font-size:12px; margin-top:4px; display:block; }

    .mobile-input-group{ display:flex; align-items:center; border:1px solid #e2e0dc; border-radius: var(--radius); background: var(--bg-soft); overflow:hidden; }
    .mobile-prefix{ padding: 0 14px; color:#666; font-size:15px; border-right:1px solid #e2e0dc; height:56px; display:flex; align-items:center; }
    .mobile-input-group input{ border:none; background:transparent; height:56px; padding:0 18px; flex:1; font-size:15px; outline:none; }

    .otp-row{ display:flex; gap:10px; justify-content:center; margin: 18px 0 8px; }
    .otp-box{ width:44px; height:54px; text-align:center; font-size:20px; border-radius:12px; border:1px solid #e2e0dc; background: var(--bg-soft); }
    .otp-box:focus{ border-color: var(--accent-light); background:#fff; outline:none; }

    .resend-row{ text-align:center; font-size:13px; color:#888; margin-bottom:18px; }
    .resend-row a{ color: var(--accent); font-weight:600; cursor:pointer; }
    .resend-row a.disabled{ color:#bbb; pointer-events:none; }

    .step-hidden{ display:none; }
    .back-link{ font-size:13px; color:#888; cursor:pointer; display:inline-flex; align-items:center; gap:6px; margin-bottom:14px; }
    .back-link:hover{ color: var(--accent); }

    /* Password show/hide */
    .password-wrap { position: relative; }
    .password-wrap .pill-input { padding-right: 48px; }
    .toggle-password {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        cursor: pointer;
        font-size: 15px;
        user-select: none;
    }
    .toggle-password:hover { color: var(--accent); }

    #scrollToTopBtn{
        display:none; position:fixed; bottom:20px; right:30px; z-index:9999;
        background-color:#1f4b3f; color:#fff; border:none; border-radius:50%;
        padding:10px; cursor:pointer; box-shadow:0 4px 8px rgba(0,0,0,.2);
        width:50px; height:50px; align-items:center; justify-content:center;
    }
    #scrollToTopBtn svg{ fill:#fff; width:24px; height:24px; }
    .swal2-container{ z-index: 10000; }
</style>

<body>

<section class="auth-shell">
    <div class="auth-logo">
        <a href="{{URL::to('/')}}"><img src="{{asset('front/images/logo.png')}}" alt="logo"></a>
    </div>

    @if (session('success'))
        <h5 class="alert alert-success text-center">{{ Session::get('success') }}</h5>
        <?php Session::forget('success'); ?>
    @endif
    @if (session('error'))
        <h5 class="alert alert-danger text-center">{{ Session::get('error') }}</h5>
        <?php Session::forget('error'); ?>
    @endif
    @if($errors->any())
        <h5 class="alert alert-danger text-center">{{ implode('', $errors->all(':message')) }}</h5>
    @endif

    <div class="auth-card">
        <div class="auth-title">Almost there!</div>
        <div class="auth-subtitle">Just a few more details to finish setting up</div>

        {{-- Step 1: mobile --}}
        <div id="mobileStep">
            <div class="field-group">
                <div class="mobile-input-group">
                    <span class="mobile-prefix">+91</span>
                    <input type="text" id="mobileInput" maxlength="10" inputmode="numeric" placeholder="Enter Mobile Number" value="{{ old('mobile') }}">
                </div>
                <span class="field-error" id="mobileInput-err"></span>
            </div>
            <button type="button" class="pill-btn" id="sendOtpBtn">Send OTP</button>
        </div>

        {{-- Step 2: OTP (4 digit, same as login/register flow) --}}
        <div id="otpStep" class="step-hidden">
            <span class="back-link" onclick="backToMobile()"><i class="fas fa-arrow-left"></i> Back</span>
            <div class="auth-subtitle" style="margin-bottom:6px;">Enter the 4-digit code sent to <b id="otpMobileLabel"></b></div>
            <div class="otp-row">
                <input type="text" class="otp-box detail-otp-box" maxlength="1" inputmode="numeric">
                <input type="text" class="otp-box detail-otp-box" maxlength="1" inputmode="numeric">
                <input type="text" class="otp-box detail-otp-box" maxlength="1" inputmode="numeric">
                <input type="text" class="otp-box detail-otp-box" maxlength="1" inputmode="numeric">
            </div>
            <span class="field-error" id="detailOtp-err" style="display:block; text-align:center; margin-bottom:10px;"></span>
            <div class="resend-row">
                Didn't receive code? <a id="detailResendLink" class="disabled">Resend in <span id="detailResendTimer">30</span>s</a>
            </div>
            <button type="button" class="pill-btn" id="verifyOtpBtn">Verify</button>
        </div>

        {{-- Step 3: rest of the form --}}
        <div id="detailsStep" class="step-hidden">
            <form id="registerForm" method="post" action="{{ route('first.details.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="mobile" id="mobileHidden">

                <div class="field-group">
                    <input type="text" class="pill-input" name="full_name" value="{{$user->full_name}}" placeholder="Full Name" required>
                </div>
                <div class="field-group">
                    <input type="text" class="pill-input" value="{{$user->email}}" placeholder="Email" readonly>
                </div>
                <div class="field-group">
                    <select name="state" id="detailState" class="pill-input">
                        <option value="">Select State</option>
                        @isset($states)
                            @foreach($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="field-group">
                    <select name="city" id="detailCity" class="pill-input">
                        <option value="">Select City</option>
                    </select>
                </div>
                <div class="field-group password-wrap">
                    <input type="password" class="pill-input" name="password" id="detailPassword" placeholder="Password"
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                        title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                        required>
                    <i class="fas fa-eye toggle-password" data-target="detailPassword"></i>
                </div>

                @php $adminsetting = \App\Models\OtherSetting::first(); @endphp
                @if($adminsetting->is_referral_enable == "1")
                    <div class="field-group">
                        <input type="text" class="pill-input referralCode" name="referralto" placeholder="Enter Referral Code (optional)">
                        <span id="errors" style="color:brown; font-size:12px;"></span>
                        <input type="text" name="isRef" id="is_valid_refer" value="0" style="display:none;">
                    </div>
                    <div class="field-group">
                        <input type="text" class="pill-input" placeholder="Referred by" id="names" value="" readonly>
                    </div>
                @endif

                <button type="submit" class="pill-btn">Create new account</button>
            </form>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">
<script src="{{asset('front/js/vendor/popper.min.js')}}"></script>
<script src="{{asset('front/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/custom/main.js')}}"></script>

<script>
const CSRF = '{{ csrf_token() }}';

window.onscroll = function() { scrollFunction() };
function scrollFunction() {
    const btn = document.getElementById("scrollToTopBtn");
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) { btn.style.display = "flex"; }
    else { btn.style.display = "none"; }
}
function scrollToTop() { window.scrollTo({top: 0, behavior: 'smooth'}); }

function backToMobile(){
    $('#otpStep').addClass('step-hidden');
    $('#mobileStep').removeClass('step-hidden');
    clearInterval(window.detailResendLink_interval);
}

/* OTP box auto-advance */
(function(){
    const boxes = document.querySelectorAll('.detail-otp-box');
    boxes.forEach((input, idx) => {
        input.addEventListener('input', () => {
            input.value = input.value.replace(/[^0-9]/g,'');
            if(input.value.length === 1 && idx < boxes.length - 1){ boxes[idx+1].focus(); }
        });
        input.addEventListener('keydown', (e) => {
            if(e.key === 'Backspace' && input.value === '' && idx > 0){ boxes[idx-1].focus(); }
        });
    });
})();
function collectOtp(){
    let otp = '';
    document.querySelectorAll('.detail-otp-box').forEach(i => otp += i.value);
    return otp;
}
function startResendTimer(seconds, onResend){
    let time = seconds;
    $('#detailResendTimer').text(time);
    $('#detailResendLink').addClass('disabled').off('click');
    clearInterval(window.detailResendLink_interval);
    window.detailResendLink_interval = setInterval(() => {
        time--;
        $('#detailResendTimer').text(time);
        if(time <= 0){
            clearInterval(window.detailResendLink_interval);
            $('#detailResendLink').removeClass('disabled').text('Resend OTP').on('click', onResend);
        }
    }, 1000);
}

function isNumber(evt) {
    evt = evt || window.event;
    var charCode = evt.which || evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) { return false; }
    return true;
}
$('#mobileInput').on('keypress', isNumber);

/* Password show/hide toggle */
$(document).on('click', '.toggle-password', function () {
    const targetId = $(this).data('target');
    const input = document.getElementById(targetId);
    if (input.type === 'password') {
        input.type = 'text';
        $(this).removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
        input.type = 'password';
        $(this).removeClass('fa-eye-slash').addClass('fa-eye');
    }
});

$('#sendOtpBtn').on('click', function(){
    const mobile = $('#mobileInput').val().trim();
    $('#mobileInput-err').text('');
    if(!/^[6-9]\d{9}$/.test(mobile)){
        $('#mobileInput-err').text('Enter a valid 10-digit Indian mobile number');
        return;
    }
    sendOtp(mobile);
});

function sendOtp(mobile){
    $('#sendOtpBtn').prop('disabled', true);
    $.post('{{ route("mobileVerify") }}', { mobile: mobile, _token: CSRF })
        .done(function(data){
            $('#sendOtpBtn').prop('disabled', false);
            if(data.success){
                $('#otpMobileLabel').text('+91 ' + mobile);
                $('#mobileStep').addClass('step-hidden');
                $('#otpStep').removeClass('step-hidden');
                $('.detail-otp-box').val('');
                $('.detail-otp-box').first().focus();
                startResendTimer(30, function(){ sendOtp(mobile); });
            } else {
                Swal.fire({icon:'error', title:'Oops...', text:'Please retry after sometime.'});
            }
        })
        .fail(function(response){
            $('#sendOtpBtn').prop('disabled', false);
            const msg = response.responseJSON && response.responseJSON.error
                ? response.responseJSON.error
                : (response.responseJSON && response.responseJSON.mobile ? response.responseJSON.mobile[0] : 'This mobile number may already be registered.');
            Swal.fire({icon:'error', title:'Oops...', text: msg});
        });
}

$('#verifyOtpBtn').on('click', function(){
    const mobile = $('#otpMobileLabel').text().replace('+91 ', '');
    const otp = collectOtp();
    $('#detailOtp-err').text('');
    if(otp.length < 4){
        $('#detailOtp-err').text('Please enter the complete 4-digit OTP');
        return;
    }
    $('#verifyOtpBtn').prop('disabled', true).text('Verifying...');
    $.ajax({
        url: '{{ route("verifyOTP") }}',
        type: 'POST',
        data: { mobile: mobile, otp: otp, _token: CSRF },
        dataType: 'json',
        success: function(data){
            $('#verifyOtpBtn').prop('disabled', false).text('Verify');
            if(data.success){
                $('#mobileHidden').val(mobile);
                $('#otpStep').addClass('step-hidden');
                $('#detailsStep').removeClass('step-hidden');
            } else {
                $('#detailOtp-err').text('You entered an incorrect OTP.');
            }
        },
        error: function(){
            $('#verifyOtpBtn').prop('disabled', false).text('Verify');
            Swal.fire({icon:'error', title:'Oops...', text:'Something went wrong, please try again.'});
        }
    });
});

/* State -> City */
$('#detailState').on('change', function(){
    var stateId = $(this).val();
    var citySelect = $('#detailCity');
    if(!stateId){
        citySelect.html('<option value="">Select City</option>');
        return;
    }
    $.post("{{ route('cities-by-state') }}", { state_id: stateId, _token: CSRF }, function(data){
        citySelect.html(data);
    });
});

/* Referral code */
let referral = '{{ session('referralCode') }}';
let referralCodeElement = $(".referralCode");
referralCodeElement.val(referral);
if (referral) {
    setTimeout(function() { referralCodeElement.trigger('keyup'); }, 100);
}
$(".referralCode").keyup(function() {
    let referralValue = $(this).val();
    if (referralValue !== "") {
        $.ajax({
            type: "GET",
            url: "{{ url('getusername') }}/" + referralValue,
            success: function(data) {
                if (data.status == 1) {
                    $('#is_valid_refer').val('1');
                    $("#names").val(data.name);
                    $("#errors").html("");
                } else if (data.status == 3) {
                    $('#is_valid_refer').val('1');
                    $("#names").val("");
                    $(".referralCode").val("");
                    $("#errors").html("This referral code(" + referralValue + ") does not fulfill the Active Paid Subscription criteria.");
                } else {
                    $('#is_valid_refer').val('0');
                    $("#names").val("");
                    $("#errors").html("Not Found");
                }
            }
        });
    } else {
        $('#is_valid_refer').val('0');
        $("#names").val("");
        $("#errors").html("");
    }
});

$('#registerForm').submit(function(event) {
    if ($('#is_valid_refer').length && $('#is_valid_refer').val() == 0 && $('.referralCode').val() && $('.referralCode').val().trim() !== '') {
        event.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Not a valid referral code!',
            text: 'Please check the entered referral code'
        });
    }
});
</script>

<button onclick="scrollToTop()" id="scrollToTopBtn" title="Go to top">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2 160 448c0 17.7 14.3 32 32 32s32-14.3 32-32l0-306.7L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"/></svg>
</button>

</body>
</html>
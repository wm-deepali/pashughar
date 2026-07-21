<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Welcome to Pashughar">
    <title>Welcome to Pashughar</title>
    {!! getCommomPageMetaTag('user-login') !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('before-styles')
    @stack('after-styles')

    <link rel="icon" href="{{asset('front/images/favicona.ico')}}">
    <link rel="stylesheet" href="{{asset('front/fonts/font-awesome/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/custom/main.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/custom/user-form.css')}}">
    
</head>

<style>
    :root {
        --accent: #1f4b3f;
        --accent-light: #2c6b57;
        --bg-soft: #f7f7f6;
        --radius: 50px;
    }

    .auth-shell {
        max-width: 460px;
        margin: 60px auto;
        padding: 0 20px;
    }

    .auth-card {
        background: #fff;
        border: 1px solid #e7e5e2;
        border-radius: 18px;
        padding: 32px 28px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
    }

    .auth-logo {
        text-align: center;
        margin-bottom: 18px;
    }

    .auth-logo img {
        max-height: 46px;
    }

    .auth-title {
        text-align: center;
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .auth-subtitle {
        text-align: center;
        color: #8a8a8a;
        font-size: 14px;
        margin-bottom: 26px;
    }

    .pill-input {
        width: 100%;
        height: 56px;
        border-radius: var(--radius);
        border: 1px solid #e2e0dc;
        background: var(--bg-soft);
        padding: 0 22px;
        font-size: 15px;
        outline: none;
        transition: border-color .2s ease;
    }

    .pill-input:focus {
        border-color: var(--accent-light);
        background: #fff;
    }

    .pill-btn {
        width: 100%;
        height: 54px;
        border-radius: var(--radius);
        border: none;
        background: var(--accent);
        color: #fff;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s ease, opacity .2s ease;
    }

    .pill-btn:hover {
        background: var(--accent-light);
    }

    .pill-btn:disabled {
        opacity: .6;
        cursor: not-allowed;
    }

    .pill-btn-outline {
        width: 100%;
        height: 54px;
        border-radius: var(--radius);
        border: 1px solid #e2e0dc;
        background: #fff;
        color: #222;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: background .2s ease;
    }

    .pill-btn-outline:hover {
        background: #f7f7f6;
    }

    .pill-btn-outline img {
        width: 20px;
        height: 20px;
    }

    .field-group {
        margin-bottom: 16px;
    }

    .field-label {
        font-size: 13px;
        color: #666;
        margin-bottom: 6px;
        display: block;
    }

    .or-divider {
        text-align: center;
        color: #a3a3a3;
        font-size: 13px;
        margin: 18px 0;
        position: relative;
    }

    .auth-switch {
        text-align: center;
        margin-top: 22px;
        font-size: 14px;
        color: #555;
    }

    .auth-switch a {
        color: var(--accent);
        font-weight: 600;
        text-decoration: none;
    }

    .otp-row {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin: 18px 0 8px;
    }

    .otp-box {
        width: 48px;
        height: 56px;
        text-align: center;
        font-size: 20px;
        border-radius: 12px;
        border: 1px solid #e2e0dc;
        background: var(--bg-soft);
    }

    .otp-box:focus {
        border-color: var(--accent-light);
        background: #fff;
        outline: none;
    }

    .resend-row {
        text-align: center;
        font-size: 13px;
        color: #888;
        margin-bottom: 18px;
    }

    .resend-row a {
        color: var(--accent);
        font-weight: 600;
        cursor: pointer;
    }

    .resend-row a.disabled {
        color: #bbb;
        pointer-events: none;
    }

    .field-error {
        color: #c0392b;
        font-size: 12px;
        margin-top: 4px;
        display: block;
    }

    .field-success {
        color: #1f8a4c;
        font-size: 12px;
        margin-top: 4px;
        display: block;
    }

    .mobile-input-group {
        display: flex;
        align-items: center;
        border: 1px solid #e2e0dc;
        border-radius: var(--radius);
        background: var(--bg-soft);
        overflow: hidden;
    }

    .mobile-prefix {
        padding: 0 14px;
        color: #666;
        font-size: 15px;
        border-right: 1px solid #e2e0dc;
        height: 56px;
        display: flex;
        align-items: center;
    }

    .mobile-input-group input {
        border: none;
        background: transparent;
        height: 56px;
        padding: 0 18px;
        flex: 1;
        font-size: 15px;
        outline: none;
    }

    select.pill-input {
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23888' stroke-width='2' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 20px center;
    }

    .step-hidden {
        display: none;
    }

    .back-link {
        font-size: 13px;
        color: #888;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 14px;
    }

    .back-link:hover {
        color: var(--accent);
    }

    .alert-modern {
        max-width: 460px;
        margin: 0 auto 16px;
        padding: 14px 18px;
        border-radius: 14px;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        animation: alertSlideIn .25s ease;
    }

    .alert-modern .alert-icon {
        flex-shrink: 0;
        width: 20px;
        height: 20px;
        margin-top: 1px;
    }

    .alert-modern .alert-text {
        flex: 1;
        line-height: 1.4;
        text-align: left;
    }

    .alert-modern .alert-close {
        flex-shrink: 0;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 16px;
        line-height: 1;
        opacity: .5;
        padding: 0;
        color: inherit;
    }

    .alert-modern .alert-close:hover {
        opacity: 1;
    }

    .alert-modern.alert-success-modern {
        background: #eafaf1;
        color: #1f8a4c;
        border: 1px solid #bfead0;
    }

    .alert-modern.alert-error-modern {
        background: #fdecea;
        color: #c0392b;
        border: 1px solid #f5c6c0;
    }

    @keyframes alertSlideIn {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<body>

    <section class="auth-shell">
        <div class="auth-logo">
            <a href="{{URL::to('/')}}"><img src="{{asset('front/images/pashugharlogo.png')}}" alt="logo"></a>
        </div>

        @if (session('success'))
            <div class="alert-modern alert-success-modern" id="successAlert">
                <svg class="alert-icon" viewBox="0 0 24 24" fill="none">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="alert-text">{{ Session::get('success') }}</span>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">&times;</button>
            </div>
            <?php    Session::forget('success'); ?>
        @endif

        @if (session('error'))
            <div class="alert-modern alert-error-modern" id="errorAlert">
                <svg class="alert-icon" viewBox="0 0 24 24" fill="none">
                    <path d="M12 9v4m0 4h.01M12 3l9 16H3L12 3z" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="alert-text">{{ Session::get('error') }}</span>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">&times;</button>
            </div>
            <?php    Session::forget('error'); ?>
        @endif

        @if($errors->any())
            <div class="alert-modern alert-error-modern" id="validationAlert">
                <svg class="alert-icon" viewBox="0 0 24 24" fill="none">
                    <path d="M12 9v4m0 4h.01M12 3l9 16H3L12 3z" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="alert-text">{{ implode(' ', $errors->all(':message')) }}</span>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif

        <div class="auth-card">

            {{-- ===================== LOGIN VIEW ===================== --}}
            <div id="loginView">
                <div class="auth-title">Welcome back!</div>
                <div class="auth-subtitle">Use your mobile or email to continue</div>

                {{-- Step 1: identifier input --}}
                <div id="loginIdentifierStep">
                    <div class="field-group">
                        <input type="text" id="loginIdentifier" class="pill-input"
                            placeholder="Enter Mobile Number or Email" autocomplete="off">
                        <span class="field-error" id="loginIdentifier-err"></span>
                    </div>
                    <button type="button" class="pill-btn" id="loginContinueBtn">Continue</button>

                    <div class="or-divider">OR</div>
                    <button type="button" class="pill-btn-outline" id="googleLoginBtn">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="google">
                        <span>Login with Google</span>
                    </button>
                </div>

                {{-- Step 2a: email + password --}}
                <div id="loginPasswordStep" class="step-hidden">
                    <span class="back-link" onclick="backToIdentifier('login')"><i class="fas fa-arrow-left"></i>
                        Back</span>
                    <form id="loginForm" method="post" action="{{ route('user.authenticate') }}">
                        @csrf
                        <input type="hidden" name="email" id="loginEmailHidden">
                        <div class="field-group">
                            <input type="password" name="password" id="loginPassword" class="pill-input"
                                placeholder="Password" required>
                            <small class="field-error" style="display:none" id="loginPassword-err"></small>
                        </div>
                        <div
                            style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                            <label style="font-size:13px; color:#666;"><input type="checkbox" name="remember"> Remember
                                me</label>
                            <a href="{{route('forget.password.get')}}"
                                style="font-size:13px; color:var(--accent);">Forgot password?</a>
                        </div>
                        <button type="submit" class="pill-btn">Login</button>
                    </form>
                </div>

                {{-- Step 2b: mobile OTP (4 digit) --}}
                <div id="loginOtpStep" class="step-hidden">
                    <span class="back-link" onclick="backToIdentifier('login')"><i class="fas fa-arrow-left"></i>
                        Back</span>
                    <div class="auth-subtitle" style="margin-bottom:6px;">Enter the 4-digit code sent to <b
                            id="loginOtpMobileLabel"></b></div>
                    <div class="otp-row" id="loginOtpBoxes">
                        <input type="text" class="otp-box login-otp-box" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-box login-otp-box" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-box login-otp-box" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-box login-otp-box" maxlength="1" inputmode="numeric">
                    </div>
                    <span class="field-error" id="loginOtp-err"
                        style="display:block; text-align:center; margin-bottom:10px;"></span>
                    <div class="resend-row">
                        Didn't receive code? <a id="loginResendLink" class="disabled">Resend in <span
                                id="loginResendTimer">30</span>s</a>
                    </div>
                    <button type="button" class="pill-btn" id="loginVerifyOtpBtn">Verify & Login</button>
                </div>

                <div class="auth-switch">
                    Don't have an account? <a onclick="switchTab('register')">Sign up</a>
                </div>
            </div>

            {{-- ===================== REGISTER VIEW ===================== --}}
            <div id="registerView" class="step-hidden">
                <div class="auth-title">Get started!</div>
                <div class="auth-subtitle">Setup a new account in a minute</div>

                {{-- Step 1: mobile --}}
                <div id="regMobileStep">
                    <div class="field-group">
                        <div class="mobile-input-group">
                            <span class="mobile-prefix">+91</span>
                            <input type="text" id="regMobile" maxlength="10" inputmode="numeric"
                                placeholder="Enter Mobile Number">
                        </div>
                        <span class="field-error" id="regMobile-err"></span>
                    </div>
                    <button type="button" class="pill-btn" id="regSendOtpBtn">Send OTP</button>

                    <div class="or-divider">OR</div>
                    <button type="button" class="pill-btn-outline" id="googleSignupBtn">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="google">
                        <span>Sign up with Google</span>
                    </button>
                </div>

                {{-- Step 2: OTP (6 digit) --}}
                <div id="regOtpStep" class="step-hidden">
                    <span class="back-link" onclick="backToRegMobile()"><i class="fas fa-arrow-left"></i> Back</span>
                    <div class="auth-subtitle" style="margin-bottom:6px;">Enter the 6-digit code sent to <b
                            id="regOtpMobileLabel"></b></div>
                    <div class="otp-row">
                        <input type="text" class="otp-box reg-otp-box" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-box reg-otp-box" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-box reg-otp-box" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-box reg-otp-box" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-box reg-otp-box" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-box reg-otp-box" maxlength="1" inputmode="numeric">
                    </div>
                    <span class="field-error" id="regOtp-err"
                        style="display:block; text-align:center; margin-bottom:10px;"></span>
                    <div class="resend-row">
                        Didn't receive code? <a id="regResendLink" class="disabled">Resend in <span
                                id="regResendTimer">30</span>s</a>
                    </div>
                    <button type="button" class="pill-btn" id="regVerifyOtpBtn">Verify</button>
                </div>

                {{-- Step 3: rest of the form --}}
                <div id="regDetailsStep" class="step-hidden">
                    <form id="registerForm" method="post" action="{{ route('user.register') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mobile" id="regMobileHidden">

                        <div class="field-group">
                            <input type="text" class="pill-input" name="full_name" placeholder="Full Name" required>
                        </div>
                        <div class="field-group">
                            <input type="text" class="pill-input" name="email" id="email_id_register"
                                placeholder="Email (optional)" autocomplete="off">
                            <span class="field-error" id="email_feedback" style="display:none;">Email already
                                exists</span>
                        </div>
                        <div class="field-group">
                            <select name="state" id="regState" class="pill-input">
                                <option value="">Select State</option>
                                @isset($states)
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="field-group">
                            <select name="city" id="regCity" class="pill-input">
                                <option value="">Select City</option>
                            </select>
                        </div>
                        <div class="field-group">
                            <input type="password" class="pill-input" name="password" placeholder="Password"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                                required>
                        </div>

                        @php $adminsetting = \App\Models\OtherSetting::first(); @endphp
                        @if($adminsetting->is_referral_enable == "1")
                            <div class="field-group">
                                <input type="text" class="pill-input referralCode" name="referralto"
                                    placeholder="Enter Referral Code (optional)">
                                <span id="errors" style="color:brown; font-size:12px;"></span>
                                <input type="text" name="isRef" id="is_valid_refer" value="0" style="display:none;">
                            </div>
                            <div class="field-group">
                                <input type="text" class="pill-input" placeholder="Referred by" id="names"
                                    value="{{ Session::get('name') ?? '' }}" readonly>
                            </div>
                        @endif

                        <div class="field-group">
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                        </div>

                        <button type="submit" class="pill-btn">Create Account</button>
                    </form>
                </div>

                <div class="auth-switch" id="registerSwitchFooter">
                    Already have an account? <a onclick="switchTab('login')">Sign in</a>
                </div>
            </div>

        </div>
    </section>

    <div class="modal fade" id="resendVerificationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Resend Verification Email</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p>Enter your registered email to resend the verification link:</p>
                        <input type="email" class="form-control" name="email" value="{{ session('resend_email') }}"
                            required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Send Link</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if(session('resend_email'))
        <script>$(function () { $('#resendVerificationModal').modal('show'); });</script>
    @endif

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="{{asset('front/js/vendor/popper.min.js')}}"></script>
    <script src="{{asset('front/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/js/custom/main.js')}}"></script>

    <script>
        const CSRF = '{{ csrf_token() }}';

        function switchTab(tab) {
            if (tab === 'register') {
                $('#loginView').addClass('step-hidden');
                $('#registerView').removeClass('step-hidden');
            } else {
                $('#registerView').addClass('step-hidden');
                $('#loginView').removeClass('step-hidden');
            }
        }

        function backToIdentifier() {
            $('#loginPasswordStep, #loginOtpStep').addClass('step-hidden');
            $('#loginIdentifierStep').removeClass('step-hidden');
            clearInterval(window.loginTimerInterval);
        }

        function backToRegMobile() {
            $('#regOtpStep').addClass('step-hidden');
            $('#regMobileStep').removeClass('step-hidden');
            clearInterval(window.regTimerInterval);
        }

        /* ---------- OTP box auto-advance ---------- */
        function wireOtpBoxes(selector) {
            const boxes = document.querySelectorAll(selector);
            boxes.forEach((input, idx) => {
                input.addEventListener('input', () => {
                    input.value = input.value.replace(/[^0-9]/g, '');
                    if (input.value.length === 1 && idx < boxes.length - 1) {
                        boxes[idx + 1].focus();
                    }
                });
                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && input.value === '' && idx > 0) {
                        boxes[idx - 1].focus();
                    }
                });
            });
        }
        wireOtpBoxes('.login-otp-box');
        wireOtpBoxes('.reg-otp-box');

        function collectOtp(selector) {
            let otp = '';
            document.querySelectorAll(selector).forEach(i => otp += i.value);
            return otp;
        }

        function startResendTimer(linkId, timerId, seconds, onResend) {
            let time = seconds;
            $(`#${timerId}`).text(time);
            $(`#${linkId}`).addClass('disabled').off('click');
            clearInterval(window[linkId + '_interval']);
            window[linkId + '_interval'] = setInterval(() => {
                time--;
                $(`#${timerId}`).text(time);
                if (time <= 0) {
                    clearInterval(window[linkId + '_interval']);
                    $(`#${linkId}`).removeClass('disabled').text('Resend OTP').on('click', onResend);
                }
            }, 1000);
        }

        /* ============ LOGIN: identifier detection ============ */
        $('#loginContinueBtn').on('click', function () {
            const val = $('#loginIdentifier').val().trim();
            $('#loginIdentifier-err').text('');

            const mobilePattern = /^[6-9]\d{9}$/;
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

            if (mobilePattern.test(val)) {
                sendLoginOtp(val);
            } else if (emailPattern.test(val)) {
                $('#loginEmailHidden').val(val);
                $('#loginIdentifierStep').addClass('step-hidden');
                $('#loginPasswordStep').removeClass('step-hidden');
            } else {
                $('#loginIdentifier-err').text('Enter a valid 10-digit mobile number or email address');
            }
        });

        function sendLoginOtp(mobile) {
            $('#loginContinueBtn').prop('disabled', true);
            $.ajax({
                url: "{{ URL::to('send/otp') }}",
                type: 'POST',
                data: { mobile_number: mobile, _token: CSRF },
                dataType: 'json',
                success: function (result) {
                    $('#loginContinueBtn').prop('disabled', false);
                    if (result.success) {
                        $('#loginOtpMobileLabel').text('+91 ' + mobile);
                        $('#loginIdentifierStep').addClass('step-hidden');
                        $('#loginOtpStep').removeClass('step-hidden');
                        $('.login-otp-box').val('');
                        $('.login-otp-box').first().focus();
                        startResendTimer('loginResendLink', 'loginResendTimer', 30, function () { sendLoginOtp(mobile); });
                    } else {
                        let msg = result.code == 422 ? Object.values(result.errors)[0][0] : 'Please retry after sometime.';
                        Swal.fire({ icon: 'error', title: 'Oops...', text: msg });
                    }
                },
                error: function () {
                    $('#loginContinueBtn').prop('disabled', false);
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                }
            });
        }

        $('#loginVerifyOtpBtn').on('click', function () {
            const mobile = $('#loginOtpMobileLabel').text().replace('+91 ', '');
            const otp = collectOtp('.login-otp-box');
            $('#loginOtp-err').text('');
            if (otp.length < 4) {
                $('#loginOtp-err').text('Please enter the complete 4-digit OTP');
                return;
            }
            $('#loginVerifyOtpBtn').prop('disabled', true).text('Verifying...');
            $.ajax({
                url: "{{ URL::to('verify/otp') }}",
                type: 'POST',
                data: { mobile_number: mobile, otp: otp, _token: CSRF },
                dataType: 'json',
                success: function (result) {
                    $('#loginVerifyOtpBtn').prop('disabled', false).text('Verify & Login');
                    if (result.success) {
                        window.location.href = result.redirect || "{{ route('user.dashboard') }}";
                    } else {
                        let msg = result.code == 422 ? Object.values(result.errors)[0][0] : (result.message || 'Incorrect OTP');
                        $('#loginOtp-err').text(msg);
                    }
                },
                error: function () {
                    $('#loginVerifyOtpBtn').prop('disabled', false).text('Verify & Login');
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                }
            });
        });

        /* ============ REGISTER: mobile -> OTP -> details ============ */
        $('#regSendOtpBtn').on('click', function () {
            const mobile = $('#regMobile').val().trim();
            $('#regMobile-err').text('');
            if (!/^[6-9]\d{9}$/.test(mobile)) {
                $('#regMobile-err').text('Enter a valid 10-digit Indian mobile number');
                return;
            }
            sendRegisterOtp(mobile);
        });

        function sendRegisterOtp(mobile) {
            $('#regSendOtpBtn').prop('disabled', true);
            $.post("{{ route('mobileVerify') }}", { mobile: mobile, _token: CSRF })
                .done(function (data) {
                    $('#regSendOtpBtn').prop('disabled', false);
                    if (data.success) {
                        $('#regOtpMobileLabel').text('+91 ' + mobile);
                        $('#regMobileStep').addClass('step-hidden');
                        $('#regOtpStep').removeClass('step-hidden');
                        $('.reg-otp-box').val('');
                        $('.reg-otp-box').first().focus();
                        startResendTimer('regResendLink', 'regResendTimer', 30, function () { sendRegisterOtp(mobile); });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Oops...', text: 'Please retry after sometime.' });
                    }
                })
                .fail(function (response) {
                    $('#regSendOtpBtn').prop('disabled', false);
                    const msg = response.responseJSON && response.responseJSON.error
                        ? response.responseJSON.error
                        : (response.responseJSON && response.responseJSON.mobile ? response.responseJSON.mobile[0] : 'This mobile number may already be registered.');
                    Swal.fire({ icon: 'error', title: 'Oops...', text: msg });
                });
        }

        $('#regVerifyOtpBtn').on('click', function () {
            const mobile = $('#regOtpMobileLabel').text().replace('+91 ', '');
            const otp = collectOtp('.reg-otp-box');
            $('#regOtp-err').text('');
            if (otp.length < 6) {
                $('#regOtp-err').text('Please enter the complete 6-digit OTP');
                return;
            }
            $('#regVerifyOtpBtn').prop('disabled', true).text('Verifying...');
            $.ajax({
                url: "{{ route('verifyOTP') }}",
                type: 'POST',
                data: { mobile: mobile, otp: otp, _token: CSRF },
                dataType: 'json',
                success: function (data) {
                    $('#regVerifyOtpBtn').prop('disabled', false).text('Verify');
                    if (data.success) {
                        $('#regMobileHidden').val(mobile);
                        $('#regOtpStep').addClass('step-hidden');
                        $('#registerSwitchFooter').addClass('step-hidden');
                        $('#regDetailsStep').removeClass('step-hidden');
                    } else {
                        $('#regOtp-err').text('You entered an incorrect OTP.');
                    }
                },
                error: function () {
                    $('#regVerifyOtpBtn').prop('disabled', false).text('Verify');
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                }
            });
        });

        /* ============ Register form: email check + captcha ============ */
        function checkEmailExists() {
            var email = $('#email_id_register').val();
            var emailFeedback = $('#email_feedback');
            if (email.trim() === '') { emailFeedback.hide(); return; }

            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (emailPattern.test(email)) {
                $.ajax({
                    url: '{{ route("check-email") }}',
                    method: 'POST',
                    data: { email: email, _token: CSRF },
                    success: function (data) {
                        if (data.exists) { emailFeedback.text('Email already exists').show(); }
                        else { emailFeedback.hide(); }
                    }
                });
            } else {
                emailFeedback.text('Invalid email address').show();
            }
        }
        $('#email_id_register').on('input change', checkEmailExists);

        $('#registerForm').submit(function (event) {
            var recaptchaResponse = grecaptcha.getResponse();
            if (recaptchaResponse.length === 0) {
                event.preventDefault();
                Swal.fire({ icon: 'error', title: 'Captcha Required', text: 'Please complete the reCAPTCHA before submitting the form.' });
                return false;
            }
            if ($('#is_valid_refer').length && $('#is_valid_refer').val() == 0 && $('.referralCode').val() && $('.referralCode').val().trim() !== '') {
                event.preventDefault();
                Swal.fire({ icon: 'error', title: 'Not a valid referral code!', text: 'Please check the entered referral code' });
            }
        });

        /* ============ State -> City ajax ============ */
        $('#regState').on('change', function () {
            var stateId = $(this).val();
            var citySelect = $('#regCity');
            citySelect.html('<option value="">Select City</option>');
            if (!stateId) return;
            $.post("{{ route('cities-by-state') }}", { state_id: stateId, _token: CSRF }, function (data) {
                citySelect.html(data);
            });
        });


        /* ============ Referral code ============ */
        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }
        $(document).ready(function () {
            var referralCode = getUrlParameter('referralCode');
            if (referralCode) {
                $('.referralCode').val(referralCode);
                setTimeout(function () { $(".referralCode").trigger('keyup'); }, 100);
            }
            $(".referralCode").keyup(function () {
                let referral = $(this).val();
                if (referral !== "") {
                    $.ajax({
                        type: "GET",
                        url: "{{url('getusername')}}/" + referral,
                        success: function (data) {
                            if (data.status == 1) {
                                $('#is_valid_refer').val('1');
                                $("#names").val(data.name);
                                $("#errors").html("");
                            } else if (data.status == 3) {
                                $('#is_valid_refer').val('1');
                                $("#names").val("");
                                $(".referralCode").val("");
                                $("#errors").html("This referral code(" + referral + ") does not fulfill the Active Paid Subscription criteria.");
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

            if (referralCode) {
                switchTab('register');
            }
        });

        /* ============ Google buttons ============ */
        $('#googleLoginBtn, #googleSignupBtn').on('click', function () {
            window.location.href = "{{ route('google.redirect') }}";
        });

        $(function () {
            setTimeout(function () {
                $('#successAlert, #errorAlert, #validationAlert').fadeOut(400, function () { $(this).remove(); });
            }, 5000);
        });
    </script>

</body>

</html>
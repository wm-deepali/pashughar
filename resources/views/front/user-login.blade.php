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

    .field-hint {
        font-size: 11px;
        color: #999;
        display: block;
        margin-top: 4px;
    }

    .or-divider {
        text-align: center;
        color: #a3a3a3;
        font-size: 13px;
        margin: 18px 0;
        position: relative;
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

    /* Password show/hide */
    .password-wrap {
        position: relative;
    }

    .password-wrap .pill-input {
        padding-right: 48px;
    }

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

    .toggle-password:hover {
        color: var(--accent);
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

            <div class="auth-title">Welcome!</div>
            <div class="auth-subtitle">Login or create an account using your mobile or email</div>

            {{-- ===================== STEP 1: IDENTIFIER ===================== --}}
            <div id="identifierStep">
                <div class="field-group">
                    <input type="text" id="identifierInput" class="pill-input"
                        placeholder="Enter Mobile Number or Email ID" autocomplete="off">
                    <span class="field-error" id="identifier-err"></span>
                </div>
                <button type="button" class="pill-btn" id="identifierContinueBtn">Continue</button>

                <div class="or-divider">OR</div>
                <button type="button" class="pill-btn-outline" id="googleAuthBtn">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="google">
                    <span>Continue with Google</span>
                </button>
            </div>

            {{-- ===================== STEP 2: MOBILE OTP (login-existing OR signup-new) ===================== --}}
            <div id="otpStep" class="step-hidden">
                <span class="back-link" id="otpBackLink"><i class="fas fa-arrow-left"></i> Back</span>
                <div class="auth-subtitle" style="margin-bottom:6px;">Enter the 4-digit code sent to <b
                        id="otpMobileLabel"></b></div>
                <div class="otp-row" id="otpBoxes">
                    <input type="text" class="otp-box main-otp-box" maxlength="1" inputmode="numeric">
                    <input type="text" class="otp-box main-otp-box" maxlength="1" inputmode="numeric">
                    <input type="text" class="otp-box main-otp-box" maxlength="1" inputmode="numeric">
                    <input type="text" class="otp-box main-otp-box" maxlength="1" inputmode="numeric">
                </div>
                <span class="field-error" id="otp-err"
                    style="display:block; text-align:center; margin-bottom:10px;"></span>
                <div class="resend-row">
                    Didn't receive code? <a id="otpResendLink" class="disabled">Resend in <span
                            id="otpResendTimer">30</span>s</a>
                </div>
                <button type="button" class="pill-btn" id="otpVerifyBtn">Verify</button>
            </div>

            {{-- ===================== STEP 3: MOBILE SIGNUP DETAILS (new mobile, OTP verified) ===================== --}}
            <div id="mobileSignupDetailsStep" class="step-hidden">
                <span class="back-link" id="mobileSignupBackLink"><i class="fas fa-arrow-left"></i> Back</span>
                <div class="auth-subtitle" style="margin-bottom:14px;">Just a few more details to get started</div>
                <input type="hidden" id="mobileSignupMobileHidden">

                <div class="field-group">
                    <input type="text" id="mobileSignupFullName" class="pill-input" placeholder="Full Name">
                    <span class="field-error" id="mobileSignupFullName-err"></span>
                </div>

                <div class="field-group">
                    <input type="text" id="mobileSignupEmail" class="pill-input" placeholder="Email Id (Optional)"
                        autocomplete="off">
                    <span class="field-error" id="mobileSignupEmail-err"></span>
                </div>

                <div class="field-group password-wrap step-hidden" id="mobileSignupPasswordGroup">
                    <input type="password" id="mobileSignupPassword" class="pill-input" placeholder="Password">
                    <i class="fas fa-eye toggle-password" data-target="mobileSignupPassword"></i>
                    <span class="field-error" id="mobileSignupPassword-err"></span>
                    <small class="field-hint">Password to be Alpha Numeric e.g. abc12345</small>
                </div>

                <button type="button" class="pill-btn" id="mobileSignupSubmitBtn">Create Account</button>
            </div>

            {{-- ===================== STEP 4: EMAIL LOGIN (existing email, ask password) ===================== --}}
            <div id="emailPasswordStep" class="step-hidden">
                <span class="back-link" id="emailPasswordBackLink"><i class="fas fa-arrow-left"></i> Back</span>
                <div class="auth-subtitle" style="margin-bottom:6px;">Login as <b id="emailPasswordLabel"></b>
                </div>
                <input type="hidden" id="emailPasswordEmailHidden">

                <div class="field-group password-wrap">
                    <input type="password" id="emailPasswordInput" class="pill-input" placeholder="Password">
                    <i class="fas fa-eye toggle-password" data-target="emailPasswordInput"></i>
                    <span class="field-error" id="emailPassword-err"></span>
                </div>

                <div style="display:flex; justify-content:flex-end; margin-bottom:16px;">
                    <a href="{{route('forget.password.get')}}" style="font-size:13px; color:var(--accent);">Forgot
                        password?</a>
                </div>

                <button type="button" class="pill-btn" id="emailPasswordSubmitBtn">Login</button>
            </div>

            {{-- ===================== STEP 5: EMAIL SIGNUP DETAILS (new email) ===================== --}}
            <div id="emailSignupDetailsStep" class="step-hidden">
                <span class="back-link" id="emailSignupBackLink"><i class="fas fa-arrow-left"></i> Back</span>
                <div class="auth-subtitle" style="margin-bottom:14px;">Create your account for <b
                        id="emailSignupLabel"></b></div>
                <input type="hidden" id="emailSignupEmailHidden">

                <div class="field-group">
                    <input type="text" id="emailSignupFullName" class="pill-input" placeholder="Full Name">
                    <span class="field-error" id="emailSignupFullName-err"></span>
                </div>

                <div id="emailSignupMobileBlock">
                    <div class="field-group">
                        <div class="mobile-input-group">
                            <span class="mobile-prefix">+91</span>
                            <input type="text" id="emailSignupMobile" maxlength="10" inputmode="numeric"
                                placeholder="Enter Mobile Number">
                        </div>
                        <span class="field-error" id="emailSignupMobile-err"></span>
                    </div>
                    <button type="button" class="pill-btn" id="emailSignupSendOtpBtn">Send OTP</button>
                </div>

                <div id="emailSignupOtpBlock" class="step-hidden">
                    <div class="auth-subtitle" style="margin-bottom:6px;">Enter the 4-digit code sent to <b
                            id="emailSignupOtpMobileLabel"></b></div>
                    <div class="otp-row">
                        <input type="text" class="otp-box email-signup-otp-box" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-box email-signup-otp-box" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-box email-signup-otp-box" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-box email-signup-otp-box" maxlength="1" inputmode="numeric">
                    </div>
                    <span class="field-error" id="emailSignupOtp-err"
                        style="display:block; text-align:center; margin-bottom:10px;"></span>
                    <div class="resend-row">
                        Didn't receive code? <a id="emailSignupResendLink" class="disabled">Resend in <span
                                id="emailSignupResendTimer">30</span>s</a>
                    </div>
                    <button type="button" class="pill-btn" id="emailSignupVerifyOtpBtn">Verify Mobile</button>
                </div>

                <div class="field-group password-wrap step-hidden" id="emailSignupPasswordGroup">
                    <input type="password" id="emailSignupPassword" class="pill-input" placeholder="Password">
                    <i class="fas fa-eye toggle-password" data-target="emailSignupPassword"></i>
                    <span class="field-error" id="emailSignupPassword-err"></span>
                    <small class="field-hint">Password to be Alpha Numeric e.g. abc12345</small>
                </div>

                <button type="button" class="pill-btn step-hidden" id="emailSignupSubmitBtn">Create Account</button>
            </div>

        </div>
    </section>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="{{asset('front/js/vendor/popper.min.js')}}"></script>
    <script src="{{asset('front/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/js/custom/main.js')}}"></script>

    <script>
        const CSRF = '{{ csrf_token() }}';

        /* ---------- Step visibility ---------- */
        const STEP_IDS = ['identifierStep', 'otpStep', 'mobileSignupDetailsStep', 'emailPasswordStep', 'emailSignupDetailsStep'];

        function showStep(id) {
            STEP_IDS.forEach(function (s) {
                if (s === id) $('#' + s).removeClass('step-hidden');
                else $('#' + s).addClass('step-hidden');
            });
        }

        function resetToIdentifier() {
            showStep('identifierStep');
            $('#identifierInput').val('');
            $('#identifier-err').text('');
            clearInterval(window.otpResendLink_interval);
            clearInterval(window.emailSignupResendLink_interval);
        }

        $('#otpBackLink, #mobileSignupBackLink, #emailPasswordBackLink, #emailSignupBackLink').on('click', resetToIdentifier);

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
        wireOtpBoxes('.main-otp-box');
        wireOtpBoxes('.email-signup-otp-box');

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

        /* ---------- Password show/hide toggle ---------- */
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

        /* ---------- Password validation (Alpha Numeric, min 8 chars) ---------- */
        function validatePasswordValue(pwd) {
            if (!pwd || pwd.length < 8) return 'Password must be at least 8 characters';
            if (!/[A-Za-z]/.test(pwd)) return 'Password should be Alpha Numeric, use atleast One alphabet';
            if (!/[0-9]/.test(pwd)) return 'Password should be Alpha Numeric, use atleast One numerical number';
            if (!/^[A-Za-z0-9]+$/.test(pwd)) return 'Password should be Alpha Numeric';
            return null;
        }

        let currentMobile = '';
        let currentEmail = '';
        let otpMode = ''; // 'login-mobile' | 'signup-mobile'

        /* ============ STEP 1: Identify ============ */
        $('#identifierContinueBtn').on('click', function () {
            const val = $('#identifierInput').val().trim();
            $('#identifier-err').text('');

            const mobilePattern = /^[6-9]\d{9}$/;
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

            if (!mobilePattern.test(val) && !emailPattern.test(val)) {
                $('#identifier-err').text('Enter a valid 10-digit mobile number or email address');
                return;
            }

            $('#identifierContinueBtn').prop('disabled', true).text('Please wait...');

            $.ajax({
                url: "{{ route('check-identifier') }}",
                type: 'POST',
                data: { identifier: val, _token: CSRF },
                dataType: 'json',
                success: function (result) {
                    $('#identifierContinueBtn').prop('disabled', false).text('Continue');
                    if (!result.success) {
                        $('#identifier-err').text(result.message || 'Something went wrong.');
                        return;
                    }
                    if (result.type === 'mobile') {
                        currentMobile = val;
                        if (result.exists) {
                            sendLoginOtp(val);
                        } else {
                            sendSignupMobileOtp(val);
                        }
                    } else {
                        currentEmail = val;
                        if (result.exists) {
                            $('#emailPasswordEmailHidden').val(val);
                            $('#emailPasswordLabel').text(val);
                            $('#emailPasswordInput').val('');
                            $('#emailPassword-err').text('');
                            showStep('emailPasswordStep');
                        } else {
                            $('#emailSignupEmailHidden').val(val);
                            $('#emailSignupLabel').text(val);
                            $('#emailSignupFullName').val('');
                            $('#emailSignupMobile').val('');
                            $('#emailSignupMobileBlock').removeClass('step-hidden');
                            $('#emailSignupOtpBlock').addClass('step-hidden');
                            $('#emailSignupPasswordGroup').addClass('step-hidden');
                            $('#emailSignupSubmitBtn').addClass('step-hidden');
                            showStep('emailSignupDetailsStep');
                        }
                    }
                },
                error: function () {
                    $('#identifierContinueBtn').prop('disabled', false).text('Continue');
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                }
            });
        });

        /* ============ STEP 2: Mobile OTP (login-existing OR signup-new) ============ */
        function sendLoginOtp(mobile) {
            $.ajax({
                url: "{{ URL::to('send/otp') }}",
                type: 'POST',
                data: { mobile_number: mobile, _token: CSRF },
                dataType: 'json',
                success: function (result) {
                    if (result.success) {
                        otpMode = 'login-mobile';
                        openOtpStep(mobile);
                    } else {
                        let msg = result.code == 422 ? Object.values(result.errors)[0][0] : 'Please retry after sometime.';
                        Swal.fire({ icon: 'error', title: 'Oops...', text: msg });
                    }
                },
                error: function () {
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                }
            });
        }

        function sendSignupMobileOtp(mobile) {
            $.post("{{ route('mobileVerify') }}", { mobile: mobile, _token: CSRF })
                .done(function (data) {
                    if (data.success) {
                        otpMode = 'signup-mobile';
                        openOtpStep(mobile);
                    } else {
                        Swal.fire({ icon: 'error', title: 'Oops...', text: 'Please retry after sometime.' });
                    }
                })
                .fail(function (response) {
                    const msg = response.responseJSON && response.responseJSON.error
                        ? response.responseJSON.error
                        : (response.responseJSON && response.responseJSON.mobile ? response.responseJSON.mobile[0] : 'This mobile number may already be registered.');
                    Swal.fire({ icon: 'error', title: 'Oops...', text: msg });
                });
        }

        function openOtpStep(mobile) {
            $('#otpMobileLabel').text('+91 ' + mobile);
            $('#otp-err').text('');
            $('.main-otp-box').val('');
            showStep('otpStep');
            $('.main-otp-box').first().focus();
            startResendTimer('otpResendLink', 'otpResendTimer', 30, function () {
                if (otpMode === 'login-mobile') sendLoginOtp(mobile);
                else sendSignupMobileOtp(mobile);
            });
        }

        $('#otpVerifyBtn').on('click', function () {
            const otp = collectOtp('.main-otp-box');
            $('#otp-err').text('');
            if (otp.length < 4) {
                $('#otp-err').text('Please enter the complete 4-digit OTP');
                return;
            }
            $('#otpVerifyBtn').prop('disabled', true).text('Verifying...');

            if (otpMode === 'login-mobile') {
                $.ajax({
                    url: "{{ URL::to('verify/otp') }}",
                    type: 'POST',
                    data: { mobile_number: currentMobile, otp: otp, _token: CSRF },
                    dataType: 'json',
                    success: function (result) {
                        $('#otpVerifyBtn').prop('disabled', false).text('Verify');
                        if (result.success) {
                            window.location.href = result.redirect || "{{ route('user.dashboard') }}";
                        } else {
                            let msg = result.code == 422 ? Object.values(result.errors)[0][0] : (result.message || 'Incorrect OTP');
                            $('#otp-err').text(msg);
                        }
                    },
                    error: function () {
                        $('#otpVerifyBtn').prop('disabled', false).text('Verify');
                        Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                    }
                });
            } else {
                $.ajax({
                    url: "{{ route('verifyOTP') }}",
                    type: 'POST',
                    data: { mobile: currentMobile, otp: otp, _token: CSRF },
                    dataType: 'json',
                    success: function (data) {
                        $('#otpVerifyBtn').prop('disabled', false).text('Verify');
                        if (data.success) {
                            clearInterval(window.otpResendLink_interval);
                            $('#mobileSignupMobileHidden').val(currentMobile);
                            $('#mobileSignupFullName').val('');
                            $('#mobileSignupEmail').val('');
                            $('#mobileSignupPasswordGroup').addClass('step-hidden');
                            $('#mobileSignupPassword').val('');
                            $('#mobileSignupFullName-err, #mobileSignupEmail-err, #mobileSignupPassword-err').text('');
                            showStep('mobileSignupDetailsStep');
                        } else {
                            $('#otp-err').text('You entered an incorrect OTP.');
                        }
                    },
                    error: function () {
                        $('#otpVerifyBtn').prop('disabled', false).text('Verify');
                        Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                    }
                });
            }
        });

        /* ============ STEP 3: Mobile signup details ============ */
        $('#mobileSignupEmail').on('input', function () {
            const val = $(this).val().trim();
            $('#mobileSignupEmail-err').text('');
            if (val) {
                $('#mobileSignupPasswordGroup').removeClass('step-hidden');
            } else {
                $('#mobileSignupPasswordGroup').addClass('step-hidden');
                $('#mobileSignupPassword').val('');
                $('#mobileSignupPassword-err').text('');
            }
        });

        $('#mobileSignupEmail').on('blur', function () {
            const email = $(this).val().trim();
            if (!email) return;
            $.ajax({
                url: '{{ route("check-email") }}',
                method: 'POST',
                data: { email: email, _token: CSRF },
                success: function (data) {
                    if (data.exists) { $('#mobileSignupEmail-err').text('Email already exists'); }
                }
            });
        });

        $('#mobileSignupPassword').on('blur', function () {
            const val = $(this).val();
            $('#mobileSignupPassword-err').text(val ? (validatePasswordValue(val) || '') : '');
        });

        $('#mobileSignupSubmitBtn').on('click', function () {
            const fullName = $('#mobileSignupFullName').val().trim();
            const email = $('#mobileSignupEmail').val().trim();
            const password = $('#mobileSignupPassword').val();
            const mobile = $('#mobileSignupMobileHidden').val();

            $('#mobileSignupFullName-err, #mobileSignupEmail-err, #mobileSignupPassword-err').text('');

            if (!fullName) {
                $('#mobileSignupFullName-err').text('Full Name is required');
                return;
            }

            if (email) {
                const pwdErr = validatePasswordValue(password);
                if (pwdErr) {
                    $('#mobileSignupPassword-err').text(pwdErr);
                    return;
                }
            }

            $('#mobileSignupSubmitBtn').prop('disabled', true).text('Please wait...');
            $.ajax({
                url: "{{ route('register.via.mobile') }}",
                type: 'POST',
                data: { full_name: fullName, email: email, password: password, mobile: mobile, _token: CSRF },
                dataType: 'json',
                success: function (result) {
                    if (result.success) {
                        window.location.href = result.redirect;
                    } else {
                        $('#mobileSignupSubmitBtn').prop('disabled', false).text('Create Account');
                        if (result.errors) {
                            const firstErr = Object.values(result.errors)[0][0];
                            Swal.fire({ icon: 'error', title: 'Oops...', text: firstErr });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Oops...', text: result.message || 'Something went wrong.' });
                        }
                    }
                },
                error: function () {
                    $('#mobileSignupSubmitBtn').prop('disabled', false).text('Create Account');
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                }
            });
        });

        /* ============ STEP 4: Email login (existing email) ============ */
        $('#emailPasswordSubmitBtn').on('click', function () {
            const email = $('#emailPasswordEmailHidden').val();
            const password = $('#emailPasswordInput').val();
            $('#emailPassword-err').text('');
            if (!password) {
                $('#emailPassword-err').text('Password is required');
                return;
            }
            $('#emailPasswordSubmitBtn').prop('disabled', true).text('Please wait...');
            $.ajax({
                url: "{{ route('user.authenticate') }}",
                type: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                data: { email: email, password: password, _token: CSRF },
                dataType: 'json',
                success: function (result) {
                    $('#emailPasswordSubmitBtn').prop('disabled', false).text('Login');
                    if (result.success) {
                        window.location.href = result.redirect;
                    } else if (result.message && result.message.indexOf('not been verified') !== -1) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Email not verified',
                            text: result.message,
                            showCancelButton: true,
                            confirmButtonText: 'Resend Verification Email',
                        }).then(function (res) {
                            if (res.isConfirmed) {
                                $.post("{{ route('verification.resend') }}", { email: email, _token: CSRF }, function (r) {
                                    Swal.fire({ icon: 'success', title: 'Sent', text: r.message });
                                }, 'json');
                            }
                        });
                    } else if (result.errors) {
                        const firstErr = Object.values(result.errors)[0][0];
                        $('#emailPassword-err').text(firstErr);
                    } else {
                        $('#emailPassword-err').text(result.message || 'Something went wrong.');
                    }
                },
                error: function () {
                    $('#emailPasswordSubmitBtn').prop('disabled', false).text('Login');
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                }
            });
        });

        /* ============ STEP 5: Email signup (new email) ============ */
        $('#emailSignupSendOtpBtn').on('click', function () {
            const mobile = $('#emailSignupMobile').val().trim();
            $('#emailSignupMobile-err').text('');
            if (!/^[6-9]\d{9}$/.test(mobile)) {
                $('#emailSignupMobile-err').text('Enter a valid 10-digit Indian mobile number');
                return;
            }
            sendEmailSignupOtp(mobile);
        });

        function sendEmailSignupOtp(mobile) {
            $('#emailSignupSendOtpBtn').prop('disabled', true);
            $.post("{{ route('mobileVerify') }}", { mobile: mobile, _token: CSRF })
                .done(function (data) {
                    $('#emailSignupSendOtpBtn').prop('disabled', false);
                    if (data.success) {
                        currentMobile = mobile;
                        $('#emailSignupOtpMobileLabel').text('+91 ' + mobile);
                        $('#emailSignupMobileBlock').addClass('step-hidden');
                        $('#emailSignupOtpBlock').removeClass('step-hidden');
                        $('#emailSignupOtp-err').text('');
                        $('.email-signup-otp-box').val('');
                        $('.email-signup-otp-box').first().focus();
                        startResendTimer('emailSignupResendLink', 'emailSignupResendTimer', 30, function () { sendEmailSignupOtp(mobile); });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Oops...', text: 'Please retry after sometime.' });
                    }
                })
                .fail(function (response) {
                    $('#emailSignupSendOtpBtn').prop('disabled', false);
                    const msg = response.responseJSON && response.responseJSON.error
                        ? response.responseJSON.error
                        : (response.responseJSON && response.responseJSON.mobile ? response.responseJSON.mobile[0] : 'This mobile number may already be registered.');
                    Swal.fire({ icon: 'error', title: 'Oops...', text: msg });
                });
        }

        $('#emailSignupVerifyOtpBtn').on('click', function () {
            const otp = collectOtp('.email-signup-otp-box');
            $('#emailSignupOtp-err').text('');
            if (otp.length < 4) {
                $('#emailSignupOtp-err').text('Please enter the complete 4-digit OTP');
                return;
            }
            $('#emailSignupVerifyOtpBtn').prop('disabled', true).text('Verifying...');
            $.ajax({
                url: "{{ route('verifyOTP') }}",
                type: 'POST',
                data: { mobile: currentMobile, otp: otp, _token: CSRF },
                dataType: 'json',
                success: function (data) {
                    $('#emailSignupVerifyOtpBtn').prop('disabled', false).text('Verify Mobile');
                    if (data.success) {
                        clearInterval(window.emailSignupResendLink_interval);
                        $('#emailSignupOtpBlock').addClass('step-hidden');
                        $('#emailSignupPasswordGroup').removeClass('step-hidden');
                        $('#emailSignupSubmitBtn').removeClass('step-hidden');
                    } else {
                        $('#emailSignupOtp-err').text('You entered an incorrect OTP.');
                    }
                },
                error: function () {
                    $('#emailSignupVerifyOtpBtn').prop('disabled', false).text('Verify Mobile');
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                }
            });
        });

        $('#emailSignupPassword').on('blur', function () {
            const val = $(this).val();
            $('#emailSignupPassword-err').text(val ? (validatePasswordValue(val) || '') : '');
        });

        $('#emailSignupSubmitBtn').on('click', function () {
            const fullName = $('#emailSignupFullName').val().trim();
            const password = $('#emailSignupPassword').val();
            const email = $('#emailSignupEmailHidden').val();
            const mobile = currentMobile;

            $('#emailSignupFullName-err, #emailSignupPassword-err').text('');

            if (!fullName) {
                $('#emailSignupFullName-err').text('Full Name is required');
                return;
            }
            const pwdErr = validatePasswordValue(password);
            if (pwdErr) {
                $('#emailSignupPassword-err').text(pwdErr);
                return;
            }

            $('#emailSignupSubmitBtn').prop('disabled', true).text('Please wait...');
            $.ajax({
                url: "{{ route('register.via.email') }}",
                type: 'POST',
                data: { full_name: fullName, email: email, mobile: mobile, password: password, _token: CSRF },
                dataType: 'json',
                success: function (result) {
                    if (result.success) {
                        window.location.href = result.redirect;
                    } else {
                        $('#emailSignupSubmitBtn').prop('disabled', false).text('Create Account');
                        if (result.errors) {
                            const firstErr = Object.values(result.errors)[0][0];
                            Swal.fire({ icon: 'error', title: 'Oops...', text: firstErr });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Oops...', text: result.message || 'Something went wrong.' });
                        }
                    }
                },
                error: function () {
                    $('#emailSignupSubmitBtn').prop('disabled', false).text('Create Account');
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                }
            });
        });

        /* ============ Google button ============ */
        $('#googleAuthBtn').on('click', function () {
            window.location.href = "{{ route('google.redirect') }}";
        });

        /* ============ Top flash alerts auto-fade ============ */
        $(function () {
            setTimeout(function () {
                $('#successAlert, #errorAlert, #validationAlert').fadeOut(400, function () { $(this).remove(); });
            }, 5000);
        });
    </script>

</body>

</html>
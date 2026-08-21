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

    .pill-btn-sm {
        height: 44px;
        border-radius: var(--radius);
        border: none;
        background: var(--accent);
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        padding: 0 20px;
        white-space: nowrap;
        transition: background .2s ease, opacity .2s ease;
    }

    .pill-btn-sm:hover {
        background: var(--accent-light);
    }

    .pill-btn-sm:disabled {
        opacity: .6;
        cursor: not-allowed;
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

    .inline-verify-row {
        display: flex;
        gap: 8px;
        align-items: stretch;
    }

    .inline-verify-row .pill-input {
        flex: 1;
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

    .verified-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: #1f8a4c;
        font-weight: 600;
        margin-top: 6px;
    }

    .step-hidden {
        display: none;
    }

    .verified-pill.step-hidden {
        display: none;
    }

    .terms-check-row {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 18px;
        font-size: 13px;
        color: #555;
        line-height: 1.5;
    }

    .terms-check-row input[type="checkbox"] {
        margin-top: 3px;
        width: 16px;
        height: 16px;
        flex-shrink: 0;
        accent-color: var(--accent);
        cursor: pointer;
    }

    .terms-check-row label {
        cursor: pointer;
    }

    .terms-check-row a {
        color: var(--accent);
        font-weight: 600;
        text-decoration: underline;
    }

    .terms-check-row a:hover {
        color: var(--accent-light);
    }

    .pill-btn-sm.block-btn {
        width: 100%;
        display: block;
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

            {{-- ===================== STEP 2B: EMAIL OTP (login-existing OR signup-new) ===================== --}}
            <div id="emailOtpStep" class="step-hidden">
                <span class="back-link" id="emailOtpBackLink"><i class="fas fa-arrow-left"></i> Back</span>
                <div class="auth-subtitle" style="margin-bottom:6px;">Enter the 4-digit code sent to <b
                        id="emailOtpLabel"></b></div>
                <div class="otp-row" id="emailOtpBoxes">
                    <input type="text" class="otp-box email-otp-box" maxlength="1" inputmode="numeric">
                    <input type="text" class="otp-box email-otp-box" maxlength="1" inputmode="numeric">
                    <input type="text" class="otp-box email-otp-box" maxlength="1" inputmode="numeric">
                    <input type="text" class="otp-box email-otp-box" maxlength="1" inputmode="numeric">
                </div>
                <span class="field-error" id="emailOtp-err"
                    style="display:block; text-align:center; margin-bottom:10px;"></span>
                <div class="resend-row">
                    Didn't receive code? <a id="emailOtpResendLink" class="disabled">Resend in <span
                            id="emailOtpResendTimer">30</span>s</a>
                </div>
                <button type="button" class="pill-btn" id="emailOtpVerifyBtn">Verify</button>
            </div>

            {{-- ===================== STEP 3: MOBILE SIGNUP DETAILS (new mobile, OTP verified) =====================
            --}}
            <div id="mobileSignupDetailsStep" class="step-hidden">
                <span class="back-link" id="mobileSignupBackLink"><i class="fas fa-arrow-left"></i> Back</span>
                <div class="auth-subtitle" style="margin-bottom:14px;">Just a few more details to get started</div>
                <input type="hidden" id="mobileSignupMobileHidden">
                <input type="hidden" id="mobileSignupEmailVerified" value="0">

                <div class="field-group">
                    <input type="text" id="mobileSignupFullName" class="pill-input" placeholder="Full Name">
                    <span class="field-error" id="mobileSignupFullName-err"></span>
                </div>

                <div class="field-group">
                    <input type="text" id="mobileSignupEmail" class="pill-input" placeholder="Email Id (Optional)"
                        autocomplete="off">
                    <span class="field-error" id="mobileSignupEmail-err"></span>
                    <button type="button" class="pill-btn-sm block-btn" id="mobileSignupSendEmailOtpBtn"
                        style="display:none; margin-top:10px;">Verify</button>
                    <span class="verified-pill step-hidden" id="mobileSignupEmailVerifiedPill">
                        <i class="fas fa-check-circle"></i> Email verified
                    </span>
                </div>
                <div class="field-group step-hidden" id="mobileSignupEmailOtpGroup">
                    <div class="otp-row">
                        <input type="text" class="otp-box mobile-signup-email-otp-box" maxlength="1"
                            inputmode="numeric">
                        <input type="text" class="otp-box mobile-signup-email-otp-box" maxlength="1"
                            inputmode="numeric">
                        <input type="text" class="otp-box mobile-signup-email-otp-box" maxlength="1"
                            inputmode="numeric">
                        <input type="text" class="otp-box mobile-signup-email-otp-box" maxlength="1"
                            inputmode="numeric">
                    </div>
                    <span class="field-error" id="mobileSignupEmailOtp-err"
                        style="display:block; text-align:center; margin-bottom:10px;"></span>
                    <div class="resend-row">
                        Didn't receive code? <a id="mobileSignupEmailResendLink" class="disabled">Resend in <span
                                id="mobileSignupEmailResendTimer">30</span>s</a>
                    </div>
                    <button type="button" class="pill-btn" id="mobileSignupEmailOtpVerifyBtn">Verify Email</button>
                </div>

                <div class="terms-check-row">
                    <input type="checkbox" id="mobileSignupTermsCheckbox">
                    <label for="mobileSignupTermsCheckbox">
                        I Accept the <a href="{{ route('terms-condition') }}" target="_blank">Terms &
                            Conditions</a> of PashuGhar Livestock Trade & Marketing
                    </label>
                </div>
                <span class="field-error" id="mobileSignupTerms-err"></span>

                <button type="button" class="pill-btn" id="mobileSignupSubmitBtn">Create Account</button>
            </div>

            {{-- ===================== STEP 5: EMAIL SIGNUP DETAILS (new email, OTP verified) ===================== --}}
            <div id="emailSignupDetailsStep" class="step-hidden">
                <span class="back-link" id="emailSignupBackLink"><i class="fas fa-arrow-left"></i> Back</span>
                <div class="auth-subtitle" style="margin-bottom:14px;">Create your account for <b
                        id="emailSignupLabel"></b></div>
                <input type="hidden" id="emailSignupEmailHidden">
                <input type="hidden" id="emailSignupMobileVerified" value="0">

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
                    <button type="button" class="pill-btn step-hidden" id="emailSignupSendOtpBtn">Send OTP</button>
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

                <div class="terms-check-row mt-3">
                    <input type="checkbox" id="emailSignupTermsCheckbox">
                    <label for="emailSignupTermsCheckbox">
                        I Accept the <a href="{{ route('terms-condition') }}" target="_blank">Terms &
                            Conditions</a> of PashuGhar Livestock Trade & Marketing
                    </label>
                </div>
                <span class="field-error" id="emailSignupTerms-err"></span>

                <button type="button" class="pill-btn" id="emailSignupSubmitBtn">Create Account</button>
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
        const STEP_IDS = ['identifierStep', 'otpStep', 'emailOtpStep', 'mobileSignupDetailsStep', 'emailSignupDetailsStep'];

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
            clearInterval(window.emailOtpResendLink_interval);
            clearInterval(window.mobileSignupEmailResendLink_interval);
            clearInterval(window.emailSignupResendLink_interval);
        }

        $('#otpBackLink, #emailOtpBackLink, #mobileSignupBackLink, #emailSignupBackLink').on('click', resetToIdentifier);

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
        wireOtpBoxes('.email-otp-box');
        wireOtpBoxes('.mobile-signup-email-otp-box');
        wireOtpBoxes('.email-signup-otp-box');

        function collectOtp(selector) {
            let otp = '';
            document.querySelectorAll(selector).forEach(i => otp += i.value);
            return otp;
        }

        function clearOtpBoxes(selector) {
            document.querySelectorAll(selector).forEach(i => i.value = '');
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

        let currentMobile = '';
        let currentEmail = '';
        let otpMode = '';       // 'login-mobile' | 'signup-mobile'
        let emailOtpMode = '';  // 'login-email' | 'signup-email'

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
                        emailOtpMode = result.exists ? 'login-email' : 'signup-email';
                        sendEmailOtp(val, emailOtpMode);
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
            clearOtpBoxes('.main-otp-box');
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
                            $('#mobileSignupEmailVerified').val('0');
                            $('#mobileSignupEmailVerifiedPill').addClass('step-hidden');
                            $('#mobileSignupEmailOtpGroup').addClass('step-hidden');
                            $('#mobileSignupSendEmailOtpBtn').hide().prop('disabled', false).text('Verify');
                            $('#mobileSignupEmail').prop('disabled', false);
                            $('#mobileSignupFullName-err, #mobileSignupEmail-err').text('');
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

        /* ============ STEP 2B: Email OTP (login-existing OR signup-new) ============ */
        function sendEmailOtp(email, mode) {
            $.ajax({
                url: "{{ route('send.email.otp') }}",
                type: 'POST',
                data: { email: email, _token: CSRF },
                dataType: 'json',
                success: function (result) {
                    if (result.success) {
                        emailOtpMode = mode;
                        $('#emailOtpLabel').text(email);
                        $('#emailOtp-err').text('');
                        clearOtpBoxes('.email-otp-box');
                        showStep('emailOtpStep');
                        $('.email-otp-box').first().focus();
                        startResendTimer('emailOtpResendLink', 'emailOtpResendTimer', 30, function () {
                            sendEmailOtp(email, mode);
                        });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Oops...', text: result.message || 'Please retry after sometime.' });
                    }
                },
                error: function () {
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                }
            });
        }

        $('#emailOtpVerifyBtn').on('click', function () {
            const otp = collectOtp('.email-otp-box');
            $('#emailOtp-err').text('');
            if (otp.length < 4) {
                $('#emailOtp-err').text('Please enter the complete 4-digit OTP');
                return;
            }
            $('#emailOtpVerifyBtn').prop('disabled', true).text('Verifying...');
            $.ajax({
                url: "{{ route('verify.email.otp') }}",
                type: 'POST',
                data: { email: currentEmail, otp: otp, _token: CSRF },
                dataType: 'json',
                success: function (result) {
                    $('#emailOtpVerifyBtn').prop('disabled', false).text('Verify');
                    if (!result.success) {
                        $('#emailOtp-err').text(result.message || 'Incorrect OTP');
                        return;
                    }
                    clearInterval(window.emailOtpResendLink_interval);
                    if (result.mode === 'login') {
                        window.location.href = result.redirect || "{{ route('user.dashboard') }}";
                    } else {
                        $('#emailSignupEmailHidden').val(currentEmail);
                        $('#emailSignupLabel').text(currentEmail);
                        $('#emailSignupFullName').val('');
                        $('#emailSignupMobile').val('');
                        $('#emailSignupMobileVerified').val('0');
                        $('#emailSignupSendOtpBtn').addClass('step-hidden');
                        $('#emailSignupMobileBlock').removeClass('step-hidden');
                        $('#emailSignupOtpBlock').addClass('step-hidden');
                        $('#emailSignupFullName-err').text('');
                        $('#emailSignupMobile-err').removeClass('field-success').addClass('field-error').text('');
                        showStep('emailSignupDetailsStep');
                    }
                },
                error: function () {
                    $('#emailOtpVerifyBtn').prop('disabled', false).text('Verify');
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                }
            });
        });

        /* ============ STEP 3: Mobile signup details (Full Name + optional Email) ============ */
        $('#mobileSignupEmail').on('input', function () {
            const emailVal = $(this).val().trim();

            $('#mobileSignupEmail-err').text('');
            $('#mobileSignupEmailVerified').val('0');
            $('#mobileSignupEmailVerifiedPill').addClass('step-hidden');
            $('#mobileSignupEmailOtpGroup').addClass('step-hidden');

            if (emailVal.length > 0) {
                $('#mobileSignupSendEmailOtpBtn').show();
            } else {
                $('#mobileSignupSendEmailOtpBtn').hide();
            }
        });

        $('#mobileSignupSendEmailOtpBtn').on('click', function () {
            const email = $('#mobileSignupEmail').val().trim();
            $('#mobileSignupEmail-err').text('');
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                $('#mobileSignupEmail-err').text('Enter a valid email address');
                return;
            }
            $('#mobileSignupSendEmailOtpBtn').prop('disabled', true).text('Sending...');
            $.ajax({
                url: '{{ route("check-email") }}',
                method: 'POST',
                data: { email: email, _token: CSRF },
                success: function (data) {
                    if (data.exists) {
                        $('#mobileSignupSendEmailOtpBtn').prop('disabled', false).text('Verify');
                        $('#mobileSignupEmail-err').text('Email already exists');
                        return;
                    }
                    $.ajax({
                        url: "{{ route('send.email.otp') }}",
                        type: 'POST',
                        data: { email: email, _token: CSRF },
                        dataType: 'json',
                        success: function (result) {
                            $('#mobileSignupSendEmailOtpBtn').prop('disabled', false).text('Verify');
                            if (result.success) {
                                $('#mobileSignupSendEmailOtpBtn').hide();
                                $('#mobileSignupEmailOtpGroup').removeClass('step-hidden');
                                $('#mobileSignupEmailOtp-err').text('');
                                clearOtpBoxes('.mobile-signup-email-otp-box');
                                $('.mobile-signup-email-otp-box').first().focus();
                                startResendTimer('mobileSignupEmailResendLink', 'mobileSignupEmailResendTimer', 30, function () {
                                    $('#mobileSignupSendEmailOtpBtn').trigger('click');
                                });
                            } else {
                                Swal.fire({ icon: 'error', title: 'Oops...', text: result.message || 'Please retry after sometime.' });
                            }
                        },
                        error: function () {
                            $('#mobileSignupSendEmailOtpBtn').prop('disabled', false).text('Verify');
                            Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                        }
                    });
                },
                error: function () {
                    $('#mobileSignupSendEmailOtpBtn').prop('disabled', false).text('Verify');
                }
            });
        });

        $('#mobileSignupEmailOtpVerifyBtn').on('click', function () {
            const email = $('#mobileSignupEmail').val().trim();
            const otp = collectOtp('.mobile-signup-email-otp-box');
            $('#mobileSignupEmailOtp-err').text('');
            if (otp.length < 4) {
                $('#mobileSignupEmailOtp-err').text('Please enter the complete 4-digit OTP');
                return;
            }
            $('#mobileSignupEmailOtpVerifyBtn').prop('disabled', true).text('Verifying...');
            $.ajax({
                url: "{{ route('verify.email.otp') }}",
                type: 'POST',
                data: { email: email, otp: otp, _token: CSRF },
                dataType: 'json',
                success: function (result) {
                    $('#mobileSignupEmailOtpVerifyBtn').prop('disabled', false).text('Verify Email');
                    if (result.success) {
                        clearInterval(window.mobileSignupEmailResendLink_interval);
                        $('#mobileSignupEmailVerified').val('1');
                        $('#mobileSignupEmailOtpGroup').addClass('step-hidden');
                        $('#mobileSignupSendEmailOtpBtn').hide();
                        $('#mobileSignupEmail').prop('disabled', true);
                        $('#mobileSignupEmailVerifiedPill').removeClass('step-hidden');
                    } else {
                        $('#mobileSignupEmailOtp-err').text(result.message || 'Incorrect OTP');
                    }
                },
                error: function () {
                    $('#mobileSignupEmailOtpVerifyBtn').prop('disabled', false).text('Verify Email');
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                }
            });
        });

        $('#mobileSignupSubmitBtn').on('click', function () {
            const fullName = $('#mobileSignupFullName').val().trim();
            const email = $('#mobileSignupEmail').val().trim();
            const emailVerified = $('#mobileSignupEmailVerified').val();
            const mobile = $('#mobileSignupMobileHidden').val();

            $('#mobileSignupFullName-err, #mobileSignupEmail-err, #mobileSignupTerms-err').text('');

            if (!fullName) {
                $('#mobileSignupFullName-err').text('Full Name is required');
                return;
            }

            if (email && emailVerified !== '1') {
                $('#mobileSignupEmail-err').text('Please verify this email before continuing');
                return;
            }

            if (!$('#mobileSignupTermsCheckbox').is(':checked')) {
                $('#mobileSignupTerms-err').text('Please accept the Terms & Conditions to continue');
                return;
            }

            $('#mobileSignupSubmitBtn').prop('disabled', true).text('Please wait...');
            $.ajax({
                url: "{{ route('register.via.mobile') }}",
                type: 'POST',
                data: { full_name: fullName, email: email, mobile: mobile, _token: CSRF },
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

        /* ============ STEP 5: Email signup (Full Name + Mobile, mobile OTP verified) ============ */
        $('#emailSignupMobile').on('input', function () {
            const mobileVal = $(this).val().trim();
            $('#emailSignupMobile-err').removeClass('field-success').addClass('field-error').text('');
            $('#emailSignupMobileVerified').val('0');

            if (mobileVal.length > 0) {
                $('#emailSignupSendOtpBtn').removeClass('step-hidden');
            } else {
                $('#emailSignupSendOtpBtn').addClass('step-hidden');
            }
        });

        $('#emailSignupSendOtpBtn').on('click', function () {
            const mobile = $('#emailSignupMobile').val().trim();
            $('#emailSignupMobile-err').text('');
            if (!/^[6-9]\d{9}$/.test(mobile)) {
                $('#emailSignupMobile-err').text('Enter a valid 10-digit Indian mobile number');
                return;
            }
            sendEmailSignupMobileOtp(mobile);
        });

        function sendEmailSignupMobileOtp(mobile) {
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
                        clearOtpBoxes('.email-signup-otp-box');
                        $('.email-signup-otp-box').first().focus();
                        startResendTimer('emailSignupResendLink', 'emailSignupResendTimer', 30, function () { sendEmailSignupMobileOtp(mobile); });
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
                        $('#emailSignupMobileVerified').val('1');
                        $('#emailSignupOtpBlock').addClass('step-hidden');
                        $('#emailSignupMobile-err').removeClass('field-error').addClass('field-success').text('Mobile number verified successfully.');
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

        $('#emailSignupSubmitBtn').on('click', function () {
            const fullName = $('#emailSignupFullName').val().trim();
            const email = $('#emailSignupEmailHidden').val();
            const mobile = currentMobile;
            const mobileVerified = $('#emailSignupMobileVerified').val();

            $('#emailSignupFullName-err, #emailSignupTerms-err').text('');

            if (!fullName) {
                $('#emailSignupFullName-err').text('Full Name is required');
                return;
            }

            if (mobileVerified !== '1') {
                $('#emailSignupMobile-err').removeClass('field-success').addClass('field-error').text('Please verify your mobile number to continue');
                return;
            }

            if (!$('#emailSignupTermsCheckbox').is(':checked')) {
                $('#emailSignupTerms-err').text('Please accept the Terms & Conditions to continue');
                return;
            }

            $('#emailSignupSubmitBtn').prop('disabled', true).text('Please wait...');
            $.ajax({
                url: "{{ route('register.via.email') }}",
                type: 'POST',
                data: { full_name: fullName, email: email, mobile: mobile, _token: CSRF },
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
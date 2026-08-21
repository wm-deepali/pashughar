<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Welcome to Pashughar">
    <title>Welcome to Pashughar</title>
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

    .pill-input[readonly] {
        color: #888;
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

    .field-group {
        margin-bottom: 16px;
    }

    .field-hint {
        font-size: 11px;
        color: #999;
        display: block;
        margin-top: 4px;
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
            <div class="auth-subtitle">Create your account for <b>{{ $user->email }}</b></div>

            {{-- ===================== STEP 1: FULL NAME ===================== --}}
            <div id="nameStep">
                <div class="field-group">
                    <input type="text" id="fullNameInput" class="pill-input" placeholder="Full Name"
                        value="{{ old('full_name', $user->full_name) }}">
                    <span class="field-error" id="fullNameInput-err"></span>
                </div>
                <button type="button" class="pill-btn" id="nameContinueBtn">Continue</button>
            </div>

            {{-- ===================== STEP 2: MOBILE ===================== --}}
            <div id="mobileStep" class="step-hidden">
                <span class="back-link" id="mobileBackLink"><i class="fas fa-arrow-left"></i> Back</span>
                <div class="field-group">
                    <div class="mobile-input-group">
                        <span class="mobile-prefix">+91</span>
                        <input type="text" id="mobileInput" maxlength="10" inputmode="numeric"
                            placeholder="Enter Mobile Number" value="{{ old('mobile') }}">
                    </div>
                    <span class="field-error" id="mobileInput-err"></span>
                </div>
                <button type="button" class="pill-btn step-hidden" id="sendOtpBtn">Send OTP</button>
            </div>

            {{-- ===================== STEP 3: OTP ===================== --}}
            <div id="otpStep" class="step-hidden">
                <span class="back-link" id="otpBackLink"><i class="fas fa-arrow-left"></i> Back</span>
                <div class="auth-subtitle" style="margin-bottom:6px;">Enter the 4-digit code sent to <b
                        id="otpMobileLabel"></b></div>
                <div class="otp-row">
                    <input type="text" class="otp-box detail-otp-box" maxlength="1" inputmode="numeric">
                    <input type="text" class="otp-box detail-otp-box" maxlength="1" inputmode="numeric">
                    <input type="text" class="otp-box detail-otp-box" maxlength="1" inputmode="numeric">
                    <input type="text" class="otp-box detail-otp-box" maxlength="1" inputmode="numeric">
                </div>
                <span class="field-error" id="detailOtp-err"
                    style="display:block; text-align:center; margin-bottom:10px;"></span>
                <div class="resend-row">
                    Didn't receive code? <a id="detailResendLink" class="disabled">Resend in <span
                            id="detailResendTimer">30</span>s</a>
                </div>
                <button type="button" class="pill-btn" id="verifyOtpBtn">Verify</button>
            </div>

            {{-- ===================== STEP 4: REFERRAL (optional) + SUBMIT ===================== --}}
            <div id="detailsStep" class="step-hidden">
                <form id="registerForm" method="post" action="{{ route('first.details.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="full_name" id="fullNameHidden">
                    <input type="hidden" name="mobile" id="mobileHidden">

                    @php $adminsetting = \App\Models\OtherSetting::first(); @endphp
                    @if($adminsetting->is_referral_enable == "1")
                        <div class="field-group">
                            <input type="text" class="pill-input referralCode" name="referralto"
                                placeholder="Enter Referral Code (optional)">
                            <span id="errors" class="field-error"></span>
                            <input type="text" name="isRef" id="is_valid_refer" value="0" style="display:none;">
                        </div>
                        <div class="field-group">
                            <input type="text" class="pill-input" placeholder="Referred by" id="names" value="" readonly>
                        </div>
                    @endif

                    <div class="terms-check-row">
                        <input type="checkbox" id="termsCheckbox">
                        <label for="termsCheckbox">
                            I Accept the <a href="{{ route('terms-conditions') }}" target="_blank">Terms &
                                Conditions</a> of PashuGhar Livestock Trade & Marketing
                        </label>
                    </div>
                    <span id="terms-err" class="field-error"></span>

                    <button type="submit" class="pill-btn">Create Account</button>
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

        /* ---------- Step visibility ---------- */
        const STEP_IDS = ['nameStep', 'mobileStep', 'otpStep', 'detailsStep'];

        function showStep(id) {
            STEP_IDS.forEach(function (s) {
                if (s === id) $('#' + s).removeClass('step-hidden');
                else $('#' + s).addClass('step-hidden');
            });
        }

        $('#mobileBackLink').on('click', function () {
            showStep('nameStep');
        });
        $('#otpBackLink').on('click', function () {
            showStep('mobileStep');
            clearInterval(window.detailResendLink_interval);
        });

        /* ---------- OTP box auto-advance ---------- */
        (function () {
            const boxes = document.querySelectorAll('.detail-otp-box');
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
        })();

        function collectOtp() {
            let otp = '';
            document.querySelectorAll('.detail-otp-box').forEach(i => otp += i.value);
            return otp;
        }

        function startResendTimer(seconds, onResend) {
            let time = seconds;
            $('#detailResendTimer').text(time);
            $('#detailResendLink').addClass('disabled').off('click');
            clearInterval(window.detailResendLink_interval);
            window.detailResendLink_interval = setInterval(() => {
                time--;
                $('#detailResendTimer').text(time);
                if (time <= 0) {
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

        $('#mobileInput').on('input', function () {
            const mobileVal = $(this).val().trim();
            $('#mobileInput-err').text('');

            if (mobileVal.length > 0) {
                $('#sendOtpBtn').removeClass('step-hidden');
            } else {
                $('#sendOtpBtn').addClass('step-hidden');
            }
        });

        /* ============ STEP 1: Full Name ============ */
        $('#nameContinueBtn').on('click', function () {
            const fullName = $('#fullNameInput').val().trim();
            $('#fullNameInput-err').text('');
            if (!fullName) {
                $('#fullNameInput-err').text('Full Name is required');
                return;
            }
            $('#fullNameHidden').val(fullName);
            showStep('mobileStep');
        });

        /* ============ STEP 2: Mobile -> Send OTP ============ */
        $('#sendOtpBtn').on('click', function () {
            const mobile = $('#mobileInput').val().trim();
            $('#mobileInput-err').text('');
            if (!/^[6-9]\d{9}$/.test(mobile)) {
                $('#mobileInput-err').text('Enter a valid 10-digit Indian mobile number');
                return;
            }
            sendOtp(mobile);
        });

        function sendOtp(mobile) {
            $('#sendOtpBtn').prop('disabled', true);
            $.post('{{ route("mobileVerify") }}', { mobile: mobile, _token: CSRF })
                .done(function (data) {
                    $('#sendOtpBtn').prop('disabled', false);
                    if (data.success) {
                        $('#otpMobileLabel').text('+91 ' + mobile);
                        $('.detail-otp-box').val('');
                        showStep('otpStep');
                        $('.detail-otp-box').first().focus();
                        startResendTimer(30, function () { sendOtp(mobile); });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Oops...', text: 'Please retry after sometime.' });
                    }
                })
                .fail(function (response) {
                    $('#sendOtpBtn').prop('disabled', false);
                    const msg = response.responseJSON && response.responseJSON.error
                        ? response.responseJSON.error
                        : (response.responseJSON && response.responseJSON.mobile ? response.responseJSON.mobile[0] : 'This mobile number may already be registered.');
                    Swal.fire({ icon: 'error', title: 'Oops...', text: msg });
                });
        }

        /* ============ STEP 3: Verify OTP -> straight to referral/submit, no password ============ */
        $('#verifyOtpBtn').on('click', function () {
            const mobile = $('#otpMobileLabel').text().replace('+91 ', '');
            const otp = collectOtp();
            $('#detailOtp-err').text('');
            if (otp.length < 4) {
                $('#detailOtp-err').text('Please enter the complete 4-digit OTP');
                return;
            }
            $('#verifyOtpBtn').prop('disabled', true).text('Verifying...');
            $.ajax({
                url: '{{ route("verifyOTP") }}',
                type: 'POST',
                data: { mobile: mobile, otp: otp, _token: CSRF },
                dataType: 'json',
                success: function (data) {
                    $('#verifyOtpBtn').prop('disabled', false).text('Verify');
                    if (data.success) {
                        clearInterval(window.detailResendLink_interval);
                        $('#mobileHidden').val(mobile);
                        showStep('detailsStep');
                    } else {
                        $('#detailOtp-err').text('You entered an incorrect OTP.');
                    }
                },
                error: function () {
                    $('#verifyOtpBtn').prop('disabled', false).text('Verify');
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                }
            });
        });

        /* ============ STEP 4: Submit (referral only, no password) ============ */
        $('#registerForm').on('submit', function (event) {
            $('#terms-err').text('');

            if ($('#is_valid_refer').length && $('#is_valid_refer').val() == 0 && $('.referralCode').val() && $('.referralCode').val().trim() !== '') {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Not a valid referral code!',
                    text: 'Please check the entered referral code'
                });
                return;
            }

            if (!$('#termsCheckbox').is(':checked')) {
                event.preventDefault();
                $('#terms-err').text('Please accept the Terms & Conditions to continue');
            }
        });

        /* ---------- Referral code ---------- */
        let referral = '{{ session('referralCode') }}';
        let referralCodeElement = $(".referralCode");
        referralCodeElement.val(referral);
        if (referral) {
            setTimeout(function () { referralCodeElement.trigger('keyup'); }, 100);
        }
        $(".referralCode").keyup(function () {
            let referralValue = $(this).val();
            if (referralValue !== "") {
                $.ajax({
                    type: "GET",
                    url: "{{ url('getusername') }}/" + referralValue,
                    success: function (data) {
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

        /* ---------- Top flash alerts auto-fade ---------- */
        $(function () {
            setTimeout(function () {
                $('#successAlert, #errorAlert, #validationAlert').fadeOut(400, function () { $(this).remove(); });
            }, 5000);
        });

        $(function () {
            if ($('#mobileInput').val().trim().length > 0) {
                $('#sendOtpBtn').removeClass('step-hidden');
            }
        });
    </script>

</body>

</html>
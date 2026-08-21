@extends('front.layouts.master')

@section('title')
    Ad Post
@endsection
@push('after-styles')
    <link rel="stylesheet" href="{{asset('front/css/custom/ad-post.css')}}">
@endpush
@section('content')
    <style>
        div.gallery img {
            width: 60px;
        }

        #rowAdder {
            margin-left: 17px;
        }

        .img-div {
            position: relative;
            width: 46%;
            float: left;
            margin-right: 5px;
            margin-left: 5px;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .image {
            opacity: 1;
            display: block;
            width: 100%;
            max-width: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .middle {
            opacity: 1;
            position: absolute;
            top: 15%;
            left: 24%;
            text-align: center;
        }

        .img-div:hover .image {
            opacity: 0.3;
        }

        .img-div:hover .middle {
            opacity: 1;
        }

        .mandatory-mark {
            color: #999;
            font-size: 9px;
            font-weight: 400;
            margin-left: 6px;
        }

        /* Dropdown arrow fix for Category / Price Type / other custom-select fields */
        select.custom-select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23888' stroke-width='2' fill='none'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 36px;
        }

        /* Email verify / OTP buttons — clean pill style */
        .email-verify-row {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-verify-inline {
            background: #1f4b3f;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 0 20px;
            height: 44px;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            cursor: pointer;
            transition: background .2s ease, opacity .2s ease;
            flex-shrink: 0;
        }

        .btn-verify-inline:hover {
            background: #2c6b57;
        }

        .btn-verify-inline:disabled {
            opacity: .6;
            cursor: not-allowed;
        }

        .otp-verify-box {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .otp-verify-box input {
            max-width: 160px;
            height: 44px;
            border-radius: 10px;
            border: 1px solid #e2e0dc;
            background: #f7f7f6;
            padding: 0 16px;
            font-size: 15px;
            letter-spacing: 2px;
        }

        .otp-verify-box input:focus {
            outline: none;
            border-color: #2c6b57;
            background: #fff;
        }

        .email-verify-msg {
            display: block;
            font-size: 12px;
            margin-top: 6px;
        }

        .field-example {
            color: #999;
            font-size: 11px;
            font-weight: 400;
            display: block;
            margin-top: 4px;
        }

        /* Focus hote hi placeholder hide ho jaaye */
        .form-control::placeholder {
            transition: opacity 0.2s ease;
            opacity: 1;
        }

        .form-control:focus::placeholder {
            opacity: 0;
        }
    </style>
    <!--=====================================
                                                                                ADPOST PART START
                                                                    =======================================-->
    <section class="adpost-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <form class="adpost-form" action="{{ route('user.save-ad-post') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="adpost-card">
                            <div class="adpost-title">
                                <h3>Ad Information</h3>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label">Ad Title <span
                                                class="mandatory-mark">(Mandatory)</span></label>
                                        <input type="text" class="form-control" name="title"
                                            placeholder="Example: Sirohi Goat for Sale / 2 साल की Sirohi बकरी बिक्री के लिए"
                                            required>
                                    </div>
                                </div>

                                <div class="col-lg-6 category_div">
                                    <div class="form-group">
                                        <label class="form-label">Category <span
                                                class="mandatory-mark">(Mandatory)</span></label>
                                        <select class="form-control custom-select" name="category_id" id="category_id"
                                            required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 subcategory_div" id="subcategory_wrapper" style="display: none;">
                                    <div class="form-group">
                                        <label class="form-label">Sub Category</label>
                                        <select name="subcategory_id" id="subcategory_id"
                                            class="form-control custom-select"></select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Price <span
                                                class="mandatory-mark">(Mandatory)</span></label>
                                        <input type="number" class="form-control" name="price"
                                            placeholder="Enter your pricing amount" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Price Type <span
                                                class="mandatory-mark">(Mandatory)</span></label>
                                        <select class="form-control custom-select" name="price_type" id="price_type"
                                            required>
                                            <option value="Fixed">Fixed</option>
                                            <option value="Negotiable">Negotiable</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-12" id="locationdiv">
                                    <div class="form-group">
                                        <label class="form-label">Location <span
                                                class="mandatory-mark">(Mandatory)</span></label>
                                        <input type="text" class="form-control" name="location" id="location" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label">ad description <span
                                                class="mandatory-mark">(Mandatory)</span></label>
                                        <textarea class="form-control" name="description"
                                            placeholder="Example: Enter Detail / अपने पशु के बारे में जानकारी लिखें। जैसे: 2 साल की Sirohi बकरी है, वजन लगभग 40 किलो है। स्वस्थ है।"
                                            required></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 features-sec" style="display: contents;">
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label">Specifications</label>
                                        <div id="row">
                                            <div class="input-group mb-3 align-items-center">

                                                <input type="text" class="form-control m-input" name="specifications[]"
                                                    placeholder="Example: 2 Years / 2 साल की गाय है">
                                                <div class="input-group-prepend">
                                                    <button class="btn delete-btn-app" id="DeleteRow" type="button">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <small class="field-example">यहाँ आप अपने पशु के बारे में अतिरिक्त जानकारी दे सकते
                                            हैं, जैसे वह कितना दूध देता है, उसका स्वास्थ्य कैसा है, Vaccination कराया गया है
                                            या नहीं आदि। "Add More" पर क्लिक करके आप एक-एक करके अलग-अलग जानकारी भी जोड़ सकते
                                            हैं।</small>
                                        <div id="newinput"></div>
                                        <button id="rowAdder" type="button" class="btn btn-add-more-app">
                                            <i class="fas fa-plus"></i> Add More
                                        </button>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label">Ad Multiple Image <span
                                                class="mandatory-mark">(Mandatory)</span></label>
                                        <input type="file" id="image" class="form-control" name="image[]"
                                            multiple="multiple" accept="image/png, image/jpeg" required>
                                        <div class="gallery"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="adpost-card">
                            <div class="adpost-title">
                                <h3>Author Information</h3>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Name <span
                                                class="mandatory-mark">(Mandatory)</span></label>
                                        <input type="text" class="form-control" name="author_name"
                                            value="{{Auth::guard('member')->user()->full_name ?? ''}}"
                                            placeholder="Your Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Email <span
                                                class="mandatory-mark">(Optional)</span></label>
                                        <div class="email-verify-row">
                                            <input type="email" class="form-control" name="author_email" id="author_email"
                                                value="{{Auth::guard('member')->user()->email ?? ''}}"
                                                data-verified-email="{{ Auth::guard('member')->user()->email_verified_at ? Auth::guard('member')->user()->email : '' }}"
                                                placeholder="Your Email (optional)">
                                            <button type="button" class="btn-verify-inline" id="verifyEmailBtn"
                                                style="display:none;">Verify Now</button>
                                        </div>
                                        <span id="emailVerifyMsg" class="email-verify-msg"></span>

                                        {{-- OTP box, hidden until Verify Now is clicked --}}
                                        <div id="emailOtpBox" class="otp-verify-box" style="display:none;">
                                            <input type="text" id="emailOtpInput" maxlength="4" inputmode="numeric"
                                                placeholder="Enter OTP">
                                            <button type="button" class="btn-verify-inline" id="submitEmailOtpBtn">Submit
                                                OTP</button>
                                        </div>
                                        <input type="hidden" id="email_is_verified" value="0">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Number <span
                                                class="mandatory-mark">(Mandatory)</span></label>
                                        <input type="number" class="form-control" name="author_mobile"
                                            value="{{Auth::guard('member')->user()->mobile ?? ''}}"
                                            placeholder="Your Number" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Address <span
                                                class="mandatory-mark">(Mandatory)</span></label>
                                        <input type="text" class="form-control" name="author_address"
                                            value="{{Auth::guard('member')->user()->address ?? ''}}"
                                            placeholder="Your Address" required>
                                    </div>
                                </div>
                                <div class="form-group text-right price-btn">
                                    <button class="btn btn-inline">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Post your ad</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>



                </div>

            </div>
        </div>
    </section>
    <!--=====================================
                                                                                ADPOST PART END
                                                                    =======================================-->
@endsection

@push('after-script')

    <script>
        const CSRF_AD = '{{ csrf_token() }}';
        const originalVerifiedEmail = $('#author_email').data('verified-email');

        function toggleVerifyButton() {
            const currentEmail = $('#author_email').val().trim();
            $('#emailOtpBox').hide();
            $('#emailVerifyMsg').text('');

            if (currentEmail === '') {
                // Email khali hai — ye optional field hai, verify karne ki zaroorat nahi
                $('#verifyEmailBtn').hide();
                $('#email_is_verified').val('1');
            } else if (originalVerifiedEmail && currentEmail === originalVerifiedEmail) {
                // Ye wahi email hai jo pehle se verified hai — dobara verify mat karwao
                $('#verifyEmailBtn').hide();
                $('#email_is_verified').val('1');
            } else {
                // Naya ya unverified email — pehle verify karwana padega
                $('#verifyEmailBtn').show();
                $('#email_is_verified').val('0');
            }
        }
        toggleVerifyButton();
        $('#author_email').on('input', toggleVerifyButton);

        $('#verifyEmailBtn').on('click', function () {
            const email = $('#author_email').val().trim();
            if (!email) {
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Please enter an email first.' });
                return;
            }
            $('#verifyEmailBtn').prop('disabled', true).text('Sending...');
            $.ajax({
                url: "{{ route('send.ad.email.otp') }}",
                type: 'POST',
                data: { email: email, _token: CSRF_AD },
                dataType: 'json',
                success: function (result) {
                    $('#verifyEmailBtn').prop('disabled', false).text('Verify Now');
                    if (result.success) {
                        $('#emailVerifyMsg').css('color', '#1f8a4c').text(result.message);
                        $('#emailOtpBox').show();
                        $('#emailOtpInput').val('').focus();
                    } else {
                        Swal.fire({ icon: 'error', title: 'Oops...', text: result.message });
                    }
                },
                error: function () {
                    $('#verifyEmailBtn').prop('disabled', false).text('Verify Now');
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                }
            });
        });

        $('#submitEmailOtpBtn').on('click', function () {
            const email = $('#author_email').val().trim();
            const otp = $('#emailOtpInput').val().trim();
            if (otp.length < 4) {
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Please enter the complete 4-digit OTP' });
                return;
            }
            $('#submitEmailOtpBtn').prop('disabled', true).text('Verifying...');
            $.ajax({
                url: "{{ route('verify.ad.email.otp') }}",
                type: 'POST',
                data: { email: email, otp: otp, _token: CSRF_AD },
                dataType: 'json',
                success: function (result) {
                    $('#submitEmailOtpBtn').prop('disabled', false).text('Submit OTP');
                    if (result.success) {
                        $('#emailVerifyMsg').css('color', '#1f8a4c').text(result.message);
                        $('#emailOtpBox').hide();
                        $('#verifyEmailBtn').hide();
                        $('#email_is_verified').val('1');
                    } else {
                        $('#emailVerifyMsg').css('color', '#c0392b').text(result.message);
                    }
                },
                error: function () {
                    $('#submitEmailOtpBtn').prop('disabled', false).text('Submit OTP');
                    Swal.fire({ icon: 'error', title: 'Oops...', text: 'Something went wrong, please try again.' });
                }
            });
        });

        $('.adpost-form').on('submit', function (event) {
            const currentEmail = $('#author_email').val().trim();
            if (currentEmail !== '' && $('#email_is_verified').val() != '1') {
                event.preventDefault();
                Swal.fire({ icon: 'warning', title: 'Email not verified', text: 'Please verify your email before posting the ad.' });
            }
        });

        $(document).ready(function () {
            var fileArr = [];
            $("#image").change(function () {
                if (fileArr.length > 0) fileArr = [];

                $('.gallery').html("");
                var total_file = document.getElementById("image").files;
                if (!total_file.length) return;
                for (var i = 0; i < total_file.length; i++) {
                    if (total_file[i].size > 1048576) {
                        return false;
                    } else {
                        fileArr.push(total_file[i]);
                        $('.gallery').append("<div class='img-div' id='img-div" + i + "'><img src='" + URL.createObjectURL(event.target.files[i]) + "' class='img-responsive image img-thumbnail' title='" + total_file[i].name + "'><div class='middle'><button id='action-icon' value='img-div" + i + "' class='' role='" + total_file[i].name + "'><i class='fa fa-trash'></i></button></div></div>");
                    }
                }
            });

            $('body').on('click', '#action-icon', function (evt) {
                var divName = this.value;
                var fileName = $(this).attr('role');
                $(`#${divName}`).remove();

                for (var i = 0; i < fileArr.length; i++) {
                    if (fileArr[i].name === fileName) {
                        fileArr.splice(i, 1);
                    }
                }
                document.getElementById('image').files = FileListItem(fileArr);
                evt.preventDefault();
            });

            function FileListItem(file) {
                file = [].slice.call(Array.isArray(file) ? file : arguments)
                for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
                if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
                for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
                return b.files
            }
        });

        $(document).on('change', '#category_id', function (event) {
            $('#subcategory_id').html('');
            let category_id = $(this).val();

            $.ajax({
                url: `{{ URL::to('fetch-subcategory/${category_id}') }}`,
                type: 'GET',
                dataType: 'json',
                success: function (result) {
                    if (result.success) {
                        if (result.html && result.html.length > 0) {
                            $('#subcategory_id').html('<option value="">-- Select --</option>' + result.html);
                            $('#subcategory_wrapper').show();
                        } else {
                            $('#subcategory_id').html('<option value="">-- Select --</option>');
                            $('#subcategory_wrapper').hide();
                        }

                        fetchformData(category_id, 0);
                    } else {
                        toastr.error('Error encountered: ' + result.msgText);
                    }
                },
            });
        });

        $(document).on('change', '#subcategory_id', function (event) {
            let subcategory_id = $(this).val();
            let category_id = $('#category_id').val();
            fetchformData(category_id, subcategory_id);
        });

        $(document).on('change', '#brand_category_id', function (event) {

            let brand_category_id = $(this).val();
            $.ajax({
                url: `{{ URL::to('fetch-brand/${brand_category_id}') }}`,
                type: 'GET',
                dataType: 'json',
                success: function (result) {
                    if (result.success) {
                        $('.brand_category_div').after(result.html);

                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
            });
        });

        function fetchformData(catid, subcatid) {

            $('.features-sec').html("")
            $('#branddiv').html('');

            $.ajax({
                url: `{{ URL::to('fetch-form-data/${catid}/${subcatid}') }}`,
                type: 'GET',
                dataType: 'json',
                success: function (result) {
                    if (result.success) {
                        $('.features-sec').append(result.html);
                        $('#brands').append(result.brands);

                        var branddiv = document.getElementById("branddiv");

                        if (typeof (branddiv) != 'undefined' && branddiv != null) {

                            var locationdiv = document.getElementById("locationdiv");
                            $('#locationdiv').removeClass('col-lg-12');
                            $('#locationdiv').addClass('col-lg-6');

                            $(branddiv).insertAfter($(locationdiv));
                        }

                        var yearInput = document.getElementById("yeardiv");
                        var monthInput = document.getElementById("monthdiv");
                        var approxInput = document.getElementById("approxdiv");

                        var avgwtInput = document.getElementById("avgwtdiv");
                        var avgwtInInput = document.getElementById("avgwtindiv");

                        var wtInput = document.getElementById("wtdiv");
                        var wtInInput = document.getElementById("wtindiv");

                        var minqty = document.getElementById("minqty");
                        var availqty = document.getElementById("availqty");

                        if (typeof (minqty) != 'undefined' && minqty != null) {
                            $(availqty).insertAfter($(minqty));
                        }

                        if (typeof (yearInput) != 'undefined' && yearInput != null) {
                            $(monthInput).insertAfter($(yearInput));
                        }
                        if (typeof (approxInput) != 'undefined' && approxInput != null) {
                            $(approxInput).insertAfter($(monthInput));
                        }

                        if (typeof (avgwtInput) != 'undefined' && avgwtInput != null) {
                            $(avgwtInInput).insertAfter($(avgwtInput));
                        }

                        if (typeof (wtInput) != 'undefined' && wtInput != null) {
                            $(wtInInput).insertAfter($(wtInput));
                        }

                        if (typeof (yearInput) != 'undefined' && yearInput != null && typeof (avgwtInput) != 'undefined' && avgwtInput != null) {
                            $(avgwtInput).insertAfter($(approxInput));
                            $(avgwtInInput).insertAfter($(avgwtInput));
                        }

                        if (typeof (yearInput) != 'undefined' && yearInput != null && typeof (wtInput) != 'undefined' && wtInput != null) {
                            $(wtInput).insertAfter($(approxInput));
                            $(wtInInput).insertAfter($(wtInput));
                        }

                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
            });
        }

        $(document).on('change', '#vehicle_type', function (event) {
            let vehicle_type = $(this).val();
            fetchfueltype(vehicle_type);
        });

        function fetchfueltype(vehicle_type) {
            $('#fuel_type').html("")
            $.ajax({
                url: `{{ URL::to('fetch-fuel-type/${vehicle_type}') }}`,
                type: 'GET',
                dataType: 'json',
                success: function (result) {
                    if (result.success) {
                        $('#fuel_type').append(result.html);

                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
            });
        }
        $("#rowAdder").click(function () {
            newRowAdd =
                ' <div id="row"><div class="input-group mb-3 align-items-center">' +
                '<input type="text" class="form-control m-input" name="specifications[]" placeholder="Example: Weight: 40 Kg / वजन: 40 किलो">' +
                '<div class="input-group-append">' +
                '<button class="btn delete-btn-app" id="DeleteRow" type="button">' +
                '<i class="fas fa-trash"></i></button> </div>' +
                '</div> </div>';

            $('#newinput').append(newRowAdd);
        });
        $("body").on("click", "#DeleteRow", function () {
            $(this).parents("#row").remove();
        })
    </script>

@endpush
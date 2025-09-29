@extends('front.layouts.master')

@section('title')
    Checkout
@endsection
@push('after-styles')
    <link rel="stylesheet" href="{{asset('front/css/custom/profile.css')}}">
@endpush
@section('content')
    <style>
        .price {
            font-size: 22px;
            text-align: center;
        }

        .price-sub {
            width: 100%;
            height: auto;
            display: flex;
            justify-content: space-between;
        }

        .price-sub div h2 {
            font-size: 18px;
        }
    </style>
    <section class="profile-part checkout">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-card subscription-card-layout">
                        <div class="account-title">
                            <h3>{{$subscription->name}} @php
                                $category_list = $categorysubscriptions;
                                $result = App\Models\Category::whereIn('id', $category_list)->pluck('name');
                                $categoryall = $result->implode(',');
                            @endphp
                                <i data-toggle="tooltip" data-placement="top" data-html="true" title="{!! $categoryall !!}"
                                    style="font-size:24px" class="fa">&#xf05a;</i>
                            </h3>
                        </div>
                        <ul class="account-card-list">


                            @if($subscription->subscription_validity == '1' || $subscription->subscription_validity == '0')
                                @php

                                    $total_day = 'Day';
                                @endphp
                            @else
                                @php
                                    $total_day = 'Days';
                                @endphp
                            @endif
                            <div class="price-sub">
                                <div>
                                    <h2>Validity Plan:
                                        {{ $subscription->subscription_validity}} {{ $total_day }}
                                    </h2>
                                    <h2>Number of Ads:{{ $subscription->no_of_ads}}</h2>
                                </div>
                                <div>
                                    @if(isset($subscription->discount) && $subscription->discount != 0)

                                        <h2 class="" style="font-size:34px; font-weight:800"> ₹ {{ $subscription->offer_price }}
                                        </h2>
                                    @else
                                        <h2 style="font-size:24px; font-weight:800"> ₹ {{ $subscription->mrp }}</h2>

                                    @endif

                                </div>

                            </div>

                            <!--<div class="price">{{ $subscription->subscription_validity}} {{ $total_day }} Validity Plan</div>-->
                            <!--<div class="price">{{ $subscription->no_of_ads}} Ads</div>-->
                            <!--@if(isset($subscription->discount)&&$subscription->discount!=0)-->
                            <!--<div class="price s">INR {{ $subscription->offer_price }}</div>-->
                            <!--@else-->
                            <!--<div class="price">INR {{ $subscription->mrp }}</div>-->
                            <!--@endif-->
                        </ul>
                    </div>


                </div>
                <div class="row">

                    <div class="col-lg-6">
                        <div class="account-card">
                            <div class="account-title">
                                <h3>Price Summary</h3>
                            </div>
                            <ul class="account-card-list" style="padding-left:0px;">
                                <li>
                                    <h5>MRP</h5>
                                    <p>₹ {{ $subscription->mrp }}</p>
                                </li>

                                <li>
                                    <h5>Discount</h5>
                                    <p>₹ {{ $subscription->mrp - $subscription->offer_price }}</p>
                                </li>
                                <li>
                                    <h5>Offered price</h5>
                                    <p>₹ {{ $subscription->offer_price }}</p>
                                </li>
                                <li>
                                    <h5>SubTotal</h5>
                                    <p>
                                        <span id="subtotal">₹ {{ $subscription->offer_price }}</span>

                                    </p>
                                </li>
                                <li>
                                    <h5>GST<p>({{$gst_percent}}% {{$gst_type}})</p>
                                    </h5>

                                    <p>
                                        <span id="gst_amount" gst_amount="{{$total_gst}}">₹ {{$total_gst}}</span>

                                    </p>
                                </li>
                                <li>
                                    <h5>Total</h5>

                                    <p>
                                        <span id="total" total="{{$total}}">₹ {{$total}}</span>
                                        <input type="hidden" value="{{ $total }}" id="totalAmt">
                                    </p>
                                </li>

                                <li style="display:{{$wallet != 0 ? '' : 'none'}}">
                                    <h5>Pay with Wallet(₹ {{$wallet}})
                                        <p style="margin-bottom: 0.2rem; font-weight:400; color:gray;font-size:13px;">You
                                            can pay maximum {{$admin_wallet_limit}}% of the Offer Price by wallet</p>

                                    </h5>

                                    <p>
                                        <input type="checkbox" id="payWithWalletCheckbox" onchange="updatePaymentMethod()">
                                        <label for="payWithWalletCheckbox" style="color:green;">₹
                                            {{ $usable_wallet_amount > $wallet ? $wallet : $usable_wallet_amount }}</label>
                                    </p>
                                </li>

                                <div id="remaining_balance_wallet" style="display: none">
                                    <li>
                                        <h5>Remaining wallet balance
                                        </h5>
                                        <p>
                                            <span>₹ {{max(0, $wallet - $usable_wallet_amount)}}</span>

                                        </p>
                                    </li>
                                    <li>
                                        <h5>Final payable amount</h5>
                                        @php
                                            $wallBal = $usable_wallet_amount > $wallet ? $wallet : $usable_wallet_amount;
                                        @endphp

                                        <p><span>₹ {{ (float) (str_replace(',', '', $total)) - (float) $wallBal }}</span>
                                            <input type="hidden"
                                                value="{{ (float) (str_replace(',', '', $total)) - (float) $wallBal }}"
                                                id="fpay">
                                        </p>
                                    </li>
                                </div>
                                @php
                                    $disabled = $user->address == '' ? 'disabled' : '';
                                    $addrText = $user->address == '' ? 'Please first complete billing address details' : '';
                                @endphp
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="account-card">
                            <div class="account-title">
                                <h3>Billing Address Information</h3>
                            </div>

                            <form id="checkoutForm" action="{{ route('free-subscription') }}" method="POST">
                                @csrf

                                {{-- Hidden fields --}}
                                <input type="hidden" name="amount" id="paidAmt" value="">
                                <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                                <input type="hidden" name="orderId" value="{{ $orderId }}">
                                <input type="hidden" name="id" value="{{ $subscription->id }}">
                                <input type="hidden" name="wallet_used" id="wallet_used" value="0">

                                {{-- Billing Address --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Country</label>
                                            <input type="text" class="form-control" name="country" value="India" readonly>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">State</label>
                                            <select class="form-control custom-select" name="state" id="state_id" required>
                                                <option value="">Select State</option>
                                                @foreach($states as $state)
                                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">City</label>
                                            <select class="form-control custom-select" name="city" id="city" required>
                                                <option value="">City</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-label">Pin Code</label>
                                            <input type="text" class="form-control" name="zipcode" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">Address</label>
                                            <textarea class="form-control" rows="2" name="address" id="address"
                                                required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 d-flex align-items-center justify-content-center">
                                    <button id="proceedToPay" class="btn btn-primary btn-lg" style="width:100%;">Proceed to
                                        Pay</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
    </section>

@endsection
@push('after-script')
    <script>
        $(document).on("change", "#state_id", function () {
            $("#city").html("");
            let state_id = $(this).val();
            $.ajax({
                url: `{{ URL::to('cities-by-state') }}`,
                type: "post",
                dataType: "json",
                data: { "state_id": state_id, "_token": "{{ csrf_token() }}", },
                success: function (result) {
                    console.log(result);
                    $("#city").html(result);

                }
            });
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.js"></script>

    <script>
        function updatePaymentMethod() {
            var payWithWalletCheckbox = document.getElementById("payWithWalletCheckbox");
            var remainingBalLiWal = document.getElementById("remaining_balance_wallet");
            var isPayWithWallet = payWithWalletCheckbox.checked;
            var subTotal = document.getElementById('subtotal');
            var gst = document.getElementById('gst_amount');
            var totalSp = document.getElementById('total');
            var fpay = document.getElementById('fpay').value;

            var payAmt = document.getElementById('paidAmt');
            var payAmtVal = document.getElementById('totalAmt').value;

            // Perform actions based on the state of the checkbox
            if (isPayWithWallet) {
                // User wants to pay with wallet
                totalSp.style.display = 'block';
                gst.style.display = 'block';
                subTotal.style.display = 'block';
                remainingBalLiWal.style.display = 'block';
                // razor_but_view.style.display = 'none';
                // wallet_but_view.style.display = 'block';
                payAmt.value = fpay;
                console.log("User wants to pay with wallet");
                // You can add additional logic here
            } else {
                // User does not want to pay with wallet
                totalSp.style.display = 'block';
                gst.style.display = 'block';
                subTotal.style.display = 'block';

                payAmt.value = payAmtVal;
                payWithWalletCheckbox.checked = false;
                remainingBalLiWal.style.display = 'none';
                // razor_but_view.style.display = 'block';
                // wallet_but_view.style.display = 'none';
                console.log("User does not want to pay with wallet");
                // You can add additional logic here
            }
        }
    </script>

    <script src="https://checkout.razorpay.com/v2/checkout.js"></script>
    <script>
        /**
         * Helper: parse a currency/number string robustly
         * Accepts strings like "1,234.50", "₹ 1,234.50", "1234.5" and returns Number
         */
        function parseNum(str) {
            if (str === null || str === undefined) return 0;
            // remove commas and any non-digit (except dot and minus)
            const cleaned = String(str).replace(/,/g, '').replace(/[^\d.-]/g, '');
            const n = parseFloat(cleaned);
            return isNaN(n) ? 0 : n;
        }

        document.getElementById('proceedToPay').addEventListener('click', function (e) {
            e.preventDefault();

            // Read original total from hidden input totalAmt (prefer this because it is numeric)
            const totalAmtEl = document.getElementById('totalAmt');
            const originalTotal = totalAmtEl ? parseNum(totalAmtEl.value) : parseNum(document.getElementById('total').getAttribute('total'));

            // Is user opting to pay with wallet?
            const walletCheckbox = document.getElementById('payWithWalletCheckbox');
            const isPayWithWallet = walletCheckbox && walletCheckbox.checked;

            // Final payable after wallet deduction (fpay contains total - walletUsed)
            const fpayEl = document.getElementById('fpay');
            const finalAfterWallet = fpayEl ? parseNum(fpayEl.value) : originalTotal;

            // Compute wallet used:
            // walletUsed = originalTotal - finalAfterWallet  (but never negative)
            const walletUsed = Math.max(0, originalTotal - finalAfterWallet);

            // Put walletUsed into hidden field
            const walletUsedField = document.getElementById('wallet_used');
            if (walletUsedField) walletUsedField.value = walletUsed;

            // Decide final amount to charge online
            const finalAmount = isPayWithWallet ? finalAfterWallet : originalTotal;

            // Put amount into hidden field for backend
            const paidAmtField = document.getElementById('paidAmt');
            if (paidAmtField) paidAmtField.value = finalAmount;

            // If the final amount is zero or less (wallet covered everything), skip Razorpay and submit form
            if (finalAmount <= 0) {
                // Optionally set a marker so backend knows payment was wallet-only
                const rpField = document.getElementById('razorpay_payment_id');
                if (rpField) rpField.value = ''; // empty means no Razorpay id (use 'WALLET' if you prefer)
                // submit the form to free-subscription
                document.getElementById('checkoutForm').submit();
                return;
            }

            // Convert to paise and round
            const amountPaise = Math.round(finalAmount * 100);

            // Build Razorpay options
            const options = {
                key: "{{ config('services.razorpay.key') }}", // server-side config
                amount: amountPaise,
                currency: "INR",
                name: "{{ config('app.name', 'Your Site Name') }}",
                description: "Subscription Payment",
                prefill: {
                    name: "{{ $user->name }}",
                    email: "{{ $user->email }}"
                },
                handler: function (response) {
                    // put Razorpay payment id into hidden input and submit the form
                    const rpField = document.getElementById('razorpay_payment_id');
                    if (rpField) rpField.value = response.razorpay_payment_id || '';
                    // Submit the form to your route with Razorpay id + wallet_used + billing info
                    document.getElementById('checkoutForm').submit();
                },
                modal: {
                    ondismiss: function () {
                        // optional: user closed the checkout
                        // console.log('Razorpay modal closed');
                    }
                },
                theme: {
                    color: "#3399cc"
                }
            };

            // create and open Razorpay
            const rzp = new Razorpay(options);
            rzp.open();
        });
    </script>



@endpush
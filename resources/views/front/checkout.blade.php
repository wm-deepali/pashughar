@extends('front.layouts.master')

@section('title')
Checkout
@endsection
@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/profile.css')}}">
@endpush
@section('content')
<style>
    .price
    {
        font-size:22px;
        text-align:center;
    }
    .price-sub{
        width:100%;
        height:auto;
        display:flex;
        justify-content:space-between;
    }
    .price-sub div h2{
        font-size:18px;
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
                        $result = App\Models\Category::whereIn('id',$category_list)->pluck('name');
                        $categoryall = $result->implode(',');
                        @endphp
                        <i data-toggle="tooltip" data-placement="top" data-html="true" title="{!! $categoryall !!}" style="font-size:24px" class="fa">&#xf05a;</i> </h3>
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
{{ $subscription->subscription_validity}} {{ $total_day }} </h2>
<h2>Number of Ads:{{ $subscription->no_of_ads}}</h2>
</div>
<div>
    @if(isset($subscription->discount)&&$subscription->discount!=0)
                        
                        <h2 class="" style="font-size:34px; font-weight:800"> ₹ {{ $subscription->offer_price }}</h2>
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
                        <li><h5>MRP</h5><p>₹ {{ $subscription->mrp }}</p></li>
                        
                        <li><h5>Discount</h5><p>₹ {{ $subscription->mrp - $subscription->offer_price }}</p></li>
                        <li><h5>Offered price</h5><p>₹ {{ $subscription->offer_price }}</p></li>
                        <li>
                            <h5>SubTotal</h5>
                            <p>
                                <span id="subtotal" >₹ {{ $subscription->offer_price }}</span>
                                
                            </p>
                        </li>
                        <li>
                            <h5>GST<p>({{$gst_percent}}% {{$gst_type}})</p></h5>
                            
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
                        
                        <li style="display:{{$wallet != 0 ? '':'none'}}">
                            <h5>Pay with Wallet(₹ {{$wallet}})
                            <p style="margin-bottom: 0.2rem; font-weight:400; color:gray;font-size:13px;">You can pay maximum {{$admin_wallet_limit}}% of the Offer Price by wallet</p>
                                
                            </h5>
                            
                            <p>
                            <input type="checkbox" id="payWithWalletCheckbox" onchange="updatePaymentMethod()">
                            <label for="payWithWalletCheckbox" style="color:green;">₹ {{ $usable_wallet_amount > $wallet ? $wallet : $usable_wallet_amount }}</label>
                            </p>
                        </li>

                        <div id="remaining_balance_wallet" style="display: none">
                            <li>
                                <h5>Remaining wallet balance
                                </h5>
                                <p>
                                        <span>₹ {{max(0,$wallet - $usable_wallet_amount)}}</span>
                                
                                </p>
                            </li>
                            <li>
                                <h5>Final payable amount</h5>
                                @php
                                $wallBal = $usable_wallet_amount > $wallet ? $wallet : $usable_wallet_amount;
                                @endphp
                                
                                <p><span>₹ {{ (float)(str_replace(',', '', $total)) - (float)$wallBal }}</span>
                                <input type="hidden" value="{{ (float)(str_replace(',', '', $total)) - (float)$wallBal }}" id="fpay">
                            </p>
                            </li>
                        </div>
                        @php
                        $disabled = $user->address =='' ? 'disabled': '';
                        $addrText = $user->address =='' ? 'Please first complete billing address details': '';
                        @endphp
                        
                    </ul>
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="account-title">
                        <h3>Acount Details</h3>
                    </div>
                        <div class="account-card" style="padding-left:0px;margin-bottom:0px;">
                            <ul class="" style="padding-left:0px;">
                                <li><b>Bank Name:</b>&nbsp;{{$bankdetail->bank_name}}</li>
                                <!--<li>{{$bankdetail->bank_name}}</li>-->
                                
                                <li><b>Account Name:</b>&nbsp;{{$bankdetail->bank_account_name}}</li>
                                <!--<li>{{$bankdetail->bank_account_name}}</li>-->
                                
                                <li><b>Account Number:</b>&nbsp;{{$bankdetail->account_number}}</li>
                                <!--<li>{{$bankdetail->account_number}}</li>-->
                                
                                <li><b>Bank Branch Name:</b>&nbsp;{{$bankdetail->bank_branch}}</li>
                                <!--<li>{{$bankdetail->bank_branch}}</li>-->
                                
                                <li><b>Swift Code:</b>&nbsp;{{$bankdetail->swift_code}}</li>
                                <!--<li>{{$bankdetail->swift_code}}</li>-->
                                
                                <li><b>IFSC Code:</b>&nbsp;{{$bankdetail->ifsc_code}}</li>
                                <!--<li>{{$bankdetail->ifsc_code}}</li>-->
                                
                                
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="account-card" style="">
                            <ul class="account-card-list" style="padding-left:0px">
                                <li><img src="{{ asset('storage').'/'.$bankdetail->bar_code_image}}" alt="Bar Code" style="width: 100%;"></li>
                                <li><b>UPI Id:</b> {{$bankdetail->upi_id}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
                    </div>
                    <div class="col-lg-6">
 <div class="account-card">
                    <div class="account-title">
                        <h3>Billing Address Information</h3>
                    </div>
                    
                    <form class="adpost-form" action="{{ route('free-subscription') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" class="form-control" name="orderId" value="{{$orderId}}">
                        
                         <input type="hidden" class="form-control" name="id" value="{{$subscription->id}}">
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
                                    <input type="text" class="form-control" name="zipcode" value="" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control" rows="2" name="address" id="address" required>
                                    </textarea>
                                </div>
                            </div>
                                               <div class="account-title" style="padding-left:0px;margin-left:13px;">
                        <h3>Payment Method</h3>
                    </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Payment Method</label>
                                    <select class="form-control custom-select" name="payment_method" id="payment_method" required>
                                        <option value="">Select payment Method</option>  
                                        <option value="Paid in Cash">Paid in Cash</option> 
                                        <option value="Net Banking">Net Banking</option>  
                                        <option value="Wire Transfer">Wire Transfer</option>  
                                        <option value="Paypal">Paypal</option> 
                                        <option value="UPI">UPI</option>  
                                    </select>
                                </div>
                            </div>
                             <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Paid Amount</label>
                                    <input type="text" class="form-control" name="amount" value="{{$total}}" id="paidAmt" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Transaction Id / UTR Number</label>
                                    <input type="text" class="form-control" name="transaction_id" id="transaction_id" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Payment Date</label>
                                    <input type="date" class="form-control" name="payment_date" id="payment_date" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Screenshot</label>
                                    <input type="file" class="form-control" name="screenshot" id="screenshot" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Remark</label>
                                    <textarea class="form-control" name="remark" id="remark"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group price">
                                    <button type="submit" style="width:100%;" class="btn btn-primary" >Submit</button>
                                </div>
                            </div>
                        
                        </div>
                        </form>

            </div>
                    </div>
                
            </div>
        <!--    <div class="col-lg-6">-->
        <!--        <div class="row">-->
        <!--            <div class="col-lg-6">-->
        <!--                <div class="account-card" style="padding-left:0px;">-->
        <!--                    <ul class="">-->
        <!--                        <li><b>Bank Name:</b></li>-->
        <!--                        <li>{{$bankdetail->bank_name}}</li>-->
                                
        <!--                        <li><b>Account Name:</b></li>-->
        <!--                        <li>{{$bankdetail->bank_account_name}}</li>-->
                                
        <!--                        <li><b>Account Number:</b></li>-->
        <!--                        <li>{{$bankdetail->account_number}}</li>-->
                                
        <!--                        <li><b>Bank Branch Name:</b></li>-->
        <!--                        <li>{{$bankdetail->bank_branch}}</li>-->
                                
        <!--                        <li><b>Swift Code:</b></li>-->
        <!--                        <li>{{$bankdetail->swift_code}}</li>-->
                                
        <!--                        <li><b>IFSC Code:</b></li>-->
        <!--                        <li>{{$bankdetail->ifsc_code}}</li>-->
                                
                                
                                
        <!--                    </ul>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-lg-6">-->
        <!--                <div class="account-card">-->
        <!--                    <ul class="account-card-list">-->
        <!--                        <li><img src="{{ asset('storage').'/'.$bankdetail->bar_code_image}}" alt="Bar Code" style="width: 100%;"></li>-->
        <!--                        <li><b>UPI Id:</b> {{$bankdetail->upi_id}}</li>-->
        <!--                    </ul>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="account-card">-->
        <!--            <div class="account-title">-->
        <!--                <h3>Billing Address Information</h3>-->
        <!--            </div>-->
                    
        <!--            <form class="adpost-form" action="{{ route('free-subscription') }}" method="post" enctype="multipart/form-data">-->
        <!--                @csrf-->
        <!--                <input type="hidden" class="form-control" name="orderId" value="{{$orderId}}">-->
                        
        <!--                 <input type="hidden" class="form-control" name="id" value="{{$subscription->id}}">-->
        <!--                <div class="row">-->
                           
        <!--                    <div class="col-lg-6">-->
        <!--                        <div class="form-group">-->
        <!--                            <label class="form-label">Country</label>-->
        <!--                            <input type="text" class="form-control" name="country" value="Ethiopia" readonly>-->
        <!--                        </div>-->
        <!--                    </div>-->
                        
        <!--                    <div class="col-lg-6">-->
        <!--                        <div class="form-group">-->
        <!--                            <label class="form-label">State</label>-->
        <!--                            <select class="form-control custom-select" name="state" id="state_id" required>-->
        <!--                                <option value="">Select State</option>-->
        <!--                                @foreach($states as $state)-->
        <!--                                <option value="{{$state->id}}">{{$state->name}}</option>-->
        <!--                                @endforeach-->
        <!--                            </select>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="col-lg-6">-->
        <!--                        <div class="form-group">-->
        <!--                            <label class="form-label">City</label>-->
        <!--                            <select class="form-control custom-select" name="city" id="city" required>-->
        <!--                                <option value="">City</option>  -->
        <!--                            </select>-->
        <!--                        </div>-->
        <!--                    </div>-->
                        
        <!--                    <div class="col-lg-6">-->
        <!--                        <div class="form-group">-->
        <!--                            <label class="form-label">Post Code</label>-->
        <!--                            <input type="text" class="form-control" name="zipcode" value="" required>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="col-lg-12">-->
        <!--                        <div class="form-group">-->
        <!--                            <label class="form-label">Address</label>-->
        <!--                            <textarea class="form-control" rows="2" name="address" id="address" required>-->
        <!--                            </textarea>-->
        <!--                        </div>-->
        <!--                    </div>-->
                           
        <!--                    <div class="col-lg-12">-->
        <!--                        <div class="form-group">-->
        <!--                            <label class="form-label">Payment Method</label>-->
        <!--                            <select class="form-control custom-select" name="payment_method" id="payment_method" required>-->
        <!--                                <option value="">Select payment Method</option>  -->
        <!--                                <option value="Paid in Cash">Paid in Cash</option> -->
        <!--                                <option value="Net Banking">Net Banking</option>  -->
        <!--                                <option value="Wire Transfer">Wire Transfer</option>  -->
        <!--                                <option value="Paypal">Paypal</option> -->
        <!--                                <option value="UPI">UPI</option>  -->
        <!--                            </select>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                     <div class="col-lg-12">-->
        <!--                        <div class="form-group">-->
        <!--                            <label class="form-label">Paid Amount</label>-->
        <!--                            <input type="text" class="form-control" name="amount" value="{{$total}}" id="paidAmt" readonly>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="col-lg-12">-->
        <!--                        <div class="form-group">-->
        <!--                            <label class="form-label">Transaction Id / UTR Number</label>-->
        <!--                            <input type="text" class="form-control" name="transaction_id" id="transaction_id" required>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="col-lg-12">-->
        <!--                        <div class="form-group">-->
        <!--                            <label class="form-label">Payment Date</label>-->
        <!--                            <input type="date" class="form-control" name="payment_date" id="payment_date" required>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="col-lg-12">-->
        <!--                        <div class="form-group">-->
        <!--                            <label class="form-label">Screenshot</label>-->
        <!--                            <input type="file" class="form-control" name="screenshot" id="screenshot" required>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="col-lg-12">-->
        <!--                        <div class="form-group">-->
        <!--                            <label class="form-label">Remark</label>-->
        <!--                            <textarea class="form-control" name="remark" id="remark"></textarea>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                    <div class="col-lg-12">-->
        <!--                        <div class="form-group">-->
        <!--                            <button type="submit" class="btn btn-primary" >Submit</button>-->
        <!--                        </div>-->
        <!--                    </div>-->
                        
        <!--                </div>-->
        <!--                </form>-->

        <!--    </div>-->
 
        <!--</div>-->
    </div>
</section>

@endsection
@push('after-script')
<script>
    $(document).on("change", "#state_id", function() {
        $("#city").html("");
       let state_id = $(this).val();  
       $.ajax({
           url: `{{ URL::to('cities-by-state') }}`,
           type: "post",
           dataType: "json",
           data:{"state_id":state_id, "_token": "{{ csrf_token() }}",},
           success: function(result) {
               console.log(result);
               $("#city").html(result);
              
           }
       });
   });
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.css" >
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.js"></script>

<script src="https://checkout.razorpay.com/v2/checkout.js"></script>
<script>
    function updatePaymentMethod() {
            var payWithWalletCheckbox = document.getElementById("payWithWalletCheckbox");
            var remainingBalLiWal = document.getElementById("remaining_balance_wallet");
            
            //var razor_but_view = document.getElementById("paymentButton");
           // var wallet_but_view = document.getElementById("wallet_but_view");
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
                payAmt.value=fpay;
                console.log("User wants to pay with wallet");
                // You can add additional logic here
            }else{
                // User does not want to pay with wallet
                totalSp.style.display = 'block';
                gst.style.display = 'block';
                subTotal.style.display = 'block';
                
                 payAmt.value=payAmtVal;
                payWithWalletCheckbox.checked = false;
                remainingBalLiWal.style.display = 'none';
               // razor_but_view.style.display = 'block';
               // wallet_but_view.style.display = 'none';
                console.log("User does not want to pay with wallet");
                // You can add additional logic here
            }
        }
</script>

<script>
        $("#payWallet").on("click", function() {
            var subscriptionId = $(this).data('subscription-id');
            if (($(this).data('total')).toString().indexOf(',') > -1) { 
                var tot = ($(this).data('total')).replace(/,/g, '');
            }
            else{
                var tot = $(this).data('total');
            }
            
            var total = parseFloat(tot);
            var subscriptionOfferedPrice = '{{$subscription->offer_price}}';
            var remainingWall₹alance = parseFloat($(this).data('remaining'));
            var wall₹alance = parseFloat($(this).data('wallet-balance'));
            var usableWallet = parseFloat($(this).data('usable-wallet'));
            var walletLimit = parseFloat($(this).data('wallet-limit'));
            var remainingBalance = wall₹alance - usableWallet;
            var description = 'Subscription purchasing ' + $(this).data('subscription-name');
            var phone = $(this).data('phone');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var isPayWithWallet = payWithWalletCheckbox.checked;
            var totalGst = parseFloat($(this).data('total-gst'));

            // Check if wallet balance is sufficient
            if(usableWallet>=total&&!isPayWithWallet){
                walletPayBegin(wall₹alance-subscriptionOfferedPrice,subscriptionId,total,2);
            } else if(usableWallet>wall₹alance){
                 Swal.fire({
                    title: 'Are you sure?',
                    icon: 'success',
                    text: 'Your wallet balance is not enough. Do you want to proceed with razorpay for remaining &#8377;'+(total - wall₹alance)+' amount?',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Subscribe',
                }).then((result) => {
                    if (result.isConfirmed) {
                        payRazorpay(description,phone,name,email,subscriptionId,total-totalGst,wall₹alance,remainingWall₹alance,total-wall₹alance,0);
                    }
                });
            }else {
                Swal.fire({
                    title: 'Are you sure?',
                    icon: 'success',
                    text: 'You can only use '+walletLimit+'% of wallet balance. Do you want to proceed with razorpay for remaining &#8377;'+(total - usableWallet)+' amount?',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Subscribe',
                }).then((result) => {
                    if (result.isConfirmed) {
                        payRazorpay(description,phone,name,email,subscriptionId,total-totalGst,wall₹alance,remainingWall₹alance,total-usableWallet,0);
                    }
                });
            }
        });
        function walletPayBegin(remainingBalance,subscriptionId,total,type){
            Swal.fire({
                title: 'Are you sure?',
                icon: 'success',
                text: 'After this payment your remaining welcome bonus balance is &#8377;' + (remainingBalance) + '. Do you want to proceed with welcome bonus payment?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Subscribe'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform wallet payment
                    $.ajax({
                        url: '{{ url("free-subscription") }}',
                        method: 'POST',
                        data: {
                            id: subscriptionId,
                            total_subscription: total,
                            wallet_remaining: remainingBalance,
                           
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire({
                                    title: "Package Purchased Successfully",
                                    icon: "success",
                                    timer: 2000,
                                    timerProgressBar: true,
                                    onClose: () => {
                                        window.location.href = "{{ route('purchase-subscription') }}";
                                    }
                                });
                            }
                        }
                    });
                }
            });
        }
        $('#paymentButton').click(function() {
            var subscriptionId = $(this).data('subscription-id');
            if (($(this).data('total')).toString().indexOf(',') > -1) { 
                var tot = ($(this).data('total')).replace(/,/g, '');
            }
            else{
                var tot = $(this).data('total');
            }
            var total = parseFloat(tot);
            var remainingWall₹alance = parseFloat($(this).data('remaining'));
            var wall₹alance = parseFloat($(this).data('wallet-balance'));
            var usableWallet = parseFloat($(this).data('usable-wallet'));
            var walletLimit = parseFloat($(this).data('wallet-limit'));
            var totalGst = parseFloat($(this).data('total-gst'));
            var remainingBalance = wall₹alance - usableWallet;
            var description = 'Subscription purchasing ' + $(this).data('subscription-name');
            var phone = $(this).data('phone');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var valWoutGst = total-totalGst;
            console.log(valWoutGst)
            payRazorpay(description,phone,name,email,subscriptionId,valWoutGst,wall₹alance,remainingWall₹alance,total,0);
        
        });
        
        function payRazorpay(description,phone,name,email,subscriptionId,total,wall₹alance,remainingWall₹alance,usableWallet,isWelcome)
        {
            
            var amount = usableWallet;
            $.ajax({
            url: `{{ URL::to('user/create-order/${amount}/${email}') }}`,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    var orderId = result.order;
                    var key = result.key;

                    var options = {
                    "key": key, // Enter the Key ID generated from the Dashboard
                    "amount": amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "currency": "INR",
                    "name": "AVHClicks", //your business name
                    "description": description,
                    "image": "http://127.0.0.1/avhclick-admin/public/front/images/logo.png",
                    "order_id": orderId, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                    "handler": function (response){
                        var razorpay_payment_id = response.razorpay_payment_id;
                        
                        $.ajax({
                        url: `{{ route('user.payment-store')}}`,
                        type: 'POST',
                        data:{razorpay_payment_id:razorpay_payment_id,id:subscriptionId,_token: '{{ csrf_token() }}'},
                        dataType: 'json',
                        success: function(result) {
                            window.location.href = "{{ route('user.buy-subscription') }}";
                            toastr.success('Success: ' + result.msgText);
                        }
                    });
                        
                    },
                    "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information, especially their phone number
                        "name": name, //your customer's name
                        "email": email,
                        "contact": phone  //Provide the customer's phone number for better conversion rates 
                    },
                    "notes": {
                        "address": "Razorpay Corporate Office"
                    },
                    "theme": {
                        "color": "#3399cc"
                    }
                    };
                
                    var rzp1 = new Razorpay(options);
                    rzp1.on('payment.failed', function (response){
                        //alert(response.error.code);
                        alert(response.error.description);
                        //alert(response.error.source);
                        //alert(response.error.step);
                        //alert(response.error.reason);
                        //alert(response.error.metadata.order_id);
                        //alert(response.error.metadata.payment_id);
                    });
                    rzp1.open();
                } else {
                    toastr.error('error encountered ' + result.msgText);
                }
            },
        });
            
    }
</script>
@endpush
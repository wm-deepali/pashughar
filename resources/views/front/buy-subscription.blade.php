@extends('front.layouts.master')

@section('title')
Buy Subscription
@endsection

@section('metatags')
{!! getCommomPageMetaTag('purchase-subscription'); !!}
@endsection

@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/my-ads.css')}}">
<style>
.margin-btm {
    margin-bottom: 25px;
}
.margin-top {
    margin-top: 40px;
}
#overlay { 
   background-color: #868686;
   opacity: 0.9;
   width: 100%;
   height: 100%;
   position: absolute;
   top: 0;
   left: 0;
   z-index: 1;
}

#text{
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 50px;
  color: white;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
}
</style>
@endpush
@section('content')
<section class="inner-section category-part">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 margin-btm mt-3">
                <h2 class="mt-3">Buy New Subscription</h2>
                <h5 style="font-size:18px;">All active or live ads will expire on Subscription Expiry Date</h5>
            </div>
            
        @if(isset($subscriptions) && count($subscriptions)>0)
        @foreach($subscriptions as $subscription)
        @php
        $freeCard = $subscription->offer_price == 0 ? 'freeCard' : '';
        @endphp
        <div class="col-md-6 col-lg-4" style="margin-top: 20px;">
            
                <div class="price-card {{$freeCard}}">
                    <div class="price-head">
                         <h4>{{$subscription->name}}</h4>
                        <i class="{{$subscription->icon}}"></i>
                        @if($subscription->discount > 0 && $subscription->offer_price > 0)
                        <h3><span style="font-size:20px">₹&nbsp;</span>{{$subscription->offer_price}} <strike class="strike">{{$subscription->mrp}}</strike> <span class="discount">{{$subscription->discount}}%</span></h3>
                        @else
                        <h3><span style="font-size:20px">₹&nbsp;</span>{{$subscription->offer_price}}</h3>
                        @endif
                         <div class="price-btn">
                    @if(Auth::guard('member')->user() !='' && !empty(Auth::guard('member')->user()))
                        @if($subscription->offer_price == 0)
                            @if(Auth::guard('member')->user()->is_buy_free_subscription == 0)
                                @if(Auth::guard('member')->user()->state != '')
                                <button class='btn btn-inline pay_now' name="pay_now" id="pay_now" subscription_id="{{$subscription->id}}"><i class="fas fa-sign-in-alt"></i><span>Free Subscription</span></button>
                                @else
                                    <a class='btn btn-inline'  href="{{route('user.settings')}}"><i class="fas fa-sign-in-alt"></i><span>Free Subscription</span></a>
                                @endif
                            @else
                            <a href="javascript:void(0);" class='btn btn-inline' onclick="return confirm('Your buy free subscription limit end');"><i class="fas fa-sign-in-alt"></i><span>Free Subscription</span></a>
                            @endif

                        @else
                            @if(Auth::guard('member')->user()->no_of_ads == 0 || Auth::guard('member')->user()->expiry_date < date('Y-m-d'))
                            <a class='btn btn-inline' href="{{route('user.checkout', Crypt::encrypt($subscription->id))}}">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Buy Now</span>
                            </a>
                            
                            @else
                            
                            <a href="javascript:void(0);" class='btn btn-inline' onclick="return confirm('Ads are already available to publish in your active subscription. Please use all the ads in the bucket first.');"><i class="fas fa-sign-in-alt"></i><span>Buy Subscription</span></a>
                            @endif
                        @endif
                    @else
                    <a class='btn btn-inline'  href="{{route('user.login')}}"><i class="fas fa-sign-in-alt"></i><span>Buy Subscription</span></a>
                    @endif
                    
                    </div>
                       
                    </div>
                    <ul class="price-list" style="padding-left:0px;">
                         <li>
                            <i class="fas fa-check"></i>
                            <p>{{$subscription->no_of_ads}} &nbsp; Ads Post  </p>
                            
                        </li>
                        @if(isset($subscription->features) && count($subscription->features) > 0)
                        @foreach($subscription->features as $feature)
                        <li>
                            <i class="{{$feature->is_available == 1 ? 'fas fa-check' : 'fas fa-times'}}"></i>
                            <p>{{$feature->feature}}</p>
                        </li>
                        @endforeach
                        @endif
                         <li>
                            <i class="fas fa-check"></i> <p>{{$subscription->subscription_validity}} &nbsp;Days Validity
                            </p>
                            
                        </li>
                    </ul>
                   
                </div>
            </div>
        @endforeach
        @endif
        </div>
        
    </div>
</section>
@endsection
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@push('after-script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.css" >
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.js"></script>

<script>
var overlay = $('<div id="overlay"><div id="text">Already Used</div></div>');
$('.freeCard').append(overlay);
    $(".pay_now").on("click",function(){
        Swal.fire({
            title: 'Are you sure?',
            
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Subcribe Free'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).attr('subscription_id');
            
                    $.ajax({
        		url:'{{url("free-subscription")}}',
        		method:'POST',
        		data:{id:id,'_token':"{{csrf_token()}}"},
        		success:function(data){
                    console.log(data);
                    if (data.success) 
                    {
                        Swal.fire(
                            "Package Purchased Successfully."
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 100);
                    }else{
                         Swal.fire(
                            data.msgText
                        );
                    }
        		}
        	});
                }
            })
        
    });
</script>
@endpush
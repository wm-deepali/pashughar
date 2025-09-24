@extends('front.layouts.app')

@section('title')
Buy New Subscription
@endsection

@section('metatags')
{!! getCommomPageMetaTag('subscription-plan') !!}
@endsection

@section('page_name') Buy New Subscription @endsection

@section('page_url') pricing plan @endsection

@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/price.css')}}">
@endpush

@section('content')
@include('front.layouts.includes.single-banner-price')

<!--=====================================
            Price PART START
=======================================-->
<section class="price-part">
    <div class="container">
        <div class=" subs-price">
        
            @if(isset($subscriptions) && count($subscriptions)>0)
            @foreach($subscriptions as $subscription)
            <div class="col-md-6 col-lg-3 price-card-list" style="margin-top: 20px;">
                <div class="price-card">
                    <div class="price-head">
                                                <h4>{{$subscription->name}}</h4>
                        <i class="{{$subscription->icon}}"></i>
                        @if($subscription->discount > 0 && $subscription->offer_price > 0)
                        <h3><span style="font-size:20px">₹</span> {{$subscription->offer_price}} <strike class="strike">{{$subscription->mrp}}</strike> <span class="discount">{{$subscription->discount}}%</span></h3>
                        @else
                        <h3><span style="font-size:20px">₹</span> {{$subscription->offer_price}}</h3>
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
                                   
                                   <i class="fas fa-sign-in-alt"></i> <span>Buy Now</span>
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
                    <ul class="price-list">
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
                            <i class="fas fa-check"></i><p> {{$subscription->subscription_validity}} &nbsp;Days Validity </p>
                            
                        </li>
                    </ul>
                   
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Choose the right Plan for Livestock & Product Ads</h2>
                    <p>List your Livestock & Dairy Products by selecting one of our tailored pricing plans. Whether you're a retail seller or a Bulk Supplier, we have the right package to maximize your reach and visibility.</p>
                    <a class='btn btn-outline' href="{{route('user.post-your-ad')}}">
                        <i class="fas fa-plus-circle"></i>
                        <span>post your ad</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================
                PRICE PART END
=======================================-->
@endsection
@push('after-script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.css" >
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.js"></script>
<script>
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
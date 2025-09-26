@extends('front.layouts.app')

@section('title')
Welcome to Afar Logistic & Trade Marketing | Afar Region | Ethiopia
@endsection

@section('metatags')
{!! getCommomPageMetaTag('/') !!}
@endsection

@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/index.css')}}">
@endpush

@section('content')

@include('front.layouts.includes.banner')
@include('front.layouts.includes.suggestion')

<!--=====================================
            FEATURE PART START
=======================================-->
<!--<section class="section feature-part">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-md-5 col-lg-5">-->
<!--                <div class="section-side-heading">-->
<!--                    <h2>Find your needs in our best <span>Featured Ads</span></h2>-->
<!--                    <p>Explore our top-rated featured ads to find exactly what you need. From the latest gadgets to essential services, we offer a curated selection of trusted sellers and great deals. Whether you're shopping or booking services, our featured ads ensure quality and convenience for a smooth experience every time.</p>-->
<!--                    <div class="price-btn mobile-view-btn">-->
<!--                    <a class='btn btn-inline' href="{{route('list-all-ads', array('type' => 'featured'))}}">-->
<!--                        <i class="fas fa-eye"></i>-->
<!--                        <span>View All Featured Ads</span>-->
<!--                    </a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-7 col-lg-7">-->
<!--                <div class="feature-card-slider slider-arrow">-->
<!--                    @if(count($featureAds) > 0)-->
<!--                    @foreach ($featureAds as $fad) -->
<!--                    <div class="feature-card" onclick="window.location.href='{{route('ad-details', [base64_encode($fad->id), $fad->slug])}}'">-->
<!--                        <a href="{{route('ad-details', [base64_encode($fad->id), $fad->slug])}}" class="feature-img">-->
<!--                            @if(isset($fad->adImage) && count($fad->adImage)>0)-->
<!--                               <img src="{{ asset('storage').'/'.$fad->adImage[0]->image}}" alt="product">-->
<!--                            @else-->
<!--                                <img src="{{asset('front/images/no-image.jpeg')}}" alt="product">-->
<!--                            @endif-->
<!--                        </a>-->
<!--                        <div class="cross-inline-badge feature-badge">-->
<!--                            <span>featured</span>-->
<!--                            <i class="fas fa-book-open"></i>-->
<!--                        </div>-->
                        
<!--                        <div class="feature-content">-->
<!--                            <ol class="breadcrumb feature-category mt-1">-->
<!--                              @if(isset($fad->category))  <li class="breadcrumb-item"><a href="#">{{$fad->category->name ?? ''}}</a></li>  @endif-->
<!--                                <li class="breadcrumb-item active" aria-current="page" style="color:#fff;">{{$fad->title ?? ''}}</li>-->
<!--                            </ol>-->
<!--                            <h3 class="feature-title"><a href="{{route('ad-details', [base64_encode($fad->id), $fad->slug])}}">{{Str::of($fad->description)->words(10, ' ...')}}</a></h3>-->
<!--                            <div class="feature-meta">-->
<!--                                <span class="feature-price">₹ {{$fad->price}}</span>-->
<!--                                <div class="d-flex justify-content-between">-->
<!--                                <span class="feature-time"><i class="fas fa-clock"></i>{{$fad->created_at->diffForHumans()}}</span>&nbsp;&nbsp;-->
<!--                                <span class="feature-time text-right"><i class="fas fa-eye"></i>{{$fad->views ?? '0'}}</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    @endforeach-->
<!--                    @endif-->
<!--                </div>-->
                
<!--                <div class="feature-thumb-slider">-->
<!--                @if(count($featureAds) > 0)-->
<!--                @foreach ($featureAds as $fad)-->
<!--                    @if(isset($fad->adImage) && count($fad->adImage)>0)-->
<!--                    <div class="feature-thumb"><img src="{{asset('storage').'/'.$fad->adImage[0]->image}}" alt="product"></div>-->
<!--                    @else-->
<!--                    <div class="feature-thumb"><img src="{{asset('front/images/no-image.jpeg')}}" alt="product"></div>-->
<!--                    @endif-->
<!--                @endforeach-->
<!--                @endif-->
<!--                 </div>-->
<!--                                    <div class="price-btn desktop-view-btn mt-3">-->
<!--                    <a class='btn btn-inline' href="{{route('list-all-ads', array('type' => 'featured'))}}">-->
<!--                        <i class="fas fa-eye"></i>-->
<!--                        <span>View All Featured Ads</span>-->
<!--                    </a>-->
<!--                    </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
<!--=====================================
            FEATURE PART END
=======================================-->


<!--=====================================
            RECOMEND PART START
=======================================-->
 <section class="section recomend-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2>Our Recommend <span>Ads</span></h2>
                        <p>Discover top picks with our recommended ads, offering trusted products and services tailored to meet your unique needs.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="recomend-slider slider-arrow">
                    @if(count($recommendAds) > 0)
                    @foreach ($recommendAds as $rad) 
                        <div class="product-card" onclick="window.location.href='{{route('ad-details', [$rad->category->name,$rad->slug])}}'">
                            <div class="product-media">
                                <div class="product-img">
                                    @if(isset($rad->adImage) && count($rad->adImage)>0)
                                    <img src="{{ asset('storage').'/'.$rad->adImage[0]->image}}" alt="product">
                                    @else
                                    <img src="{{asset('front/images/no-image.jpeg')}}" alt="product">
                                    @endif
                                </div>
                                <div class="cross-vertical-badge product-badge">
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>recommend</span>
                                </div>
                                <div class="product-type">
                                  
                                </div>
                                
                            </div>
                            <div class="product-content">
                                <ol class="breadcrumb product-category mt-1">
                                   @if(isset($rad->category)) <li class="breadcrumb-item"><a href="#">{{$rad->category->name ?? ''}}</a></li> @endif
                                    <li class="breadcrumb-item active" aria-current="page">{{$rad->title ?? ''}}</li>
                                </ol>
                                <h5 class="product-title">
                                    <a href="{{route('ad-details', [$rad->category->name,$rad->slug])}}">{{Str::of($rad->description)->words(4, ' ...')}}</a>
                                </h5>
                                <div class="product-meta">
                                    <span><i class="fas fa-map-marker-alt"></i>{{$rad->author_address ?? ''}}</span>
                                    
                                </div>
                                 <div class="product-meta">
                                    
                                    <span><i class="fas fa-clock"></i>{{$rad->created_at->diffForHumans()}}</span>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-price">₹ {{$rad->price}}</h5>
                                    <div class="product-btn">
                                    <span><i class="fas fa-eye"></i> {{$rad->views}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                        @endif    
                        
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-50">
                                            <div class="price-btn">
                    <a class='btn btn-inline' href="{{route('list-all-ads', array('type' => 'recommend'))}}">
                            <i class="fas fa-eye"></i>
                            <span>View All Recommended Ads</span>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--=====================================
            TREND PART START
=======================================-->
<section class="section trend-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Popular Trending <span>Ads</span></h2>
                    <p>Explore the most popular and trending ads, featuring top products and services that everyone is talking about right now.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
        @if(count($trendingAds) > 0)
        @foreach ($trendingAds as $tad) 
            <div class="col-md-11 col-lg-8 col-xl-6">
                <div class="product-card standard" onclick="window.location.href='{{route('ad-details', [$tad->category->name,$tad->slug])}}'">
                    <div class="product-media">
                        <div class="product-img">
                            @if(isset($tad->adImage) && count($tad->adImage)>0)
                               <img src="{{ asset('storage').'/'.$tad->adImage[0]->image}}" alt="product">
                            @else
                                <img src="{{ asset('front/images/no-image.jpeg')}}" alt="product">
                            @endif
                        </div>
                        <div class="cross-vertical-badge product-badge">
                            <i class="fas fa-bolt"></i>
                            <span>trending</span>
                        </div>
                        
                        
                    </div>
                    <div class="product-content">
                        <ol class="breadcrumb product-category mt-1">
                          @if(isset($tad->category))    <li class="breadcrumb-item"><a href="#">{{$tad->category->name ?? '0'}}</a></li> @endif
                            <li class="breadcrumb-item active" aria-current="page">{{$tad->title ?? ' '}}</li>
                        </ol>
                        <h5 class="product-title">
                        <a href="{{route('ad-details', [$tad->category->name,$tad->slug])}}">{{Str::of($tad->description)->words(6, ' ...')}}</a>
                        </h5>
                        <div class="product-meta">
                        <span><i class="fas fa-map-marker-alt"></i>{{$tad->author_address ?? ''}}</span>
                        <span><i class="fas fa-clock"></i>{{$tad->created_at->diffForHumans()}}</span>
                        </div>
                        <div class="product-info">
                            <h5 class="product-price">₹ {{$tad->price ?? '0'}}</h5>
                            <div class="product-btn">
                            <span><i class="fas fa-eye"></i> {{$tad->views}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
                    @endif
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="center-20">
                                        <div class="price-btn">
                    <a class='btn btn-inline' href="{{route('list-all-ads', array('type' => 'trending'))}}">
                        <i class="fas fa-eye"></i>
                        <span>View All Trending Ads</span>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================
            TREND PART END
=======================================-->
        
    <section class="section recomend-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2>Recently Viewed <span>Ads</span></h2>
                        <p>Discover top picks with our recommended ads, offering trusted products and services tailored to meet your unique needs.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="recomend-slider slider-arrow">
                    @if(count($recommendAds) > 0)
                    @foreach ($recommendAds as $rad) 
                        <div class="product-card" onclick="window.location.href='{{route('ad-details', [$rad->category->name,$rad->slug])}}'">
                            <div class="product-media">
                                <div class="product-img">
                                    @if(isset($rad->adImage) && count($rad->adImage)>0)
                                    <img src="{{ asset('storage').'/'.$rad->adImage[0]->image}}" alt="product">
                                    @else
                                    <img src="{{asset('front/images/no-image.jpeg')}}" alt="product">
                                    @endif
                                </div>
                                <div class="cross-vertical-badge product-badge">
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>recommend</span>
                                </div>
                                <div class="product-type">
                                  
                                </div>
                                
                            </div>
                            <div class="product-content">
                                <ol class="breadcrumb product-category mt-1">
                                   @if(isset($rad->category)) <li class="breadcrumb-item"><a href="#">{{$rad->category->name ?? ''}}</a></li> @endif
                                    <li class="breadcrumb-item active" aria-current="page">{{$rad->title ?? ''}}</li>
                                </ol>
                                <h5 class="product-title">
                                    <a href="{{route('ad-details', [$rad->category->name,$rad->slug])}}">{{Str::of($rad->description)->words(4, ' ...')}}</a>
                                </h5>
                                <div class="product-meta">
                                    <span><i class="fas fa-map-marker-alt"></i>{{$rad->author_address ?? ''}}</span>
                                    
                                </div>
                                 <div class="product-meta">
                                    
                                    <span><i class="fas fa-clock"></i>{{$rad->created_at->diffForHumans()}}</span>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-price">₹ {{$rad->price}}</h5>
                                    <div class="product-btn">
                                    <span><i class="fas fa-eye"></i> {{$rad->views}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                        @endif    
                        
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-50">
                                            <div class="price-btn">
                    <a class='btn btn-inline' href="{{route('list-all-ads', array('type' => 'recommend'))}}">
                            <i class="fas fa-eye"></i>
                            <span>View All Recommended Ads</span>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!--=====================================
            RECOMEND PART START
=======================================-->








<!--=====================================
            CATEGORY PART START
=======================================-->
<section class="section category-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Top Categories by <span>Ads</span></h2>
                    <p>
                        Browse our top categories, featuring the most popular ads across various sections. Find the best deals and services tailored to your needs.</p>
                </div>
            </div>
        </div>
        <div class="row desktop-category">
            @if(isset($pageCategories) && count($pageCategories)>0)
            @foreach($pageCategories as $pcategory)

            @php  //dd($pcategory); 
             @endphp
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="category-card">
                    <div class="category-head">
                       
                        @if($pcategory->bottom_categories=='yes')
                        <img src="{{asset('storage')}}/{{$pcategory->bottom_image}}" alt="car">
                        
                            @else
                       
                        <img src="{{asset('storage')}}/{{$pcategory->image}}" alt="car">
                        @endif
                       
                        <a href="{{route('category-details', $pcategory->slug)}}" class="category-content">
                            <h4>{{$pcategory->name}}</h4>
                            <p>({{isset($pcategory->ads) && $pcategory->ads !='' ? $pcategory->ads->where('status', 'Published')->count() : 0}})</p>
                        </a>
                    </div>
                    <ul class="category-list">
                        @if(isset($pcategory->subcategory) && count($pcategory->subcategory)>0)
                        @foreach($pcategory->subcategory as $subcat)
                        @php
                        $slugName = strtolower(str_replace('_', '-', str_replace(' ', '-', $subcat->name)));
                        @endphp
                        <li><a href="{{route('sub-details', ['subcategoryname'=>$slugName, 'id'=>base64_encode($subcat->id)])}}"><h6>{{$subcat->name}}</h6><p>({{isset($subcat->ads) && $subcat->ads !='' ? $subcat->ads->where('status', 'Published')->count() : 0}})</p></a></li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            @endforeach
            @endif
            
        </div>
          <div class=" mobile-category">
            @if(isset($pageCategories) && count($pageCategories)>0)
            @foreach($pageCategories as $pcategory)

            @php  //dd($pcategory); 
             @endphp
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="category-card">
                    <div class="category-head">
                       
                        @if($pcategory->bottom_categories=='yes')
                        <img src="{{asset('storage')}}/{{$pcategory->bottom_image}}" alt="car">
                        
                            @else
                       
                        <img src="{{asset('storage')}}/{{$pcategory->image}}" alt="car">
                        @endif
                       
                        <a href="{{route('category-details', $pcategory->slug)}}" class="category-content">
                            <h4>{{$pcategory->name}}</h4>
                            <p>({{isset($pcategory->ads) && $pcategory->ads !='' ? $pcategory->ads->where('status', 'Published')->count() : 0}})</p>
                        </a>
                    </div>
                    <ul class="category-list">
                        @if(isset($pcategory->subcategory) && count($pcategory->subcategory)>0)
                        @foreach($pcategory->subcategory as $subcat)
                        @php
                        $slugName = strtolower(str_replace('_', '-', str_replace(' ', '-', $subcat->name)));
                        @endphp
                        <li><a href="{{route('sub-details', ['subcategoryname'=>$slugName, 'id'=>base64_encode($subcat->id)])}}"><h6>{{$subcat->name}}</h6><p>({{isset($subcat->ads) && $subcat->ads !='' ? $subcat->ads->where('status', 'Published')->count() : 0}})</p></a></li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            @endforeach
            @endif
            
        </div>
        @if(count($pageCategories)>=8)
        <div class="row">
            <div class="col-lg-12">
                <div class="center-20">
                                        <div class="price-btn">
                    <a class='btn btn-inline' href="{{route('list-categories')}}">
                        <i class="fas fa-eye"></i>
                        <span>Post Your Ad</span>
                    </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!--<div class="row">-->
        <!--    <div class="col-lg-12">-->
        <!--        <div class="center-20">-->
        <!--            <a class='btn btn-inline' href="{{route('list-categories')}}">-->
        <!--                <i class="fas fa-eye"></i>-->
        <!--                <span>view all categories</span>-->
        <!--            </a>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->


    </div>
</section>
<!--=====================================
            CATEGORY PART END
=======================================-->


<!--=====================================
            INTRO PART START
=======================================-->
<section class="intro-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Do you have something to advertise?</h2>
                    <p>Have something to advertise? Reach a wider audience by promoting your products or services with us. Boost visibility, attract more customers, and grow your business with our effective advertising platform.</p>
                                        <div class="price-btn mb-3">
                    <a class='btn btn-outline' href="{{route('user.post-your-ad')}}">
                        <i class="fas fa-plus-circle"></i>
                        <span>Post Your Ad</span>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================
            INTRO PART END
=======================================-->


<!--=====================================
                PRICE PART START
=======================================-->
<section class="price-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Best Reliable Pricing Plans</h2>
                    <p>All active or live ads will expire on Subscription Expiry Date</p>
                </div>
            </div>
        </div>
        <div class=" desktop-category subs-price ">
          
                
            
        @if(isset($subscriptions) && count($subscriptions)>0)
            @foreach($subscriptions as $subscription)
            <div class="col-md-6 col-lg-3 mb-4 price-card-list">
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
                            <i class="fas fa-check"></i> 
                            <p>{{$subscription->subscription_validity}} &nbsp;Days Validity</p>
                            
                        </li>
                    </ul>
                    
                </div>
            </div>
            @endforeach
            @endif
            </div>
       
        <div class=" mobile-category">
        @if(isset($subscriptions) && count($subscriptions)>0)
            @foreach($subscriptions as $subscription)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="price-card">
                    <div class="price-head">
                        <i class="{{$subscription->icon}}"></i>
                        <h3>₹ {{$subscription->offer_price}}</h3>
                        <h4>{{$subscription->name}}</h4>
                    </div>
                    <ul class="price-list">
                         <li>
                            <i class="fas fa-plus"></i> {{$subscription->no_of_ads}} &nbsp; Ads Post  
                            
                        </li>
                        @if(isset($subscription->features) && count($subscription->features) > 0)
                        @foreach($subscription->features as $feature)
                        <li>
                            <i class="{{$feature->is_available == 1 ? 'fas fa-plus' : 'fas fa-times'}}"></i>
                            <p>{{$feature->feature}}</p>
                        </li>
                        @endforeach
                        @endif
                        
                          <li>
                            <i class="fas fa-plus"></i> {{$subscription->subscription_validity}} &nbsp;Days Validity
                            
                        </li>
                    </ul>
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
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>
<!--=====================================
                PRICE PART END
=======================================-->


<!--=====================================
                BLOG PART START
=======================================-->
<section class="blog-part">
    <!--div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Read Our <span>Recent Articles</span></h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit aspernatur illum vel sunt libero voluptatum repudiandae veniam maxime tenetur.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-slider slider-arrow">
                    <div class="blog-card">
                        <div class="blog-img">
                            <img src="{{url('front/images/blog/01.jpg')}}" alt="blog">
                            <div class="blog-overlay">
                                <span class="marketing">Marketing</span>
                            </div>
                        </div>
                        <div class="blog-content">
                            <a href="#" class="blog-avatar">
                                <img src="{{url('front/images/avatar/01.jpg')}}" alt="avatar">
                            </a>
                            <ul class="blog-meta">
                                <li>
                                    <i class="fas fa-user"></i>
                                    <p><a href="#">MironMahmud</a></p>
                                </li>
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <p>02 Feb 2021</p>
                                </li>
                            </ul>
                            <div class="blog-text">
                                <h4><a href='blog-details.html'>Lorem ipsum dolor sit amet eius minus elit cum quaerat volupt.</a></h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus veniam ad dolore labore laborum perspiciatis...</p>
                            </div>
                            <a class='blog-read' href='blog-details.html'>
                                <span>read more</span>
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="blog-card">
                        <div class="blog-img">
                            <img src="{{url('front/images/blog/02.jpg')}}" alt="blog">
                            <div class="blog-overlay">
                                <span class="advertise">advertise</span>
                            </div>
                        </div>
                        <div class="blog-content">
                            <a href="#" class="blog-avatar">
                                <img src="{{url('front/images/avatar/02.jpg')}}" alt="avatar">
                            </a>
                            <ul class="blog-meta">
                                <li>
                                    <i class="fas fa-user"></i>
                                    <p><a href="#">LabonnoKhan</a></p>
                                </li>
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <p>02 Feb 2021</p>
                                </li>
                            </ul>
                            <div class="blog-text">
                                <h4><a href='blog-details.html'>Lorem ipsum dolor sit amet eius minus elit cum quaerat volupt.</a></h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus veniam ad dolore labore laborum perspiciatis...</p>
                            </div>
                            <a class='blog-read' href='blog-details.html'>
                                <span>read more</span>
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="blog-card">
                        <div class="blog-img">
                            <img src="{{url('front/images/blog/03.jpg')}}" alt="blog">
                            <div class="blog-overlay">
                                <span class="safety">safety</span>
                            </div>
                        </div>
                        <div class="blog-content">
                            <a href="#" class="blog-avatar">
                                <img src="{{url('front/images/avatar/03.jpg')}}" alt="avatar">
                            </a>
                            <ul class="blog-meta">
                                <li>
                                    <i class="fas fa-user"></i>
                                    <p><a href="#">MironMahmud</a></p>
                                </li>
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <p>02 Feb 2021</p>
                                </li>
                            </ul>
                            <div class="blog-text">
                                <h4><a href='blog-details.html'>Lorem ipsum dolor sit amet eius minus elit cum quaerat volupt.</a></h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus veniam ad dolore labore laborum perspiciatis...</p>
                            </div>
                            <a class='blog-read' href='blog-details.html'>
                                <span>read more</span>
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="blog-card">
                        <div class="blog-img">
                            <img src="{{url('front/images/blog/04.jpg')}}" alt="blog">
                            <div class="blog-overlay">
                                <span class="security">security</span>
                            </div>
                        </div>
                        <div class="blog-content">
                            <a href="#" class="blog-avatar">
                                <img src="{{url('front/images/avatar/04.jpg')}}" alt="avatar">
                            </a>
                            <ul class="blog-meta">
                                <li>
                                    <i class="fas fa-user"></i>
                                    <p><a href="#">TahminaBonny</a></p>
                                </li>
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <p>02 Feb 2021</p>
                                </li>
                            </ul>
                            <div class="blog-text">
                                <h4><a href='blog-details.html'>Lorem ipsum dolor sit amet eius minus elit cum quaerat volupt.</a></h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus veniam ad dolore labore laborum perspiciatis...</p>
                            </div>
                            <a class='blog-read' href='blog-details.html'>
                                <span>read more</span>
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-btn">
                    <a class='btn btn-inline' href='blog-list.html'>
                        <i class="fas fa-eye"></i>
                        <span>view all blogs</span>
                    </a>
                </div>
            </div>
        </div>
    </div-->
</section>
<!--=====================================
                BLOG PART END
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
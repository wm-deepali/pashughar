@extends('front.layouts.app')

@section('title')
{{$ad->title}}
@endsection

@section('metatags')

{!! getDetailsPageMetaTag($ad->meta_title ?? 'Pashughar', $ad->meta_keyword, $ad->meta_description, Request::url()) !!}
@endsection

@section('page_name') {{$ad->title}} @endsection

@section('page_url') {{$ad->title}} @endsection

@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/ad-details.css')}}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>

  <script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_SITE_KEY') }}"></script>
@endpush

@section('content')
@include('front.layouts.includes.single-banner-price')
<style>
    .select2-results__options[aria-multiselectable="true"] li {
    padding-left: 30px;
    position: relative
}

.select2-results__options[aria-multiselectable="true"] li:before {
    position: absolute;
    left: 8px;
    opacity: .6;
    top: 6px;
    font-family: "FontAwesome";
    content: "\f0c8";
}

.select2-results__options[aria-multiselectable="true"] li[aria-selected="true"]:before {
    content: "\f14a";
}
.category-head img {
    width: 100%;
    height: 120px !important;
    object-fit: contain;
}
.slideimg img{
    width:565px;
    height:304px;
}
.slidethumbimg img{
    width:252px;
    height:180px;
}
.author-img img
{
    width: 80px;
    border: 1px solid #eee;
    border-radius: 50%;
}
</style>
 <style>
    .get-start {
        margin-top: 30px;
        font-size: 22px;
        font-weight: 600;
    }
    .continue-w {
        padding-top: 10px;
    }
    .form-login-reg.comment-form.modal-l {
        margin-top: 20px;
    }
    /* .inner-frm 
    {
        text-align: center;
    } */
    .form-login-reg.comment-form {
        padding: 20px;
        border: 1px solid #c6c3c3;
        border-radius: 8px;
    }
    .comment-form .form-group input[type="text"], .comment-form .form-group input[type="password"], .comment-form .form-group input[type="tel"], .comment-form .form-group input[type="email"], .comment-form .form-group input[type="date"], .comment-form .form-group input[type="file"], .comment-form .form-group select, .comment-form .form-group .ui-selectmenu-button.ui-button {
        position: relative;
        display: block;
        width: 100%;
        line-height: 28px;
        padding: 10px 25px;
        height: 60px;
        border-radius: 0px;
        -webkit-transition: all 300ms ease;
        -ms-transition: all 300ms ease;
        -o-transition: all 300ms ease;
        -moz-transition: all 300ms ease;
        transition: all 300ms ease;
        background-color: rgb(247, 247, 246);        ;
        border: 1px solid rgba(0,0,0, 0.06);
    }
    #hiddenInput {
        margin-bottom: 30px;
    }
    .otp-input {
        width: 50px;
        margin-right: 20px;
    }
    .cus-btn-osd {
        text-align: center;
        background: linear-gradient(136deg, #307cf5 2%, #3b8ee5 64%);
        color: #fff;
        border-radius: 3px;
        font-size: 16px;
        height: 50px;
        align-content: center;
    }
    a:visited {
        text-decoration: none;
        outline: none !important;
    }
    .card-title{
        font-size:14px !important;
    }
    .ad-details-title{
        margin-bottom:10px !important;
    }
    ul.select2-selection__rendered
    {
        padding-left: 5px !important;
    }
    </style>
 <!--=====================================
            AD DETAILS PART START
=======================================-->
<section class="inner-section ad-details-part">
    <div class="container">
    @include('front.layouts.includes.messages')
        <div class="row content-reverse mobile-view-details-card">
            <div class="col-lg-4">
                 <div class="ad-details-slider-group">
                        <div class="ad-details-slider slider-arrow">
                            @if(isset($ad->adImage) && count($ad->adImage)>0)
                            @foreach($ad->adImage as  $images)
                            <div class="slideimg"><img src="{{ asset('storage').'/'.$images->image}}" alt="details"></div>
                            @endforeach
                            @else
                            <div><img src="{{asset('front/images/no-image.jpeg')}}" alt="product"></div>
                            @endif
                            
                        </div>
                        
                    </div>

                <!-- PRICE CARD -->
                <div class="mobile-view-details-image">
                                    <div class="common-card">
                    
                    
                    <h3 class="ad-details-title">{{$ad->title}}</h3>
                   
                    <div class="ad-details-slider-group">
                        <div class="ad-details-slider slider-arrow">
                            @if(isset($ad->adImage) && count($ad->adImage)>0)
                            @foreach($ad->adImage as  $images)
                            <div class="slideimg"><img src="{{ asset('storage').'/'.$images->image}}" alt="details"></div>
                            @endforeach
                            @else
                            <div><img src="{{asset('front/images/no-image.jpeg')}}" alt="product"></div>
                            @endif
                            
                        </div>
                        
                    </div>
                    
                    <div class="ad-thumb-slider">
                            @if(isset($ad->adImage) && count($ad->adImage)>0)
                            @foreach($ad->adImage as  $images)
                            <div class="slidethumbimg"><img src="{{ asset('storage').'/'.$images->image}}" alt="details"></div>
                            @endforeach
                            @else
                            <div><img src="{{asset('front/images/no-image.jpeg')}}" alt="product"></div>
                            @endif
                    </div>
                    
                </div>
                </div>
                <!--<div class="common-card price">-->
                <!--    <h3 class="d-flex"><span style="font-size:20px;padding-top:8px">₹</span>&nbsp;{{$ad->price}}<span style="font-size:18px;padding-top:5px; padding-left:10px">({{$ad->price_type}})</span></h3>-->
                <!--    <i class="fas fa-tag"></i>-->
                <!--</div>-->
                <!--<strong><h5 class="mb-4 cname"> Category:</strong> {{($ad->category != '' && isset($ad->category->name)) ? $ad->category->name : ''}}{{($ad->subcategory != '' && isset($ad->subcategory->name)) ? '/'.$ad->subcategory->name : ''}}</h5>-->
                <!--<div class="common-card">-->
                <!--    <div class="card-header">-->
                <!--        <h5 class="card-title">Other Informations</h5>-->
                <!--    </div>-->
                <!--    <div class="ad-details-author">-->
                       
                <!--        <div class="author-meta mt-3 text-left mb-0">-->
                            
                <!--            @if(App\Http\Controllers\FrontController::getfeature($ad->id, 'brand') !='')-->
                <!--            <strong><h5><i class="fas fa-calendar"></i> Brand:</strong> {{ App\Http\Controllers\FrontController::getfeature($ad->id, 'brand') }}</h5>-->
                <!--            @endif-->
                            
                <!--            @if(App\Http\Controllers\FrontController::getfeature($ad->id, 'age_in_year') !='')-->
                <!--            <strong><h5><i class="fas fa-calendar"></i> Age:</strong> {{ App\Http\Controllers\FrontController::getfeature($ad->id, 'age_in_year') }}</h5>-->
                <!--            @endif-->
                            
                <!--            @if(App\Http\Controllers\FrontController::getfeature($ad->id, 'available_quantity') !='')-->
                <!--            <strong><h5><i class="fas fa-calendar"></i> Available Quantity:</strong>  {{ App\Http\Controllers\FrontController::getfeature($ad->id, 'available_quantity') }}</h5>-->
                <!--            @endif-->
                            
                <!--            @if(App\Http\Controllers\FrontController::getfeature($ad->id, 'weight') !='')-->
                <!--            <strong><h5><i class="fas fa-calendar"></i> Weight:</strong> {{ App\Http\Controllers\FrontController::getfeature($ad->id, 'weight') }}</h5>-->
                <!--            @endif-->
                            
                <!--            @if(App\Http\Controllers\FrontController::getfeature($ad->id, 'average_weight') !='')-->
                <!--            <strong><h5><i class="fas fa-calendar"></i> Average Weight:</strong> {{ App\Http\Controllers\FrontController::getfeature($ad->id, 'average_weight') }}</h5>-->
                <!--            @endif-->
                            
                           
                <!--            <strong><h5><i class="fas fa-calendar"></i> Location:</strong> {{$ad->location}}</h5>-->
                            
                <!--             @if(App\Http\Controllers\FrontController::getfeature($ad->id, 'minimum_order_quanitity') !='')-->
                <!--            <strong><h5><i class="fas fa-calendar"></i> Minimum Order Quantity:</strong> {{ App\Http\Controllers\FrontController::getfeature($ad->id, 'minimum_order_quanitity') }}</h5>-->
                <!--            @endif-->
                            
                            
                <!--             <div class="ad-details-meta mt-3 border-top border-bottom pt-3 pb-3 mb-2" style="display:flex;justify-content:space-between; ">-->
                <!--        <a class="view">-->
                <!--            <i class="fas fa-eye"></i>-->
                <!--            <span><strong>({{$ad->views}})</strong>preview</span>-->
                <!--        </a>-->
                        <!--<a class="click">-->
                        <!--    <i class="fas fa-mouse"></i>-->
                        <!--    <span><strong>({{$ad->total_enquiry}})</strong>Enquiry</span>-->
                        <!--</a>-->
                <!--        <a href="#review" class="rating">-->
                <!--            <i class="fas fa-star"></i>-->
                <!--            <span><strong>({{$ad->total_review}})</strong>review</span>-->
                <!--        </a>-->
                        
                <!--    </div>-->
                <!--                                <strong><h5 class="text-center m-0 mb-0">Published On: </strong> {{date('F d, Y',strtotime($ad->published_date))}}</h5>-->
                            
                <!--        </div>-->
                       
                <!--    </div>-->
                <!--</div>-->
                <!-- NUMBER CARD -->
                            <div class="price-btn mb-4">
                            <button type="button" data-toggle="modal" data-target="#number"  class="btn " style="height:70px;font-size:22px; font-weight:700;width:100%;text-align:center;">
                               
                                <span>Buy or Book Now <i class="fas fa-sign-in-alt"></i></span>
                            </button>
                            </div>
                <!-- <button type="button" class="common-card number" data-toggle="modal" data-target="#number">-->
                <!--    <h3>{{$ad->author_mobile}}<span>Click to show</span></h3>-->
                <!--    <i class="fas fa-phone"></i>-->
                <!--</button>-->
                <!-- <div class="common-card">-->
                <!--    <div class="card-header">-->
                <!--        <h5 class="card-title">Link Share</h5>-->
                <!--    </div>-->
                <!--    <div class="ad-details-author">-->
                        
                <!--         <ul class="footer-social1">-->
                <!--            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>-->
                <!--            <li><a href="#"><i class="fab fa-twitter"></i></a></li>-->
                <!--            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>-->
                <!--            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>-->
                <!--            <li><a href="#"><i class="fab fa-youtube"></i></a></li>-->
                <!--            <li><a href="https://www.instagram.com/avhclicks_official/profilecard/?igsh=MXR3OXZqcDI1c3JlMw%3D%3D"><i class="fab fa-instagram"></i></a></li>-->
                <!--        </ul>-->
                       
                <!--    </div>-->
                <!--</div>                -->
                               <!-- AUTHOR CARD -->
                <!--<div class="common-card">-->
                <!--    <div class="card-header">-->
                <!--        <h5 class="card-title">author info</h5>-->
                <!--    </div>-->
                <!--    <div class="ad-details-author">-->
                <!--        <a href="#" class="author-img active mt-2">-->
                <!--            @if($ad->user->profile_pic !='')-->
                <!--                @if (strpos($ad->user->profile_pic,'https') !== false) -->
                <!--                <img src="{{$ad->user->profile_pic}}">-->
                <!--                @else-->
                <!--                <img src="{{asset('storage').'/'.$ad->user->profile_pic}}">-->
                <!--                @endif-->
                <!--            @else-->
                <!--                <img src="{{asset('front/images/avatar/user.png')}}" alt="avatar">-->
                <!--            @endif-->
                        
                <!--        </a>-->
                <!--        <div class="author-meta">-->
                <!--            <h4> {{$ad->author_name}}</h4>-->
                <!--            <strong><h5><i class="fas fa-calendar"></i> Member Since:</strong> {{date('F d, Y', strtotime($ad->user->created_at))}}</h5>-->
                            <!--<strong><h5><i class="fas fa-envelope"></i> Email: </strong>{{$ad->author_email}}</h5>-->
                <!--            <strong><h5>Products / Logistics: </strong>{{$adCount}}</h5>-->
                <!--            <strong><h5><i class="fas fa-map"></i> Address: </strong>{{$ad->author_address}}</h5>-->
                <!--        </div>-->
                       
                <!--    </div>-->
                <!--</div>-->

                <!--@if((Auth::guard('member')->user() =='') || Auth::guard('member')->user()->id !=  $ad->user_id)-->
                <!-- AUTHOR CARD -->
                <!--<div class="common-card">-->
                <!--    <div class="card-header">-->
                <!--        <h5 class="card-title">Ad Enquiry</h5>-->
                <!--    </div>-->
                <!--    <div class="ad-details-author">-->
                <!--    <form class="review-form" action="{{ route('save-ad-enquiry') }}" method="post" enctype="multipart/form-data">-->
                <!--        @csrf-->
                        
                            
                <!--            <div class="form-group">-->
                <!--            <input type="hidden" class="form-control" name="en_ad_id" value="{{$ad->id}}" required>-->
                <!--                <input type="text" class="form-control" name="e_name" placeholder="Name" required>-->
                <!--            </div>-->
                <!--            <div class="form-group">-->
                <!--                <input type="email" class="form-control" name="e_email" placeholder="Email" required>-->
                <!--            </div>-->
                                
                            
                <!--            <div class="form-group">-->
                <!--                <textarea class="form-control" name="message" placeholder="Describe" required></textarea>-->
                <!--            </div>-->
                <!--            <button type="submit" class="btn btn-inline review-submit">-->
                <!--                <i class="fas fa-tint"></i>-->
                <!--                <span>post your enquiry</span>-->
                <!--            </button>-->
                <!--        </form>-->
                       
                <!--    </div>-->
                <!--</div>-->
                <!--@endif-->
                @if((Auth::guard('member')->user() =='') || Auth::guard('member')->user()->id !=  $ad->user_id)
                <!-- AUTHOR CARD -->
                <div class="common-card">
                    <div class="card-header">
                        <h5 class="card-title">Ad Enquiry</h5>
                    </div>
                    <div class="ad-details-author">
                    <form class="review-form" action="{{ route('save-ad-enquiry') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                            
                            <div class="form-group">
                            <input type="hidden" class="form-control" name="en_ad_id" value="{{$ad->id}}" required>
                            
                             <input type="hidden" class="form-control" name="e_type" value="Direct Enquriy" required>
                            
                                <input type="text" class="form-control" name="e_name" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="e_email" placeholder="Email" required>
                            </div>
                                
                            
                            <div class="form-group">
                                 <input type="tel" onkeypress="return isNumber(event)" autocomplete="off" class="form-control" name="e_mobile_number" placeholder="Moblie number" minlength="10" maxlength="10" required>
                            </div>
                            <div class="form-group">
                                 <input type="text" class="form-control" name="e_telegram_id" placeholder="Telegram Id (if any)">
                            </div>
                            <div class="form-group">
                                 <select class="form-control  custom-select" name="e_country" required>
                                    <option value="India">India</option>
                                            
                                </select>
                            </div>
                            <div class="form-group">
                                 <select class="form-control custom-select" name="e_state" id="e_state_id" required>
                                                <option value="">Select State</option>
                                            @foreach($states as $state)
                                            <option value="{{$state->id}}" >{{$state->name}}</option>
                                            @endforeach
                                </select>
                            </div>
                            <div class="form-group e_cityDiv">
                                
                                
                                           
                                            <select class="form-control custom-select" name="e_city" id="e_city">
                                                <option value="">City</option>  
                                            </select>
                                       
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" placeholder="Describe" required></textarea>
                            </div>
                              <div class="price-btn">
                            <button type="submit" class="btn btn-inline review-submit">
                                <i class="fas fa-tint"></i>
                                <span>post your enquiry</span>
                            </button>
                            </div>
                        </form>
                       
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-8">

                <!-- AD DETAILS CARD -->
                <div class="common-card mobile-view-details-image1">
                    
                    <div class="d-flex justify-content-between">
                         <h3 class="ad-details-title">{{$ad->title}}</h3>
                    
                    <h3 class="d-flex" style="color:green;"><span style="font-size:20px;padding-top:8px">₹</span>&nbsp;{{$ad->price}}<span style="font-size:18px;padding-top:5px; padding-left:10px">({{$ad->price_type}})</span></h3>
                    </div>
                   
                   <strong><p><i class="fas fa-map"></i> Address: </strong>{{$ad->author_address}}</p>
                   
                   <div class="d-flex gap-4">
                       <button class="btn " style="background:#48a571; color:#fff;"><i class="fa-solid fa-copy"></i> Copy Link</button>
                        <button class="btn btn-primery" style="background:blue; color:#fff;"><i class="fa-solid fa-share-nodes"></i> Share</button>
                   </div>
                    <!--<div class="ad-details-slider-group">-->
                    <!--    <div class="ad-details-slider slider-arrow">-->
                    <!--        @if(isset($ad->adImage) && count($ad->adImage)>0)-->
                    <!--        @foreach($ad->adImage as  $images)-->
                    <!--        <div class="slideimg"><img src="{{ asset('storage').'/'.$images->image}}" alt="details"></div>-->
                    <!--        @endforeach-->
                    <!--        @else-->
                    <!--        <div><img src="{{asset('front/images/no-image.jpeg')}}" alt="product"></div>-->
                    <!--        @endif-->
                            
                    <!--    </div>-->
                        
                    <!--</div>-->
                    
                    <!--<div class="ad-thumb-slider">-->
                    <!--        @if(isset($ad->adImage) && count($ad->adImage)>0)-->
                    <!--        @foreach($ad->adImage as  $images)-->
                    <!--        <div class="slidethumbimg"><img src="{{ asset('storage').'/'.$images->image}}" alt="details"></div>-->
                    <!--        @endforeach-->
                    <!--        @else-->
                    <!--        <div><img src="{{asset('front/images/no-image.jpeg')}}" alt="product"></div>-->
                    <!--        @endif-->
                    <!--</div>-->
                    <div class="col-12 d-flex gap-3 mt-4">
                     
                        <h5 class="col-3 card-title" style="color:green;">Specification</h5>
                    
                    <div class="col-9">
                                            <div class="ad-details-author">
                       
                        <div class="author-meta  text-left mb-0" style="    display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                            
                         @if(App\Http\Controllers\FrontController::getfeature($ad->id, 'brand') !='')
                         <div>
                            <strong><h5><i class="fas fa-calendar"></i> Brand:</strong> {{ App\Http\Controllers\FrontController::getfeature($ad->id, 'brand') }}</h5>
                            </div>
                            @endif
                            
                           
                            @if(App\Http\Controllers\FrontController::getfeature($ad->id, 'age_in_year') !='')
                             <div>
                            <strong><h5><i class="fas fa-calendar"></i> Age:</strong> {{ App\Http\Controllers\FrontController::getfeature($ad->id, 'age_in_year') }}</h5>
                            </div>
                            @endif
                            
                            
                            @if(App\Http\Controllers\FrontController::getfeature($ad->id, 'available_quantity') !='')
                            <div>
                            <strong><h5><i class="fas fa-calendar"></i> Available Quantity:</strong>  {{ App\Http\Controllers\FrontController::getfeature($ad->id, 'available_quantity') }}</h5>
                            </div>
                            @endif
                            
                           
                            @if(App\Http\Controllers\FrontController::getfeature($ad->id, 'weight') !='')
                             <div>
                            <strong><h5><i class="fas fa-calendar"></i> Weight:</strong> {{ App\Http\Controllers\FrontController::getfeature($ad->id, 'weight') }}</h5>
                            </div>
                            @endif
                            
                            
                            @if(App\Http\Controllers\FrontController::getfeature($ad->id, 'average_weight') !='')
                            <div>
                            <strong><h5><i class="fas fa-calendar"></i> Average Weight:</strong> {{ App\Http\Controllers\FrontController::getfeature($ad->id, 'average_weight') }}</h5>
                             </div>
                            @endif
                           
                           <div>
                            <strong><h5><i class="fas fa-calendar"></i> Location:</strong> {{$ad->location}}</h5>
                            </div>
                            
                             @if(App\Http\Controllers\FrontController::getfeature($ad->id, 'minimum_order_quanitity') !='')
                             <div>
                            <strong><h5><i class="fas fa-calendar"></i> Minimum Order Quantity:</strong> {{ App\Http\Controllers\FrontController::getfeature($ad->id, 'minimum_order_quanitity') }}</h5>
                             </div>
                            @endif
                           
                    </div>
                    </div>
                    </div>
                   
                    </div>
                    
                   
                    <div class="col-12 d-flex gap-3 mt-4">
                     
                        <h5 class="col-3 card-title" style="color:green;">description</h5>
                    
                    <p class="col-9 ad-details-desc">{{$ad->description}}</p>
                   
                    </div>
                     
                       @if(isset($ad->adSpecification) && count($ad->adSpecification) >0)
                    
                    <div class="col-12 d-flex gap-3 mt-4">
                     
                        <h5 class="col-3 card-title" style="color:green;">Features</h5>
                    <div class="specification">
                    @foreach($ad->adSpecification as $speciality )
                    
                    <p class=" ad-details-desc"><i class="fa fa-arrow-right"></i> &nbsp;{{$speciality->specification}}</p>
                    @endforeach
                    </div>
                   
                    </div>
                    @endif
                    
                      @if(App\Http\Controllers\FrontController::getfeature($ad->id, 'general_information') !='')
                    <div class="col-12 d-flex gap-3 mt-4">
                     
                        <h5 class="col-3 card-title" style="color:green;">General Information</h5>
                    
                    <p class="col-9 ad-details-desc">{{App\Http\Controllers\FrontController::getfeature($ad->id, 'general_information')}}</p>
                   
                    </div>
                       @endif
                       
                       
                          @if(App\Http\Controllers\FrontController::getfeature($ad->id, 'other_information') !='')
                    <div class="col-12 d-flex gap-3 mt-4">
                     
                        <h5 class="col-3 card-title" style="color:green;">Other Information</h5>
                    
                    <p class="col-9 ad-details-desc">{{App\Http\Controllers\FrontController::getfeature($ad->id, 'other_information')}}</p>
                   
                    </div>
                       @endif
                </div>
                <!-- DESCRIPTION CARD -->
                <!--<div class="common-card">-->
                <!--    <div class="card-header">-->
                <!--        <h5 class="card-title">description</h5>-->
                <!--    </div>-->
                <!--    <p class="ad-details-desc mt-4">{{$ad->description}}</p>-->
                <!--</div>-->
                
                <!-- General Info CARD -->
                <!--@if(App\Http\Controllers\FrontController::getfeature($ad->id, 'general_information') !='')-->
                <!--<div class="common-card">-->
                <!--    <div class="card-header">-->
                <!--        <h5 class="card-title">General Information</h5>-->
                <!--    </div>-->
                <!--    <p class="ad-details-desc mt-4">{{App\Http\Controllers\FrontController::getfeature($ad->id, 'general_information')}}</p>-->
                <!--</div>-->
                <!--@endif-->
                
                <!-- Other Info CARD -->
                <!--@if(App\Http\Controllers\FrontController::getfeature($ad->id, 'other_information') !='')-->
                <!--<div class="common-card">-->
                <!--    <div class="card-header">-->
                <!--        <h5 class="card-title">Other Information</h5>-->
                <!--    </div>-->
                <!--    <p class="ad-details-desc mt-4">{{App\Http\Controllers\FrontController::getfeature($ad->id, 'other_information')}}</p>-->
                <!--</div>-->
                <!--@endif-->
                
                <!--@if(isset($ad->adSpecification) && count($ad->adSpecification) >0)-->
                <!--<div class="common-card">-->
                <!--    <div class="card-header">-->
                <!--        <h5 class="card-title">Specification</h5>-->
                <!--    </div>-->
                <!--    @foreach($ad->adSpecification as $speciality )-->
                <!--    <p class="ad-details-desc mt-4"><i class="fa fa-arrow-right"></i> &nbsp;{{$speciality->specification}}</p>-->
                <!--    @endforeach-->
                <!--</div>-->
                <!-- @endif-->
                        




                <!-- REVIEWS CARD -->
                <div class="common-card" id="review">
                    <div class="card-header">
                        <h5 class="card-title">reviews ({{$ad->total_review}})</h5>
                    </div>
                    <div class="ad-details-review">
                        <ul class="review-list">
                        @if(isset($ad->reviews) && count($ad->reviews) >0)
                        @foreach($ad->reviews as $review)
                            <li class="review-item">
                                <div class="review-user">
                                    <div class="review-head">
                                        <div class="review-profile">
                                            <a href="#" class="review-avatar">
                                                <img src="{{asset('front/images/avatar/review.jpg')}}" alt="review">
                                            </a>
                                            <div class="review-meta">
                                                <h6>
                                                    <a href="#">{{$review->name}} -</a> 
                                                    <span>{{date('F d, Y', strtotime($review->created_at))}}</span>
                                                </h6>
                                                <ul>
                                                    @php 
                                                    $rating = $review->rating;
                                                    $nonrating = 5-$rating;
                                                    @endphp
                                                    @for($i=1;$i<=$rating;$i++)
                                                    <li><i class="fas fa-star active"></i></li>
                                                    @endfor
                                                    @for($j=1;$j<=$nonrating;$j++)
                                                    <li><i class="fas fa-star"></i></li>
                                                    @endfor
                                                   
                                                    <li><h5>- for {{$review->quote}}</h5></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="review-desc">{{$review->review}}</p>
                                </div>
                            </li>
                            @endforeach
                        @endif
                        </ul>
                        <form class="ad-review-form" action="{{ route('save-ad-review') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                            <div class="star-rating">
                                <input type="radio" class="ratingstar" name="rating" value="5" id="star-1"><label data-id="1" class="rating" for="star-1"></label>
                                <input type="radio" class="ratingstar" name="rating" value="4" id="star-2"><label data-id="2" class="rating" for="star-2"></label>
                                <input type="radio" class="ratingstar" name="rating" value="3" id="star-3"><label data-id="3" class="rating" for="star-3"></label>
                                <input type="radio" class="ratingstar" name="rating" value="2" id="star-4"><label data-id="4" class="rating" for="star-4"></label>
                                <input type="radio" class="ratingstar" name="rating" value="1" id="star-5"><label data-id="5" class="rating" for="star-5"></label>
                                <input type="hidden" class="form-control" name="ratings" id="ratings" value="1" required>
                            </div>
                                       <div class="review-form-grid">
                                <div class="form-group">
                                <input type="hidden" class="form-control" name="ad_id" value="{{$ad->id}}" required>
                                    <input type="text" class="form-control" name="re_name" placeholder="Name" value="{{ $tempReview->name ?? old('re_name') }}" required>
                                    @if ($errors->has('re_name'))

                                            <span class="text-danger">{{ $errors->first('re_name') }}</span>

                                        @endif
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="re_email" value="{{ $tempReview->email ?? old('re_email') }}" placeholder="Email" required>
                                    @if ($errors->has('re_email'))

                                            <span class="text-danger">{{ $errors->first('re_email') }}</span>

                                        @endif
                                </div>
                                <div class="form-group">
                                    <input type="tel" onkeypress="return isNumber(event)" autocomplete="off" class="form-control" name="re_mobile"  minlength="10" maxlength="10" placeholder="Moblie number"  value="{{$tempReview->mobile ?? old('re_mobile') }}" required>
                                    @if ($errors->has('re_mobile'))

                                            <span class="text-danger">{{ $errors->first('re_mobile') }}</span>

                                        @endif
                                </div>
                                </div>
                                <div class="form-group">
                                    @php
                                    $recommended_quotes = ["Livestock Health","Logistic & Delivery",
                       "Purchasing Experience",
                       "Booking Experience","Payments & Transactions","Company Support"];
                       
                                    @endphp
                                    <select class="form-control custom-select select2" name="quote[]" id="quote" multiple="multiple" required>
                                        
                                        @foreach ($recommended_quotes as $key => $quote)
                                            <option value="{{ $quote}}" {{(isset($tempReview->quote) && $tempReview->quote !="" && collect(explode(",",$tempReview->quote))->contains($quote)) ? 'selected':'' }}>{{ $quote }}</option>
                                        @endforeach
                                        
                                    </select>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="review" placeholder="Review" required>{{ $tempReview->review ?? old('review') }}</textarea>
                                @if ($errors->has('review'))

                                            <span class="text-danger">{{ $errors->first('review') }}</span>

                                        @endif
                                        
                                        @if ($errors->has('g-recaptcha-response'))

                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>

                                        @endif
                            </div>
                            <div class="price-btn">
                            <button type="submit" class="btn btn-inline ad-review-submit">
                                <i class="fas fa-tint"></i>
                                <span>Submit Your Feedback</span>
                            </button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!--=====================================
            AD DETAILS PART END
=======================================-->



 <!--=====================================
                  NUMBER MODAL PART START
        =======================================-->
        <div class="modal fade" id="number">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="font-weight:600;">Purchase Enquiry</h4>
                        <button class="fas fa-times" data-dismiss="modal"></button>
                    </div>
                    <div class="modal-body"> 
                        <form id="purcahseForm" method="post">
                            @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="ad_id"value="{{$ad->id}}" required>
                                    <input type="text" class="form-control require" name="name" placeholder="Full Name"  required>
                                    <input type="hidden" class="form-control" name="type" value="Book Now" required>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control require" autocomplete="off" name="email" id="email_id_register" placeholder="Email"  required>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="tel" onkeypress="return isNumber(event)" autocomplete="off" class="form-control require" name="mobile_number"  minlength="10" maxlength="10" placeholder="Moblie number" id="phone_number" required>

                                
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="telegram_id" placeholder="Telegram Id (if any)" >
                                   
                                   
                                </div>
                            </div>
                            <div class="col-lg-12">
                                        <div class="form-group">
                                           
                                            <select class="form-control custom-select require" name="country" required>
                                                <option>Select Country</option>
                                                <option value="India">India</option>
                                            
                                            </select>
                                        </div>
                                    </div>



                            
                            <div class="col-lg-12">
                                        <div class="form-group">
                                           
                                            <select class="form-control require custom-select" name="state" id="state_id" required>
                                                <option value="">Select State</option>
                                            @foreach($states as $state)
                                            <option value="{{$state->id}}" >{{$state->name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                   
                                    <div class="col-12 cityDiv" >
                                <div class="form-group">
                                           
                                            <select class="form-control custom-select" name="city" id="city">
                                                <option value="">City</option>  
                                            </select>
                                        </div>
                            </div>
                                     <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="detail"  placeholder="Detail (If Any)"  required>


                                </div>
                            </div>
                                   
                            <div class="col-12">
                                <div class="form-group price-btn">
                                    <button type="submit" class="btn btn-inline"style="width:100%;" id="savepurchaseEq">

                                        <span>Submit Enquiry</span>
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!--=====================================
                  NUMBER MODAL PART END
        =======================================-->
@endsection
@push('after-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script>
function isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            }
    $(document).on("change", "#state_id", function() {
        $(".cityDiv").show();
        $("#city").html("");
       let state_id = $(this).val();  
       $.ajax({
           url: `{{ URL::to('cities-by-state') }}`,
           type: "post",
           dataType: "json",
           data:{"state_id":state_id, "_token": "{{ csrf_token() }}",},
           success: function(result) {
               if(result !="")
               {
                   $(".cityDiv").show();
                   $("#city").html(result);
               }
               else
               {
                   $(".cityDiv").hide();
               }
               
              
           }
       });
   });
   $(document).on("change", "#e_state_id", function() {
        $(".e_cityDiv").show();
        $("#e_city").html("");
       let state_id = $(this).val();  
       $.ajax({
           url: `{{ URL::to('cities-by-state') }}`,
           type: "post",
           dataType: "json",
           data:{"state_id":state_id, "_token": "{{ csrf_token() }}",},
           success: function(result) {
               if(result !="")
               {
                   $(".e_cityDiv").show();
                   $("#e_city").html(result);
               }
               else
               {
                   $(".e_cityDiv").hide();
               }
               
              
           }
       });
   });
 $('label.rating').click(function() {
    var $for=$(this).attr('for')
    //alert($(this).attr('data-id'));
    var rate = $('#'+$for).val();
    $('#ratings').val(rate);
    
});
$('#savepurchaseEq').click(function (e) {
        e.preventDefault();
        $empty = $('form#purcahseForm').find(".require").filter(function() {
        return this.value === "";
    });
    if($empty.length) {
        alert('All fields required!');
        return false;
    }else{
        Swal.fire({
            title: 'Are you sure?',
            
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Submit Enquiry'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#savepurchaseEq").text('Wait...');
                $.ajax({
        		url:'{{route("save-purchase-enquiry")}}',
        		method:'POST',
        		data: $("#purcahseForm").serialize(),
        		success:function(data){
                    console.log(data);
                    if (data.success) 
                    {
                        Swal.fire(
                            data.message
                        );
                        setTimeout(() => { 
                            location.reload();
                        }, 5000);
                        

                        $("#savepurchaseEq").text('Submit Enquiry');
                    }else{
                        $("#savepurchaseEq").text('Submit Enquiry');
                         Swal.fire(
                            data.errors
                            
                        );
                    }
        		}
        	});
                }
        })
    };
        
    
    });
     
</script>
<script>
document.querySelectorAll('.star-rating .rating').forEach(label => {
    label.addEventListener('click', function() {
        const value = this.getAttribute('data-id');
        document.getElementById('ratings').value = value;
    });
});

$('.select2[multiple]').select2({
    width: '100%',
    closeOnSelect: false,
    placeholder: 'Rate for'
})

</script>
<script type="text/javascript">

    $('.ad-review-form').submit(function(event) {

        event.preventDefault();

    

        grecaptcha.ready(function() {

            grecaptcha.execute("{{ env('RECAPTCHA_SITE_KEY') }}", {action: 'subscribe_newsletter'}).then(function(token) {

                $('.ad-review-form').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');

                $('.ad-review-form').unbind('submit').submit();

            });;

        });

    });

</script>
@endpush
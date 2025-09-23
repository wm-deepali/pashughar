@extends('front.layouts.app')

@section('title')
About Us
@endsection

@section('metatags')
{!! getCommomPageMetaTag('about-us'); !!}
@endsection

@php
$adCount = App\Models\Ad::where('delete_status', '0')->where('status', 'Published')->count();
$userCount = App\Models\Member::count();
@endphp
@section('page_name') About Us @endsection

@section('page_url') About Us @endsection

@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/about.css')}}">
@endpush

@section('content')
@include('front.layouts.includes.single-banner')

<!--=====================================
                    ABOUT PART START
        =======================================-->
<section class="about-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-content">
                    <h2>{{$about->heading}}</h2>
                    <p>{{$about->short_description}}</p>
                </div>
                <div class="about-quote">
                    {!! $about->detail_content !!}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row about-image">
                    <div class="col-6 col-lg-6">
                        <img src="{{asset('front/images/about/01.jpg')}}" alt="about">
                    </div>
                    <div class="col-6 col-lg-6">
                        <img src="{{asset('front/images/about/02.jpg')}}" alt="about">
                    </div>
                    <div class="col-6 col-lg-6">
                        <img src="{{asset('front/images/about/03.jpg')}}" alt="about">
                    </div>
                    <div class="col-6 col-lg-6">
                        <img src="{{asset('front/images/about/04.jpg')}}" alt="about">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!--=====================================
            COUNTER PART START
=======================================-->
<section class="counter-part">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <div class="counter-card">
                    <div class="counter-image">
                        <img src="{{asset('front/images/counter/user.png')}}" alt="user">
                    </div>
                    <div class="counter-content">
                        <h2><span class="counter-number">{{$userCount}}</span>+</h2>
                        <p>Registered Sellers</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="counter-card">
                    <div class="counter-image">
                        <img src="{{asset('front/images/counter/ads.png')}}" alt="user">
                    </div>
                    <div class="counter-content">
                        <h2><span class="counter-number">{{$adCount}}</span>+</h2>
                        <p>Ads Posted</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="counter-card">
                    <div class="counter-image">
                        <img src="{{asset('front/images/counter/review.png')}}" alt="user">
                    </div>
                    <div class="counter-content">
                        <h2><span class="counter-number">50</span>+</h2>
                        <p>satisfied feedback</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================
            COUNTER PART END
=======================================-->

<!--=====================================
            ABOUT PART END
=======================================-->



@endsection

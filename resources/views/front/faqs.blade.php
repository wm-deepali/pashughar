@extends('front.layouts.app')
@php
$adCount = App\Models\Ad::where('delete_status', '0')->where('status', 'Published')->count();
$userCount = App\Models\Member::count();
@endphp
@section('title')
FAQs
@endsection

@section('metatags')
{!! getCommomPageMetaTag('faqs'); !!}
@endsection

@section('page_name') FAQs @endsection

@section('page_url') FAQs @endsection

@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/about.css')}}">
@endpush

@section('content')
@include('front.layouts.includes.single-banner')

<!--=====================================
            FAQ PART START
=======================================-->
<section class="about-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="about-content">
                    <h2>Frequently Asked Questions
                    </h2>
                    <p>Find answers to common questions about buying, selling, and using Pashughar.com's E-Market Place.</p>
                </div>

                @foreach($faqs as $faq)
                <div class="about-quote">
                    <div class="how-to-coll">
                        <ul>
                            <li>
                                <h4>{{$faq->qustion}}</h4>
                                <div>
                                    <p>{!! $faq->answer !!}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                @endforeach


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
                        <p>Registered Users</p>
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
                        <p>community ads</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="counter-card">
                    <div class="counter-image">
                        <img src="{{asset('front/images/counter/review.png')}}" alt="user">
                    </div>
                    <div class="counter-content">
                        <h2><span class="counter-number">3455</span>+</h2>
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
@endsection

@extends('front.layouts.master')

@section('title')
Profile
@endsection
@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/profile.css')}}">
@endpush
@section('content')
<!--=====================================
            PROFILE PART START
=======================================-->
<section class="profile-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="account-card">
                    <div class="account-title">
                        <h3>Profile Info</h3>
                        <a href="{{route('user.settings')}}">Edit</a>
                    </div>
                    <ul class="account-card-list">
                        <li><h5>Name</h5><p>{{$user->full_name}}</p></li>
                        <li><h5>Joined</h5><p>{{date('F d, Y', strtotime($user->created_at))}}</p></li>
                        <li><h5>Mobile</h5><p>{{$user->mobile}}</p></li>
                        <li><h5>Email</h5><p>{{$user->email}}</p></li>
                    </ul>
                </div>
                <div class="account-card">
                    <div class="account-title">
                        <h3>Contact Info</h3>
                        <a href="{{route('user.settings')}}">Edit</a>
                    </div>
                    <ul class="account-card-list">
                       <li><h5>Email:</h5><p>{{$user->email}}</p></li>
                        <li><h5>Mobile:</h5><p>{{$user->mobile}}</p></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="account-card">
                    <div class="account-title">
                        <h3>Billing Address</h3>
                        <a href="{{route('user.settings')}}">Edit</a>
                    </div>
                    <ul class="account-card-list">
                        <li><h5>Post Code:</h5><p>{{$user->zipcode ?? ''}}</p></li>
                        <li><h5>State:</h5><p>{{(isset($user->statename) && $user->statename !='') ? $user->statename->name : ''}}</p></li>
                        <li><h5>City:</h5><p>{{(isset($user->cityname) && $user->cityname !='') ? $user->cityname->name : ''}}</p></li>
                        <li><h5>Country:</h5><p>{{(isset($user->countryname) && $user->countryname !='') ? $user->countryname->name : ''}}</p></li>
                    </ul>
                </div>
                <div class="account-card">
                    <div class="account-title">
                        <h3>Shipping Address</h3>
                        <a href="{{route('user.settings')}}">Edit</a>
                    </div>
                    <ul class="account-card-list">
                        <li><h5>Post Code:</h5><p>{{$user->zipcode ?? ''}}</p></li>
                        <li><h5>State:</h5><p>{{(isset($user->statename) && $user->statename !='') ? $user->statename->name : ''}}</p></li>
                        <li><h5>City:</h5><p>{{(isset($user->cityname) && $user->cityname !='') ? $user->cityname->name : ''}}</p></li>
                        <li><h5>Country:</h5><p>{{(isset($user->countryname) && $user->countryname !='') ? $user->countryname->name : ''}}</p></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================
            PROFILE PART END
=======================================-->


@endsection
<!--@extends('front.layouts.app')-->

@section('title')
    Categories
@endsection

@section('metatags')
    {!! getCommomPageMetaTag('list-categories') !!}
@endsection

@section('page_name') Categories @endsection

@section('page_url') categories @endsection

@push('after-styles')
    <link rel="stylesheet" href="{{asset('front/css/custom/category-list.css')}}">
    <style>
        .btn-custom {
            background-color: #ff7f00 !important;
            /* button background color */
            color: #fff !important;
            /* text color */
            border: 1px solid #ff7f00 !important;
            /* border color */
            transition: 0.3s !important;
        }

        .btn-custom:hover {
            background-color: #e67300;
            /* darker shade on hover */
            color: #fff;
        }
        
    </style>
@endpush

@section('content')
    @include('front.layouts.includes.single-banner')
    
    <style>
        .category-head img {
            width: 100%;
            height: 120px !important;
            object-fit: contain;
        }
        .suggest-slider1 {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
    gap: 20px;
    justify-content: space-between;
    align-items: center;
    margin-bottom:40px;
}
.suggest-card1 {
    width: 100%;
    height: 190px;
    margin: 0px 4px;
    border-radius: 8px;
    padding: 15px 6px 6px 6px;
    text-align: center;
    border-bottom: 2px solid #003c02;
    background: #fef8ed;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.suggest-card1 img {
    height: 100px;
    margin-bottom: 10px;
    width: 100px;
    border-radius: 10px;
}
.suggest-card1 h6 {
    font-weight: 500;
    margin-bottom: 5px;
    text-transform: capitalize;
    font-size: 20px;
}
    .inner-section {
        margin-bottom: 40px !important;
    }
@media (max-width: 768px) {
     .suggest-slider1 {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 20px;
    justify-content: space-between;
    align-items: center;
    margin-bottom:30px;
}
}
    </style>
    <!--=====================================
                    CATEGORY PART START
        =======================================-->
        
        
        
        <section class="suggest-part">
    <div class="container">
        <div class="suggest-slider1 slider-arrow ">
        @if(count($categories) > 0)
                    @foreach($categories as $category)
            <a class='suggest-card1' href="{{route('category-details', $category->slug)}}">
                <img src="{{asset('storage')}}/{{$category->image}}" alt="car">
                <h6>{{$category->name}}</h6>
                <!--<p>({{isset($category->ads) && $category->ads !='' ? $category->ads->where('status', 'Published')->count() : 0}})</p>-->
            </a>
        @endforeach
                @endif 
        
         <!--<a class='suggest-card' href="{{route('category-details', $category->slug)}}">-->
         <!--       <img src="{{ asset('front/images/add-more.png') }}" alt="car">-->
         <!--       <h6> More</h6>-->
                
         <!--   </a>-->
        </div>
    </div>
</section>
        
   {{--     
    <section class="inner-section category-part mt-4">
        <div class="container">
            <div class="row">
                @if(count($categories) > 0)
                    @foreach($categories as $category)
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                            <div class="category-card">
                                <div class="category-head">

                                    <img src="{{asset('storage/' . $category->image)}}" alt="car">

                                    <a href="{{route('category-details', $category->slug)}}" class="category-content">
                                        <h4>{{$category->name}}</h4>
                                        <p>({{isset($category->ads) && $category->ads != '' ? $category->ads->where('status', 'Published')->count() : 0}})
                                        </p>
                                    </a>
                                </div>
<!-- 
                                @if(isset($category->subcategory) && count($category->subcategory) > 0)
                                    <ul class="category-list">
                                        @foreach($category->subcategory as $subcat)
                                            @php
                                                $slugName = strtolower(str_replace('_', '-', str_replace(' ', '-', $subcat->name)));
                                            @endphp
                                            <li><a
                                                    href="#">
                                                    <h6>{{$subcat->name}}</h6>
                                                    <p>({{isset($subcat->ads) && $subcat->ads != '' ? $subcat->ads->where('status', 'Published')->count() : 0}})
                                                    </p>
                                                </a></li>
                                        @endforeach
                                    </ul>
                                @endif -->

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </section>
    --}}
    <!--=====================================
                    CATEGORY PART END
        =======================================-->


    <!--=====================================
                    INTRO PART START
        =======================================-->
    <!--<section class="intro-part">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-lg-12">-->
    <!--                <div class="section-center-heading">-->
    <!--                    <h2>Choose the right Plan for Livestock & Product Ads</h2>-->
    <!--                    <p>List your Livestock & Dairy Products by selecting one of our tailored pricing plans. Whether-->
    <!--                        you're a retail seller or a Bulk Supplier, we have the right package to maximize your reach and-->
    <!--                        visibility.</p>-->
    <!--                    <a class="btn btn-custom" href="{{route('user.post-your-ad')}}">-->
    <!--                        <i class="fas fa-plus-circle"></i>-->
    <!--                        <span>post your ad</span>-->
    <!--                    </a>-->

    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->

@endsection
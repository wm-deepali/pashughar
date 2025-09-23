@extends('front.layouts.app')

@section('title')
Categories
@endsection

@section('metatags')
{!! getCommomPageMetaTag('categories'); !!}
@endsection

@section('page_name') Categories @endsection

@section('page_url') categories @endsection

@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/category-list.css')}}">
@endpush

@section('content')
@include('front.layouts.includes.single-banner')
<style>
.category-head img {
    width: 100%;
    height: 120px !important;
    object-fit: contain;
}
</style>
<!--=====================================
            CATEGORY PART START
=======================================-->
<section class="inner-section category-part">
    <div class="container">
        <div class="row">
            @if(count($categories)>0)
            @foreach($categories as $category)
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="category-card">
                    <div class="category-head">
                    
                    <img src="{{asset('storage/'.$category->image)}}" alt="car">
                    
                        <a href="{{route('category-details', base64_encode($category->id))}}" class="category-content">
                            <h4>{{$category->name}}</h4>
                            <p>({{isset($category->ads) && $category->ads !='' ? $category->ads->where('status', 'Published')->count() : 0}})</p>
                        </a>
                    </div>
                    
                    @if(isset($category->subcategory) && count($category->subcategory)>0)
                    <ul class="category-list">
                    @foreach($category->subcategory as $subcat)
                        @php
                        $slugName = strtolower(str_replace('_', '-', str_replace(' ', '-', $subcat->name)));
                        @endphp
                        <li><a href="{{route('sub-details', ['subcategoryname'=>$slugName, 'id'=>base64_encode($subcat->id)])}}"><h6>{{$subcat->name}}</h6><p>({{isset($subcat->ads) && $subcat->ads !='' ? $subcat->ads->where('status', 'Published')->count() : 0}})</p></a></li>
                    @endforeach
                    </ul>
                    @endif
                    
                </div>
            </div>
            @endforeach
            @endif
        </div>
        
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
                    <h2>Choose the right Plan for Livestock & Product Ads</h2>
                    <p>List your Livestock & Dairy Products by selecting one of our tailored pricing plans. Whether you're a retail seller or a Bulk Supplier, we have the right package to maximize your reach and visibility.</p>
                    <a class='btn btn-outline' href="{{route('user.ad-post')}}">
                        <i class="fas fa-plus-circle"></i>
                        <span>post your ad</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
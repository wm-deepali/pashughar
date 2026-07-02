@extends('front.layouts.app')

@section('title')
All Ads
@endsection

@section('metatags')

@if(app('request')->has('type'))
@php $stype = app('request')->input('type'); @endphp
{!! getCommomPageMetaTag($stype)!!}
@else
{!! getCommomPageMetaTag('list-all-ads') !!}
@endif

@endsection

@section('page_name') All Ads @endsection

@section('page_url') All Ads @endsection

@push('after-styles')
@endpush

@section('content')
@include('front.layouts.includes.single-banner')
@php 
if (request()->query('perPage')) {
   $perPage = request()->query('perPage');
}
else{
    $perPage =4;
}
if (request()->query('type')) {
   $type =request()->query('type');
}
else{
    $type ='all';
}
@endphp

<style>
    .custom-select-box {
    width: 100%;
    position: relative;
    margin-bottom:10px;
}

/* Main Select Box */
.custom-select-box select {
    width: 100%;
    padding: 12px 16px;
    border-radius: 8px;
    border: 1px solid #ddd;
    background: #fff;
    font-size: 14px;
    font-weight: 500;
    color: #333;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    outline: none;
    appearance: none;
    -webkit-appearance: none;
    cursor: pointer;
}

/* Custom dropdown arrow */
.custom-select-box::after {
    content: "\f078";   /* FontAwesome down arrow */
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    color: #555;
    font-size: 12px;
}

/* Ensure dropdown list stays inside box */
.custom-select-box select option {
    font-size: 14px;
    padding: 10px;
    background: #fff;
    color: #333;
    word-break: break-word;
    white-space: normal;  /* Auto wrap text */
}



</style>
<!--=====================================
            AD LIST PART START
=======================================-->
<section class="inner-section ad-list-part">
    <div class="container">
        <div class="row content-reverse">
            <div class="col-lg-4 col-xl-3">
                <div class="row">
                    <div class="col-md-6 col-lg-12">
                        <div class="product-widget">
                            <h6 class="product-widget-title">Filter by Price</h6>
                            <form action="">
                                <div class="product-widget-group">
                                    <input type="text" name="min" placeholder="min - 00" value="{{ request('min') ?? '' }}" required>
                                    <input type="text" name="max" value="{{ request('max') ?? '' }}" placeholder="max - 1B" required>
                                </div>
<div class="custom-select-box">
    <select name="category" required>
        <option value="">Select Category</option>
        @if(!empty($categories) && count($categories) > 0)
            @foreach($categories as $category)
                <option value="{{ $category->name }}" {{ request('category') == $category->name ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        @else
            <option value="">No categories found</option>
        @endif
    </select>
</div>

                                <button type="submit" class="product-widget-btn">
                                    <i class="fas fa-search"></i>
                                    <span>search</span>
                                </button>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
            
            <div class="col-lg-8 col-xl-9">
            <form action="" class="filter-form">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-filter">
                        
                        <div class="filter-show">
                                <label class="filter-label">Show :</label>
                                <select class="custom-select filter-select" name="perPage" onchange="this.form.submit()">
                                    <option value="1" {{$perPage ==1 ? 'selected' : ''}}>10</option>
                                    <option value="2" {{$perPage ==2 ? 'selected' : ''}}>25</option>
                                    <option value="3" {{$perPage ==3 ? 'selected' : ''}}>50</option>
                                    <option value="4" {{$perPage ==4 ? 'selected' : ''}}>All</option>
                                </select>
                            </div>
                            <div class="filter-short">
                                <label class="filter-label">Short by :</label>
                                <select class="custom-select filter-select" name="type" onchange="this.form.submit()">
                                    <option value="all" {{$type =='all' ? 'selected' : ''}}>all</option>
                                    <option value="trending" {{$type =='trending' ? 'selected' : ''}}>trending</option>
                                    <option value="featured" {{$type =='featured' ? 'selected' : ''}}>featured</option>
                                    <option value="recommend" {{$type =='recommend' ? 'selected' : ''}}>recommend</option>
                                </select>
                            </div>
                        
                        </div>
                    </div>
                </div>
                </form>
                <div class="row">
                @if(count($ads) > 0)
                @foreach ($ads as $ad) 
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                        <div class="product-card">
                            <div class="product-media">
                                <div class="product-img">
                                @if(isset($ad->adImage) && count($ad->adImage)>0)
                                    <img src="{{ asset('storage').'/'.$ad->adImage[0]->image}}" alt="product">
                                @else
                                    <img src="{{asset('front/images/no-image.jpeg')}}" alt="product">
                                @endif
                                </div>
                                <div class="product-type">
                                    <span class="flat-badge booking">Top</span>
                                </div>
                                
                            </div>
                            <div class="product-content">
                                <ol class="breadcrumb product-category">
                                    <li><i class="fas fa-tags"></i></li>
                                    <li class="breadcrumb-item"><a href="#">{{$ad->category->name ?? ''}}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{$ad->title}}</li>
                                </ol>
                                <h5 class="product-title">
                                    <a href="{{route('ad-details', [$ad->category->name,$ad->slug])}}">{{Str::of($ad->description)->words(10, ' ...')}}</a>
                                </h5>
                                <div class="product-meta">
                                    <span><i class="fas fa-map-marker-alt"></i>{{$ad->author_address ?? ''}}</span>
                                    <span><i class="fas fa-clock"></i>{{$ad->created_at->diffForHumans()}}</span>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-price">&#8377;{{$ad->price}}</h5>
                                    <div class="product-btn">
                                    <span><i class="fas fa-eye"></i> {{$ad->views}}</span>
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
                        <div class="footer-pagection">
                        {!! $ads->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================
            AD LIST PART END
=======================================-->

@endsection

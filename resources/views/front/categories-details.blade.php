@extends('front.layouts.app')

@section('title')
{{$category->name}}
@endsection

@section('metatags')
{!! getDetailsPageMetaTag($category->meta_title ?? 'Pashughar', $category->meta_keyword, $category->meta_description, Request::url()) !!}
@endsection

@section('page_name') {{$category->name}} @endsection

@section('page_url') {{$category->name}} @endsection

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
<!--=====================================
            AD LIST PART START
=======================================-->
<section class="inner-section ad-list-part">
    <div class="container">
        <div class="row content-reverse">
            <div class="col-lg-4 col-xl-3">
                <div class="row">
                    <div class="col-md-6 col-lg-12">
                        <form action="">

                        <div class="product-widget">
                            <h6 class="product-widget-title">Filter by Category</h6>
                            @foreach($category->subcategory as $categ)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{$categ->id}}"  id="flexCheckDefault" name="subcatid[]">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{$categ->name}}
                                </label>
                            </div>
                            @endforeach
                        </div> 
                        <div class="product-widget">
                            <h6 class="product-widget-title">Filter by Price</h6>

                                <div class="product-widget-group">
                                    <input type="text" name="min" placeholder="min - 00" required>
                                    <input type="text" name="max" placeholder="max - 1B" required>
                                </div>
                                <button type="submit" class="product-widget-btn">
                                    <i class="fas fa-search"></i>
                                    <span>search</span>
                                </button>
                        </div> 
                        </form>
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
                                <label class="filter-label">Sort by :</label>
                                <select class="custom-select filter-select" name="type" onchange="this.form.submit()">
                                    <option value="all" {{$type =='all' ? 'selected' : ''}}>All</option>
                                    
                                    <option value="all" {{$type =='all' ? 'recent' : ''}}>Recent First</option>
                                    <option value="trending" {{$type =='trending' ? 'selected' : ''}}>Trending Ads</option>
                                    <option value="featured" {{$type =='featured' ? 'selected' : ''}}>Featured Ads</option>
                                    <option value="recommend" {{$type =='recommend' ? 'selected' : ''}}>Recommended Ads</option>
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
                                    <h5 class="product-price">₹    {{$ad->price}}</h5>
                                    <div class="product-btn">
                                    <span><i class="fas fa-eye"></i> {{$ad->views}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    
                     <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                         <h5 class="text-center">No Ads Found</h5>
                         
                    </div>
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
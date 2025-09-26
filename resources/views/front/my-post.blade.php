@extends('front.layouts.master')

@section('title')
My Ads
@endsection
@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/my-ads.css')}}">
@endpush
@section('content')

<!--=====================================
            MY ADS PART START
=======================================-->

@if(Session::has('success'))
    <script>
        alert('{{ Session::get('success') }}');
    </script>
@endif 
<section class="myads-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!--div class="header-filter">
                    <div class="filter-show">
                        <label class="filter-label">Show :</label>
                        <select class="custom-select filter-select">
                            <option value="1">12</option>
                            <option value="2">24</option>
                            <option value="3">36</option>
                        </select>
                    </div>
                    <div class="filter-short">
                        <label class="filter-label">Short by :</label>
                        <select class="custom-select filter-select">
                            <option selected>all ads</option>
                            <option value="3">booking ads</option>
                            <option value="2">rental ads</option>
                            <option value="1">sale ads</option>
                        </select>
                    </div>
                </div-->
            </div>
        </div>
        <div class="row">
            @if(count($ads) > 0)
            @foreach ($ads as $ad) 
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="product-card">
                    <div class="product-media">
                        <div class="product-img">
                        
                        @if(isset($ad->adImage) && count($ad->adImage)>0)
                            <img src="{{ asset('storage').'/'.$ad->adImage[0]->image}}" alt="product">
                        @else
                        <img src="{{asset('front/images/no-image.jpeg')}}" alt="product">
                        @endif
                        </div>
                        
                        @php 
                        if($ad->status == 'Published')
                        {
                            $sCalss='rent';
                        } 
                        else if($ad->status == 'Expired')
                        {
                            $sCalss='expired';
                        }
                        else if($ad->status == 'Rejected')
                        {
                            $sCalss='sale';
                        }
                        else{
                            $sCalss='booking';
                        }
                        @endphp
                        <div class="product-type">
                           
                            <span class="flat-badge {{$sCalss}}">{{$ad->status}}</span>
                            
                        </div>
                        @if(isset($ad->reviews) && $ad->reviews !='')
                            @if(count($ad->reviews) > 0)
                                @php $star=$ad->reviews->sum('rating')/$ad->reviews->count(); 
                                $star= number_format($star);
                                @endphp
                            @else
                                @php $star=0; @endphp
                            @endif
                        @else
                            @php $star=0; @endphp
                        @endif
                        <ul class="product-action">
                            <li class="view"><i class="fas fa-eye"></i><span>{{$ad->views}}</span></li>
                            <li class="rating"><i class="fas fa-star"></i><span>{{$star}}/5</span></li>
                        </ul>
                    </div>
                    <div class="product-content">
                        <ol class="breadcrumb product-category">
                            <li class="breadcrumb-item"><a href="#">{{$ad->category->name ?? ''}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$ad->title}}</li>
                        </ol>
                        <h5 class="product-title">
                            <a href="{{route('ad-details',[$ad->category->name,$ad->slug])}}">{{Str::of($ad->description)->words(4, ' ...')}}</a>
                        </h5>
                        <div class="product-meta">
                            <span><i class="fas fa-map-marker-alt"></i>{{$ad->author_address ?? ''}}</span>
                            <span><i class="fas fa-clock"></i>{{$ad->created_at->diffForHumans()}}</span>
                        </div>
                        <div class="product-info">
                            <h5 class="product-price">&#8377; {{$ad->price}}</h5>
                            <div class="product-btn">
                            @if($ad->status == 'Published' || $ad->status == 'Pending')
                            <a class='fas fa-edit' href="{{route('user.edit-ad-post', base64_encode($ad->id))}}" title='Edit'></a>
                            @endif
                            <a class='fas fa-question-circle' href="{{route('user.ad-enquiries', base64_encode($ad->id))}}" title='Enquiry'></a>
                            <a class='fas fa-trash' href="{{route('user.delete-ad', base64_encode($ad->id))}}" title='Delete'></a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        {!! $ads->links() !!}

    </div>
</section>
<!--=====================================
            MY ADS PART END
=======================================-->
@endsection
@push('after-script')

@endpush
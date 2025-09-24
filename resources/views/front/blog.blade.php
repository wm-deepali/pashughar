@extends('front.layouts.app')

@section('title')
Blogs
@endsection

@section('metatags')
{!! getCommomPageMetaTag('blog-listing') !!}
@endsection

@section('page_name') Blogs @endsection

@section('page_asset') Blogs @endsection

@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/index.css')}}">
@endpush

@section('content')
@include('front.layouts.includes.single-banner-price')



<!--=====================================
            Price PART START
=======================================-->
<section class="blog-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Read Our <span>Recent Articles</span></h2>
                    <p>Pashughar.com always tries to bring you the recent updates in Livestock market and Dairy product farming and selling</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-slider slider-arrow">
                    @foreach ($blogs as $blog)
                    <div class="blog-card">
                        <div class="blog-img">

                            <img src="{{ $blog->thumb_image ? url($blog->thumb_image) : asset('front/images/no-image.jpg') }}" alt="blog">
                            <div class="blog-overlay">
                                <span class="marketing">Marketing</span>
                            </div>
                        </div>
                        <div class="blog-content">
                            <a href="#" class="blog-avatar">
                                <img src="{{asset('front/images/favicona.png')}}" alt="avatar">
                            </a>
                            <ul class="blog-meta">
                                <li>
                                    <i class="fas fa-user"></i>
                                    <p><a href="#">Pashughar Team</a></p>
                                </li>
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <p>{{ $blog->created_at ? $blog->created_at->format('Y-m-d') : 'N/A' }}</p>
                                </li>
                            </ul>
                            <div class="blog-text">
                                <h4><a href='{{route('blog-details', $blog->id)}}'>{{$blog->title}}</a></h4>
                                <p> {{ \Illuminate\Support\Str::limit($blog->short_description, 150) }}</p>
                            </div>
                            <a class='blog-read' href='{{route('blog-details', $blog->id)}}'>
                                <span>read more</span>
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>

<!--=====================================
                PRICE PART END
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
        		asset:'{{asset("free-subscription")}}',
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

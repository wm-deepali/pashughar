@extends('front.layouts.app')

@section('title')
{{$page->name}}
@endsection

@section('metatags')
{!! getDetailsPageMetaTag($page->meta_title ?? 'Pashughar', $page->meta_keyword, $page->meta_description, $page->canonical) !!}
@endsection

@section('page_name') {{$page->name}} @endsection

@section('page_url') {{$page->canonical}}  @endsection

@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/price.css')}}">
@endpush

@section('content')
@include('front.layouts.includes.single-banner-price')

<!--=====================================
            Price PART START
=======================================-->
<section class="price-part11 mt-4 mb-4">

    <div class="container">
        <div class="terms-page" style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; padding: 20px;">
            <h2 style="text-align: center; font-size: 24px; color: #0056b3; margin-bottom: 20px;">{{$page->name}} </h2>
            <p>
                {{$page->heading}}
            </p>
            <ol style="margin: 20px 0; padding-left: 20px;">
                {!! $page->detail_content !!}
            </ol>
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
        		url:'{{url("free-subscription")}}',
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

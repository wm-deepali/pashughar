@extends('front.layouts.app')

@section('title')
Terms and Conditions
@endsection

@section('metatags')
{!! getCommomPageMetaTag('terms-condition') !!}
@endsection

@section('page_name') Terms and Conditions @endsection

@section('page_url') Terms and Conditions @endsection

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
            <h2 style="text-align: center; font-size: 24px; color: #0056b3; margin-bottom: 20px;">Terms and Conditions</h2>
            <p>
                Welcome to our website. By accessing and using this site, you agree to comply with the following terms 
                and conditions. Please read them carefully:
            </p>
            <ol style="margin: 20px 0; padding-left: 20px;">
                <li>
                    <strong>Use of Content:</strong> The content provided is for personal and informational use only. 
                    Unauthorized reproduction, distribution, or modification is strictly prohibited.<br>
                </li>
                <li>
                    <strong>Changes to Terms:</strong> We reserve the right to update these terms at any time without prior notice. 
                    It is your responsibility to review them periodically.<br>
                </li>
                <li>
                    <strong>User Responsibility:</strong> Users must ensure that their use of this website complies with applicable laws 
                    and regulations in their jurisdiction.<br>
                </li>
                <li>
                    <strong>Liability Disclaimer:</strong> We are not liable for any inaccuracies, delays, or damages arising from 
                    the use of the site or its content.<br>
                </li>
                <li>
                    <strong>Third-party Links:</strong> Our website may contain links to third-party websites. We are not responsible 
                    for the content, privacy policies, or practices of these external sites.<br>
                </li>
                <li>
                    <strong>Privacy Policy:</strong> By using this website, you agree to our Privacy Policy. Ensure that you review 
                    it for details on how your information is used and protected.<br>
                </li>
                <li>
                    <strong>Termination:</strong> We reserve the right to terminate access to the website for users who violate these 
                    terms or engage in unauthorized activities.<br>
                </li>
            </ol>
            <p>
                By continuing to use this site, you acknowledge that you have read and understood these terms 
                and agree to be bound by them. For any queries or concerns, feel free to <a href="contact.html" style="color: #007bff;">contact us</a>.
            </p>
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
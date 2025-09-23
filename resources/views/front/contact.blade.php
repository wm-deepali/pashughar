@extends('front.layouts.app')

@section('title')
Contact Us
@endsection

@section('metatags')
{!! getCommomPageMetaTag('contact-us'); !!}
@endsection

@section('page_name') Contact Us @endsection

@section('page_url') Contact Us @endsection

@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/contact.css')}}">
@endpush

@section('content')
@include('front.layouts.includes.single-banner-price')

<!--=====================================
            Contact PART START
=======================================-->
<section class="contact-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="contact-info">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Find us</h3>
                    <p>Address: Kalindikunj, Near Okhla Bird Sanctuary, Delhi, India</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-info">
                    <i class="fas fa-phone-alt"></i>
                    <h3>Make a Call</h3>
                    <p>+91-8755718642</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-info">
                    <i class="fas fa-envelope"></i>
                    <h3>Send Mail</h3>
                    <p>admin@pashughar.com</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="contact-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14019.585402542492!2d77.2911205871582!3d28.542834999999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce4202e1dd459%3A0x98e4638e9d17e546!2sKalindi%20Kunj!5e0!3m2!1sen!2sin!4v1744185266463!5m2!1sen!2sin"></iframe>
                    

                </div>
            </div>
            <div class="col-lg-6">
                <form class="contact-form" id="contact-form" method="post">
                @csrf
                
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" name="subject" class="form-control" placeholder="Your Subject" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea class="form-control" name="message" placeholder="Your Message" required></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-btn">
                                <button class="btn btn-inline saveContact">
                                    <i class="fas fa-paper-plane"></i>
                                    <span>send message</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--=====================================
                Contact PART END
=======================================-->
@endsection
@push('after-script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.css" >
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.js"></script>
<script>
    $('.saveContact').click(function (e) {
        e.preventDefault();
        $empty = $('form.contact-form').find("input,textarea").filter(function() {
        return this.value === "";
    });
    if($empty.length) {
        alert('You must fill out all fields in enquiry to submit');
        return false;
    }else{
        Swal.fire({
            title: 'Are you sure?',
            
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Submit Enquiry'
            }).then((result) => {
                if (result.isConfirmed) {
                   
                $.ajax({
        		url:'{{route("save-contact-us")}}',
        		method:'POST',
        		data: $("#contact-form").serialize(),
        		success:function(data){
                    console.log(data);
                    if (data.success) 
                    {
                        Swal.fire(
                            data.message
                        );
                        document.getElementById("#contact-form").refresh();
                    }else{
                         Swal.fire(
                            data.message
                        );
                    }
        		}
        	});
                }
        })
    };
        
    
    });
    
</script>
@endpush
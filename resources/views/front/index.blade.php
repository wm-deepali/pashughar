@extends('front.layouts.app')

@section('title')
Welcome to PashuGhar Livestock Trade & Marketing | Delhi | India
@endsection

@section('metatags')
{!! getCommomPageMetaTag('/') !!}
@endsection

@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/index.css')}}">
@endpush

@section('content')

@include('front.layouts.includes.banner')
@include('front.layouts.includes.suggestion')



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
    .usp-section {
    text-align: center;
    padding: 60px 20px;
    background: #ffffff;
    font-family: 'Poppins', sans-serif;
}

.usp-section h2 {
    font-size: 36px;
    font-weight: 700;
}

.sub {
    font-size: 14px;
    margin-bottom: 35px;
    color: #c89f80;
    letter-spacing: 2px;
}

.usp-container {
    display: flex;
    justify-content: center;
    gap: 40px;
    flex-wrap: wrap;
    /**/
}

/* LEFT + RIGHT ITEM BOXES */
.usp-left, .usp-right {
    display: flex;
    flex-direction: column;
    gap: 30px;
    width: 360px;
}

.usp-box {
    text-align: center;
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.usp-box:hover {
    transform: translateY(-5px);
}

.usp-box i {
    font-size: 32px;
    color: #e88a39;
    margin-bottom: 10px;
}

.usp-box h3 {
    font-size: 18px;
    margin-bottom: 6px;
}

.usp-box p {
    font-size: 13px;
    color: #666;
}

/* CENTER IMAGE */
.usp-image {
    position: relative;
}

.usp-image img {
    position: relative;
    bottom: -225px;
    width: 380px;
    height: 300px;
    border-radius: 20px;
    object-fit: cover;
}

.center-tag {
    position: absolute;
    top: 0px;
    left: 50%;
    transform: translateX(-50%);
    background: #f3c7c7;
    padding: 15px 25px;
    border-radius: 18px;
    text-align: center;
    width: 100%;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.center-tag i {
    font-size: 26px;
    margin-bottom: 5px;
    color: #d86e6e;
}

.center-tag h3 {
    margin: 0;
    font-size: 16px;
    margin-bottom:5px;
}

.center-tag p {
    font-size: 12px;
    color: #555;
}

.intro-section {
    background: #f4f8f4;
    padding: 70px 30px;
    /*text-align: center;*/
    font-family: 'Poppins', sans-serif;
    margin-top:50px;
}

.main-heading {
    font-size: 2rem;
    font-weight: 700;
    text-align:center;
    color:#232d3b;
}

.sub-heading {
    font-size: 15px;
    color: #6f6f6f;
    max-width: 750px;
    margin: 10px auto 40px;
}

/* MAIN CONTAINER */
.intro-container {
    display: flex;
    gap: 30px;
    margin-top: 40px;
}

/* LEFT CARD (COL-4) */
.intro-left-card {
    width: 32%; /* approx col-4 */
    background: white;
    padding: 30px;
    border-radius: 14px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.07);
}

/* RIGHT CARD (COL-8) */
.intro-right-card {
    width: 68%; /* approx col-8 */
    background: #e8f0e7;
    padding: 30px;
    border-radius: 14px;
    display: flex;
    justify-content: space-between;
    gap: 30px;
}

/* INNER LEFT IN COL-8 */
.right-content {
    width: 60%;
}

/* INNER RIGHT IN COL-8 */
.right-points {
    width: 40%;
}

/* HEADING */
.intro-left-card h3,
.right-content h3 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 12px;
}

/* SUB TEXT */
.sub {
    font-size: 14px;
    color: #397839;
    margin-bottom: 14px;
    font-weight:600;
}

/* NORMAL TEXT */
.text {
    font-size: 14px;
    color: #555;
    line-height: 1.6;
    margin-bottom: 20px;
}

/* BUTTON */
.btn-join {
    background: #397839;
    color: white;
    border: none;
    padding: 10px 22px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    transition: 0.3s;
}

.btn-join:hover {
    background: #2e1d10;
    color:#fff;
}

/* BULLET POINT LIST */
.bullet-points {
    list-style: none;
    padding: 0;
}

.bullet-points li {
    font-size: 14px;
    color: #333;
    margin: 10px 0;
    display: flex;
    align-items: start;
}

.bullet-points i {
    background: #397839;
    color: white;
    font-size: 10px;
    padding: 4px;
    border-radius: 50%;
    margin-right: 10px;
}

/* Responsive */
@media(max-width: 900px) {
    .intro-container {
        flex-direction: column;
    }
    .intro-left-card,
    .intro-right-card {
        width: 100%;
    }
    .intro-right-card {
        flex-direction: column;
    }
    .right-content, .right-points {
        width: 100%;
    }
}

.seller-section {
    padding: 60px 40px;
    background: #f4f8f4;
    font-family: 'Poppins', sans-serif;
     margin-top: 40px;
}

.seller-container {
    display: flex;
    gap: 40px;
    align-items: flex-start;
}

/* LEFT IMAGE */
.seller-image img {
    width: 450px;
    border-radius: 16px;
}

/* RIGHT CONTENT */
.seller-content {
    width: 55%;
}

.seller-content h2 {
    font-size: 28px;
    font-weight: 700;
}

.seller-content .desc {
    font-size: 15px;
    color: #555;
    margin: 10px 0 30px;
    max-width: 600px;
}

/* STEPS WRAPPER */
.steps {
    border-left: 3px solid #c5b8ad;
    padding-left: 30px;
    margin-left: 10px;
}

/* STEP CARD */
.step-card {
    position: relative;
    background: #f4f8f4;
    padding: 20px 25px;
    border-radius: 14px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

/* DOT ON LEFT */
.step-card .dot {
    width: 14px;
    height: 14px;
    background: #7a5a48;
    border-radius: 50%;
    position: absolute;
    left: -38px;
    top: 28px;
    border: 3px solid #faf8f6;
}

/* GREEN DOT */
.step-card .dot.green {
    background: #2ea84a;
}

.step-card h4 {
    font-size: 14px;
    color: #397839;
    margin-bottom: 5px;
}

.step-card h3 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 8px;
}

.step-card p {
    font-size: 14px;
    color: #555;
    line-height: 1.6;
}

/* Closing Box */
.closing-box {
    margin-top: 25px;
    background: #f4f8f4;
    padding: 18px 22px;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 600;
    color: #397839;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    width: fit-content;
        display: flex;
    gap: 30px;
    align-items: center;
    margin:auto;
}

/* Responsive */
@media(max-width: 900px) {
    .seller-container {
        flex-direction: column;
    }
    .seller-content {
        width: 100%;
    }
    .seller-image img {
        width: 100%;
    }
}

.main-heading, .main-desc {
    text-align: center;
}

.seller-container {
    margin-top: 40px;
    display: flex;
    align-items: center;
    gap: 40px;
}

.seller-image {
    width: 40%;
    height: auto;
    display: flex;
    justify-content: center;
    align-items: center;
}

.seller-image img {
    width: 100%;
    height: 100%;
    object-fit: contain; /* no crop, full visible */
}

/* MAIN SECTION */
.faq-section {
    background: #f4f8f4;
    padding: 70px 0;
    margin-top:40px;
}

.faq-container {
    width: 90%;
    max-width: 1200px;
    margin: auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
}

/* LEFT FAQ */
.faq-title {
    font-size: 32px;
    font-weight: 700;
    color: #333;
    margin-bottom: 25px;
}

.faq-box {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.faq-item {
    background: #fff;
    padding: 18px 20px;
    border-radius: 12px;
    box-shadow: 0px 3px 10px rgba(0,0,0,0.08);
    cursor: pointer;
    transition: 0.3s;
}

.faq-item:hover {
    transform: translateY(-4px);
}

.faq-question {
    font-size: 18px;
    font-weight: 600;
    color: #222;
    margin-bottom: 8px;
}

.faq-answer {
    font-size: 15px;
    color: #555;
    line-height: 1.5;
}

/* RIGHT FORM */
.faq-form-card {
    background: #fff;
    padding: 45px 30px;
    border-radius: 14px;
    box-shadow: 0px 3px 15px rgba(0,0,0,0.07);
}

.faq-form-title {
    font-size: 28px;
    font-weight: 700;
    color: #333;
    margin-bottom: 8px;
}

.faq-form-sub {
    font-size: 15px;
    color: #666;
    margin-bottom: 25px;
}

/* FORM FIELDS */
.faq-input,
.faq-textarea {
    width: 100%;
    padding: 12px 14px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 15px;
    margin-bottom: 18px;
    outline: none;
    transition: 0.3s;
}

.faq-input:focus,
.faq-textarea:focus {
    border-color: #397839;
    box-shadow: 0px 0px 5px rgba(255,136,0,0.4);
}

/* BUTTON */
.faq-btn {
    width: 100%;
    background: #397839;
    color: #fff;
    border: none;
    padding: 14px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}

.faq-btn:hover {
    background: #e07200;
}


/* BUTTON */
.otp-btn {
    background: #397839;
    color: #fff;
    border: none;
    padding: 11px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 7px;
    cursor: pointer;
    transition: 0.3s;
}

.otp-btn:hover {
    background: #e07200;
}

/* RESPONSIVE */
@media (max-width: 900px) {
    .faq-container {
        grid-template-columns: 1fr;
    }
}
.faq-item {
    background: #fff;
    padding: 18px 20px;
    border-radius: 12px;
    box-shadow: 0px 3px 10px rgba(0,0,0,0.08);
    cursor: pointer;
    transition: 0.3s;
}

.faq-question-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.faq-icon {
    font-size: 24px;
    font-weight: 700;
    color: #397839;
    transition: 0.3s;
}

/* answer hidden by default */
.faq-answer {
    font-size: 15px;
    color: #555;
    line-height: 1.5;
    margin-top: 10px;
    display: none;
}

/* when active */
.faq-item.active .faq-answer {
    display: block;
}

.faq-item.active .faq-icon {
    transform: rotate(180deg);
    content: "-";
}


.testi-section {
    padding: 60px 20px;
    background: #fff;
}

.testi-title {
    text-align: center;
    margin-bottom: 40px;
    font-size: 28px;
    font-weight: 700;
}

.testi-card {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.07);
    text-align: center;
    transition: 0.3s;
}

.testi-card:hover {
    transform: translateY(-5px);
}

.testi-img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 12px;
}

.testi-name {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 5px;
}

.testi-rating {
    color: #ffb400;
    font-size: 18px;
    margin-bottom: 10px;
}

.testi-text {
    font-size: 15px;
    color: #555;
    line-height: 1.5;
}

/* NAV BUTTONS */
.testi-prev, .testi-next {
    position: absolute;
    top: 45%;
    transform: translateY(-50%);
    z-index: 10;
    background: #fff;
    padding: 10px 15px;
    border-radius: 50%;
    box-shadow: 0 3px 10px rgba(0,0,0,0.15);
    cursor: pointer;
    font-size: 20px;
    user-select: none;
}

.testi-prev { left: -10px; }
.testi-next { right: -10px; }

.swiper-pagination-bullet-active {
    background: #007bff !important;
}
.faq-phone-group {
    display: flex;
    gap: 10px;
    width: 100%;
}

.faq-country {
    width: 120px;
        margin-bottom: 18px;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ddd;
    font-size: 15px;
    background: #fff;
    cursor: pointer;
}

.phone-input {
    flex: 1;
}

.cta-section {
    width: 100%;
    padding: 70px 20px;
    background: #f4f8f4;
    display: flex;
    justify-content: center;
    margin-top:40px;
}

.cta-container {
    max-width: 900px;
    text-align: center;
}

.cta-heading {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 15px;
}

.cta-subheading {
    font-size: 18px;
    color: #444;
    margin-bottom: 20px;
}

.cta-content {
    font-size: 16px;
    color: #555;
    line-height: 1.6;
    margin-bottom: 35px;
}

.cta-btn-group {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.cta-btn {
    padding: 10px 35px;
    font-size: 17px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    border: 2px solid #397839;
    transition: 0.3s;
}

/* Buyer Button */
.cta-btn.buyer {
    background: #397839;
    color: #fff;
}

.cta-btn.buyer:hover {
    background: #ffffff;
    color:#397839;
}
.cta-btn1.buyer:hover {
    background: #ffffff;
    color:#397839;
}
/* Seller Button */
.cta-btn.seller {
    background: #fff;
    color: #397839;
}

.cta-btn.seller:hover {
    background: #0d6a0d;
    color:#ffffff;
}


.cta-btn1.seller:hover {
    background: #0d6a0d;
    color:#ffffff;
}
@media(max-width: 600px){
    .cta-heading {
        font-size: 26px;
    }
    .cta-btn {
        width: 100%;
        text-align: center;
    }
}

.cta-btn-group1 {
    display: flex;
    justify-content: start;
    gap: 20px;
    flex-wrap: wrap;
}
.cta-btn1 {
    padding: 5px 35px;
    font-size: 17px;
    border-radius: 8px;
    font-weight: 500;
    text-decoration: none;
    border: 1px solid #397839;
    transition: 0.3s;
}
.cta-btn1.buyer {
    background: #397839;
    color: #fff;
}
.cta-btn1.seller {
    background: #fff;
    color: #397839;
}
.product-img img {
    width: 100% !important;
    height: 182px;
}
.closing-btn {
    display: inline-block;
    background: #53843d;
    color: #fff;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.3s;
}

.closing-btn:hover {
    background: #fff;
    color:#53843d;
}
</style>



<section class="intro-section">

    <h2 class="main-heading">Welcome to PashuGhar.com</h2>
    <p class="sub-heading">
        Platform for Buy & Sell Livestocks, Dairy Products & Free Classified Postings 
        for Livestock & Dairy Products.
    </p>

   <div class="intro-container">

    <!-- LEFT COL (4) -->
    <div class="intro-left-card">
        <h3>PashuGhar Livestock Trade & Marketing</h3>

        <p class="sub">
            MSME Registered (Udyam Registration No: UDYAM-DL-03-0058814)
        </p>

        <p class="text">
            Digital Platform to list your livestock and dairy products, get direct enquiries, 
            and sell at the right market value тАФ without middlemen.
        </p>

        <!--<button class="btn-join">Join Us</button>-->
    </div>

    <!-- RIGHT COL (8) -->
    <div class="intro-right-card">

        <!-- INNER LEFT (CONTENT) -->
        <div class="right-content">
            <h3>Connecting Livestock & Dairy Sellers with Buyers тАФ Simply & Transparently</h3>

            <p class="text">
                We help sellers list livestock and dairy products easily and connect directly 
                with genuine buyers. By removing middlemen and increasing visibility, PashuGhar 
                enables fair pricing and faster deals. Our platform supports both retail and 
                bulk trade, locally and globally.
            </p>
            <div class="cta-btn-group1">
            <a href="#" class="cta-btn1 buyer">IтАЩm a Buyer</a>
            <a href="#" class="cta-btn1 seller"> FREE Listing</a>
        </div>
        </div>

        <!-- INNER RIGHT (BULLET POINTS) -->
        <div class="right-points">
            <ul class="bullet-points">
                <li><i class="fa-solid fa-check"></i> MSME Registered Business</li>
                <li><i class="fa-solid fa-check"></i> Platform for Livestock & Dairy Trading</li>
                <li><i class="fa-solid fa-check"></i> Serving Sellers & Buyers Across India & Globally</li>
                <li><i class="fa-solid fa-check"></i> Aligned with IndiaтАЩs Livestock & Dairy Ecosystem</li>
                <li><i class="fa-solid fa-check"></i> Built for Farmers, Traders & Agri Businesses</li>
            </ul>
        </div>

    </div>
</div>


</section>


<section class="usp-section">
    <h2>Our USP</h2>
    <p class="sub">PashuGhar.com empowers livestock and dairy businesses with visibility, transparency, and choice.</p>

    <div class="usp-container">

        <!-- Left Side -->
        <div class="usp-left">
            <div class="usp-box">
                <i class="fa-regular fa-rectangle-list"></i>
                <h3>ЁЯЖУ Free Classified Listing</h3>
                <p>List livestock and dairy products without any listing fee or hidden charges.</p>
            </div>

            <div class="usp-box">
               <i class="fa-regular fa-handshake"></i>
                <h3>ЁЯдЭ Direct BuyerтАУSeller Connect</h3>
                <p>Buyers and sellers communicate directly via call or WhatsApp тАФ no brokers involved.</p>
            </div>

            <div class="usp-box">
                <i class="fa-solid fa-earth-europe"></i>
                <h3>ЁЯМН Local & Global Reach</h3>
                <p>Reach buyers not only from your local area but also from other regions and countries.</p>
            </div>
        </div>

        <!-- Center Image -->
        <div class="usp-image">
            <div class="center-tag">
                <i class="fa-solid fa-user-gear"></i>
                <h3>PashuGhar.com is built to simplify livestock and dairy trading by directly connecting buyers and sellers on a transparent, affordable, and easy-to-use platform тАФ locally and globally.</h3>
                <p>We focus on solving real problems faced by farmers, traders, and buyers by removing middlemen, reducing costs, and improving market access.</p>
            </div>
            <img src="https://kjcdn.gumlet.io/media/28715/mela.png" alt="USP Image">
            
        </div>

        <!-- Right Side -->
        <div class="usp-right">
            <div class="usp-box">
                <i class="fa-brands fa-product-hunt"></i>
                <h3>ЁЯРД Wide Product Coverage</h3>
                <p>Supports Cow, Buffalo, Goat, Sheep, Camel, Chicken, Fish, Poultry & Dairy Products.</p>
            </div>

            <div class="usp-box">
                <i class="fa-solid fa-person-circle-check"></i>
                <h3>тЪб Simple & Easy to Use</h3>
                <p>Quick registration, easy listing process, and user-friendly interface for everyone.</p>
            </div>

            <div class="usp-box">
                <i class="fa-solid fa-indian-rupee-sign"></i>
                <h3>ЁЯТ░ Fair Market Pricing</h3>
                <p>More visibility brings more enquiries, helping sellers get the right market value.</p>
            </div>
        </div>

    </div>
</section>

<!--=====================================
            FEATURE PART START
=======================================-->
<!--<section class="section feature-part">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-md-5 col-lg-5">-->
<!--                <div class="section-side-heading">-->
<!--                    <h2>Find your needs in our best <span>Featured Ads</span></h2>-->
<!--                    <p>Explore our top-rated featured ads to find exactly what you need. From the latest gadgets to essential services, we offer a curated selection of trusted sellers and great deals. Whether you're shopping or booking services, our featured ads ensure quality and convenience for a smooth experience every time.</p>-->
<!--                    <div class="price-btn mobile-view-btn">-->
<!--                    <a class='btn btn-inline' href="{{route('list-all-ads', array('type' => 'featured'))}}">-->
<!--                        <i class="fas fa-eye"></i>-->
<!--                        <span>View All Featured Ads</span>-->
<!--                    </a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-7 col-lg-7">-->
<!--                <div class="feature-card-slider slider-arrow">-->
<!--                    @if(count($featureAds) > 0)-->
<!--                    @foreach ($featureAds as $fad) -->
<!--                    <div class="feature-card" onclick="window.location.href='{{route('ad-details', [base64_encode($fad->id), $fad->slug])}}'">-->
<!--                        <a href="{{route('ad-details', [base64_encode($fad->id), $fad->slug])}}" class="feature-img">-->
<!--                            @if(isset($fad->adImage) && count($fad->adImage)>0)-->
<!--                               <img src="{{ asset('storage').'/'.$fad->adImage[0]->image}}" alt="product">-->
<!--                            @else-->
<!--                                <img src="{{asset('front/images/no-image.jpeg')}}" alt="product">-->
<!--                            @endif-->
<!--                        </a>-->
<!--                        <div class="cross-inline-badge feature-badge">-->
<!--                            <span>featured</span>-->
<!--                            <i class="fas fa-book-open"></i>-->
<!--                        </div>-->
                        
<!--                        <div class="feature-content">-->
<!--                            <ol class="breadcrumb feature-category mt-1">-->
<!--                              @if(isset($fad->category))  <li class="breadcrumb-item"><a href="#">{{$fad->category->name ?? ''}}</a></li>  @endif-->
<!--                                <li class="breadcrumb-item active" aria-current="page" style="color:#fff;">{{$fad->title ?? ''}}</li>-->
<!--                            </ol>-->
<!--                            <h3 class="feature-title"><a href="{{route('ad-details', [base64_encode($fad->id), $fad->slug])}}">{{Str::of($fad->description)->words(10, ' ...')}}</a></h3>-->
<!--                            <div class="feature-meta">-->
<!--                                <span class="feature-price">тВ╣ {{$fad->price}}</span>-->
<!--                                <div class="d-flex justify-content-between">-->
<!--                                <span class="feature-time"><i class="fas fa-clock"></i>{{$fad->created_at->diffForHumans()}}</span>&nbsp;&nbsp;-->
<!--                                <span class="feature-time text-right"><i class="fas fa-eye"></i>{{$fad->views ?? '0'}}</span>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    @endforeach-->
<!--                    @endif-->
<!--                </div>-->
                
<!--                <div class="feature-thumb-slider">-->
<!--                @if(count($featureAds) > 0)-->
<!--                @foreach ($featureAds as $fad)-->
<!--                    @if(isset($fad->adImage) && count($fad->adImage)>0)-->
<!--                    <div class="feature-thumb"><img src="{{asset('storage').'/'.$fad->adImage[0]->image}}" alt="product"></div>-->
<!--                    @else-->
<!--                    <div class="feature-thumb"><img src="{{asset('front/images/no-image.jpeg')}}" alt="product"></div>-->
<!--                    @endif-->
<!--                @endforeach-->
<!--                @endif-->
<!--                 </div>-->
<!--                                    <div class="price-btn desktop-view-btn mt-3">-->
<!--                    <a class='btn btn-inline' href="{{route('list-all-ads', array('type' => 'featured'))}}">-->
<!--                        <i class="fas fa-eye"></i>-->
<!--                        <span>View All Featured Ads</span>-->
<!--                    </a>-->
<!--                    </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
<!--=====================================
            FEATURE PART END
=======================================-->


<!--=====================================
            RECOMEND PART START
=======================================-->
 <section class="section recomend-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2>Recently Added Listings</h2>
                        <p><strong>Explore the latest livestock and dairy listings added to PashuGhar.</strong><br>
                        <span>
Stay updated with new ads posted by sellers across different categories and locations.</span></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="recomend-slider slider-arrow">
                    @if(count($recommendAds) > 0)
                    @foreach ($recommendAds as $rad) 
                        <div class="product-card" onclick="window.location.href='{{route('ad-details', [$rad->category->name,$rad->slug])}}'">
                            <div class="product-media">
                                <div class="product-img">
                                    @if(isset($rad->adImage) && count($rad->adImage)>0)
                                    <img src="{{ asset('storage').'/'.$rad->adImage[0]->image}}" alt="product">
                                    @else
                                    <img src="{{asset('front/images/no-image.jpeg')}}" alt="product">
                                    @endif
                                </div>
                                <div class="cross-vertical-badge product-badge">
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>recommend</span>
                                </div>
                                <div class="product-type">
                                  
                                </div>
                                
                            </div>
                            <div class="product-content">
                                <ol class="breadcrumb product-category mt-1">
                                   @if(isset($rad->category)) <li class="breadcrumb-item"><a href="#">{{$rad->category->name ?? ''}}</a></li> @endif
                                    <!--<li class="breadcrumb-item active" aria-current="page">{{$rad->title ?? ''}}</li>-->
                                </ol>
                                <h5 class="product-title">
                                    <a href="{{route('ad-details', [$rad->category->name,$rad->slug])}}">{{Str::of($rad->title)->words(9, ' ...')}}</a>
                                </h5>
                                <div class="product-meta">
                                    
                                    <span style="display:flex;"><i class="fas fa-map-marker-alt" style="font-size: 14px;
    margin-top: 5px;"></i>{{$rad->author_address ?? ''}}</span>
                                    
                                    
                                </div>
                                 <div class="product-meta">
                                    
                                    <span><i class="fas fa-clock"></i>{{$rad->created_at->diffForHumans()}}</span>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-price">тВ╣ {{$rad->price}}</h5>
                                    <div class="product-btn">
                                    <span><i class="fas fa-eye"></i> {{$rad->views}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                        @endif    
                        
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-50">
                                            <div class="price-btn">
                    <a class='btn btn-inline' href="{{route('list-all-ads', array('type' => 'recommend'))}}">
                            <i class="fas fa-eye"></i>
                            <span>Show All Ads</span>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

<section class="seller-section">

    <h2 class="main-heading">Start Your Journey with PashuGhar.com</h2>
    <p class="main-desc">
        PashuGhar.com helps livestock and dairy sellers reach genuine buyers through a simple,
        transparent, and free platform.
    </p>

    <div class="seller-container">

        <!-- LEFT IMAGE -->
        <div class="seller-image">
            <img src="{{ asset('front/images/stepimage1.png') }}" alt="">
        </div>

        <!-- RIGHT CONTENT -->
        <div class="seller-content">
            <div class="steps">

                <!-- Step 1 -->
                <div class="step-card">
                    <div class="dot"></div>
                    <h4>Step 1</h4>
                    <h3>Register & Create Your Account</h3>
                    <p>
                        Create your seller account on PashuGhar.com to start listing livestock 
                        and dairy products. / <br>
                        PashuGhar.com рдкрд░ рдЕрдкрдирд╛ seller account рдмрдирд╛рдПрдВ рдФрд░ listing рд╢реБрд░реВ рдХрд░реЗрдВред
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="step-card active">
                    <div class="dot green"></div>
                    <h4>Step 2</h4>
                    <h3>List Your Livestock or Dairy Products</h3>
                    <p>
                        Add photos, quantity, location, and price details. You can list multiple 
                        livestock or products. / <br>
                        рдлреЛрдЯреЛ, рд╕рдВрдЦреНрдпрд╛, рд╕реНрдерд╛рди рдФрд░ рджрд╛рдо рдХреА рдЬрд╛рдирдХрд╛рд░реА рдбрд╛рд▓реЗрдВред рдЖрдк рдПрдХ рд╕реЗ рдЕрдзрд┐рдХ рдкрд╢реБ рдпрд╛ рдЙрддреНрдкрд╛рдж list рдХрд░ рд╕рдХрддреЗ рд╣реИрдВред
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="step-card active">
                    <div class="dot green"></div>
                    <h4>Step 3</h4>
                    <h3>Reach Local & Global Buyers</h3>
                    <p>
                        Your listings become visible to buyers across locations, helping you get wider reach. / <br>
                        рдЖрдкрдХреА listing рд▓реЛрдХрд▓ рдФрд░ рдЕрдВрддрд░рд░рд╛рд╖реНрдЯреНрд░реАрдп buyers рдХреЛ рджрд┐рдЦрд╛рдИ рджреЗрддреА рд╣реИ, рдЬрд┐рд╕рд╕реЗ рдкрд╣реБрдБрдЪ рдмрдврд╝рддреА рд╣реИред
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="step-card active">
                    <div class="dot green"></div>
                    <h4>Step 4</h4>
                    <h3>Receive Direct Enquiries</h3>
                    <p>
                        Buyers contact you directly via call or WhatsApp тАФ no brokers involved. / <br>
                        рдЦрд░реАрджрд╛рд░ рдЖрдкрд╕реЗ рд╕реАрдзреЗ call рдпрд╛ WhatsApp рдХреЗ рдорд╛рдзреНрдпрдо рд╕реЗ рд╕рдВрдкрд░реНрдХ рдХрд░рддреЗ рд╣реИрдВ тАФ рдмрд┐рдирд╛ рдХрд┐рд╕реА рджрд▓рд╛рд▓ рдХреЗред
                    </p>
                </div>

                <!-- Step 5 -->
                <div class="step-card active">
                    <div class="dot green"></div>
                    <h4>Step 5</h4>
                    <h3>Negotiate & Close the Deal</h3>
                    <p>
                        Discuss price and delivery directly with buyers and complete the deal 
                        with confidence. / <br>
                        рджрд╛рдо рдФрд░ рдбрд┐рд▓реАрд╡рд░реА рдХреА рд╢рд░реНрддреЗрдВ рд╕реАрдзреЗ buyer рд╕реЗ рддрдп рдХрд░реЗрдВ рдФрд░ рд╕реМрджрд╛ рдкреВрд░рд╛ рдХрд░реЗрдВред
                    </p>
                </div>

            </div>

            <!-- CLOSING LINE BOX -->
            
        </div>

    </div>
    <div class="closing-box">
    <p style="margin:0px;">Simple process. Transparent deals. Better market access for sellers.</p>

    <a href="{{route('user.login')}}" class="closing-btn">Register Now</a>
</div>

</section>

 <section class="section recomend-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2>Recommended Listings</h2>
                        <p><strong>Highlighted listings selected for better visibility.</strong><br><span>
These sponsored ads help buyers discover relevant livestock and dairy products faster.</span></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="recomend-slider slider-arrow">
                    @if(count($recommendAds) > 0)
                    @foreach ($recommendAds as $rad) 
                        <div class="product-card" onclick="window.location.href='{{route('ad-details', [$rad->category->name,$rad->slug])}}'">
                            <div class="product-media">
                                <div class="product-img">
                                    @if(isset($rad->adImage) && count($rad->adImage)>0)
                                    <img src="{{ asset('storage').'/'.$rad->adImage[0]->image}}" alt="product">
                                    @else
                                    <img src="{{asset('front/images/no-image.jpeg')}}" alt="product">
                                    @endif
                                </div>
                                <div class="cross-vertical-badge product-badge">
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>recommend</span>
                                </div>
                                <div class="product-type">
                                  
                                </div>
                                
                            </div>
                            <div class="product-content">
                                <ol class="breadcrumb product-category mt-1">
                                   @if(isset($rad->category)) <li class="breadcrumb-item"><a href="#">{{$rad->category->name ?? ''}}</a></li> @endif
                                    <!--<li class="breadcrumb-item active" aria-current="page">{{$rad->title ?? ''}}</li>-->
                                </ol>
                                <h5 class="product-title">
                                    <a href="{{route('ad-details', [$rad->category->name,$rad->slug])}}">{{Str::of($rad->title)->words(9, ' ...')}}</a>
                                </h5>
                                <div class="product-meta">
                                    
                                    <span style="display:flex;"><i class="fas fa-map-marker-alt" style="font-size: 14px;
    margin-top: 5px;"></i>{{$rad->author_address ?? ''}}</span>
                                    
                                    
                                </div>
                                 <div class="product-meta">
                                    
                                    <span><i class="fas fa-clock"></i>{{$rad->created_at->diffForHumans()}}</span>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-price">тВ╣ {{$rad->price}}</h5>
                                    <div class="product-btn">
                                    <span><i class="fas fa-eye"></i> {{$rad->views}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                        @endif    
                        
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-50">
                                            <div class="price-btn">
                    <a class='btn btn-inline' href="{{route('list-all-ads', array('type' => 'recommend'))}}">
                            <i class="fas fa-eye"></i>
                            <span>Show All Ads</span>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--=====================================
            TREND PART START
=======================================-->

<!--=====================================
            TREND PART END
=======================================-->
<section class="faq-section">

    <div class="faq-container">

        <!-- LEFT SIDE FAQ -->
        <div class="faq-left">

            <h2 class="faq-title">Frequently Asked Questions</h2>

            <div class="faq-box">
     @if(count($faqs) > 0)
    @foreach ($faqs as $faq) 
    <div class="faq-item">
        <div class="faq-question-row">
            <h3 class="faq-question">{{$faq->qustion}}</h3>
            <span class="faq-icon">+</span>
        </div>
        <div class="faq-answer">
    {!! $faq->answer !!}
</div>
    </div>
 
    @endforeach
    @endif    
    

   

</div>


        </div>

        <!-- RIGHT SIDE ENQUIRY FORM -->
        <div class="faq-right">

            <div class="faq-form-card">

                <h2 class="faq-form-title">Send Us an Enquiry</h2>
                <p class="faq-form-sub">
                    Have questions? Need help? Submit your enquiry and our team will reach out soon.
                </p>

                <form class="faq-form" id="homeenquiryForm">
                    @csrf
                    <input type="text" class="faq-input" name="full_name" placeholder="Full Name" value="{{ old('full_name') }}">
                    
                    <input type="email" name="email_address" id="email-address" class="faq-input" placeholder="Email Address" value="{{ old('email_address') }}">

                    <div class="faq-phone-group">
                        <select class="faq-country" name="country_code">
                            <option value="+91">ЁЯЗоЁЯЗ│ +91</option>
                            </select>
                    
                        <input type="tel" onkeypress="return isNumber(event)" class="faq-input phone-input" name="mobile_number" id="mobile-number" autocomplete="off" placeholder="Mobile Number" value="{{ old('mobile_number') }}">
                        <p id="verified_badge" style="color:green;display:none;">Verified</p>
                    </div>
                    <input type="tel" name="mobile" id="mob_in" class="form-control" style="display:none;" />

                    <input type="text" name="isValid" id="is_valid_number" value="0" class="form-control" style="display:none;" />

                    <div class="form-group mb-2" id="otp_field" style="display: none;">
                        <input
                            type="text"
                            class="form-control"
                            id="otp"
                            name="otp"
                            placeholder="Enter OTP"
                            maxlength="6"
                        />
                    </div>

                    <button type="button" class="otp-btn mb-2" id="send-otp-bt" onclick="sendOTP()">
                        Send OTP
                    </button>

                    <button type="button" class="otp-btn mb-2" id="verify-otp-bt" style="display: none;" onclick="verifyOTP()">
                        Verify
                    </button>
                    <button type="button" class="otp-btn mb-2" id="resend-otp-bt" style="display:none;" onclick="sendOTP()">Re-Send OTP</button>

                    <textarea name="message" class="faq-textarea" rows="4" placeholder="Write your message...">{{ old('message') }}</textarea>
                        <div class="col-md-12">
                            <div class="g-recaptcha mb-2" data-sitekey={{ config('services.recaptcha.key') }}></div>
                        </div>

                    <button type="submit" class="faq-btn">Submit Enquiry</button>

                </form>

            </div>

        </div>

    </div>

</section>
<!--<section class="section trend-part">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-lg-12">-->
<!--                <div class="section-center-heading">-->
<!--                    <h2>Most Popular Listings</h2>-->
<!--                    <p><strong>Listings that are getting the most attention from buyers.</strong><br><span>See livestock and dairy ads that are viewed frequently on the platform.</span></p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row justify-content-center">-->
<!--        @if(count($trendingAds) > 0)-->
<!--        @foreach ($trendingAds as $tad) -->
<!--            <div class="col-md-11 col-lg-8 col-xl-6">-->
<!--                <div class="product-card standard" onclick="window.location.href='{{route('ad-details', [$tad->category->name,$tad->slug])}}'">-->
<!--                    <div class="product-media">-->
<!--                        <div class="product-img" style="width:250px; height:100%;">-->
<!--                            @if(isset($tad->adImage) && count($tad->adImage)>0)-->
<!--                               <img src="{{ asset('storage').'/'.$tad->adImage[0]->image}}" alt="product" style="height:220px;">-->
<!--                            @else-->
<!--                                <img src="{{ asset('front/images/no-image.jpeg')}}" alt="product">-->
<!--                            @endif-->
<!--                        </div>-->
<!--                        <div class="cross-vertical-badge product-badge">-->
<!--                            <i class="fas fa-bolt"></i>-->
<!--                            <span>trending</span>-->
<!--                        </div>-->
                        
                        
<!--                    </div>-->
<!--                    <div class="product-content">-->
<!--                        <ol class="breadcrumb product-category mt-1">-->
<!--                          @if(isset($tad->category))    <li class="breadcrumb-item"><a href="#">{{$tad->category->name ?? '0'}}</a></li> @endif-->
                            <!--<li class="breadcrumb-item active" aria-current="page">{{$tad->title ?? ' '}}</li>-->
<!--                        </ol>-->
<!--                        <h5 class="product-title">-->
<!--                        <a href="{{route('ad-details', [$tad->category->name,$tad->slug])}}">{{Str::of($tad->title)->words(10, ' ...')}}</a>-->
<!--                        </h5>-->
<!--                        <div class="product-meta">-->
                                    
<!--                                    <span style="display:flex;"><i class="fas fa-map-marker-alt" style="font-size: 14px;-->
<!--    margin-top: 5px;"></i>{{$rad->author_address ?? ''}}</span>-->
                                    
                                    
<!--                                </div>-->
<!--                                 <div class="product-meta">-->
                                    
<!--                                    <span><i class="fas fa-clock"></i>{{$rad->created_at->diffForHumans()}}</span>-->
<!--                                </div>-->
<!--                        <div class="product-info">-->
<!--                            <h5 class="product-price">тВ╣ {{$tad->price ?? '0'}}</h5>-->
<!--                            <div class="product-btn">-->
<!--                            <span><i class="fas fa-eye"></i> {{$tad->views}}</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            @endforeach-->
<!--                    @endif-->
<!--        </div>-->
<!--        <div class="row">-->
<!--            <div class="col-lg-12">-->
<!--                <div class="center-20">-->
<!--                                        <div class="price-btn">-->
<!--                    <a class='btn btn-inline' href="{{route('list-all-ads', array('type' => 'trending'))}}">-->
<!--                        <i class="fas fa-eye"></i>-->
<!--                        <span>View All Most Popular Listings</span>-->
<!--                    </a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
 <section class="section recomend-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2>Most Popular Listings</h2>
                        <p><strong>Listings that are getting the most attention from buyers.</strong><br><span>See livestock and dairy ads that are viewed frequently on the platform.</span></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="recomend-slider slider-arrow">
                    @if(count($recommendAds) > 0)
                    @foreach ($recommendAds as $rad) 
                        <div class="product-card" onclick="window.location.href='{{route('ad-details', [$rad->category->name,$rad->slug])}}'">
                            <div class="product-media">
                                <div class="product-img">
                                    @if(isset($rad->adImage) && count($rad->adImage)>0)
                                    <img src="{{ asset('storage').'/'.$rad->adImage[0]->image}}" alt="product">
                                    @else
                                    <img src="{{asset('front/images/no-image.jpeg')}}" alt="product">
                                    @endif
                                </div>
                                <div class="cross-vertical-badge product-badge">
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>recommend</span>
                                </div>
                                <div class="product-type">
                                  
                                </div>
                                
                            </div>
                            <div class="product-content">
                                <ol class="breadcrumb product-category mt-1">
                                   @if(isset($rad->category)) <li class="breadcrumb-item"><a href="#">{{$rad->category->name ?? ''}}</a></li> @endif
                                    <!--<li class="breadcrumb-item active" aria-current="page">{{$rad->title ?? ''}}</li>-->
                                </ol>
                                <h5 class="product-title">
                                    <a href="{{route('ad-details', [$rad->category->name,$rad->slug])}}">{{Str::of($rad->title)->words(9, ' ...')}}</a>
                                </h5>
                                <div class="product-meta">
                                    
                                    <span style="display:flex;"><i class="fas fa-map-marker-alt" style="font-size: 14px;
    margin-top: 5px;"></i>{{$rad->author_address ?? ''}}</span>
                                    
                                    
                                </div>
                                 <div class="product-meta">
                                    
                                    <span><i class="fas fa-clock"></i>{{$rad->created_at->diffForHumans()}}</span>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-price">тВ╣ {{$rad->price}}</h5>
                                    <div class="product-btn">
                                    <span><i class="fas fa-eye"></i> {{$rad->views}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                        @endif    
                        
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-50">
                                            <div class="price-btn">
                    <a class='btn btn-inline' href="{{route('list-all-ads', array('type' => 'recommend'))}}">
                            <i class="fas fa-eye"></i>
                            <span>Show All Ads</span>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        
  

<!--=====================================
            RECOMEND PART START
=======================================-->








<!--=====================================
            CATEGORY PART START
=======================================-->

{{--
<section class="section category-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Top Categories by <span>Ads</span></h2>
                    <p>
                        Browse our top categories, featuring the most popular ads across various sections. Find the best deals and services tailored to your needs.</p>
                </div>
            </div>
        </div>
        <div class="row desktop-category">
            @if(isset($pageCategories) && count($pageCategories)>0)
            @foreach($pageCategories as $pcategory)

            @php  //dd($pcategory); 
             @endphp
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="category-card">
                    <div class="category-head">
                       
                        @if($pcategory->bottom_categories=='yes')
                        <img src="{{asset('storage')}}/{{$pcategory->bottom_image}}" alt="car">
                        
                            @else
                       
                        <img src="{{asset('storage')}}/{{$pcategory->image}}" alt="car">
                        @endif
                       
                        <a href="{{route('category-details', $pcategory->slug)}}" class="category-content">
                            <h4>{{$pcategory->name}}</h4>
                            <p>({{isset($pcategory->ads) && $pcategory->ads !='' ? $pcategory->ads->where('status', 'Published')->count() : 0}})</p>
                        </a>
                    </div>
                    <!-- <ul class="category-list">
                        @if(isset($pcategory->subcategory) && count($pcategory->subcategory)>0)
                        @foreach($pcategory->subcategory as $subcat)
                        @php
                        $slugName = strtolower(str_replace('_', '-', str_replace(' ', '-', $subcat->name)));
                        @endphp
                        <li><a href="#"><h6>{{$subcat->name}}</h6><p>({{isset($subcat->ads) && $subcat->ads !='' ? $subcat->ads->where('status', 'Published')->count() : 0}})</p></a></li>
                        @endforeach
                        @endif
                    </ul> -->
                </div>
            </div>
            @endforeach
            @endif
            
        </div>
          <div class=" mobile-category">
            @if(isset($pageCategories) && count($pageCategories)>0)
            @foreach($pageCategories as $pcategory)

            @php  //dd($pcategory); 
             @endphp
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <div class="category-card">
                    <div class="category-head">
                       
                        @if($pcategory->bottom_categories=='yes')
                        <img src="{{asset('storage')}}/{{$pcategory->bottom_image}}" alt="car">
                        
                            @else
                       
                        <img src="{{asset('storage')}}/{{$pcategory->image}}" alt="car">
                        @endif
                       
                        <a href="{{route('category-details', $pcategory->slug)}}" class="category-content">
                            <h4>{{$pcategory->name}}</h4>
                            <p>({{isset($pcategory->ads) && $pcategory->ads !='' ? $pcategory->ads->where('status', 'Published')->count() : 0}})</p>
                        </a>
                    </div>
                    <ul class="category-list">
                        @if(isset($pcategory->subcategory) && count($pcategory->subcategory)>0)
                        @foreach($pcategory->subcategory as $subcat)
                        @php
                        $slugName = strtolower(str_replace('_', '-', str_replace(' ', '-', $subcat->name)));
                        @endphp
                        <li><a href="#"><h6>{{$subcat->name}}</h6><p>({{isset($subcat->ads) && $subcat->ads !='' ? $subcat->ads->where('status', 'Published')->count() : 0}})</p></a></li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            @endforeach
            @endif
            
        </div>
        @if(count($pageCategories)>=8)
        <div class="row">
            <div class="col-lg-12">
                <div class="center-20">
                                        <div class="price-btn">
                    <a class='btn btn-inline' href="{{route('list-categories')}}">
                        <i class="fas fa-eye"></i>
                        <span>Post Your Ad</span>
                    </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!--<div class="row">-->
        <!--    <div class="col-lg-12">-->
        <!--        <div class="center-20">-->
        <!--            <a class='btn btn-inline' href="{{route('list-categories')}}">-->
        <!--                <i class="fas fa-eye"></i>-->
        <!--                <span>view all categories</span>-->
        <!--            </a>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->


    </div>
</section>
--}}
<!--=====================================
            CATEGORY PART END
=======================================-->


<!--=====================================
            INTRO PART START
=======================================-->
{{--
<section class="intro-part" style="margin-top:0px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Do you have something to advertise?</h2>
                    <p>Have something to advertise? Reach a wider audience by promoting your products or services with us. Boost visibility, attract more customers, and grow your business with our effective advertising platform.</p>
                                        <div class="price-btn mb-3">
                    <a class='btn btn-outline' href="{{route('user.post-your-ad')}}">
                        <i class="fas fa-plus-circle"></i>
                        <span>Post Your Ad</span>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
--}}
<!--=====================================
            INTRO PART END
=======================================-->


<!--=====================================
                PRICE PART START
=======================================-->
{{--
<section class="price-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Best Reliable Pricing Plans</h2>
                    <p>All active or live ads will expire on Subscription Expiry Date</p>
                </div>
            </div>
        </div>
        <div class=" desktop-category subs-price ">
          
                
            
        @if(isset($subscriptions) && count($subscriptions)>0)
            @foreach($subscriptions as $subscription)
            <div class="col-md-6 col-lg-3 mb-4 price-card-list">
                <div class="price-card">
                    <div class="price-head">
                         <h4>{{$subscription->name}}</h4>
                        <i class="{{$subscription->icon}}"></i>
                        @if($subscription->discount > 0 && $subscription->offer_price > 0)
                        <h3><span style="font-size:20px">тВ╣</span> {{$subscription->offer_price}} <strike class="strike">{{$subscription->mrp}}</strike> <span class="discount">{{$subscription->discount}}%</span></h3>
                        @else
                        <h3><span style="font-size:20px">тВ╣</span> {{$subscription->offer_price}}</h3>
                        @endif
                       <div class="price-btn">
                        @if(Auth::guard('member')->user() !='' && !empty(Auth::guard('member')->user()))
                            @if($subscription->offer_price == 0)
                                @if(Auth::guard('member')->user()->is_buy_free_subscription == 0)
                                    @if(Auth::guard('member')->user()->state != '')
                                    <button class='btn btn-inline pay_now' name="pay_now" id="pay_now" subscription_id="{{$subscription->id}}"><i class="fas fa-sign-in-alt"></i><span>Free Subscription</span></button>
                                    @else
                                        <a class='btn btn-inline'  href="{{route('user.settings')}}"><i class="fas fa-sign-in-alt"></i><span>Free Subscription</span></a>
                                    @endif
                                @else
                                <a href="javascript:void(0);" class='btn btn-inline' onclick="return confirm('Your buy free subscription limit end');"><i class="fas fa-sign-in-alt"></i><span>Free Subscription</span></a>
                                @endif

                            @else
                                @if(Auth::guard('member')->user()->no_of_ads == 0 || Auth::guard('member')->user()->expiry_date < date('Y-m-d'))
                                <a class='btn btn-inline' href="{{route('user.checkout', Crypt::encrypt($subscription->id))}}">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>Buy Now</span>
                                </a>
                                
                                @else
                                <a href="javascript:void(0);" class='btn btn-inline' onclick="return confirm('Ads are already available to publish in your active subscription. Please use all the ads in the bucket first.');"><i class="fas fa-sign-in-alt"></i><span>Buy Subscription</span></a>
                                @endif
                            @endif
                        @else
                        <a class='btn btn-inline'  href="{{route('user.login')}}"><i class="fas fa-sign-in-alt"></i><span>Buy Subscription</span></a>
                        @endif
                    </div>
                    </div>
                    
                    <ul class="price-list" style="padding-left:0px;">
                         <li>
                            <i class="fas fa-check"></i>
                            <p>{{$subscription->no_of_ads}} &nbsp; Ads Post  </p>
                            
                        </li>
                        @if(isset($subscription->features) && count($subscription->features) > 0)
                        @foreach($subscription->features as $feature)
                        <li>
                            <i class="{{$feature->is_available == 1 ? 'fas fa-check' : 'fas fa-times'}}"></i>
                            <p>{{$feature->feature}}</p>
                        </li>
                        @endforeach
                        @endif
                        
                          <li>
                            <i class="fas fa-check"></i> 
                            <p>{{$subscription->subscription_validity}} &nbsp;Days Validity</p>
                            
                        </li>
                    </ul>
                    
                </div>
            </div>
            @endforeach
            @endif
            </div>
       
        <div class=" mobile-category">
        @if(isset($subscriptions) && count($subscriptions)>0)
            @foreach($subscriptions as $subscription)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="price-card">
                    <div class="price-head">
                        <i class="{{$subscription->icon}}"></i>
                        <h3>тВ╣ {{$subscription->offer_price}}</h3>
                        <h4>{{$subscription->name}}</h4>
                    </div>
                    <ul class="price-list">
                         <li>
                            <i class="fas fa-plus"></i> {{$subscription->no_of_ads}} &nbsp; Ads Post  
                            
                        </li>
                        @if(isset($subscription->features) && count($subscription->features) > 0)
                        @foreach($subscription->features as $feature)
                        <li>
                            <i class="{{$feature->is_available == 1 ? 'fas fa-plus' : 'fas fa-times'}}"></i>
                            <p>{{$feature->feature}}</p>
                        </li>
                        @endforeach
                        @endif
                        
                          <li>
                            <i class="fas fa-plus"></i> {{$subscription->subscription_validity}} &nbsp;Days Validity
                            
                        </li>
                    </ul>
                    <div class="price-btn">
                        @if(Auth::guard('member')->user() !='' && !empty(Auth::guard('member')->user()))
                            @if($subscription->offer_price == 0)
                                @if(Auth::guard('member')->user()->is_buy_free_subscription == 0)
                                    @if(Auth::guard('member')->user()->state != '')
                                    <button class='btn btn-inline pay_now' name="pay_now" id="pay_now" subscription_id="{{$subscription->id}}"><i class="fas fa-sign-in-alt"></i><span>Free Subscription</span></button>
                                    @else
                                        <a class='btn btn-inline'  href="{{route('user.settings')}}"><i class="fas fa-sign-in-alt"></i><span>Free Subscription</span></a>
                                    @endif
                                @else
                                <a href="javascript:void(0);" class='btn btn-inline' onclick="return confirm('Your buy free subscription limit end');"><i class="fas fa-sign-in-alt"></i><span>Free Subscription</span></a>
                                @endif

                            @else
                                @if(Auth::guard('member')->user()->no_of_ads == 0 || Auth::guard('member')->user()->expiry_date < date('Y-m-d'))
                                <a class='btn btn-inline' href="{{route('user.checkout', Crypt::encrypt($subscription->id))}}">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>Buy Now</span>
                                </a>
                                
                                @else
                                <a href="javascript:void(0);" class='btn btn-inline' onclick="return confirm('Ads are already available to publish in your active subscription. Please use all the ads in the bucket first.');"><i class="fas fa-sign-in-alt"></i><span>Buy Subscription</span></a>
                                @endif
                            @endif
                        @else
                        <a class='btn btn-inline'  href="{{route('user.login')}}"><i class="fas fa-sign-in-alt"></i><span>Buy Subscription</span></a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>
--}}
<!--=====================================
                PRICE PART END
=======================================-->

<!-- Swiper CSS -->


<section class="cta-section">

    <div class="cta-container">

        <h2 class="cta-heading">Ready to Get Started with PashuGhar?</h2>

        <p class="cta-subheading">
            PashuGhar.com connects livestock and dairy buyers and sellers on one simple platform.
        </p>

        <p class="cta-content">
            Whether you want to buy or sell, you can get started in just a few steps. 
            Create your account, explore listings, or post your livestock to reach genuine buyers. 
            Choose your role below and continue.
        </p>

        <div class="cta-btn-group">
            <a href="#" class="cta-btn buyer">IтАЩm a Buyer</a>
            <a href="#" class="cta-btn seller">IтАЩm a Seller</a>
        </div>

    </div>

</section>
  <section class="section recomend-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2>Recently Viewed Listings</h2>
                        <p><strong>Quick access to listings you checked earlier.</strong><br><span> Continue where you left off and compare options without searching again.</p> </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="recomend-slider slider-arrow">
                    @if(count($recommendAds) > 0)
                    @foreach ($recommendAds as $rad) 
                        <div class="product-card" onclick="window.location.href='{{route('ad-details', [$rad->category->name,$rad->slug])}}'">
                            <div class="product-media">
                                <div class="product-img">
                                    @if(isset($rad->adImage) && count($rad->adImage)>0)
                                    <img src="{{ asset('storage').'/'.$rad->adImage[0]->image}}" alt="product">
                                    @else
                                    <img src="{{asset('front/images/no-image.jpeg')}}" alt="product">
                                    @endif
                                </div>
                                <div class="cross-vertical-badge product-badge">
                                    <i class="fas fa-clipboard-check"></i>
                                    <span>recommend</span>
                                </div>
                                <div class="product-type">
                                  
                                </div>
                                
                            </div>
                            <div class="product-content">
                                <ol class="breadcrumb product-category mt-1">
                                   @if(isset($rad->category)) <li class="breadcrumb-item"><a href="#">{{$rad->category->name ?? ''}}</a></li> @endif
                                    <li class="breadcrumb-item active" aria-current="page">{{$rad->title ?? ''}}</li>
                                </ol>
                                <h5 class="product-title">
                                    <a href="{{route('ad-details', [$rad->category->name,$rad->slug])}}">{{Str::of($rad->description)->words(4, ' ...')}}</a>
                                </h5>
                                <div class="product-meta">
                                    <span><i class="fas fa-map-marker-alt"></i>{{$rad->author_address ?? ''}}</span>
                                    
                                </div>
                                 <div class="product-meta">
                                    
                                    <span><i class="fas fa-clock"></i>{{$rad->created_at->diffForHumans()}}</span>
                                </div>
                                <div class="product-info">
                                    <h5 class="product-price">тВ╣ {{$rad->price}}</h5>
                                    <div class="product-btn">
                                    <span><i class="fas fa-eye"></i> {{$rad->views}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
                        @endif    
                        
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-50">
                        
                                            <div class="price-btn">
                    <a class='btn btn-inline' href="{{route('list-all-ads', array('type' => 'recommend'))}}">
                            <i class="fas fa-eye"></i>
                            <span>Show All Ads</span>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="testi-section">
    <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2>Voices from the Livestock & Dairy Products Community</h2>
                        <p> What farmers, traders, and buyers expect from a modern livestock platform.</p>
                    </div>
                </div>
            </div>
   

    <div class="swiper testi-swiper" style="padding:40px 40px;">
        <div class="swiper-wrapper">

            <!-- CARD 1 -->
            <div class="swiper-slide">
                <div class="testi-card">

                    <!--<h4 class="testi-name">Seller Perspective</h4>-->
                    <div class="testi-rating">тШЕтШЕтШЕтШЕтШЕ</div>
                    <p class="testi-text">тАЬPashuGhar looks like a much-needed platform for livestock sellers.
The idea of listing animals for free and connecting directly with buyers is very helpful.тАЭ</p>
<p>тАФ Livestock Seller</p>
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="swiper-slide">
                <div class="testi-card">
                    <!--<img src="https://sipl.ind.in/wp-content/uploads/2022/07/dummy-user.png" class="testi-img" alt="">-->
                    <!--<h4 class="testi-name">Aman Verma</h4>-->
                    <div class="testi-rating">тШЕтШЕтШЕтШЕтШЕ</div>
                    <p class="testi-text">тАЬSelling livestock beyond the local market has always been difficult.
A platform like PashuGhar can make the process easier and more transparent.тАЭ</p>
<p>тАФ Farmer</p>
                </div>
            </div>

            <!-- CARD 3 -->
            <div class="swiper-slide">
                <div class="testi-card">
                    
                    <!--<h4 class="testi-name">Sneha Patel</h4>-->
                    <div class="testi-rating">тШЕтШЕтШЕтШЕтШЖ</div>
                    <p class="testi-text">тАЬFinding genuine livestock sellers online is not easy.
PashuGharтАЩs classified approach seems simple and useful for buyers like us.тАЭ</p>
<p>тАФ Livestock Buyer</p>
                </div>
            </div>

            <!-- CARD 4 -->
            <div class="swiper-slide">
                <div class="testi-card">
                    
                    
                    <div class="testi-rating">тШЕтШЕтШЕтШЕтШЕ</div>
                    <p class="testi-text">тАЬDirect communication with buyers without middlemen is a big advantage.
PashuGhar appears to solve a real problem in livestock and dairy trading.тАЭ</p>
<p>тАФ Dairy Product Seller</p>
                </div>
            </div>
             <div class="swiper-slide">
                <div class="testi-card">
                    
                    
                    <div class="testi-rating">тШЕтШЕтШЕтШЕтШЕ</div>
                    <p class="testi-text">тАЬA single platform for livestock and dairy listings can save a lot of time.
PashuGhar has strong potential for both retail and bulk sellers.тАЭ</p>
<p>тАФ Livestock Trader</p>
                </div>
            </div>

        </div>

        <!-- SLIDER CONTROLS -->
        <!--<div class="testi-prev">тЭо</div>-->
        <!--<div class="testi-next">тЭп</div>-->
        <div class="swiper-pagination"></div>
    </div>
</section>
<!-- Swiper JS -->


<!--=====================================
                BLOG PART START
=======================================-->
<section class="blog-part">
    <!--div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-center-heading">
                    <h2>Read Our <span>Recent Articles</span></h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit aspernatur illum vel sunt libero voluptatum repudiandae veniam maxime tenetur.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-slider slider-arrow">
                    <div class="blog-card">
                        <div class="blog-img">
                            <img src="{{url('front/images/blog/01.jpg')}}" alt="blog">
                            <div class="blog-overlay">
                                <span class="marketing">Marketing</span>
                            </div>
                        </div>
                        <div class="blog-content">
                            <a href="#" class="blog-avatar">
                                <img src="{{url('front/images/avatar/01.jpg')}}" alt="avatar">
                            </a>
                            <ul class="blog-meta">
                                <li>
                                    <i class="fas fa-user"></i>
                                    <p><a href="#">MironMahmud</a></p>
                                </li>
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <p>02 Feb 2021</p>
                                </li>
                            </ul>
                            <div class="blog-text">
                                <h4><a href='blog-details.html'>Lorem ipsum dolor sit amet eius minus elit cum quaerat volupt.</a></h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus veniam ad dolore labore laborum perspiciatis...</p>
                            </div>
                            <a class='blog-read' href='blog-details.html'>
                                <span>read more</span>
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="blog-card">
                        <div class="blog-img">
                            <img src="{{url('front/images/blog/02.jpg')}}" alt="blog">
                            <div class="blog-overlay">
                                <span class="advertise">advertise</span>
                            </div>
                        </div>
                        <div class="blog-content">
                            <a href="#" class="blog-avatar">
                                <img src="{{url('front/images/avatar/02.jpg')}}" alt="avatar">
                            </a>
                            <ul class="blog-meta">
                                <li>
                                    <i class="fas fa-user"></i>
                                    <p><a href="#">LabonnoKhan</a></p>
                                </li>
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <p>02 Feb 2021</p>
                                </li>
                            </ul>
                            <div class="blog-text">
                                <h4><a href='blog-details.html'>Lorem ipsum dolor sit amet eius minus elit cum quaerat volupt.</a></h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus veniam ad dolore labore laborum perspiciatis...</p>
                            </div>
                            <a class='blog-read' href='blog-details.html'>
                                <span>read more</span>
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="blog-card">
                        <div class="blog-img">
                            <img src="{{url('front/images/blog/03.jpg')}}" alt="blog">
                            <div class="blog-overlay">
                                <span class="safety">safety</span>
                            </div>
                        </div>
                        <div class="blog-content">
                            <a href="#" class="blog-avatar">
                                <img src="{{url('front/images/avatar/03.jpg')}}" alt="avatar">
                            </a>
                            <ul class="blog-meta">
                                <li>
                                    <i class="fas fa-user"></i>
                                    <p><a href="#">MironMahmud</a></p>
                                </li>
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <p>02 Feb 2021</p>
                                </li>
                            </ul>
                            <div class="blog-text">
                                <h4><a href='blog-details.html'>Lorem ipsum dolor sit amet eius minus elit cum quaerat volupt.</a></h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus veniam ad dolore labore laborum perspiciatis...</p>
                            </div>
                            <a class='blog-read' href='blog-details.html'>
                                <span>read more</span>
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="blog-card">
                        <div class="blog-img">
                            <img src="{{url('front/images/blog/04.jpg')}}" alt="blog">
                            <div class="blog-overlay">
                                <span class="security">security</span>
                            </div>
                        </div>
                        <div class="blog-content">
                            <a href="#" class="blog-avatar">
                                <img src="{{url('front/images/avatar/04.jpg')}}" alt="avatar">
                            </a>
                            <ul class="blog-meta">
                                <li>
                                    <i class="fas fa-user"></i>
                                    <p><a href="#">TahminaBonny</a></p>
                                </li>
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <p>02 Feb 2021</p>
                                </li>
                            </ul>
                            <div class="blog-text">
                                <h4><a href='blog-details.html'>Lorem ipsum dolor sit amet eius minus elit cum quaerat volupt.</a></h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus veniam ad dolore labore laborum perspiciatis...</p>
                            </div>
                            <a class='blog-read' href='blog-details.html'>
                                <span>read more</span>
                                <i class="fas fa-long-arrow-alt-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-btn">
                    <a class='btn btn-inline' href='blog-list.html'>
                        <i class="fas fa-eye"></i>
                        <span>view all blogs</span>
                    </a>
                </div>
            </div>
        </div>
    </div-->
</section>
<!--=====================================
                BLOG PART END
=======================================-->
@endsection
@push('after-script')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.css" >
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
<script>
document.querySelectorAll(".faq-item").forEach(item => {
    item.addEventListener("click", () => {
        
        // Close all if you want only one open at a time
        document.querySelectorAll(".faq-item").forEach(i => {
            if (i !== item) {
                i.classList.remove("active");
                i.querySelector(".faq-icon").textContent = "+";
                i.querySelector(".faq-answer").style.display = "none";
            }
        });

        // Toggle current
        item.classList.toggle("active");

        let icon = item.querySelector(".faq-icon");
        let answer = item.querySelector(".faq-answer");

        if (item.classList.contains("active")) {
            icon.textContent = "-";
            answer.style.display = "block";
        } else {
            icon.textContent = "+";
            answer.style.display = "none";
        }
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
var swiper = new Swiper('.testi-swiper', {
    slidesPerView: 3,
    spaceBetween: 20,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.testi-next',
        prevEl: '.testi-prev',
    },
    breakpoints: {
        0: { slidesPerView: 1 },
        768: { slidesPerView: 3 }
    }
});

 function isValidEmail(email) {
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return emailPattern.test(email);
}
$('#homeenquiryForm').submit(function(e) {
    e.preventDefault(); // stop default form submission
    let email = $('#email-address').val().trim();
    let phone = $('#mobile-number').val().trim();

    // Validate email
    if (!isValidEmail(email)) {
        e.preventDefault();
        Swal.fire('Invalid Email', 'Please enter a valid email address.', 'error');
        return false;
    }

    // Validate phone
    if (!/^\d{10}$/.test(phone)) {
        e.preventDefault();
        Swal.fire('Invalid Mobile', 'Please enter a 10-digit mobile number.', 'error');
        return false;
    }

    // Validate reCAPTCHA
    if (grecaptcha.getResponse() == "") {
        e.preventDefault();
        Swal.fire('Captcha Required', 'Please verify that you are not a robot.', 'error');
        return false;
    }
    let formData = $(this).serialize();
 // Show loading alert
    Swal.fire({
        title: 'Submitting...',
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    $.ajax({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        url: '{{ route("homepage-enquiry-submit") }}',
        type: 'POST',
        data: formData,
        success: function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: response.message || 'Thank you for your enquiry. We will get back to you soon.',
                confirmButtonText: 'OK'
            });

            $('#homeenquiryForm')[0].reset();
            document.getElementById('is_valid_number').value = '0';
            document.getElementById('verified_badge').style.display = 'none';
            grecaptcha.reset(); // reset the reCAPTCHA widget
        },
        error: function(xhr) {
            Swal.close(); // close the loading alert
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                let errorMessages = '';

                $.each(errors, function(key, messages) {
                    errorMessages += messages.join('<br>') + '<br>';
                });

                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: errorMessages,
                    confirmButtonText: 'Fill It'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again later.',
                    confirmButtonText: 'OK'
                });
            }
        }
    });
});
 function sendOTP() {
        var mobileNumber = document.getElementById('mobile-number').value;
        document.getElementById('mob_in').value = mobileNumber;
        var token = '{{ csrf_token() }}';
    $.post('{{ route("send-otp-customer") }}', { _token: token, mobile: mobileNumber }, function (data) {
        // Show OTP field if OTP is sent successfully
        if (data.success) {
            document.getElementById('otp_field').style.display = 'block';
            document.getElementById('send-otp-bt').style.display = 'none';
            document.getElementById('verify-otp-bt').style.display = 'block';
            document.getElementById('resend-otp-bt').style.display = 'block';
            Swal.fire({
                title: "OTP Sent!",
                text: "OTP sent to the entered mobile number...",
                icon: "success"
            });
        } else {
            document.getElementById('otp_field').style.display = 'none';
            document.getElementById('send-otp-bt').style.display = 'block';
             document.getElementById('resend-otp-bt').style.display = 'none';
            document.getElementById('verify-otp-bt').style.display = 'none';
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please retry after sometime.."
            });
        }
    }).fail(function (response) {
        // Handle server-side validation errors
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: response.responseJSON.error
        });
    });
    }
    function verifyOTP() {
        var otp = $('#otp').val();
        var mobileNumber = document.getElementById('mobile-number').value;
        $.ajax({
            url: '{{ route("verifyOTP") }}',
            type: 'POST',
            data: {
                otp: otp,
                mobile: mobileNumber,
                _token: '{{ csrf_token() }}'
            },
            success: function (data) {
                if (data.success) {
                    document.getElementById('is_valid_number').value = '1';
                    document.getElementById('mobile-number').classList.add('verified');
                    document.getElementById('otp_field').style.display = 'none';
                    document.getElementById('send-otp-bt').style.display = 'none';
                    document.getElementById('resend-otp-bt').style.display = 'none';
                    document.getElementById('verify-otp-bt').style.display = 'none';
                    document.getElementById('mobile-number').disabled = true;
                    document.getElementById('verified_badge').style.display = 'block';
                    Swal.fire({
                        title: "OTP Verified!",
                        icon: "success"
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "You entered incorrect otp.."
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    document.addEventListener('DOMContentLoaded', function () {
        const otpInputs = document.querySelectorAll('.otp-input');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (event) => {
                const currentValue = event.target.value;
                const maxLength = parseInt(event.target.getAttribute('maxlength'));

                if (currentValue.length >= maxLength) {
                    // Move to the next input field if available
                    const nextIndex = index + 1;
                    if (nextIndex < otpInputs.length) {
                        otpInputs[nextIndex].focus();
                    }
                }
            });

            // Allow only numeric input
            input.addEventListener('keydown', (event) => {
                const key = event.key;
                const isValidInput = /^\d$/.test(key); // Only allow numeric input
                if (!isValidInput && key !== 'Backspace' && key !== 'Delete') {
                    event.preventDefault();
                }
            });
        });
    });
    $("#verify-btn").click(function () {
        $("#mobile_number-err").html('');
        var data = $(this)
        var mobilenumber = $("#mobile_number").val();
        let formData = new FormData();
        formData.append('mobile_number', mobilenumber);
        formData.append('_token', "{{csrf_token()}}");
        $.ajax({
            url: "{{ URL::to('send/otp') }}",
            type: 'POST',
            processData: false,
            contentType: false,
            dataType: 'json',
            data: formData,
            context: this,
            success: function (result) {
                if (result.success) {
                    $(`#mobile_number-success`).html(result.message);
                    $("#hiddenInput").removeAttr("style")
                    $("#verify-btn").css("display", "none")
                    
                } else {
                    $(this).attr('disabled', false);
                    if (result.code == 402) {
                    }
                    if (result.code == 422) {
                        for (const key in result.errors) {
                            $(`#${key}-err`).html(result.errors[key][0]);
                        }
                    } else {
                        console.log(result);
                    }
                }
            }
        });
    })

    

    function isNumber(evt) {
        evt = evt || window.event;
        var charCode = evt.which || evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    


</script>

@endpush
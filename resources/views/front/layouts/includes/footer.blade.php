@php
    $adCount = App\Models\Ad::where('delete_status', '0')->where('status', 'Published')->count();
    $userCount = App\Models\Member::count();
@endphp
<!--=====================================
                    FOOTER PART PART
        =======================================-->
        <style>
    .mobile-sticky-menu {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: #fff;
    border-top: 1px solid #ddd;
    z-index: 9999;
    display: none;
}

.mobile-sticky-menu ul {
    margin: 0;
    padding: 0;
    list-style: none;
    display: flex;
    justify-content: space-around;
}

.mobile-sticky-menu li {
    text-align: center;
    flex: 1;
}

.mobile-sticky-menu a {
    display: flex;
    flex-direction: column;
    padding: 8px 0;
    font-size: 12px;
    color: #444;
    text-decoration: none;
}

.mobile-sticky-menu i {
    font-size: 20px;
    margin-bottom: 2px;
}

/* Center Floating Button */
.center-btn {
    position: relative;
    top: -30px;
}

.center-btn .center-icon {
    width: 50px;
    height: 50px;
    background: #397839;
    border-radius: 50%;
    margin: 0 auto 3px auto;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0px 3px 10px rgba(0,0,0,0.25);
}

.center-btn .center-icon i {
    font-size: 22px;
    color: #fff;
}

/* Mobile Only */
@media (max-width: 768px) {
    .mobile-sticky-menu {
        display: block;
    }
}

        </style>
<footer class="footer-part">
    <div class="container">
        <div class="row newsletter " style="padding-bottom:40px; border-bottom:1px solid gray;">
            <div class="col-lg-6">
                <div class="news-content">
                    <h2>Subscribe for Latest Offers</h2>
                    <p style="color:#fff">
                        Subscribe now to receive the latest offers and exclusive deals directly to your inbox!</p>
                </div>
            </div>
            <div class="col-lg-6">
                <form class="news-form" id="news-form" method="post">
                    @csrf
                    <input type="email" name="news_email" id="news_email" placeholder="Enter Your Email Address">
                    <button class="btn btn-inline" id="saveNew">
                        <i class="fas fa-envelope"></i>
                        <span>Subscribe</span>
                    </button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="footer-content">
                    <h3 style="border-bottom:1px solid #fff;">Contact Us</h3>
                    <ul class="footer-address" style="color:#fff">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <p class="m-0" style="color:#fff"> Kalindikunj, Near Okhla Bird Sanctuary, Delhi, India</p>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <p class="m-0">support@pashughar.com </p>
                        </li>
                        <li>
                            <i class="fas fa-phone-alt"></i>
                            <p class="m-0">+91-9625455691</p>
                        </li>
                        <ul class="footer-social">
                            <li><a href="https://www.facebook.com/pashughar/"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://www.instagram.com/pashughar/"><i class="fab fa-instagram"></i></a></li>
                           <!-- <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li> -->
                            <li><a href="https://www.youtube.com/@PashuGhar"><i class="fab fa-youtube"></i></a></li>
                            
                        </ul>

                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="footer-content">
                    <h3 style="border-bottom:1px solid #fff;">Quick Link</h3>
                    <ul class="footer-widget">

                        @if(Auth::guard('member')->user() != '' && !empty(Auth::guard('member')->user()))
                            <li><a href="{{route('user.dashboard')}}">Dashboard</a></li>
                        @else
                            <li><a href="{{route('user.login')}}">Login</a></li>
                            <li><a href="{{route('user.login')}}">Sign Up</a></li>

                        @endif
                        <li><a href="{{route('user.post-your-ad')}}">Post Free Ads</a></li>
                        <li><a href="{{route('list-all-ads')}}">All Ads</a></li>
                        <li><a href="{{route('subscription-plan')}}">Pricing Plan</a></li>
                        <li><a href="{{route('list-categories')}}">Show All Categories</a></li>
                        <li><a href="{{route('user.login')}}">Become Seller</a></li>
                        <li><a href="{{route('submit-bulk-stock-request')}}">Bulk Order</a></li>


                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="footer-content">
                    <h3 style="border-bottom:1px solid #fff;">Company Profile</h3>
                    <ul class="footer-widget">
                        <li><a href="{{route('about-us')}}">About Us</a></li>
                        <li><a href="{{route('our-team')}}">Our Team</a></li>
                        <li><a href="{{route('contact-us')}}">Contact Us</a></li>
                        <li><a href="{{route('faqs')}}">FAQ</a></li>
                        <li><a href="{{route('blog-listing')}}">Blogs</a></li>
                        <!--<li><a href="{{route('user.post-your-ad')}}">Post Ads</a></li>-->
                        <!--<li><a href="{{route('list-all-ads')}}">All Ads</a></li>-->
                        <!--<li><a href="{{route('subscription-plan')}}">Pricing Plan</a></li>-->
                        <!--@if(Auth::guard('member')->user() !='' && !empty(Auth::guard('member')->user()))-->
                        <!--<li><a href="{{route('user.dashboard')}}">Dashboard</a></li>-->
                        <!--@else-->
                        <!-- <li><a href="{{route('user.login')}}">Login</a></li>-->
                        <!-- <li><a href="{{route('user.login')}}">Sign Up</a></li>-->

                        <!--@endif-->

                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="footer-content">
                    <h3 style="border-bottom:1px solid #fff;">Policies & Terms </h3>
                    <ul class="footer-widget">
                        <?php $pages = App\Models\Pages::all(); ?>
                        @foreach($pages as $page)
                            <li><a href="{{ route('page.show', $page->slug) }}">{{$page->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!--<div class="col-sm-6 col-md-6 col-lg-3">-->
            <!--    <div class="footer-info">-->
            <!--        <a href="#"><img src="{{asset('front/images/logo.png')}}" alt="logo"></a>-->
            <!--        <ul class="footer-count">-->
            <!--            <li>-->
            <!--                <h5>{{$userCount}}</h5>-->
            <!--                <p>Registered Users</p>-->
            <!--            </li>-->
            <!--            <li>-->
            <!--                <h5>{{$adCount}}</h5>-->
            <!--                <p>Community Ads</p>-->
            <!--            </li>-->
            <!--        </ul>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-card-content">
                    <div class="footer-payment">
                        <a href="#"><img src="{{asset('front/images/pay-card/01.jpg')}}" alt="01"></a>
                        <a href="#"><img src="{{asset('front/images/pay-card/02.jpg')}}" alt="02"></a>
                        <a href="#"><img src="{{asset('front/images/pay-card/03.jpg')}}" alt="03"></a>
                        <a href="#"><img src="{{asset('front/images/pay-card/04.jpg')}}" alt="04"></a>
                    </div>
                    <!--div class="footer-option">
                                <button type="button" data-toggle="modal" data-target="#language"><i class="fas fa-globe"></i>English</button>
                                <button type="button" data-toggle="modal" data-target="#currency"><i class="fas fa-dollar-sign"></i>USD</button>
                            </div-->
                    <div class="footer-app">
                        <a href="#"><img src="{{asset('front/images/play-store.png')}}" alt="play-store"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-end">
        <div class="container">
            <div class="footer-end-content  d-flex justify-content-between">
                <p class="m-0 footer-end-content-tt">All Copyrights Reserved © 2024 Pashughar</p>
                <p class="m-0 footer-end-content-mobile">All Copyrights Reserved © 2025 <br /><strong>PashuGhar Livestock Trade & Marketing</strong>
                </p>
                <p> Designed & Developed by <a href="https://www.webmingo.com">Web Mingo</a></p>

            </div>

        </div>
    </div>
</footer>
<!-- MOBILE STICKY MENU -->
<div class="mobile-sticky-menu">
    <ul>

        @if(Auth::guard('member')->check())
            <!-- ============= LOGGED-IN MENU ============= -->

            <!-- 1. Home -->
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-home"></i>
                    <span>Home</span>
                </a>
            </li>

            <!-- 2. Buy Now -->
            <li>
                <a href="{{ route('list-categories') }}">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Buy Now</span>
                </a>
            </li>

            <!-- 3. Center Floating (My Dashboard) -->
            <li class="center-btn">
                <a href="{{ route('user.dashboard') }}">
                    <div class="center-icon"><i class="fa fa-user"></i></div>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- 4. Start Selling -->
            <li>
                <a href="{{ route('user.post-your-ad') }}">
                    <i class="fa fa-store"></i>
                    <span>Start Selling</span>
                </a>
            </li>

            <!-- 5. My Ads -->
            <li>
                <a href="{{ route('user.my-ads') }}">
                    <i class="fa fa-bullhorn"></i>
                    <span>My Ads</span>
                </a>
            </li>

        @else
            <!-- ============= NOT LOGGED-IN MENU ============= -->

            <!-- 1. Home -->
            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-home"></i>
                    <span>Home</span>
                </a>
            </li>

            <!-- 2. Buyers -->
            <li>
                <a href="{{ route('user.login') }}">
                    <i class="fa fa-users"></i>
                    <span>Buyers</span>
                </a>
            </li>

            <!-- 3. Center Floating (Browse Categories) -->
            <li class="center-btn">
                <a href="{{ route('list-categories') }}">
                    <div class="center-icon"><i class="fa fa-th-large"></i></div>
                    <span>Categories</span>
                </a>
            </li>

            <!-- 4. Sellers -->
            <li>
                <a href="{{ route('user.login') }}">
                    <i class="fa fa-handshake"></i>
                    <span>Sellers</span>
                </a>
            </li>

            <!-- 5. Help & Support -->
            <li>
                <a href="{{ route('contact-us') }}">
                    <i class="fa fa-headset"></i>
                    <span>Support</span>
                </a>
            </li>

        @endif

    </ul>
</div>


<!--=====================================
                    FOOTER PART END
        =======================================-->
@push('after-script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.js"></script>
    <script>
        $('#saveNew').click(function (e) {
            e.preventDefault();
            $empty = $('form.news-form').find("input").filter(function () {
                return this.value === "";
            });
            if ($empty.length) {
                alert('Email fields required!');
                return false;
            } else {
                Swal.fire({
                    title: 'Are you sure?',

                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Subscribe'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#saveNew").text('Wait...');
                        $.ajax({
                            url: '{{route("save-Subscriber")}}',
                            method: 'POST',
                            data: $("#news-form").serialize(),
                            success: function (data) {
                                console.log(data);
                                if (data.success) {
                                    Swal.fire(
                                        data.message
                                    );
                                    $("#news_email").val('');
                                    $("#saveNew").text('Subscribe');
                                } else {
                                    $("#saveNew").text('Subscribe');
                                    Swal.fire(
                                        data.errors

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
@php
$suggestCategories = App\Models\Category::all();

@endphp
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<style>
    .dropdownsearch{
       position: absolute;
    top: -20%;
    left: 0;
    
    background: #fff;
    max-height: 200px;
    overflow-y: auto;
    z-index: 10000;
    width: 90vw;
    border: 1px solid gray;
    border-radius: 7px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }

    .dropdownsearch li{
        padding: 9px ;
        /* font-size: 16px; */
        font-weight: 500;
        color: #333;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
        border-bottom: 1px solid #f0f0f0;
    }
    
    /* === PashuGhar Header - Custom prefixed classes === */
.pgh-header {
    background: #ffffff;
    border-bottom: 1px solid #e5e7eb;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    position: sticky;
    top: 0;
    z-index: 1000;
}

.pgh-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}

.pgh-header-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 100px;
}

.pgh-header-left,
.pgh-header-right {
    display: flex;
    align-items: center;
    gap: 36px;
}

.pgh-header-center {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
}

.pgh-logo img {
    height: 85px;
    width: auto;
    display: block;
}

/* Navigation */
.pgh-nav-list {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 32px;
}

.pgh-nav-link {
    color: #374151;
    font-weight: 500;
    text-decoration: none;
    font-size: 15px;
    transition: color 0.2s;
}

.pgh-nav-link:hover,
.pgh-nav-link.active {
    color: #2563eb;
}

.pgh-highlight {
    color: #ec4899;
    font-weight: 600;
}

/* Buttons */
.pgh-btn {
    display: inline-flex;
    align-items: center;
    /*gap: 8px;*/
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 500;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.2s;
    white-space: nowrap;
}

.pgh-btn-primary {
    background: #000000;
    color: white;
    border: none;
}

.pgh-btn-primary:hover {
    background: #1a1a1a;
}

.pgh-btn-outline {
    border: 1px solid #d1d5db;
    color: #374151;
    background: white;
}

.pgh-btn-outline:hover {
    background: #f3f4f6;
    border-color: #9ca3af;
}

.pgh-btn-text {
    color: #374151;
    background: transparent;
    padding: 10px 14px;
}

.pgh-btn-text:hover {
    color: #2563eb;
    background: #eff6ff;
}

/* User Dropdown */
.pgh-user-btn {
    display: flex;
    align-items: center;
    /*gap: 8px;*/
    background: none;
    border: none;
    color: #374151;
    font-weight: 500;
    cursor: pointer;
    padding: 8px 12px;
    border-radius: 8px;
}

.pgh-user-btn:hover {
    background: #f3f4f6;
}

.pgh-user-name {
    max-width: 140px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Search */
.pgh-search-wrapper {
    padding: 12px 0 20px;
    max-width: 600px;
    margin: 0 auto;
}

.pgh-search-inner {
    position: relative;
}

.pgh-search-input {
    width: 100%;
    padding: 14px 20px 14px 48px;
    border: 1px solid #d1d5db;
    border-radius: 12px;
    font-size: 15px;
}

.pgh-search-btn {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #6b7280;
    font-size: 18px;
    cursor: pointer;
}

/* Mobile */
.pgh-mobile-toggle {
    display: none;
    background: none;
    border: none;
    cursor: pointer;
}

@media (max-width: 992px) {
    .pgh-header-left,
    .pgh-header-right > *:not(.pgh-mobile-toggle) {
        display: none;
    }
    
    .pgh-header-center {
        position: static;
        transform: none;
    }
    
    .pgh-mobile-toggle {
        display: block;
    }
    
    .pgh-header-inner {
        justify-content: center;
    }
    
    .pgh-search-wrapper {
        padding: 16px 0;
    }
}

.pgh-icon-nav-list {
    display: flex;
    align-items: center;
    gap: 36px;           /* items ke beech distance */
    list-style: none;
    margin: 0;
    padding: 0;
}

.pgh-icon-link {
    display: flex;
    flex-direction: column;
    align-items: flex-start;   /* left align karne ke liye */
    text-decoration: none;
    color: #2d3748;
    transition: color 0.2s;
}

.pgh-icon-text-row {
    display: flex;
    align-items: center;
    gap: 10px;             /* icon aur text ke beech space */
}

.pgh-icon {
    font-size: 22px;
    color: #4299e1;        /* blue theme, change kar sakte ho */
    min-width: 24px;
}

.pgh-main-text {
    font-size: 15px;
    font-weight: 500;
    white-space: nowrap;
}

.pgh-sub-label {
    font-size: 12px;
    color: #718096;
    margin-top: 3px;
    opacity: 0.9;
}

/* Hover effect */
.pgh-icon-link:hover {
    color: #2b6cb0;
}

.pgh-icon-link:hover .pgh-icon {
    color: #2b6cb0;
}

.pgh-icon-link:hover .pgh-sub-label {
    color: #4a5568;
}

/* Highlight wala (Become a Vendor) */
.pgh-highlight .pgh-main-text {
    color: #2d3748;
    font-weight: 600;
}

.pgh-highlight .pgh-icon {
    color: #2d3748;
}

.pgh-highlight .pgh-sub-label {
    color: #718096;
    opacity: 1;
}

/* Mobile pe chhota kar denge */
@media (max-width: 991px) {
    .pgh-icon-nav-list {
        gap: 20px;
    }
    .pgh-main-text {
        font-size: 14px;
    }
    .pgh-sub-label {
        font-size: 11px;
    }
}

/* Reuse same classes from left nav */
.pgh-icon-link {
    display: flex;
    flex-direction: column;
    /*align-items: center;          */
    text-decoration: none;
    color: #2d3748;
    transition: all 0.2s;
    padding: 6px 12px;
    border-radius: 6px;
    min-width: 90px;
}

.pgh-icon-text-row {
    display: flex;
    align-items: center;
    gap: 8px;
}

.pgh-icon {
    font-size: 20px;
    color: #4a5568;
    min-width: 24px;
}

.pgh-main-text {
    font-size: 14.5px;
    font-weight: 500;
    white-space: nowrap;
}

.pgh-sub-label {
    font-size: 11.5px;
    color: #718096;
    margin-top: 2px;
    opacity: 0.9;
}

/* Hover for all icon-links */
.pgh-icon-link:hover {
    background: #f7fafc;
    color: #2b6cb0;
}

.pgh-icon-link:hover .pgh-icon {
    color: #2b6cb0;
}

.pgh-icon-link:hover .pgh-sub-label {
    color: #4a5568;
}

/* Primary button (Post Ad) override */
.pgh-btn-primary.pgh-icon-link {
    background: #2f855a;
    color: white;
    border-radius: 6px;
}

.pgh-btn-primary.pgh-icon-link .pgh-icon,
.pgh-btn-primary.pgh-icon-link .pgh-main-text,
.pgh-btn-primary.pgh-icon-link .pgh-sub-label {
    color: white !important;
}

.pgh-btn-primary.pgh-icon-link:hover {
    background: #276749;
}

/* Outline button (Login) */
.pgh-btn-outline.pgh-icon-link {
    border: 1px solid #cbd5e0;
    background: white;
}

.pgh-btn-outline.pgh-icon-link:hover {
    background: #edf2f7;
}

/* Text button (Buy & Sell) */
.pgh-btn-text.pgh-icon-link {
    background: transparent;
}

.pgh-btn-text.pgh-icon-link:hover {
    background: #f7fafc;
}

/* Mobile hide labels if space tight */
@media (max-width: 1200px) {
    .pgh-sub-label {
        display: none;   /* optional: hide sub-labels on smaller screens */
    }
}
.offcanvas {
    position: fixed;
    bottom: 0;
    z-index: 10001;
    display: flex;
    flex-direction: column;
    max-width: 100%;
    visibility: hidden;
    background-color: #fff;
    background-clip: padding-box;
    outline: 0;
    transition: transform .3s ease-in-out;
}

.search-popup {
    position: fixed;
    top: 151px;
    left: 0;
    width: 100%;
    padding: 0 20px;          /* equal left-right space */
    z-index: 9999;
    display: none;
}

.search-box {
    width:100%;
    background: #ffffff;
       padding: 3px 3px 3px 15px ;
    border-radius: 5px;
    display: flex;
    align-items: center;
    gap: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.18);
    animation: fadeSlideDown 0.3s ease;
}

.search-icon {
    font-size: 18px;
    color: #777;
}

.search-box input {
    width: 100%;
    border: none;
    outline: none;
    padding: 10px;
    font-size: 15px;
    background: #f7f7f7;
    border-radius: 10px;
}

.search-btn {
    background: #0A773F;
    border: none;
    color: #fff;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    font-size: 18px;
}

@keyframes fadeSlideDown {
    from { opacity: 0; transform: translateY(-15px); }
    to   { opacity: 1; transform: translateY(0); }
}

.profile-section-mobile {
    padding: 10px 0;
        margin-bottom: 20px;
}

.profile-card {
    display: flex;
    align-items: center;
    background: #ffffff;
    padding: 15px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.profile-left {
    margin-right: 15px;
}

.user-avatar {
    width: 55px;
    height: 55px;
    background: #f5f5f5;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    color: #555;
}

.profile-right {
    flex: 1;
}

.user-name {
    font-size: 17px;
    font-weight: 600;
    margin: 0;
    color: #000;
}

.manage-link {
    font-size: 14px;
    color: #007bff;
    margin-top: 3px;
    display: inline-block;
}

.login-btn,
.signup-btn {
    display: inline-block;
    font-size: 15px;
    padding: 6px 12px;
    border-radius: 8px;
    margin-right: 8px;
    background: #f3f3f3;
    color: #000;
    text-decoration: none;
}

.dropdown-menu{
        z-index: 10000;
}
.mobile-sticky-menu{
    z-index: 999 !important;
}
</style>

<!--=====================================
                    HEADER PART START
        =======================================-->
       
        <!--<div class="marque-section"style="width:100%;height:40px;background:#000000;padding:0px 10px;display:flex;align-item:center;"><marquee><ul style="color:#fff;display:flex;gap:20px;height:40px;text-align:center;margin:0px;"><li style="display:flex;align-items:center;">* Welcome to Pashughar.com, You can List & View Livestock and Dairy Farm Products.</li><li style="display:flex;align-items:center;"> * Register Today and Get Early Bird Offer</li></ul></marquee></div>-->
        
        <!-- <div class="top_header_list">-->
        <!--    <div class="top_email">-->
        <!--        <p><i class="fas fa-envelope"></i> &nbsp;&nbsp;support@pashughar.com</p>-->
        <!--        <div class="top_vender">-->
        <!--            <p data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><span>          <img src="{{asset('front/images/category.png')}}" alt="logo" style="width:20px;margin-top:-4px"></span>&nbsp;&nbsp;All Categories</p>-->
        <!--            <div class="line"></div>           -->
                       
        <!--               <p><a href="{{route('user.login')}} " style="color:#000;text-decoration:none;"><i class="fa fa-user"></i>&nbsp;&nbsp;Become Vendor</a></p>-->
        <!--               <div class="line"></div>-->
        <!--                <p><a href="{{route('submit-bulk-stock-request')}} " style="color:#000;text-decoration:none;"><i class="fas fa-mail-bulk"></i>&nbsp;&nbsp;Send Bulk Enquiry</a></p>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
         <div class="top_header_list-mobile">
             
            <div class="top_vender1" style="display:flex;justify-content:space-between;align-items:center;">     
                <p class="mobile-only" data-bs-toggle="offcanvas" href="#dummyOffcanvasExample" role="button" aria-controls="dummyOffcanvasExample">
                    <span>
                        <img src="{{asset('front/images/menu1.png')}}" alt="logo" style="width:25px;margin-left:14px;margin-top: 5px;">
                    </span>
                </p>

                    

                    <div class="header-search-container">
                        <button class="search-toggle-btn" type="button" title="Search">
                            <i class="fas fa-search"></i>&nbsp;&nbsp;Search
                        </button>
                        <div class="search-overlay"></div>

                        <form class="header-search-form search-popup" action="{{route('search')}}">
    <div class="search-box">
        <i class="fas fa-search search-icon"></i>

        <input type="text"
               placeholder="Search, Whatever you needs..."
               name="search"
               class="searchByAds">

        <button type="submit" class="search-btn">
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
</form>


                    </div>

                            @if(Auth::guard('member')->check())
        <!-- Logged-in user with icon + name + sub-label -->
        <div class="pgh-user-dropdown">
            <button class="pgh-icon-link pgh-user-btn" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="pgh-icon-text-row">
                    <i class="fas fa-user-circle pgh-icon"></i>
                    <span class="pgh-main-text">{{ Auth::guard('member')->user()->full_name }}</span>
                </div>
                <span class="pgh-sub-label">Manage your Accounts</span>
            </button>

            <!-- Dropdown remains the same -->
            <ul class="dropdown-menu pgh-dropdown-menu shadow-sm">
                <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('user.my-ads') }}">My Ads</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="{{ route('user.logout') }}">Logout</a></li>
            </ul>
        </div>
    @else
        <!-- Not logged in -->
        <a href="{{ route('user.login') }}" class="pgh-icon-link pgh-btn pgh-btn-outline">
            <div class="pgh-icon-text-row">
                
                <span class="pgh-main-text">Login & Signup</span>
                <i class="fas fa-sign-in-alt pgh-icon"></i>
            </div>
            <!--<span class="pgh-sub-label">Manage your Accounts</span>-->
        </a>
    @endif
                        
    <!--                    <button class="pgh-mobile-toggle d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample">-->
    <!--    <img src="{{ asset('front/images/cicon.png') }}" alt="Menu" style="width: 26px;">-->
    <!--</button>-->

                </div>
            </div>
<!--        <header class="header-part">-->

<!--            <div class="container">-->
                
<!--                <div class="header-content">-->
<!--                    <div class="header-left">-->
                        
<!--                        <a class='header-logo' href="{{URL::to('/')}}">-->
<!--                            <img src="{{asset('front/images/pashugharlogo.png')}}" alt="logo">-->
<!--                        </a>-->
                       
<!--                        <button type="button" class="header-widget search-btn">-->
<!--                            <i class="fas fa-search"></i>-->
<!--                        </button>-->
<!--                    </div>-->
<!--                    <form class="header-form" action="{{route('search')}}">-->
<!--                        <div class="header-search">-->
                            
<!--                            <input type="text" placeholder="Search, Whatever you needs..." name="search" class="searchByAds">-->
<!--                            <span  class="dropdownsearch">-->

<!--                            </span>-->
<!--                            <button type="button" title="Search Submit "><i class="fas fa-search"></i></button>-->
                            
<!--                         </div>-->
                        
<!--                    </form>-->
<!--                    <div class="header-right">-->
<!--                        @if(Auth::guard('member')->user() !='' && !empty(Auth::guard('member')->user()))-->
<!--                        <a class='btn btn-inline post-btn' style="background:#000000;color:#fff;white-space:nowrap;" data-bs-toggle="offcanvas" href="#dummyOffcanvasExample1" role="button" aria-controls="dummyOffcanvasExample1" >-->
<!--                            <i class="fas fa-user"></i>-->
<!--                            <span>{{Auth::guard('member')->user()->full_name}}</span>-->
<!--                            <i class="fa fa-caret-down" aria-hidden="true"></i>-->
<!--                        </a>-->
<!--                        @else-->
<!--                        <a class='btn btn-inline post-btn' style="background:#000000;color:#fff" href="{{route('user.login')}}">-->
<!--                        <i class="fas fa-sign-in-alt"></i> -->
<!--                            <span>Login/Sign Up</span>-->
<!--                        </a>-->
<!--                        @endif-->
                        
<!--                        <a class='btn btn-inline post-btn top-post-add' style="background:#000000;color:#fff" href="{{route('user.post-your-ad')}}">-->
<!--                            <i class="fas fa-plus-circle"></i>-->
<!--                            <span>post your ad</span>-->
<!--                        </a>-->
                        
<!--                    </div>-->
<!--                     <p class="mobile-only" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><span>                            <img src="{{asset('front/images/cicon.png')}}" alt="logo" style="width:25px;margin-left:14px;margin-top: 14px;"></span></p>-->
<!--                </div>-->
<!--            </div>-->
           
<!--</header>-->
<header class="pgh-header">
    <div class="pgh-container">
        <div class="pgh-header-inner">

            <!-- Left Navigation -->
<nav class="pgh-header-left">
    <ul class="pgh-icon-nav-list">
        <li>
            <a href="{{ URL::to('/') }}" class="pgh-icon-link">
                <div class="pgh-icon-text-row">
                    <i class="fas fa-home pgh-icon"></i>
                    <span class="pgh-main-text">Home</span>
                </div>
                <span class="pgh-sub-label">View Home Page</span>
            </a>
        </li>
        
        <li>
            <a href="{{route('list-categories')}}" class="pgh-icon-link">
                <div class="pgh-icon-text-row">
                    <i class="fas fa-th-large pgh-icon"></i>
                    <span class="pgh-main-text">Buyers</span>
                </div>
                <span class="pgh-sub-label">Buy Goat, Cow, Sheep etc</span>
            </a>
        </li>
        <li>
            <a href="{{route('submit-bulk-stock-request')}}" class="pgh-icon-link">
                <div class="pgh-icon-text-row">
                    <i class="fas fa-store pgh-icon"></i>
                    <span class="pgh-main-text">Bulk Orders</span>
                </div>
                <span class="pgh-sub-label">Connect with Bulk Suppliers</span>
            </a>
        </li>
        
        <!--<li>-->
        <!--    <a href="#" class="pgh-icon-link pgh-highlight">-->
        <!--        <div class="pgh-icon-text-row">-->
        <!--            <i class="fas fa-store pgh-icon"></i>-->
        <!--            <span class="pgh-main-text">Become a Vendor</span>-->
        <!--        </div>-->
        <!--        <span class="pgh-sub-label">Join & Start Selling</span>-->
        <!--    </a>-->
        <!--</li>-->
    </ul>
</nav>

            <!-- Center Logo -->
            <div class="pgh-header-center">
                <a href="{{ URL::to('/') }}" class="pgh-logo">
                    <img src="{{ asset('front/images/pashugharlogo.png') }}" alt="PashuGhar Logo">
                </a>
            </div>

            <!-- Right Section -->
<div class="pgh-header-right">
    
    <!-- Buy & Sell -->
    @if(Auth::guard('member')->check())
    <a href="{{route('user.post-your-ad')}}" class="pgh-icon-link pgh-btn pgh-btn-text">
        <div class="pgh-icon-text-row">
            <i class="fas fa-exchange-alt pgh-icon"></i>
            <span class="pgh-main-text">Post Ad</span>
        </div>
        <span class="pgh-sub-label">Sell Goat, Cow, Sheep etc</span>
    </a>
     @else
     <a href="{{route('user.login')}}" class="pgh-icon-link pgh-btn pgh-btn-text">
        <div class="pgh-icon-text-row">
            <i class="fas fa-exchange-alt pgh-icon"></i>
            <span class="pgh-main-text">Sellers</span>
        </div>
        <span class="pgh-sub-label">Sell Goat, Cow, Sheep etc</span>
    </a>
     @endif
    @if(Auth::guard('member')->check())
    <a href="{{route('user.post-your-ad')}}" class="pgh-icon-link pgh-btn pgh-btn-text">
        <div class="pgh-icon-text-row">
            <i class="fa-brands fa-shirtsinbulk"></i>
            <span class="pgh-main-text">Bulk Suppliers</span>
        </div>
        <span class="pgh-sub-label">Start Selling in Bulk</span>
    </a>
     @else
      <a href="{{route('user.login')}}" class="pgh-icon-link pgh-btn pgh-btn-text">
        <div class="pgh-icon-text-row">
            <i class="fa-brands fa-shirtsinbulk"></i>
            <span class="pgh-main-text">Bulk Suppliers</span>
        </div>
        <span class="pgh-sub-label">Start Selling in Bulk</span>
    </a>
     @endif

    <!-- Post Your Ad -->
    <!--<a href="{{ route('user.post-your-ad') }}" class="pgh-icon-link pgh-btn pgh-btn-primary">-->
    <!--    <div class="pgh-icon-text-row">-->
    <!--        <i class="fas fa-plus-circle pgh-icon"></i>-->
    <!--        <span class="pgh-main-text">Bulk Suppliers</span>-->
    <!--    </div>-->
    <!--    <span class="pgh-sub-label">Start Selling in Bulk</span>-->
    <!--</a>-->
    @if(Auth::guard('member')->check())
        <!-- Logged-in user with icon + name + sub-label -->
        <div class="pgh-user-dropdown">
            <button class="pgh-icon-link pgh-user-btn" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="pgh-icon-text-row">
                    <i class="fas fa-user-circle pgh-icon"></i>
                    <span class="pgh-main-text">{{ Auth::guard('member')->user()->full_name }}</span>
                </div>
                <span class="pgh-sub-label">Manage your Accounts</span>
            </button>

            <!-- Dropdown remains the same -->
            <ul class="dropdown-menu pgh-dropdown-menu shadow-sm">
                <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('user.my-ads') }}">My Ads</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="{{ route('user.logout') }}">Logout</a></li>
            </ul>
        </div>
    @else
        <!-- Not logged in -->
        <a href="{{ route('user.login') }}" class="pgh-icon-link pgh-btn pgh-btn-outline">
            <div class="pgh-icon-text-row">
                <i class="fas fa-sign-in-alt pgh-icon"></i>
                <span class="pgh-main-text">Login & Signup</span>
            </div>
            <span class="pgh-sub-label">Manage your Accounts</span>
        </a>
    @endif

    

    <!-- Mobile Hamburger (simple, no sub-label needed) -->
    
</div>

        </div>

        <!-- Search Bar (below or inside depending on your preference) -->
        <!--<div class="pgh-search-wrapper">-->
        <!--    <form class="pgh-search-form" action="{{ route('search') }}" method="GET">-->
        <!--        <div class="pgh-search-inner">-->
        <!--            <input type="text" name="search" placeholder="Search animals, products, services..." class="pgh-search-input">-->
        <!--            <button type="submit" class="pgh-search-btn">-->
        <!--                <i class="fas fa-search"></i>-->
        <!--            </button>-->
        <!--        </div>-->
        <!--    </form>-->
        <!--</div>-->
    </div>
</header>

 <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Categories</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="category-name-list">
                    @if(!empty($suggestCategories) && count($suggestCategories) > 0)
                        @foreach($suggestCategories as $category)

                        <div class="cat-list border-bottom mb-2" style="position: relative;">
                            <div class="category-item cat-list " data-category-id="{{ $category->id }}" style="cursor: pointer;display:flex;gap:10px;">
                                <img src="{{ asset('storage') }}/{{$category->image}}" alt="car" style="width: 50px;">
                                <a href="{{route('category-details', $category->slug)}}"><h6 class="m-0" style="display:flex;align-items:center;">{{$category->name}}</h6>
                                <p style="color:#000;padding-left:0px; margin-top:18px;">
                                    ({{isset($category->ads) && $category->ads != '' ? $category->ads->where('status', 'Published')->count() : 0}})
                                </p></a>
                            </div>
                            <div class="subcategory-list border-top" id="subcategory-{{$category->id}}" style="display: none; padding-left: 0px; margin-top:15px;color:#000">
                                <!-- Dummy Subcategories -->
                                @if(count($category->subcategory) > 0)
                                    @foreach($category->subcategory as $sub)
                                    @php
                                    $slugName = strtolower(str_replace('_', '-', str_replace(' ', '-', $sub->name)));
                                    @endphp
                                    <a href="{{route('sub-details', ['subcategoryname'=>$slugName, 'id'=>base64_encode($sub->id)])}}"><p style="margin: 5px 0; color:black;"> <i class="fa fa-arrow-right"></i>{{$sub->name}}</p></a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
    </div>  
<div class="offcanvas offcanvas-start" tabindex="-1" id="dummyOffcanvasExample" aria-labelledby="dummyOffcanvasExampleLabel">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="dummyOffcanvasExampleLabel">Menu</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
<div class="offcanvas-body">
<div class="profile-section-mobile">
    <div class="profile-card">

        @if(Auth::guard('member')->user())

            <div class="profile-left">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
            </div>

            <div class="profile-right">
                <h4 class="user-name">
                    Testing User
                </h4>
                <a href="{{ route('user.dashboard') }}" class="manage-link">
                    Manage Your Account →
                </a>
            </div>

        @else

            <div class="profile-left">
                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>
            </div>

            <div class="profile-right">
                <a href="{{ route('user.login') }}" class="login-btn">Login / Sign Up</a>
                
            </div>

        @endif

    </div>
</div>

    
    <ul class="footer-widget" style="color:#000 margin-top:15px;">
        
        
                        <li style="color:#000; border-bottom:1px solid #0000001a; padding-bottom:5px; margin-bottom:5px;"><a style="color:#000" href="{{route('user.post-your-ad')}}">Post Free Ads</a></li>
                        <li style="color:#000; border-bottom:1px solid #0000001a; padding-bottom:5px; margin-bottom:5px;"><a style="color:#000" href="{{route('list-all-ads')}}">All Ads</a></li>
                        <li style="color:#000; border-bottom:1px solid #0000001a; padding-bottom:5px; margin-bottom:5px;"><a style="color:#000" href="{{route('subscription-plan')}}">Pricing Plan</a></li>
                        <li style="color:#000; border-bottom:1px solid #0000001a; padding-bottom:5px; margin-bottom:5px;"><a style="color:#000" href="{{route('list-categories')}}">Show All Categories</a></li>
                        <li style="color:#000; border-bottom:1px solid #0000001a; padding-bottom:5px; margin-bottom:5px;"><a style="color:#000" href="{{route('user.login')}}">Become Seller</a></li>
                        <li style="color:#000; border-bottom:1px solid #0000001a; padding-bottom:5px; margin-bottom:5px;"><a style="color:#000" href="{{route('submit-bulk-stock-request')}}">Bulk Order</a></li>


        <li style="color:#000; border-bottom:1px solid #0000001a; padding-bottom:5px; margin-bottom:5px;">
            <a style="color:#000" href="{{route('about-us')}}">About Us</a>
        </li>

        <li style="color:#000; border-bottom:1px solid #0000001a; padding-bottom:5px; margin-bottom:5px;">
            <a style="color:#000" href="{{route('our-team')}}">Our Team</a>
        </li>

        <li style="color:#000; border-bottom:1px solid #0000001a; padding-bottom:5px; margin-bottom:5px;">
            <a style="color:#000" href="{{route('contact-us')}}">Contact Us</a>
        </li>

        <li style="color:#000; border-bottom:1px solid #0000001a; padding-bottom:5px; margin-bottom:5px;">
            <a style="color:#000" href="{{route('faqs')}}">FAQ</a>
        </li>

        <li style="border-bottom:1px solid #0000001a; padding-bottom:5px; margin-bottom:5px;">
            <a href="{{route('blog-listing')}}" style="color:#000">Blogs</a>
        </li>

        <?php $pages = App\Models\Pages::all(); ?>
        @foreach($pages as $page)
            <li @if(!$loop->last) style="border-bottom:1px solid #0000001a; padding-bottom:5px; margin-bottom:5px;" @endif>
                <a style="color:#000" href="{{ route('page.show', $page->slug) }}">{{$page->name}}</a>
            </li>
        @endforeach

    </ul>

    <ul class="footer-address border-top pt-2" style="color:#000;">
        <li style="color:#000">
            <i class="fas fa-map-marker-alt"></i>
            <p class="m-0" style="color:#000"> Kalindikunj, Near Okhla Bird Sanctuary, Delhi, India</p>
        </li>

        <li>
            <i class="fas fa-envelope"></i>
            <p class="m-0">support@pashughar.com </p>
        </li>

        <li>
            <i class="fas fa-phone-alt"></i>
            <p class="m-0">+91-9625455691</p>
        </li>

        <ul class="footer-social" style="color:#000; border-top:1px solid #0000001a;">
             <li><a href="https://www.facebook.com/pashughar/"><i class="fab fa-facebook-f" style="color:#000"></i></a></li>
                            <li><a href="https://www.instagram.com/pashughar/"><i class="fab fa-instagram" style="color:#000"></i></a></li>
                           
                            <li><a href="https://www.youtube.com/@PashuGhar"><i class="fab fa-youtube" style="color:#000"></i></a></li>
        </ul>

    </ul>
</div>

</div>


<div class="offcanvas offcanvas-start" tabindex="-1" id="dummyOffcanvasExample1" aria-labelledby="dummyOffcanvasExampleLabel">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="dummyOffcanvasExampleLabel">Menu</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
                                   <ul class="user-dashboard-menu">
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('user.dashboard') ? 'active' : '' }}" href="{{route('user.dashboard')}}"><i class="fa fa-home"></i>&nbsp;Dashboard</a></li>
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('user.profile') ? 'active' : '' }}" href="{{route('user.profile')}}"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Profile</a></li>
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('user.my-enquiries') ? 'active' : '' }}" href="{{route('user.my-enquiries')}}"><i class="fa-solid fa-clipboard-list"></i>&nbsp;My Enquiries</a></li>
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('user.post-your-ad') ? 'active' : '' }}" href="{{route('user.post-your-ad')}}"><i class="fa fa-plus"></i>&nbsp;Ad Post</a></li>
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('user.my-ads') ? 'active' : '' }}" href="{{route('user.my-ads')}}"><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp;My Ads</a></li>
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('user.settings') ? 'active' : '' }}" href="{{route('user.settings')}}"><i class="fa fa-cog"></i>&nbsp;Settings</a></li>
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('user.my-wallet') ? 'active' : '' }}" href="{{route('user.my-wallet')}}"><i class="fa fa-wallet"></i>&nbsp;My Wallet</a></li>
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('user.buy-subscription') ? 'active' : '' }}" href="{{route('user.buy-subscription')}}"><i class="fa-solid fa-money-bill"></i>&nbsp;Buy Subscription</a></li>
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('user.my-subscriptions') ? 'active' : '' }}" href="{{route('user.my-subscriptions')}}"><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp;My Subscriptions</a></li>
                                    <li><a style="color:gray;text-decoration:none;" href="{{route('user.logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout</a></li>
                                </ul>
                            
  </div>
</div>

<!-- Add jQuery from CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

<script>
    $(document).on('keyup', '.searchByAds', function(){
        const inputValue = $(this).val(); // Get the current value of the input
        console.log(inputValue);
        $.ajax({
                url: "{{ route('getAdsBySearch') }}",
                method: 'post',
                data: { "_token" : "{{csrf_token()}}", 'inputValue': inputValue},
                success: function(data){
                    console.log(data)
                    $('.dropdownsearch').empty();
                    if(data){
                        $.each(data, function(index, value) {
                            var category_name = value.category.name;
                            var slug = value.slug;
                            var url = "{{ route('ad-details', ['category_name', ':slug']) }}".replace('category_name', category_name).replace(':slug', slug);
                            $('.dropdownsearch').append('<li><a href="' + url + '">' + value.title + '</a></li>');
                        });
                    }
                }
            });
    })
</script>
        
        <!-- <script>
            document.addEventListener("DOMContentLoaded", function () {
                const categoryItems = document.querySelectorAll(".category-item");

                categoryItems.forEach(item => {
                    item.addEventListener("click", function () {
                        const categoryId = this.getAttribute("data-category-id");
                        const subcategoryDiv = document.getElementById(`subcategory-${categoryId}`);

                        // Close all other subcategory lists
                        document.querySelectorAll(".subcategory-list").forEach(div => {
                            if (div !== subcategoryDiv) {
                                div.style.display = "none";
                            }
                        });

                        // Toggle visibility for the clicked subcategory
                        if (subcategoryDiv.style.display === "none" || subcategoryDiv.style.display === "") {
                            subcategoryDiv.style.display = "block";
                        } else {
                            subcategoryDiv.style.display = "none";
                        }
                    });
                });
            });
        </script> -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Existing offcanvas functionality
        const categoryItems = document.querySelectorAll(".category-item");

        categoryItems.forEach(item => {
            item.addEventListener("click", function () {
                const categoryId = this.getAttribute("data-category-id");
                const subcategoryDiv = document.getElementById(`subcategory-${categoryId}`);

                // Close all other subcategory lists
                document.querySelectorAll(".subcategory-list").forEach(div => {
                    if (div !== subcategoryDiv) {
                        div.style.display = "none";
                    }
                });

                // Toggle visibility for the clicked subcategory
                if (subcategoryDiv.style.display === "none" || subcategoryDiv.style.display === "") {
                    subcategoryDiv.style.display = "block";
                } else {
                    subcategoryDiv.style.display = "none";
                }
            });
        });

        // Mobile menu click logic for opening dummy offcanvas
        const mobileMenuBtn = document.querySelector(".mobile-only");
        mobileMenuBtn.addEventListener("click", function () {
            const offcanvasEl = document.querySelector("#dummyOffcanvasExample");
            const bootstrapOffcanvas = new bootstrap.Offcanvas(offcanvasEl);
            bootstrapOffcanvas.show();
        });

        // Search toggle functionality
        const searchToggleBtn = document.querySelector(".search-toggle-btn");
        const headerSearchForm = document.querySelector(".header-search-form");

        function toggleSearchForm() {
            if (headerSearchForm.style.display === "none" || headerSearchForm.style.display === "") {
                headerSearchForm.style.display = "flex"; // Show the input box
                searchToggleBtn.style.display = "block"; // Keep the button visible
            } else {
                headerSearchForm.style.display = "none"; // Hide the input box
                searchToggleBtn.style.display = "block"; // Keep the button visible
            }
        }

        function closeSearchForm() {
            headerSearchForm.style.display = "none";
            searchToggleBtn.style.display = "block";
        }

        // Toggle search form on button click
        searchToggleBtn.addEventListener("click", function (event) {
            toggleSearchForm();
            event.stopPropagation(); // Prevent click event from propagating to the document
        });

        // Close the search form when clicking outside
        document.addEventListener("click", function (event) {
            if (!headerSearchForm.contains(event.target) && !searchToggleBtn.contains(event.target)) {
                closeSearchForm();
            }
        });
    });
</script>

        
        
        
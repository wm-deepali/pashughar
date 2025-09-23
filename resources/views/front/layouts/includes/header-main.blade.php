@php
$suggestCategories = App\Models\Category::all();

@endphp
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<style>
    .dashmenu li{
        padding-bottom:10px;
    }
    .dashmenu li a i{
        padding-right:7px;
    }
</style>

<!--=====================================
                    HEADER PART START
        =======================================-->
                    <div class="top_header_list">
            <div class="top_email">
                <p><i class="fas fa-envelope"></i> &nbsp;&nbsp;admin@pashughar.com</p>
                <div class="top_vender">
                                           <p data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><span>                            <img src="{{asset('front/images/category.png')}}" alt="logo" style="width:20px;margin-top:-4px"></span>&nbsp;&nbsp;All Categories</p>
                    <div class="line"></div>
                         
                       <p><i class="fa fa-user"></i>&nbsp;&nbsp;Become Vendor</p>
                       <div class="line"></div>
                        <p><a href="{{route('bulk-enquiry')}} " style="color:#000;text-decoration:none;"><i class="fas fa-mail-bulk"></i>&nbsp;&nbsp;Send Bulk Enquiry</a></p>

                     
                    
                </div>
            </div>
        </div>
        
         <div class="top_header_list-mobile">
             
             <div class="top_vender1" style="display:flex;justify-content:space-between;align-items:center;">
                                           
                    
                         
                       <p class="mobile-only" data-bs-toggle="offcanvas" href="#dummyOffcanvasExample1" role="button" aria-controls="dummyOffcanvasExample1">
    <span>
        <img src="{{asset('front/images/menu1.png')}}" alt="logo" style="width:25px;margin-left:14px;margin-top: 5px;">
    </span>
</p>

                       <div class="header-search-container">
    <button class="search-toggle-btn" type="button" title="Search">
        <i class="fas fa-search"></i>&nbsp;&nbsp;Search
    </button>
    <form class="header-search-form" action="{{route('search')}}" style="display: none;">
        <div style="background:#fff; padding:10px;    display: flex
; gap:10px;">
        <input type="text" placeholder="Search, Whatever you need..." name="search">
        <button type="submit" title="Search Submit"><i class="fas fa-search"></i></button>
        </div>
    </form>
</div>

                        <p><a href="{{route('bulk-enquiry')}} " style="color:#fff;text-decoration:none;"><i class="fas fa-mail-bulk"></i>&nbsp;&nbsp; Bulk Enquiry</a></p>

                     
                    
                </div>
             </div>
        <header class="header-part">

            <div class="container">
                
                <div class="header-content">
                    <div class="header-left">
                        <!-- <button type="button" class="header-widget sidebar-btn">
                            <i class="fas fa-align-left"></i>
                        </button> -->
                        <a class='header-logo' href="{{URL::to('/')}}">
                            <img src="{{asset('front/images/afarlogo.png')}}" alt="logo">
                        </a>
                        <!-- <a class='header-widget header-user' href='user-form.html'>
                            <img src="images/user.png" alt="user">
                            <span>join me</span>
                        </a> -->
                        <button type="button" class="header-widget search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <form class="header-form" action="{{route('search')}}">
                        <div class="header-search">
                            <input type="text" placeholder="Search, Whatever you needs..." name="search">
                            <button type="submit" title="Search Submit "><i class="fas fa-search"></i></button>
                            
                         </div>
                        
                    </form>
                    <div class="header-right">
                        @if(Auth::guard('member')->user() !='' && !empty(Auth::guard('member')->user()))
                        <a class='btn btn-inline post-btn' style="background:#59984c;color:#fff" data-bs-toggle="offcanvas" href="#dummyOffcanvasExample" role="button" aria-controls="dummyOffcanvasExample" href="">
                            <i class="fas fa-user"></i>
                            <span>{{Auth::guard('member')->user()->full_name}}</span>
                             <i class="fa fa-caret-down" aria-hidden="true"></i>
                        </a>
                        @else
                        <a class='btn btn-inline post-btn' style="background:#59984c;color:#fff" href="{{route('user.login')}}" >
                        <i class="fas fa-sign-in-alt"></i> 
                            <span>Login/Sign Up</span>
                        </a>
                        @endif
                        
                        <a class='btn btn-inline post-btn top-post-add' style="background:#59984c;color:#fff" href="{{route('user.ad-post')}}">
                            <i class="fas fa-plus-circle"></i>
                            <span>post your ad</span>
                        </a>
                        
                    </div>
                     <p class="mobile-only" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><span>                            <img src="{{asset('front/images/cicon.png')}}" alt="logo" style="width:25px;margin-left:14px;margin-top: 14px;"></span></p>
                </div>
            </div>
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
                <h6 class="m-0" style="display:flex;align-items:center;">{{$category->name}}</h6>
                <p style="color:#000;padding-left:0px; margin-top:18px;">
                    ({{isset($category->ads) && $category->ads != '' ? $category->ads->where('status', 'Published')->count() : 0}})
                </p>
            </div>
            <div class="subcategory-list border-top" id="subcategory-{{$category->id}}" style="display: none; padding-left: 0px; margin-top:15px;color:#000">
                <!-- Dummy Subcategories -->
                <p style="margin: 5px 0; color:black;"> <i class="fa fa-arrow-right"></i> Subcategory 1 for {{$category->name}}</p>
                <p style="margin: 5px 0;color:black;"><i class="fa fa-arrow-right"></i> Subcategory 2 for {{$category->name}}</p>
                <p style="margin: 5px 0;color:black;"><i class="fa fa-arrow-right"></i> Subcategory 3 for {{$category->name}}</p>
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
                                   <ul class="user-dashboard-menu">
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('user.dashboard') ? 'active' : '' }}" href="{{route('user.dashboard')}}"><i class="fa fa-home"></i>&nbsp;Dashboard</a></li>
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('user.profile') ? 'active' : '' }}" href="{{route('user.profile')}}"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Profile</a></li>
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('my-enquiry') ? 'active' : '' }}" href="{{route('user.my-enquiries')}}"><i class="fa-solid fa-clipboard-list"></i></i>&nbsp;My Enquiries</a></li>
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('user.ad-post') ? 'active' : '' }}" href="{{route('user.ad-post')}}"><i class="fa fa-plus"></i>&nbsp;Ad Post</a></li>
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('user.my-ads') ? 'active' : '' }}" href="{{route('user.my-ads')}}"><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp;My Ads</a></li>
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('user.settings') ? 'active' : '' }}" href="{{route('user.settings')}}"><i class="fa fa-cog"></i>&nbsp;Settings</a></li>
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('user.my-wallet') ? 'active' : '' }}" href="{{route('user.my-wallet')}}"><i class="fa fa-wallet"></i>&nbsp;My Wallet</a></li>
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('user.buy-subscription') ? 'active' : '' }}" href="{{route('user.buy-subscription')}}"><i class="fa-solid fa-money-bill"></i>&nbsp;Buy Subscription</a></li>
                                    <li><a style="color:gray;text-decoration:none;" class="{{ Route::is('user.my-subscriptions') ? 'active' : '' }}" href="{{route('user.my-subscriptions')}}"><i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp;My Subscriptions</a></li>
                                    <li><a style="color:gray;text-decoration:none;" href="{{route('user.logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Logout</a></li>
                                </ul>
                            
  </div>
</div>


<div class="offcanvas offcanvas-start" tabindex="-1" id="dummyOffcanvasExample1" aria-labelledby="dummyOffcanvasExampleLabel">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="dummyOffcanvasExampleLabel">Menu</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
                                                                                <ul style="padding-left:0px;" class="dashmenu" >
                                    <li><a class="{{ Route::is('user.dashboard') ? 'active' : '' }}" href="{{route('user.dashboard')}}" style="color:#000; text-decoration:none;"><i class="fa-solid fa-house"></i> Dashboard</a></li>
                                    <li><a class="{{ Route::is('user.profile') ? 'active' : '' }}" href="{{route('user.profile')}}" style="color:#000; text-decoration:none;"><i class="fa-solid fa-user"></i> Profile</a></li>
                                    <li><a class="{{ Route::is('user.ad-post') ? 'active' : '' }}" href="{{route('user.ad-post')}}" style="color:#000; text-decoration:none;"><i class="fa-solid fa-signs-post"></i> Ad Post</a></li>
                                    <li><a class="{{ Route::is('user.my-ads') ? 'active' : '' }}" href="{{route('user.my-ads')}}" style="color:#000; text-decoration:none;"><i class="fa-solid fa-user-tag"></i> My Ads</a></li>
                                    <li><a class="{{ Route::is('user.settings') ? 'active' : '' }}" href="{{route('user.settings')}}" style="color:#000; text-decoration:none;"><i class="fa-solid fa-gear"></i> Settings</a></li>
                                    <li><a class="{{ Route::is('user.my-wallet') ? 'active' : '' }}" href="{{route('user.my-wallet')}}" style="color:#000; text-decoration:none;"><i class="fa-solid fa-wallet"></i> My Wallet</a></li>
                                    <li><a class="{{ Route::is('user.buy-subscription') ? 'active' : '' }}" href="{{route('user.buy-subscription')}}" style="color:#000; text-decoration:none;"><i class="fa-solid fa-money-bill"></i> Buy Subscription</a></li>
                                    <li><a class="{{ Route::is('user.my-subscriptions') ? 'active' : '' }}" href="{{route('user.my-subscriptions')}}" style="color:#000; text-decoration:none;"><i class="fa-solid fa-money-bill-1"></i> My Subscriptions</a></li>
                                    <li><a href="{{route('user.logout')}}" style="color:#000; text-decoration:none;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                                </ul>
                             <ul class="footer-address border-top pt-2" style="color:#000;">
                                <li style="color:#000">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <p class="m-0" style="color:#000">  Samara University Samara, Afar Regional State FDR Ethiopia</p>
                                </li>
                                <li>
                                    <i class="fas fa-envelope"></i>
                                    <p class="m-0">admin@afaraltmart.com </p>
                                </li>
                                <li>
                                    <i class="fas fa-phone-alt"></i>
                                    <p class="m-0">+251908180786</p>
                                </li>
                                <ul class="footer-social" style="color:#000">
                            <li><a href="#" style="color:#000"><i class="fab fa-facebook-f" style="color:#000"></i></a></li>
                            <li><a href="#" style="color:#000"><i class="fab fa-twitter" style="color:#000"></i></a></li>
                            <li><a href="#" style="color:#000"><i class="fab fa-linkedin-in" style="color:#000"></i></a></li>
                            <li><a href="#" style="color:#000"><i class="fab fa-google-plus-g" style="color:#000"></i></a></li>
                            <li><a href="#" style="color:#000"><i class="fab fa-youtube" style="color:#000"></i></a></li>
                            <li><a style="color:#000" href="https://www.instagram.com/avhclicks_official/profilecard/?igsh=MXR3OXZqcDI1c3JlMw%3D%3D"><i class="fab fa-instagram" style="color:#000"></i></a></li>
                        </ul>
                                
                            </ul>
  </div>
</div>

        </header>
        
        <script>
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

        </script>
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
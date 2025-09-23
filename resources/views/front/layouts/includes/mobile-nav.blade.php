<!--=====================================
            MOBILE-NAV PART START
=======================================-->
<nav class="mobile-nav">
    <div class="container">
        <div class="mobile-group">
            <a class='mobile-widget' href="{{URL::to('/')}}">
                <i class="fas fa-home"></i>
                <span>home</span>
            </a>
            @if(Auth::guard('member')->user() !='' && !empty(Auth::guard('member')->user()))
<a class='mobile-widget' href="{{route('user.dashboard')}}">
                <i class="fas fa-user"></i>
                <span>Dashboard</span>
            </a>
                        @else
                        <a class='mobile-widget' href="{{route('user.login')}}">
                <i class="fas fa-user"></i>
                <span>My Account</span>
            </a>
                        @endif
              @if(Auth::guard('member')->user() !='' && !empty(Auth::guard('member')->user()))
              <a class='mobile-widget ' href="{{route('user.my-ads')}}">
<i class="fa fa-list-alt" aria-hidden="true"></i>
                <span>My ADS</span>
              @else
               <a class='mobile-widget' data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" >
                <img src="{{asset('front/images/cicon.png')}}" alt="logo" style="width:15px;margin-bottom: 6px;">
                <span>Categories</span>
            </a>
              
               @endif
             
            
             <a class='mobile-widget' href="{{route('purchase-subscription')}}">
<img src="{{asset('front/images/forex.png')}}" alt="logo" style="width:15px;margin-bottom: 6px;">
                <span>Price & Plan </span>
            </a>
<!--             <a class='mobile-widget' href="{{URL::to('/')}}">-->
<!--<img src="{{asset('front/images/forex.png')}}" alt="logo" style="width:15px;margin-bottom: 6px;">-->
<!--                <span>Enquiries  </span>-->
<!--            </a>-->
            
                         <a class='mobile-widget plus-btn' href="{{route('user.ad-post')}}">
                <i class="fas fa-plus"></i>
                <span>Ad Post</span>
            </a>
          

            
           
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
</nav>
<!--=====================================
            MOBILE-NAV PART END
=======================================-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    li {
    list-style-type: none; /* Removes the bullet points */
}
p{
    font-size:15px;
}
</style>
<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link {{ Request::is('master*') ? 'active' : '' }}" data-toggle="collapse" data-target="#masterSubMenu">
        <div class="d-flex justify-content-between">
            <div>
               <i class="nav-icon fas fa-laptop-code"></i>
           <p>Master</p>  
            </div>
           
        <i class="fa fa-caret-down" aria-hidden="true" style="margin-top:5px"></i>
        </div>
        
    </a>
    <ul class="nav-item collapse" id="masterSubMenu" style="padding-left:10px;">
        <li class="nav-item"><a href="{{route('master.category.index')}}" class="nav-link"><i class="nav-icon fa fa-list-alt" aria-hidden="true"></i><p>Categories</p></a></li>
        <li class="nav-item"><a href="{{route('master.subcategory.index')}}" class="nav-link"><i class="nav-icon fas fa-file-alt"></i><p>Sub Categories</p></a></li>
        <li class="nav-item"><a href="{{route('master.country.index')}}" class="nav-link"><i class="nav-icon fa fa-flag" aria-hidden="true"></i><p>Country</p></a></li>
        <li class="nav-item"><a href="{{route('master.state.index')}}" class="nav-link"><i class="nav-icon fas fa-thumbtack" aria-hidden="true"></i><p>State</p></a></li>
        <li class="nav-item"><a href="{{route('master.city.index')}}" class="nav-link"><i class='nav-icon fas fa-city' aria-hidden="true"></i><p>City</p></a></li>
        <!--li class="nav-item"><a href="{{route('master.location.index')}}" class="nav-link"><i class='nav-icon fa fa-map-marker' aria-hidden="true"></i><p>Location</p></a></li>
        <li class="nav-item"><a href="{{route('master.pincode.index')}}" class="nav-link"><i class='nav-icon fa fa-map-pin' aria-hidden="true"></i><p>Zip Codes</p></a></li--->
        
        <li class="nav-item"><a href="{{route('master.brand.index')}}" class="nav-link"><i class='nav-icon fa fa-building' aria-hidden="true"></i><p>Brands</p></a></li>
        <!--li class="nav-item"><a href="{{route('master.vehicle.type.index')}}" class="nav-link"><i class='nav-icon fa fa-car' aria-hidden="true"></i><p>Vehicle Type</p></a></li>
        <li class="nav-item"><a href="{{route('master.fuel.type.index')}}" class="nav-link"><i class='nav-icon fas fa-car' aria-hidden="true"></i><p>Fuel Type</p></a></li>
        <li class="nav-item"><a href="{{route('master.transmission.index')}}" class="nav-link"><i class='nav-icon fa fa-car' aria-hidden="true"></i><p>Transmission</p></a></li>
        <li class="nav-item"><a href="{{route('master.engine.capacity.index')}}" class="nav-link"><i class='nav-icon fa fa-car' aria-hidden="true"></i><p>Engine Capacity</p></a></li>
        <li class="nav-item"><a href="{{route('master.property.category.index')}}" class="nav-link"><i class='nav-icon fa fa-car' aria-hidden="true"></i><p>Property Category</p></a></li>
        <li class="nav-item"><a href="{{route('master.property.type.index')}}" class="nav-link"><i class='nav-icon fa fa-car' aria-hidden="true"></i><p>Property Type</p></a></li>
        <li class="nav-item"><a href="{{route('master.construction.status.index')}}" class="nav-link"><i class='nav-icon fa fa-car' aria-hidden="true"></i><p>Construction Status</p></a></li>
        <li class="nav-item"><a href="{{route('master.owner.type.index')}}" class="nav-link"><i class='nav-icon fa fa-car' aria-hidden="true"></i><p>Owner Type</p></a></li>
        <li class="nav-item"><a href="{{route('master.furnishing.status.index')}}" class="nav-link"><i class='nav-icon fa fa-car' aria-hidden="true"></i><p>Furnishing Status</p></a></li>
        <li class="nav-item"><a href="{{route('master.job.category.index')}}" class="nav-link"><i class='nav-icon fa fa-car' aria-hidden="true"></i><p>Job Category</p></a></li>
        <li class="nav-item"><a href="{{route('master.job.subcategory.index')}}" class="nav-link"><i class='nav-icon fa fa-car' aria-hidden="true"></i><p>Job Sub Category</p></a></li>
        <li class="nav-item"><a href="{{route('master.employment.type.index')}}" class="nav-link"><i class='nav-icon fa fa-car' aria-hidden="true"></i><p>Employment Type</p></a></li>
        <li class="nav-item"><a href="{{route('master.storage.index')}}" class="nav-link"><i class='nav-icon fa fa-car' aria-hidden="true"></i><p>Storage</p></a></li>
        <li class="nav-item"><a href="{{route('master.ram.index')}}" class="nav-link"><i class='nav-icon fa fa-car' aria-hidden="true"></i><p>Ram</p></a></li>
        <li class="nav-item"><a href="{{route('master.display.type.index')}}" class="nav-link"><i class='nav-icon fa fa-car' aria-hidden="true"></i><p>Display Type</p></a></li>
        <li class="nav-item"><a href="{{route('master.operating.system.index')}}" class="nav-link"><i class='nav-icon fa fa-car' aria-hidden="true"></i><p>Operating System</p></a></li-->
    </ul>
</li>

{{-- chandan --}}
<li class="nav-item">
    <a href="#" class="nav-link {{ Request::is('pages*') ? 'active' : '' }}" data-toggle="collapse" data-target="#contentManagement">
       
         <div class="d-flex justify-content-between">
            <div>
               <i class="nav-icon fa fa-file-text" aria-hidden="true"></i>
        <p>Content Management</p>  
            </div>
           
        <i class="fa fa-caret-down" aria-hidden="true" style="margin-top:5px"></i>
        </div>
    </a>
    <ul class="nav-item collapse" id="contentManagement" style="padding-left:10px;">
        <li class="nav-item"><a href="{{ route('pages.index') }}" class="nav-link"><i class="nav-icon fas fa-file-alt" aria-hidden="true"></i><p>Manage Dynamic Pages</p></a></li>
        <li class="nav-item"><a href="{{ route('blogs.index') }}" class="nav-link"><i class="nav-icon fas fa-blog" aria-hidden="true"></i><p>Manage Blogs</p></a></li>

        <li class="nav-item"><a href="{{ route('comments.index') }}" class="nav-link"><i class="nav-icon fas fa-comment" aria-hidden="true"></i><p>Manage Comments</p></a></li>
        <li class="nav-item"><a href="{{ route('faq.index') }}" class="nav-link"><i class="nav-icon fas fa-question-circle" aria-hidden="true"></i><p>Manage FAQ</p></a></li>
        <li class="nav-item"><a href="{{ route('abouts.index') }}" class="nav-link"><i class="nav-icon fas fa-info-circle" aria-hidden="true"></i><p>Manage About Us</p></a></li>
        <li class="nav-item"><a href="{{ route('enquirys.index') }}" class="nav-link"><i class="nav-icon fas fa-question-circle" aria-hidden="true"></i><p>Manage Enquiry</p></a></li>
        <li class="nav-item"><a href="{{ route('teams.index') }}" class="nav-link"><i class="nav-icon fas fa-users" aria-hidden="true"></i><p>Manage Team</p></a></li>
        <li class="nav-item"><a href="{{ route('manage-seo.index') }}" class="nav-link"><i class="nav-icon fas fa-users" aria-hidden="true"></i><p>Manage SEO</p></a></li>
    </ul>
</li>


<li class="nav-item">
    <a href="{{ route('form-features.index') }}" class="nav-link {{ Request::is('form-features') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-text-slash"></i>
        <!--<i class="nav-icon fas fa-cog"></i>-->
        <p>Ad Form Features</p>
        
        
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('subscriptions.index') }}" class="nav-link {{ Request::is('subscriptions') ? 'active' : '' }}">
        <i class="nav-icon fa-solid fa-money-bill"></i>
        <!--<i class="nav-icon fas fa-cog"></i>-->
        <p>Membership Plan</p>
    </a>
</li>


<li class="nav-item">
    <a href="#" class="nav-link {{ Request::is('manage-users*') ? 'active' : '' }}" data-toggle="collapse" data-target="#usersandorders">
        
         <div class="d-flex justify-content-between">
            <div>
                <i class="nav-icon fa-regular fa-user"></i>
<!--<i class="nav-icon fas fa-laptop-code"></i>-->
        <p>Users & Subscriptions</p>
            </div>
           
        <i class="fa fa-caret-down" aria-hidden="true" style="margin-top:5px"></i>
        </div>
    </a>
    <ul class="nav-item collapse" id="usersandorders" style="padding-left:10px;">
        <li class="nav-item">
    <a href="{{ route('manage-users.index') }}" class="nav-link {{ Request::is('manage-users') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Manage Users</p>
    </a>
     <a href="{{ route('manage-user-subscriptions') }}" class="nav-link {{ Request::is('manage-user-subscriptions') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p style="white-space:nowrap;">Manage User Subscriptions</p>
    </a>
</li>

    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link {{ Request::is('manage-ads*') ? 'active' : '' }}" data-toggle="collapse" data-target="#adsandanalytics">
       
        <div class="d-flex justify-content-between">
            <div>
                <i class="nav-icon fa-solid fa-chart-simple"></i>
 <!--<i class="nav-icon fas fa-laptop-code"></i>-->
        <p>Ads & Analytics</p>
            </div>
           
        <i class="fa fa-caret-down" aria-hidden="true" style="margin-top:5px"></i>
        </div>
    </a>
    <ul class="nav-item collapse" id="adsandanalytics" style="padding-left:10px;">
        <li class="nav-item">
    <a href="{{ route('manage-ads.index') }}" class="nav-link {{ Request::is('manage-ads') ? 'active' : '' }}">
        <i class="nav-icon fas fa-cog"></i>
        <p>Manage User Ads</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('ad-analytics') }}" class="nav-link {{ Request::is('ad-analytics') ? 'active' : '' }}">
        <i class="fas fa-chart-bar"></i>
        <p>Ad Analytics</p>
    </a>
</li>

    </ul>
</li>






<li class="nav-item">
    <a href="#" style="white-space:nowrap;" class="nav-link {{ Request::is('transactions*') ? 'active' : '' }}" data-toggle="collapse" data-target="#transactionSubMenu">
       
         <div class="d-flex justify-content-between">
            <div>
                <i class="nav-icon fa-regular fa-credit-card"></i>
 <!--<i class="nav-icon fas fa-laptop-code"></i>-->
        <p style="white-space:nowrap;">Payments & Transactions</p>
            </div>
           
        <i class="fa fa-caret-down" aria-hidden="true" ></i>
        </div>
    </a>
    <ul class="nav-item collapse" id="transactionSubMenu" style="padding-left:10px;">
        <li class="nav-item"><a href="{{route('transactions.pending-payments')}}" class="nav-link"><i class="nav-icon fa fa-list-alt" aria-hidden="true"></i><p>Pending Payments </p></a></li>
        <li class="nav-item"><a href="{{route('transactions.approved-payments')}}" class="nav-link"><i class="nav-icon fa fa-list-alt" aria-hidden="true"></i><p>Approved Payments </p></a></li>
        
    </ul>
</li>







<li class="nav-item">
    <a href="{{ route('manage-contact-us.index') }}" class="nav-link {{ Request::is('manage-contact-us') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Manage Contact Us enquiry</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('seller-ads-enquiries') }}" class="nav-link {{ Request::is('seller-ads-enquiries') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Seller Ads Enquiries</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('ad-reviews') }}" class="nav-link {{ Request::is('ad-reviews') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Seller Ads Review</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('manage-subscribers') }}" class="nav-link {{ Request::is('manage-subscribers') ? 'active' : '' }}">
        <i class="nav-icon fas fa-envelope"></i>
        <p>Manage Subscribers</p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link {{ Request::is('transactions*') ? 'active' : '' }}" data-toggle="collapse" data-target="#adminsettings">
        <i class="nav-icon fa-solid fa-gear"></i>
        <!--<i class="nav-icon fas fa-laptop-code"></i>-->
        <p>Admin Settings</p>
    </a>
    <ul class="nav-item collapse" id="adminsettings" style="padding-left:10px;">
        
        <li class="nav-item">
    <a href="{{ route('admin.settings') }}" class="nav-link {{ Request::is('admin-settings') ? 'active' : '' }}">
        <i class="nav-icon fas fa-cog"></i>
        <p>Profile & Invoice</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('wallet-online-payment-master.index') }}" class="nav-link {{ Request::is('wallet-online-payment-master') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Manage Bank Account</p>
    </a>
</li>
        </ul>



@extends('front.layouts.master')

@section('title')
Dashboard
@endsection

@php
$adCount = App\Models\Ad::where('user_id', Auth::guard('member')->user()->id)->where('delete_status', '0')->where('status', 'Published')->count();
$pendingadCount = App\Models\Ad::where('user_id', Auth::guard('member')->user()->id)->where('delete_status', '0')->where('status', 'Pending')->count();
@endphp
@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/dashboard.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css">
@endpush
@section('content')

<section class="dash-header-part1">
            <div class="container">
                <div class="dash-header-card">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="dash-header-left">
                                <div class="dash-avatar">
                                    @if(Auth::guard('member')->user()->profile_pic !='')
                                    @if (strpos(Auth::guard('member')->user()->profile_pic,'https') !== false) 
                                    <a href="#"><img src="{{Auth::guard('member')->user()->profile_pic}}"></a>
                                    @else
                                    <a href="#"><img src="{{asset('storage').'/'.Auth::guard('member')->user()->profile_pic}}"></a>
                                    @endif
                                    @else
                                    <a href="#"><img src="{{asset('front/images/avatar/user.png')}}" alt="avatar"></a>
                                    @endif
                                </div>
                                <div class="dash-intro">
                                    <h4><a href="#">{{ Auth::guard('member')->user()->full_name ?? ''}}</a></h4>
                                    
                                    <ul class="dash-meta">
                                        <li>
                                            <i class="fas fa-phone-alt"></i>
                                            <span>{{ Auth::guard('member')->user()->mobile ?? ''}}</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-envelope"></i>
                                            <span>{{ Auth::guard('member')->user()->email ?? ''}}</span>
                                        </li>
                                        <li>
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>{{ Auth::guard('member')->user()->address ?? 'NA'}}</span>
                                        </li>
                                        <li>
                                        <i class="fa fa-user-plus" aria-hidden="true" title="Referral Code"></i> 
                                        <input type="text" value="{{ Auth::guard('member')->user()->referral_code ?? ''}}" id="myInput" style="display:none;">

                                            <span title="Referral Code">{{ Auth::guard('member')->user()->referral_code ?? 'NA'}}</span> <button onclick="copyFunction()" title="Copy Referral Code"  style="margin-left:20px;"><i class="fa fa-copy"></i></button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="dash-header-right">
                                <div class="dash-focus dash-list">
                                    <h2>{{$adCount}}</h2>
                                    <p>Total ads</p>
                                </div>
                                <div class="dash-focus dash-book">
                                    <h2>{{ $totalWalletPonts ?? 0}}</h2>
                                    <p>Reward points</p>
                                </div>
                                <div class="dash-focus dash-rev">
                                    <h2>{{ Auth::guard('member')->user()->used_wallet_points ?? 0}}</h2>
                                    <p>Used Points</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!empty($subscriber_history_check))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dash-header-alert alert alert-add fade show" >
                                @if($subscriber_history_check->payment_status == 'Pending')
                                <p>Our Team is reviewing your payment detail once it is verified we will notify you on your email, thank you for your patience.</p>
                                @else if($subscriber_history_check->payment_status == 'Completed')
                                 <p>Congratulations! your payment has been approved now you can start posting your Ads.</p>
                                @endif
                                <button data-dismiss="alert"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dash-menu-list">
                                <ul style="padding-left:0px;">
                                    <li><a class="{{ Route::is('user.dashboard') ? 'active' : '' }}" href="{{route('user.dashboard')}}">dashboard</a></li>
                                    <li><a class="{{ Route::is('user.profile') ? 'active' : '' }}" href="{{route('user.profile')}}">Profile</a></li>
                                    <li><a class="{{ Route::is('user.ad-post') ? 'active' : '' }}" href="{{route('user.ad-post')}}">ad post</a></li>
                                    <li><a class="{{ Route::is('user.my-ads') ? 'active' : '' }}" href="{{route('user.my-ads')}}">my ads</a></li>
                                    <li><a class="{{ Route::is('user.settings') ? 'active' : '' }}" href="{{route('user.settings')}}">settings</a></li>
                                    <li><a class="{{ Route::is('user.my-wallet') ? 'active' : '' }}" href="{{route('user.my-wallet')}}">My Wallet</a></li>
                                    <li><a class="{{ Route::is('user.buy-subscription') ? 'active' : '' }}" href="{{route('user.buy-subscription')}}">Buy Subscription</a></li>
                                    <li><a class="{{ Route::is('user.my-subscriptions') ? 'active' : '' }}" href="{{route('user.my-subscriptions')}}">My Subscriptions</a></li>
                                    <li><a href="{{route('user.logout')}}">logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<section class="dashboard-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="account-card alert fade show">
                    <div class="account-title">
                        <h3>Welcome!</h3>
                        <button data-dismiss="alert">close</button>
                    </div>
                    <div class="dash-content">
                        <p>Dear Customer,</p> <p>We are thrilled to have you on Afar Logistic & Trade Market platform</p><p>It is the best platform in Ethiopian region to Buy and Sell the Cattles which may includes Camel, Goat, Cow, Buffalo, OX, Chicken, Hen, Fish and other poultry products, apart from this you can also buy or sell Dairy products which may include Curd, Butter, Milk and other dairy products</p>
                    </div>
                </div>
                <div class="account-card alert fade show">
                    <div class="account-title">
                        <h3>Ad Reviews!</h3>
                        <button data-dismiss="alert">close</button>
                    </div>
                    <div class="dash-content">
                        <table id="reviewExample" class="table table-responsive table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="white-space:nowrap;width:20%;">Date & Time</th>
                                <th style="width:20%">Ad Title</th>
                                <th style="width:20%">User Detail</th>
                                <th style="width:10%">Rating</th>
                                <th style="width:20%">Rate For</th>
                               
                                 <th style="width:10%">Review</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($reviews) && count($reviews)>0)
                            @foreach($reviews as $review)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($review->created_at)) }}<br/>{{ date('g:i A', strtotime($review->created_at)) }}</td>
                                
                                <td>{{$review->ad->title ?? "" }}</td>
                                
                                <td>{{$review->name ?? "" }}<br/>{{$review->email ?? "" }}<br/>{{$review->mobile ?? "" }}</td>
                               
                               
                               <td>{{$review->rating ?? "" }}</td>
                               
                               
                                <td>{{$review->quote ?? "" }}</td>
                                
                                <td>{{$review->review ?? "" }}</td>
                                
                            
                                       
                            </tr>
                            @endforeach
                           
                            @endif
                            
                        </tbody>
                        
                    </table>
                    @if(isset($reviews) && count($reviews)>0)
                    {{$reviews->links()}}
                    @endif
                    </div>
                </div>
                
            </div>
            <div class="col-lg-4">
                <div class="account-card alert fade show">
                    <div class="account-title">
                        <h3>Membership</h3>
                        <button data-dismiss="alert">close</button>
                    </div>
                    @php
                    if(isset($history) && !empty($history))
                    {
                        if($history->subscription_expiry < date('Y-m-d'))
                        {
                            $status = 'Expired';
                        }
                        else{
                            $status = 'Active';
                        }
                    }
                    else{
                        $status = '';
                    }
                    @endphp
                    <ul class="account-card-list">
                        @if(!empty($history))
                        <li><h5>Package Name</h5><p>{{(isset($history) && !empty($history) && $history->subscriptions !='') ? $history->subscriptions->name : ''}}</p></li>
                        <li><h5>Status</h5><p>{{$status}}</p></li>
                        <li><h5>Joined</h5><p>{{date('F d, Y', strtotime($history->created_at)) ?? ''}}</p></li>
                        <li><h5>Expire</h5><p>{{date('F d, Y', strtotime($history->subscription_expiry)) ?? ''}}</p></li>
                        @else
                        <li><h5>Data not found</h5>
                        @endif
                        
                    </ul>
                </div>
                <div class="account-card alert fade show">
                    <div class="account-title">
                        <h3>Current Info</h3>
                        <button data-dismiss="alert">close</button>
                    </div>
                    <ul class="account-card-list">
                        <li><h5>Active Ads</h5><h6>{{$adCount}}</h6></li>
                        <li><h5>Pending Ads</h5><h6>{{$pendingadCount}}</h6></li>
                    </ul>
                </div>
                
                
            </div>
        </div>
    </div>
</section>
@endsection
@push('after-scripts')



<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap4.js"></script>

<script>


new DataTable('#reviewExample', {
    "bLengthChange": false,
    "bPaginate": false,
    "info": false
});

</script>
@endpush
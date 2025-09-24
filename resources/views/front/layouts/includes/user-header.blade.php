@php
$adCount = App\Models\Ad::where('user_id', Auth::guard('member')->user()->id)->where('delete_status', '0')->count();
$totalWalletPonts = App\Models\WalletAmount::where('user_id', Auth::guard('member')->user()->id)->sum('points');
$subscriber_history_check  = App\Models\SubscriptionHistory::where('user_id',Auth::guard('member')->user()->id)->whereDate('subscription_expiry','>=',date('Y-m-d'))->where('paid_amount', '!=', 0)->orderBy('created_at','DESC')->first();

@endphp
<section class="dash-header-part">
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
                            <div class="dash-header-alert alert fade show">
                                @if($subscriber_history_check->payment_status == 'Pending')
                                <p>Our Team is reviewing your payment detail once it is verified we will notify you on your email, thank you for your patience.</p>
                                @elseif($subscriber_history_check->payment_status == 'Completed')
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
                                <ul>
                                    <li><a class="{{ Route::is('user.dashboard') ? 'active' : '' }}" href="{{route('user.dashboard')}}">dashboard</a></li>
                                    <li><a class="{{ Route::is('user.profile') ? 'active' : '' }}" href="{{route('user.profile')}}">Profile</a></li>
                                    <li><a class="{{ Route::is('user.post-your-ad') ? 'active' : '' }}" href="{{route('user.post-your-ad')}}">ad post</a></li>
                                    <li><a class="{{ Route::is('user.my-ads') ? 'active' : '' }}" href="{{route('user.my-ads')}}">my ads</a></li>
                                    <li><a class="{{ Route::is('user.my-enquiries') ? 'active' : '' }}" href="{{route('user.my-enquiries')}}"> enquiries</a></li>
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
        @push('after-script')
        <script>
        function copyFunction() {

  var copyText = document.getElementById("myInput");

  // Select the text 
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);

  // Alert the copied text
  alert("Copied");
}
</script>
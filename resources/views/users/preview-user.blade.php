<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group row">
           <div class="col-sm-4">
               <label class="con-label">Profile Pic</label><br>
               @if(isset($user->profile_pic) && $user->profile_pic !='')
                @if (strpos($user->profile_pic,'https') !== false) 
                <img class="mt-2 img-fluid" src="{{$user->profile_pic}}" alt="User Image" style="height:70px;">
                @else
                <img class="mt-2 img-fluid" src="{{ asset('storage').'/'.$user->profile_pic}}" alt="User Image" style="height:70px;">
                @endif
                @else
                <img class="mt-2 img-fluid" src="{{asset('front/images/avatar/user.png')}}" alt="User Image" style="height:70px;">
                @endif
              
           </div>
           <div class="col-sm-4">
               <label class="con-label">Member Id</label>
               <h3 class="text-con-label">{{ $user->member_id }}</h3>
           </div>
           <div class="col-sm-4">
               <label class="con-label">Full Name</label>
               <h3 class="text-con-label">{{ $user->full_name }}</h3>
           </div>
       </div>    
       <div class="form-group row">
           
           <div class="col-sm-4">
               <label class="con-label">Email</label>
               <h3 class="text-con-label">{{ $user->email }}</h3>
           </div>
           <div class="col-sm-4">
               <label class="con-label">Mobile</label>
               <h3 class="text-con-label">{{ $user->mobile }}</h3>
           </div>
            <div class="col-sm-4">
               <label class="con-label">User Type</label>
               <h3 class="text-con-label">{{ $user->user_type }}</h3>
           </div>
           
       </div>
       <div class="form-group row">
          
           
            <div class="col-sm-4">
               <label class="con-label">Referral Code</label>
               <h3 class="text-con-label">{{ $user->referral_code }}</h3>
           </div>
           <div class="col-sm-4">
               <label class="con-label">Wallet Points</label>
               <h3 class="text-con-label">{{ $user->wallet_points }}</h3>
           </div>
           <div class="col-sm-4">
               <label class="con-label">Used Wallet Points</label>
               <h3 class="text-con-label">{{ $user->used_wallet_points }}</h3>
           </div>
       </div>
       <div class="form-group row">
          
           <div class="col-sm-4">
               <label class="con-label">Membership Expiry At</label>
               <h3 class="text-con-label">{{ $user->membership_expiry_at }}</h3>
           </div>
            <div class="col-sm-4">
               <label class="con-label">Active Subscription</label>
               <h3 class="text-con-label">{{ $user->activeSubscription->name ?? ''}}</h3>
           </div>
           <div class="col-sm-4">
               <label class="con-label">Status</label>
               <h3 class="text-con-label">{{ $user->status }}</h3>
           </div>
            
       </div>
       
       
       
       <div class="form-group row">
          <div class="col-sm-12">
              <h3>Billing Information</h3>
          </div>
           <div class="col-sm-4">
               <label class="con-label">Country</label>
               <h3 class="text-con-label">{{ $user->countryname->name ?? '' }}</h3>
           </div>
            <div class="col-sm-4">
               <label class="con-label">State</label>
               <h3 class="text-con-label">{{ $user->statename->name ?? '' }}</h3>
           </div>
            <div class="col-sm-4">
               <label class="con-label">City</label>
               <h3 class="text-con-label">{{ $user->cityname->name ?? '' }}</h3>
           </div>
       </div>
       <div class="form-group row">
          
           <div class="col-sm-4">
               <label class="con-label">Address</label>
               <h3 class="text-con-label">{{ $user->address }}</h3>
           </div>
            <div class="col-sm-4">
               <label class="con-label">Zipcode</label>
               <h3 class="text-con-label">{{ $user->zipcode }}</h3>
           </div>
            
       </div>
       
       
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
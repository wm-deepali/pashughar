@extends('front.layouts.master')

@section('title')
Setting
@endsection
@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/setting.css')}}">
@endpush
@section('content')

<!--=====================================
            MY ADS PART START
=======================================-->
<div class="setting-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card alert fade show">
                    <div class="account-title">
                        <h3>Edit Profile(First complete your profile before purchase subscription)</h3>
                        <!--<button data-dismiss="alert">close</button>-->
                    </div>
                    <form class="setting-form" action="{{ route('save.settings') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="full_name" value="{{Auth::guard('member')->user()->full_name}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{Auth::guard('member')->user()->email}}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Mobile</label>
                                    <input type="text" class="form-control" name="mobile" value="{{Auth::guard('member')->user()->mobile}}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{Auth::guard('member')->user()->address ?? ''}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">State</label>
                                    <select class="form-control custom-select" name="state" id="state_id" required>
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                    <option value="{{$state->id}}" {{Auth::guard('member')->user()->state !='' && Auth::guard('member')->user()->state ==$state->id ? 'selected':'' }}>{{$state->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">City</label>
                                    @if(Auth::guard('member')->user()->city != '')
                                    <select class="form-control custom-select" name="city" id="city" required>
                                        <option value="">City</option> 
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}"  {{Auth::guard('member')->user()->city !='' && Auth::guard('member')->user()->city ==$city->id ? 'selected':'' }}>{{$city->name}}</option>
                                        @endforeach 
                                    </select>
                                    @else
                                    <select class="form-control custom-select" name="city" id="city" required>
                                        <option value="">City</option>  
                                    </select>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Post Code</label>
                                    <input type="text" class="form-control" name="zipcode" value="{{Auth::guard('member')->user()->zipcode ?? ''}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" name="country" value="India" readonly>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Profile Image</label>
                                    <input type="file" name="profile_pic" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="price-btn">
                                <button type="submit" class="btn btn-inline">
                                    <i class="fas fa-user-check"></i>
                                    <span>update profile</span>
                                </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('after-script')
<script>
    $(document).on("change", "#state_id", function() {
        $("#city").html("");
       let state_id = $(this).val();  
       $.ajax({
           url: `{{ URL::to('cities-by-state') }}`,
           type: "post",
           dataType: "json",
           data:{"state_id":state_id, "_token": "{{ csrf_token() }}",},
           success: function(result) {
               console.log(result);
               $("#city").html(result);
              
           }
       });
   });
</script>
@endpush
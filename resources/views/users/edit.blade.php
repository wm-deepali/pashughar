@extends('layouts.app')

@section('content')
<style>
    div.gallery img
    {
        width:60px;
    }
</style>
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage User</li>
            </ol>
          </div>
        </div>
    </section>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h5>{{ Session::get('success') }}</h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php Session::forget('success'); ?>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h5>{{ Session::get('error') }}</h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php Session::forget('error'); ?>
    </div>
    @endif
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="d-grid d-md-flex justify-content-md-end m-3">
                            <a href="{{route('manage-users.index')}}" class="btn btn-outline-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{route('manage-users.update', $user->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="member_id">Member Id</label>
                                        <input type="text" class="form-control" id="member_id" name="member_id" value="{{$user->member_id}}" readonly required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="full_name">Full Name</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" value="{{$user->full_name}}" required>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="mobile">Mobile</label>
                                        <input type="number" class="form-control" id="mobile" name="mobile" value="{{$user->mobile}}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{$user->address}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" name="country" value="India" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="state">State</label>
                                       <select class="form-control custom-select" name="state" id="state_id">
                                            <option value="">Select State</option>
                                            @foreach($states as $state)
                                            <option value="{{$state->id}}" {{$user->state !='' && $user->state ==$state->id ? 'selected':'' }}>{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                     <div class="form-group col-md-6">
                                        <label for="city">City</label>
                                       @if($user->city != '')
                                    <select class="form-control custom-select" name="city" id="city">
                                        <option value="">City</option> 
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}"  {{$user->city !='' && $user->city ==$city->id ? 'selected':'' }}>{{$city->name}}</option>
                                        @endforeach 
                                    </select>
                                    @else
                                    <select class="form-control custom-select" name="city" id="city" required>
                                        <option value="">City</option>  
                                    </select>
                                    @endif
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="zipcode">Zipcode</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode" value="{{$user->zipcode}}">
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="profile_pic">Profile Pic</label>
                                        <input type="file" class="form-control" id="profile_pic" name="profile_pic">
                                        
                                        <img id="imgView" class="mt-2" src="" alt="Profile Pic" width="120" style="display:none;">
                                    </div>
                                    
                            
                                    <div class="form-group col-md-6">
                                        <label for="status">Status</label>
                                        @php
                                        $statusArr = array('Active','Block');
                                        @endphp
                                        <select name="status" class="form-control" id="status">
                                            @foreach($statusArr as $status)
                                            <option value="{{$status}}" {{$user->status == $status ? 'selected' : ''}}>{{$status}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--div class="form-group col-md-6">
                                        <label for="remark">Reason For Block</label>
                                        <textarea name="remark" class="form-control"></textarea>
                                    </div-->
                                    
                                    
                                </div>
                            
                                <div class="col-md-12">
                                    <div class="text-md-right"> <!-- Aligns content to the right in medium devices and above -->
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('after-script')
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imgView').src = e.target.result;
                document.getElementById('imgView').style = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
    
    
</script>
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
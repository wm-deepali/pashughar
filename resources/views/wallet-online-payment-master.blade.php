@extends('layouts.app')

@section('content')
<style>
    .add_button
   {
    margin-top: 10%;
   }
   .remove_button
   {
    margin-top: 10%;
   }
</style>
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Company Bank Detail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Company Bank Detail</li>
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
                        
                        <div class="card-body">
							<form class="form form-horizontal" action="{{route('wallet-online-payment-master-store')}}" method="POST" enctype= multipart/form-data>
                                @csrf
                                <div class="form-group row  mb-3">
												 
									<div class="col-sm-6  mb-3">
										<label class="label label-control">BarCode Image</label>
										<input type="file" class="form-control" name="image"  value="">
										<input type="hidden" class="form-control" name="image"  value="{{$wallet->bar_code_image}}">
										
										@if (isset($wallet))
										<img src ="{{ asset('storage').'/'.$wallet->bar_code_image }}" height="50" width="50">
										@endif
										<div class="text-danger" id="image-err"></div>
									</div>
									<div class="col-sm-6 mb-3">
										<label class="label label-control">UPI Id</label>
										<input type="text" class="form-control" name="upi_id" id="upi_id" placeholder="Enter UPI ID" value="{{ isset($wallet)? $wallet->upi_id : null }}">
										<div class="text-danger" id="upi_id-err"></div>
									</div>
										
										
								
									<div class="col-sm-6  mb-3">
										<label class="label label-control">Account Number</label>
										<input type="text" class="form-control" name="account_number" id="account_number" placeholder="Enter  Account Number" value="{{ isset($wallet)? $wallet->account_number : null }}">
										<div class="text-danger" id="account_number-err"></div>
									</div>
									<div class="col-sm-6 mb-3">
										<label class="label label-control">Business Account Name</label>
										<input type="text" class="form-control" name="bank_account_name" id="bank_account_name" placeholder="Enter Account Name" value="{{ isset($wallet)? $wallet->bank_account_name : null }}">
										<div class="text-danger" id="bank_name-err"></div>
									</div>
									<div class="col-sm-6 mb-3">
										<label class="label label-control">Bank Name</label>
										<input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Enter Bank name" value="{{ isset($wallet)? $wallet->bank_name : null }}">
										<div class="text-danger" id="bank_name-err"></div>
									</div>
									<div class="col-sm-6 mb-3">
										<label class="label label-control">Bank Branch</label>
										<input type="text" class="form-control" name="bank_branch" id="bank_branch" placeholder="Enter Bank Branch" value="{{ isset($wallet)? $wallet->bank_branch : null }}">
										<div class="text-danger" id="bank_branch-err"></div>
									</div>
									<div class="col-sm-6 mb-3">
										<label class="label label-control">IFSC Code</label>
										<input type="text" class="form-control" name="ifsc_code" id="ifsc_code" placeholder="Enter  IFSC Code" value="{{ isset($wallet)? $wallet->ifsc_code : null }}">
										<div class="text-danger" id="ifsc_code-err"></div>
									</div>
									<div class="col-sm-6 mb-3">
										<label class="label label-control">SWIFT Code</label>
										<input type="text" class="form-control" name="swift_code" id="swift_code" placeholder="Enter  Swift Code" value="{{ isset($wallet)? $wallet->swift_code : null }}">
										<div class="text-danger" id="swift_code-err"></div>
									</div>
										
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

											
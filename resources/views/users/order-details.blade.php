@extends('layouts.app')

@section('content')
<style>
    .text-con-label {
    font-size: 13px;
}
</style>
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order Details</li>
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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        
                        <div class="card-body">
                            <div class="col-12">
                                <h3>Subscription Details</h3>
                            </div>
                            
                            <div class="form-group row">
                               <div class="col-sm-4">
                                   <label class="con-label">Subscription Name</label><br>
                                   <h3 class="text-con-label">{{ $subscription->subscriptions->name ?? '' }}</h3>
                               </div>
                                <div class="col-sm-4">
                                   <label class="con-label">Subscription Expiry</label><br>
                                   <h3 class="text-con-label">{{ $subscription->subscription_expiry ?? '' }}</h3>
                               </div>
                                <div class="col-sm-4">
                                   <label class="con-label">Subscription Validity(Days)</label><br>
                                   <h3 class="text-con-label">{{ $subscription->	subscription_validity ?? '' }}</h3>
                               </div>
                           </div>  
                          
                           
                           <div class="form-group row">
                               <div class="col-sm-4">
                                   <label class="con-label">MRP</label><br>
                                   <h3 class="text-con-label">{{ $subscription->mrp ?? '' }}</h3>
                               </div>
                               <div class="col-sm-4">
                                   <label class="con-label">Discount(%)</label><br>
                                   <h3 class="text-con-label">{{ $subscription->discount_amount ?? '' }}</h3>
                               </div>
                               <div class="col-sm-4">
                                   <label class="con-label">Discount Amount(ETB)</label><br>
                                   <h3 class="text-con-label">{{ ($subscription->mrp *$subscription->discount_amount)/100 ?? '' }}</h3>
                               </div>
                               
                           </div>  
                           
                           <div class="form-group row">
                               <div class="col-sm-4">
                                   <label class="con-label">Offered Price</label><br>
                                   <h3 class="text-con-label">{{ $subscription->offered_price ?? '' }}</h3>
                               </div>
                               <div class="col-sm-4">
                                   <label class="con-label">GST</label><br>
                                   <h3 class="text-con-label">{{ $subscription->gst_type ?? '' }}</h3>
                               </div>
                               <div class="col-sm-4">
                                   <label class="con-label">GST Amount</label><br>
                                   <h3 class="text-con-label">{{ $subscription->gst_amount ?? '' }}</h3>
                               </div>
                               
                           </div> 
                           
                           <div class="form-group row">
                               <div class="col-sm-4">
                                   <label class="con-label">Wallet Used Amount</label><br>
                                   <h3 class="text-con-label">{{ $subscription->wallet_used_amount ?? '' }}</h3>
                               </div>
                               <div class="col-sm-4">
                                   <label class="con-label">Total Ads</label><br>
                                   <h3 class="text-con-label">{{ $subscription->subscriptions->no_of_ads ?? '' }}</h3>
                               </div>
                               <div class="col-sm-4">
                                   <label class="con-label">Used Ads</label><br>
                                   <h3 class="text-con-label">{{ $subscription->used_ads ?? '' }}</h3>
                               </div>
                               
                           </div> 
                           <div class="form-group row">
                               
                               <div class="col-sm-4">
                                   <label class="con-label">Unused Ads</label><br>
                                   <h3 class="text-con-label">{{ $subscription->remaining_ads ?? '' }}</h3>
                               </div>
                           </div> 
                           <div class="col-12">
                                <h3>Payment Details</h3>
                            </div>
                            <div class="form-group row">
                               <div class="col-sm-4">
                                   <label class="con-label">Payment Method</label><br>
                                   <h3 class="text-con-label">{{ $subscription->payment_method ?? '' }}</h3>
                               </div>
                               <div class="col-sm-4">
                                   <label class="con-label">Transaction Id</label><br>
                                   <h3 class="text-con-label">{{ $subscription->transaction_id ?? '' }}</h3>
                               </div>
                               <div class="col-sm-4">
                                   <label class="con-label">Order number</label><br>
                                   <h3 class="text-con-label">{{ $subscription->order_number ?? '' }}</h3>
                               </div>
                           </div> 
                           
                           <div class="form-group row">
                               <div class="col-sm-4">
                                   <label class="con-label">Payment Date</label><br>
                                   <h3 class="text-con-label">{{ $subscription->payment_date ?? '' }}</h3>
                               </div>
                               <div class="col-sm-4">
                                   <label class="con-label">Paid Amount(ETB)</label><br>
                                   <h3 class="text-con-label">{{ $subscription->paid_amount ?? '' }}</h3>
                               </div>
                               <div class="col-sm-4">
                                   <label class="con-label">Screenshot</label><br>
                                  @if($subscription->screenshot !='')
                                        <img class="mt-2 img-fluid" src="{{ asset('storage').'/'.$subscription->screenshot}}" alt="screenshot" style="height:70px;">
                                        @endif
                               </div>
                           </div> 
                           
                           <div class="form-group row">
                               <div class="col-sm-4">
                                   <label class="con-label">Remark</label><br>
                                   <h3 class="text-con-label">{{ $subscription->remark ?? '' }}</h3>
                               </div>
                               <div class="col-sm-4">
                                   <label class="con-label">Payment Status</label><br>
                                   <h3 class="text-con-label">@if($subscription->payment_status == 'Completed')
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-danger">Pending</span>
                                                @endif</h3>
                               </div>
                              
                           </div> 
                           <div class="col-12">
                                <h3>Posted Ads Details</h3>
                            </div>
                           <div class="form-group row">
                               <div class="col-sm-4">
                                   <label class="con-label">Total Posted Ads</label><br>
                                   <h3 class="text-con-label">{{ $totalAds ?? '0' }}</h3>
                               </div>
                               <div class="col-sm-4">
                                   <label class="con-label">Published Ads</label><br>
                                   <h3 class="text-con-label">{{ $publishedAds ?? '0' }}</h3>
                               </div>
                               <div class="col-sm-4">
                                   <label class="con-label">Pending Ads</label><br>
                                   <h3 class="text-con-label">{{ $pendingAds ?? '0' }}</h3>
                               </div>
                           </div> 
                           <div class="col-12">
                                <a href="{{route('manage-user-subscriptions')}}" type="button" class="btn btn-secondary" data-dismiss="modal">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>

</script>
@endsection
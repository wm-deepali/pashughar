@extends('front.layouts.master')

@section('title')
My Subscriptions
@endsection
@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/my-ads.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endpush
@section('content')
<style>
    tr>th
    {
        text-align:center !important;
    }
    tr>td
    {
        text-align:center !important;
    }
    
    .custom-select {
    display: inline-block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 1.75rem 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    vertical-align: middle;
    background: #fff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right 0.75rem center/8px 10px;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    }
    .form-control {
    
    height: calc(1.5em + 0.75rem + 2px);
    
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }


</style>
<!--=====================================
            MY ADS PART START
=======================================-->
<section class="myads-part">
    <div class="container">
        
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card">
                    <div class="account-title">
                        <h3>Subscription History</h3>
                    </div>
                    <table id="example" class="table table-responsive table-striped table-bordered" style="width:100%">
                        <thead style="width:100%">
                            <tr>
                                <th>Date & Time</th>
                                <th>Package</th>
                                <th>Order</th>
                                <th>Payment Status</th>
                                <th>Paid Amount(ETB)</th>
                                <th>Transaction Id</th>
                                <th>MRP(ETB)</th>
                                <th>Discount(ETB)</th>
                                <th>Offer Price(ETB)</th>
                                <th>GST Amount(ETB)</th>
                                <th>Wallet Used Amount(ETB)</th>
                                <th>Used Ads</th>
                                <th>Remaining Ads</th>
                                <th>Subscription Expiry</th>
                            </tr>
                        </thead>
                        <tbody style="width:100%">
                            @if(isset($history) && count($history) > 0)
                            @foreach($history as $res)
                            <tr>
                                <td>{{$res->created_at}}</td>
                                <td>{{isset($res->subscriptions) ? $res->subscriptions->name :" No Plan Active " }}</td>
                                <td>{{$res->order_number}}</td>
                                <td>{{$res->payment_status}}</td>
                                <td>{{$res->paid_amount}}</td>
                                <td>{{$res->transaction_id}}</td>
                                <td>{{$res->mrp}}</td>
                                <td>{{($res->mrp *$res->discount_amount)/100}}</td>
                                <td>{{$res->offered_price}}</td>
                                <td>{{$res->gst_amount}}</td>
                                <td>{{$res->wallet_used_amount}}</td>
                                <td>{{$res->used_ads}}</td>
                                <td>{{$res->remaining_ads}}</td>
                                <td>{{$res->subscription_expiry}}</td>
                                
                            </tr>
                            @endforeach
                            @endif
                            
                        </tbody>
                        
                    </table>
                    {{$history->links()}}
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================
            MY ADS PART END
=======================================-->
@endsection
@push('after-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap4.js"></script>




<script>

new DataTable('#example', {
    "bLengthChange": false,
    "bPaginate": false,
    "info": false
});

</script>
@endpush
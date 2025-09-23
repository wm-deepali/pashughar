@extends('front.layouts.master')

@section('title')
My Wallets
@endsection
@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/my-ads.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap4.css">
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
.breadcrumb{
    background-color:transparent;
}
@media (max-width: 767px) {
  div.dataTables_length {
    display: none !important;
  }
}

</style>
<!--=====================================
            MY ADS PART START
=======================================-->
<section class="myads-part">
    <div class="container">
        <div class="dash-header-card" style="padding: 30px 30px 30px 30px;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="dash-header-right">
                        <div class="dash-focus dash-list">
                        @php
                            $totalWalletPonts = App\Models\WalletAmount::where('user_id', $user->id)->sum('points');
                        @endphp
                            <h2>{{ $totalWalletPonts ?? 0}}</h2>
                            <p>Total Points</p>
                        </div>
                        <div class="dash-focus dash-book">
                            <h2>{{$user->used_wallet_points}}</h2>
                            <p>Used Points</p>
                        </div>
                        <div class="dash-focus dash-rev">
                            <h2>{{$totalWalletPonts - $user->used_wallet_points}}</h2>
                            <p>Remaining Points</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/><br/>
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card">
                    <div class="account-title">
                        <h3>Wallet History</h3>
                    </div>
                    <table id="example" class="table table-responsive table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="white-space:nowrap;">Date & Time</th>
                                <th style="white-space:nowrap;">Transaction Type</th>
                                <th style="white-space:nowrap;">Service Detail</th>
                                <th>Points</th>
                                <th style="white-space:nowrap;">Remaining Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($wallets) && count($wallets) > 0)
                            @foreach($wallets as $wallet)
                            <tr>
                                <td>{{$wallet->created_at}}</td>
                                <td>{{$wallet->type}}</td>
                                <td>{{$wallet->description}}</td>
                                <td>{{$wallet->points}}</td>
                                <td>{{$wallet->remaining_points}}</td>
                            </tr>
                            @endforeach
                            @endif
                            
                        </tbody>
                        
                    </table>
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
    new DataTable('#example');
</script>
@endpush
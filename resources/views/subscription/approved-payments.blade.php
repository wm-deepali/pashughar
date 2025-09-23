@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Approved Payments</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Approved Payments</li>
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
                            <table id="categoriesTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Date & Time</th>
                                        <th>User Name </th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Subscription Name</th>
                                        <th>Payment Method</th>
                                        <th>Paid Amount</th>
                                        <th>Payment Date</th>
                                        <th>Payment Status</th>
                                        <th>Screenshot</th>
                                        <th>Remark</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subscriptionshis as $key=>$subscription)
                                        <tr>
                                            <th scope="row">{{ $subscription->created_at }}</th>
                                            <td>{{$subscription->customers->full_name ?? ''}}</td>
                                            <td>{{$subscription->customers->mobile ?? ''}}</td>
                                            <td>{{$subscription->customers->email ?? ''}}</td>
                                            <td>{{$subscription->subscriptions->name ?? ''}}</td>
                                            <td>{{$subscription->payment_method ?? ''}}</td>
                                            <td>{{$subscription->paid_amount ?? ''}}</td>
                                            <td>{{$subscription->payment_date ?? ''}}</td>
                                            <td>
                                                @if($subscription->payment_status == 'Completed')
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-danger">Pending</span>
                                                @endif
                                            </td>
                                            
                                             <td>
                                                 @if($subscription->screenshot !='')
                                        <img class="mt-2 img-fluid" src="{{ asset('storage').'/'.$subscription->screenshot}}" alt="screenshot" style="height:70px;">
                                        @endif
                                        </td>
                                              <td>{{$subscription->remark ?? ''}}</td>
                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@endsection
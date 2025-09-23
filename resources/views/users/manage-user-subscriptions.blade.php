@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage User Subscriptions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage User Subscriptions</li>
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
                            <table id="categoriesTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Date & Time</th>
                                        <th>User Name </th>
                                        <th>Email Id</th>
                                        <th>Mobile Number</th>
                                        <th>Subscription Name</th>
                                        <th>Expiry Date</th>
                                        <th>Payment Method</th>
                                        <th>Paid Amount(ETB)</th>
                                        <th>Total Ads</th>
                                        <th>Used Ads</th>
                                        <th>Unused</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usersubscriptions as $key=>$subscription)
                                    @if(isset($subscription->customers)  && !empty($subscription->customers))
                                        <tr>
                                            <th scope="row">{{ $subscription->created_at }}</th>
                                            <td>{{$subscription->customers->full_name ?? ''}}</td>
                                             <td>{{$subscription->customers->email ?? ''}}</td>
                                            <td>{{$subscription->customers->mobile ?? ''}}</td>
                                           
                                            <td>{{$subscription->subscriptions->name ?? ''}}</td>
                                            <td>{{$subscription->subscription_expiry ?? ''}}</td>
                                            
                                            <td>{{$subscription->payment_method ?? ''}}</td>
                                            <td>{{$subscription->paid_amount ?? ''}}</td>
                                            
                                            <td>{{$subscription->subscriptions->no_of_ads ?? ''}}</td>
                                            <td>{{$subscription->used_ads ?? ''}}</td>
                                            <td>{{$subscription->remaining_ads ?? ''}}</td>
                                            <td>
                                                @if($subscription->payment_status == 'Completed')
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-danger">Pending</span>
                                                @endif
                                            </td>
                                             
                                            <td>
                                                <a href="{{route('order-details', $subscription->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                                @if($subscription->payment_status == 'Pending')
                                                <form id="approve-payment-{{ $subscription->id }}" action="{{ route('transactions.approve-payment', $subscription->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('POST')
                                                </form>
                                                <a href="#" class="btn btn-success" onclick="confirmApprove({{ $subscription->id }})"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
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
<script>
    function confirmApprove(subscriptionId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Approve it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('approve-payment-' + subscriptionId).submit();
            }
        })
    }
</script>
@endsection
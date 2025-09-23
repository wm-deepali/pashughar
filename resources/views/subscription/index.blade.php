@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Subscription Plan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Subscription Plan</li>
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
                        <div class="d-grid d-md-flex justify-content-md-end m-3">
                            <a href="{{route('subscriptions.create')}}" class="btn btn-outline-danger">Add</a>
                        </div>
                        <div class="card-body">
                            <table id="categoriesTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Plan</th>
                                        <th>No of Ads</th>
                                        <th>Subscription Validity(In Days)</th>
                                        <th>Ads Validity(In Days)</th>
                                        <th>MRP</th>
                                        <th>Discount (%)</th>
                                        <th>Offer Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subscriptions as $key=>$subscription)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{$subscription->name ?? ''}}</td>
                                            <td>{{$subscription->no_of_ads ?? ''}}</td>
                                            <td>{{$subscription->subscription_validity ?? ''}}</td>
                                            <td>{{$subscription->ad_validity ?? ''}}</td>
                                            <td>{{$subscription->mrp ?? ''}}</td>
                                            <td>{{$subscription->discount ?? ''}}</td>
                                            <td>{{$subscription->offer_price ?? ''}}</td>
                                            <td>
                                                @if($subscription->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('subscriptions.edit', $subscription->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                <form id="delete-subscription-{{ $subscription->id }}" action="{{ route('subscriptions.destroy', $subscription->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" class="btn btn-danger" onclick="confirmDelete({{ $subscription->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
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
<script>
    function confirmDelete(subscriptionId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-subscription-' + subscriptionId).submit();
            }
        })
    }
</script>
@endsection

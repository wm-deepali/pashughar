@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Clicks for Ad: {{ $ad->title }} on {{ $date }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('whatsapp-analytics.index') }}">WhatsApp Analytics</a></li>
              <li class="breadcrumb-item"><a href="{{ route('whatsapp-analytics.history', ['adId'=>$ad->id, 'month'=>\Carbon\Carbon::parse($date)->format('Y-m')]) }}">History</a></li>
              <li class="breadcrumb-item active">Day-wise Users</li>
            </ol>
          </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="daywiseTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Whatsapp</th>
                                        <th>IP Address</th>
                                        <th>Clicked At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clicks as $click)
                                    <tr>
                                        <td>{{ $click->user->full_name ?? '-' }}</td>
                                        <td>{{ $click->user->email ?? '-' }}</td>
                                        <td>{{ $click->user->whatsapp_number ?? '-' }}</td>
                                        <td>{{ $click->ip_address }}</td>
                                        <td>{{ $click->created_at }}</td>
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

<script>
    $(document).ready(function() {
        $('#daywiseTable').DataTable({
            "order": [[4, "desc"]]
        });
    });
</script>
@endsection

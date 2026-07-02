@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>History for Ad: {{ $ad->title }} ({{ $month }})</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('whatsapp-analytics.index') }}">WhatsApp Analytics</a></li>
              <li class="breadcrumb-item active">History</li>
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
                            <table id="historyTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Total Clicks</th>
                                        <th>View Users</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($history as $h)
                                    <tr>
                                        <td>{{ $h->date }}</td>
                                        <td>{{ $h->total_clicks }}</td>
                                        <td>
                                            <a href="{{ route('whatsapp-analytics.daywise', ['adId'=>$ad->id, 'date'=>$h->date]) }}" class="btn btn-info btn-sm">
                                                View Users
                                            </a>
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

<script>
    $(document).ready(function() {
        $('#historyTable').DataTable({
            "order": [[0, "desc"]]
        });
    });
</script>
@endsection

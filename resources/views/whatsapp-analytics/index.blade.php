@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>WhatsApp Analytics</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">WhatsApp Analytics</li>
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
                                <table id="analyticsTable" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Seller Details</th>
                                            <th>Ad Title</th>
                                            <th>Category</th>
                                            <th>Total Clicks</th>
                                            <th>Ad Status</th>
                                            <th>View History</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($analytics as $data)
                                            <tr>
                                                <td>{{ $data->month }}</td>
                                                <td>
                                                    {{ $data->seller_name }} <br>
                                                    {{ $data->seller_email }} <br>
                                                    {{ $data->seller_whatsapp }}
                                                </td>
                                                <td>{{ $data->ad_title }}</td>
                                                <td>{{ $data->full_category }}</td>
                                                <td>{{ $data->total_clicks }}</td>
                                                <td>{{ $data->ad_status }}</td>
                                                <td>
                                                    <a href="{{ route('whatsapp-analytics.history', ['adId' => $data->ad_id, 'month' => $data->month]) }}"
                                                        class="btn btn-info btn-sm">
                                                        View History
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
        $(document).ready(function () {
            $('#analyticsTable').DataTable({
                "order": [[0, "desc"]]
            });
        });
    </script>
@endsection
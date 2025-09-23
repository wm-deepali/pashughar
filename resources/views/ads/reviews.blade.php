@extends('layouts.app')

@section('content')

<style>
    .text-con-label {
    font-size: 13px;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Seller Ads Ratings & Reviews</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ads Ratings & Reviews</li>
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
                        </div>
                        <div class="card-body">
                            <table id="categoriesTable" class="table table-bordered table-hover  table-striped">
                                <thead>
                                    <tr>
                                        <th>Date & Time</th>
                                        <th>Ad Title</th>
                                        <th>User Details</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                        <th>Rate For</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($enquiries as $key=>$enquiry)
                                        <tr>
                                            <th scope="row">{{ $enquiry->created_at }}</th>
                                            <td>{{$enquiry->ad->title ?? ''}}</td>
                                            <td>{{$enquiry->name ?? ''}}<br/>{{$ad->email ?? ''}}<br/>{{$ad->mobile ?? ''}}</td>
                                            
                                            
                                            
                                            <td>{{$enquiry->rating  ?? ''}}</td>
                                            <td>{{$enquiry->review  ?? ''}}</td>
                                            <td>{{$enquiry->quote  ?? ''}}</td>
                                           
                                            <td>
                                                
                                                <form id="delete-review-{{ $enquiry->id }}" action="{{ route('delete-review', $enquiry->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" class="btn btn-danger" onclick="confirmDelete({{ $enquiry->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
@endsection
@push('after-script')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    function confirmDelete(enquiryId) {
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
                document.getElementById('delete-review-' + enquiryId).submit();
            }
        })
    }
    
</script>
@endpush
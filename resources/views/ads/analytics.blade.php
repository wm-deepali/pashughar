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
            <h1>Ad Analytics</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ad Analytics</li>
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
                            <table id="categoriesTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Ad Title</th>
                                        <th>Published On</th>
                                        <th>Category </th>
                                        <th>Total Views</th>
                                        <th>Total Enquiry</th>
                                        <th>Publisher Name</th>
                                        <th>Subscription Type</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($ads) && count($ads)>0)
                                    @foreach($ads as $key=>$ad)
                                        <tr>
                                            <td>{{$ad->title ?? ''}}</td>
                                            <td>{{date('d M Y, g:i A', strtotime($ad->published_date)) ?? ''}}</td>
                                            <td>{{$ad->category->name ?? ''}}</td>
                                            <td>{{$ad->views ?? 0}}</td>
                                            <td>{{$ad->total_enquiry ?? 0}}</td>
                                            <td>{{$ad->user->full_name ?? ''}}</td>
                                            @php
                                            if(isset($ad->subscription) && $ad->subscription !='')
                                            {
                                                $type = $ad->subscription->offer_price == 0 ? 'Free' : $ad->subscription->name;
                                            }
                                            else{
                                                $type = '';
                                            }
                                            
                                            @endphp
                                            <td>{{$type}}</td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="preview-ad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
@push('after-script')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    function confirmDelete(adId) {
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
                document.getElementById('delete-ad-' + adId).submit();
            }
        })
    }
    $(document).on('click','.preview-ad',function(event){
      let adid = $(this).attr('adid');
      $.ajax({
        url:`{{ URL::to('manage-ads/${adid}') }}`,
        type:'GET',
        dataType:'json',
        success:function(result){
          if (result.msgCode=='200') {
            $('#preview-ad').html(result.html);
            $('#preview-ad').modal('show');
            $('#preview-ad').css('opacity', '1');
            // $('#preview-ad').css('top', '12%');
          } else {
            alert(result.msgText);
          }
        },
        error:function(error) {
            alert(error.statusText);
          
        }
      })
    })
</script>
@endpush

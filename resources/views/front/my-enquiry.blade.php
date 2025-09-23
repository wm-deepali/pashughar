@extends('front.layouts.master')

@section('title')
My Enquiries 
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
        text-align:left !important;
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
                        <h3>My Enquiries </h3>
                    </div>
                     <table id="example" class="table table-responsive table-striped table-bordered" style="width:100%">
                        <thead>
                                                        <tr>
                                <th style="white-space:nowrap;width:20%;">Date & Time</th>
                                <th style="width:20%">Ad Title</th>
                                <th>Buyer Detail</th>
                               
                                <th style="white-space:nowrap;width:20%;">Telegram Id</th>
                               
                                
                                <th style="width:10%">Enquiry Type</th>
                                <th style="width:20%">Location</th>
                               
                                 <th style="width:10%">Action</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($enquiries) && count($enquiries)>0)
                            @foreach($enquiries as $enquiry)
                            <tr>
                                <td>{{ date('d/m/Y', strtotime($enquiry->created_at)) }}<br/>{{ date('g:i A', strtotime($enquiry->created_at)) }}</td>
                                <td>{{$enquiry->ad->title ?? "" }}</td>
                                <td>{{$enquiry->name ?? "" }}<br/>{{$enquiry->email ?? "" }}<br/>{{$enquiry->mobile_number ?? "" }}</td>
                               
                                <td>{{$enquiry->telegram_id ?? "" }}</td>
                               <td>{{$enquiry->type ?? "" }}</td>
                               
                                <td>{{$enquiry->country ?? "" }}<br/>{{$enquiry->statename->name ?? "" }}<br/>{{$enquiry->cityname->name ?? "" }}</td>
                               
                              
                               
                                <td>
                                    @if($enquiry->detail !="")
                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#viewDetailsModal-{{$enquiry->id}}"><i class="fas fa-eye"></i></a>
                                    @endif
                                    </td>
                                
                                
                            <div class="modal fade" id="viewDetailsModal-{{$enquiry->id}}" tabindex="-1" role="dialog" aria-labelledby="viewDetailsModalLabel" aria-hidden="true" style="top:25%;">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewDetailsModalLabel">View Message</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                    <p>{{$enquiry->detail ?? "" }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            
                                    </div>

                                    </div>
                                    
                                                    
                                    </div>
                                </div>
                                       
                            </tr>
                            @endforeach
                            @endif
                            
                        </tbody>
                        
                    </table>
                  {{$enquiries->links()}}
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
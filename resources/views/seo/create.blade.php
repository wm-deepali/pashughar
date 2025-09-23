@extends('layouts.app')

@section('content')
<style>
    .add_button
   {
    margin-top: 10%;
   }
   .remove_button
   {
    margin-top: 10%;
   }
</style>
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add SEO Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage SEO</li>
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
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h5>{{ Session::get('error') }}</h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php Session::forget('error'); ?>
    </div>
    @endif
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="d-grid d-md-flex justify-content-md-end m-3">
                            <a href="{{route('manage-seo.index')}}" class="btn btn-outline-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{route('manage-seo.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Page Name</label>
                                        <select name="name" class="form-control" id="name" required>
                                            <option value="">Select</option>
                                            @foreach($slugs as $data)
                                                <option value="{{$data->slug}}">{{$data->display}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" required>
                                    </div>
                                
                                    <div class="form-group col-md-6">
                                        <label for="meta_keyword">Meta Keyword</label>
                                        <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ old('meta_keyword') }}" required>
                                    </div>
                            
                                    <div class="form-group col-md-6">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" required>{{ old('meta_description') }}</textarea>
                                    </div>
                            
                                    <div class="form-group col-md-6">
                                        <label for="canonical">Canonical URL</label>
                                        <input type="text" class="form-control" id="canonical" name="canonical" value="{{ old('canonical') }}" required>
                                    </div>
                                </div>
                            
                                <div class="col-md-12">
                                    <div class="text-md-right"> <!-- Aligns content to the right in medium devices and above -->
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('after-script')
<script>
   $(document).ready(function(){
     function calculateOfferedPrice() {
     
                var mrp = parseFloat($('#mrp').val());
                var discount = parseFloat($('#discount').val());

                if (isNaN(mrp) || isNaN(discount)) {
                    $('#offer_price').val(mrp);
                    return;
                }

                var offeredPrice = mrp - (mrp * (discount / 100));
                $('#offer_price').val(offeredPrice.toFixed(2));
            }

            $('#mrp').on('input', calculateOfferedPrice);
            $('#discount').on('input', calculateOfferedPrice);
})  
$(document).ready(function(){
          
    var maxField = 15; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="subdiv" style="display: flex"><div class="col-md-3"><label for="feature">Feature</label><input type="text" name="feature[]" class="form-control" required/></div><div class="col-md-4"><label for="is_available">Is Available</label><select class="form-control" name="is_available[]"><option value="1">Yes</option><option value="0">No</option></select></div><div class="col-md-4"><a href="javascript:void(0);" class="remove_button btn btn-danger" title="Remove field"><i class="fa fa-trash"></i> Remove</a></div></div>'; 
    var x = 1; //Initial field counter is 1
          
    // Once add button is clicked
    $(wrapper).on('click', '.add_button', function(e){
    
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increase field counter
            $(wrapper).append(fieldHTML); //Add field html
        }else{
            alert('A maximum of '+maxField+' fields are allowed to be added. ');
        }
    });
          
    // Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).closest('.subdiv').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>
@endpush
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
            <h1>Edit Subscription Plan</h1>
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
                            <a href="{{route('subscriptions.index')}}" class="btn btn-outline-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{route('subscriptions.update',$result->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Plan Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{$result->name}}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="no_of_ads">Number Of Ads</label>
                                        <input type="number" class="form-control" id="no_of_ads" name="no_of_ads" value="{{$result->no_of_ads}}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="subscription_validity">Subscription Validity(In Days)</label>
                                        <input type="number" class="form-control" id="subscription_validity" name="subscription_validity" required value="{{$result->subscription_validity}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="ad_validity">Ad Validity(In Days)</label>
                                        <input type="number" class="form-control" id="ad_validity" name="ad_validity" value="{{$result->ad_validity}}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="mrp">MRP</label>
                                        <input type="number" class="form-control" id="mrp" name="mrp" value="{{$result->mrp}}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="discount">Discount (%)</label>
                                        <input type="text" class="form-control" id="discount" name="discount" value="{{$result->discount}}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="offer_price">Offer Price</label>
                                        <input type="number" class="form-control" id="offer_price" name="offer_price" value="{{$result->offer_price}}" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="offer_price">Icon</label>
                                        <input type="text" class="form-control" id="icon" name="icon" value="{{$result->icon}}" required>
                                    </div>
               
                                    <div class="form-group col-md-6">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control" id="status" required>
                                            <option value="1" {{$result->status == 1 ? 'selected' : ''}}>Active</option>
                                            <option value="0" {{$result->status == 0 ? 'selected' : ''}}>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="detail">Detail</label>
                                        <textarea class="form-control" id="detail" name="detail" required>{{$result->detail}}</textarea>
                                    </div>
                                    @if($categories != null && count($categories)>0)
                                    @foreach($categories as $category)
                                    <div class="form-group col-md-4">
                                        <div class="icheck-primary">
                                            <input type="checkbox" name="category_id[]" value="{{$category->id}}" {{in_array($category->id, $selectedcategories) ? 'checked' : ''}}>
                                            <label for="category_id">{{$category->name}}</label> 
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif

                                </div>
                                <div class="form-group col-md-12 field_wrapper">
                                    @if(isset($features) && count($features) > 0)
                                    @foreach($features as $feature)
                                    <div class="subdiv" style="display: flex">
                                        <div class="col-md-4">
                                            <label for="feature">Feature</label>
                                            <input type="text" name="feature[]" value="{{$feature->feature}}" class="form-control" required/>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label for="is_available">Is Available</label>
                                            <select class="form-control" name="is_available[]">
                                            <option value="1" {{$feature->is_available == 1 ? 'selected' : ''}}>Yes</option>
                                            <option value="0" {{$feature->is_available == 0 ? 'selected' : ''}}>No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                           <a href="javascript:void(0);" class="remove_button btn btn-danger" title="Remove field"><i class="fa fa-trash"></i> Remove</a>
                                        </div>
                                 
                                    </div>
                                    @endforeach
                                    <div class="col-md-4">
                                            <a href="javascript:void(0);" class="add_button btn btn-success" title="Add field"><i class="fa fa-plus"></i> Add More</a>
                                        </div>
                                    @else
                                    <div style="display: flex">
                                            <div class="col-md-3">
                                                <label for="feature">Feature</label>
                                                <input type="text" name="feature[]" class="form-control" required/>
                                            </div>
                                            <div class="col-md-4">
                                            <label for="is_available">Is Available</label>
                                                <select class="form-control" name="is_available[]">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="javascript:void(0);" class="add_button btn btn-success" title="Add field">
                                                    <i class="fa fa-plus"></i> Add More
                                                </a>
                                                
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            
                                <div class="col-md-12">
                                    <div class="text-md-right"> <!-- Aligns content to the right in medium devices and above -->
                                        <button type="submit" class="btn btn-primary">Update</button>
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

            $('#mrp, #discount').on('input', calculateOfferedPrice);
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
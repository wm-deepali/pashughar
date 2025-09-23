@extends('layouts.app')

@section('content')
<style>
    div.gallery img
    {
        width:60px;
    }
</style>
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Ad Post</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ads Post</li>
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
                            <a href="{{route('manage-ads.index')}}" class="btn btn-outline-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{route('manage-ads.update', $ad->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-group col-md-6">
                                    <input type="hidden" class="form-control" id="ad_id" value="{{$ad->id}}">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{$ad->title}}">
                                    </div>
                                    <div class="form-group col-md-6 category_div">
                                        <label class="form-label">Category</label>
                                        <select class="form-control custom-select" name="category_id" id="category_id">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$ad->category_id == $category->id ? 'selected': ''}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 subcategory_div">
                                        <label class="form-label">Sub Category</label>
                                        <select class="form-control custom-select" name="subcategory_id" id="subcategory_id">
                                            <option value="">Select Sub Category</option>
                                            @if(isset($subcategories) && count($subcategories)>0)
                                            @foreach($subcategories as $subcategory)
                                            <option value="{{$subcategory->id}}" {{$ad->subcategory_id == $subcategory->id ? 'selected': ''}}>{{$subcategory->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                   
                                    
                                    <div class="form-group col-md-6">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" id="price" name="price" value="{{$ad->price}}">
                                    </div>
                                    
                                    <div class="form-group col-lg-6">
                                        <label class="form-label">Price Type</label>
                                        <select class="form-control custom-select" name="price_type" id="price_type" required>
                                            <option value="Fixed" {{$ad->price_type == 'Fixed' ? 'selected': ''}}>Fixed</option>
                                            <option value="Negotiable"{{$ad->price_type == 'Negotiable' ? 'selected': ''}}>Negotiable</option>
                                        </select>
                                    </div>
                                
                            
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Location</label>
                                        <input type="text" class="form-control" name="location" id="location" value="{{$ad->location}}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description">{{$ad->description}}</textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" id="image" name="image[]" multiple="multiple">
                                        @if(isset($ad->adImage) && count($ad->adImage)>0)
                                        @foreach($ad->adImage as $image)
                                        <img class="mt-2" src="{{ asset('storage').'/'.$image->image}}" alt="Current Image" width="120">
                                        @endforeach
                                        @endif
                                        <div class="gallery"></div>
                                        <!--img id="imgView" class="mt-2" src="" alt="Current Image" width="120" style="display:none;"-->
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $ad->meta_title }}" placeholder="Enter Meta Title" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="author_name">Meta keywords</label>
                                        <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ $ad->meta_keyword }}" placeholder="Meta keywords here" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="author_name">Meta Description</label>
                                        <textarea class="form-control" name="meta_description" placeholder="Meta Description" required>{{$ad->meta_description}}</textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="author_name">Author Name</label>
                                        <input type="text" class="form-control" id="author_name" name="author_name" value="{{$ad->author_name}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="author_email">Author Email</label>
                                        <input type="email" class="form-control" id="author_email" name="author_email" value="{{$ad->author_email}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="author_mobile">Author Mobile</label>
                                        <input type="number" class="form-control" id="author_mobile" name="author_mobile" value="{{$ad->author_mobile}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="author_address">Author Address</label>
                                        <textarea class="form-control" id="author_address" name="author_address">{{$ad->author_address}}</textarea>
                                    </div>
               
                                    <div class="form-group col-md-6">
                                        <label for="status">Status</label>
                                        @php
                                        $statusArr = array('Pending','Published','Rejected','Expired');
                                        @endphp
                                        <select name="status" class="form-control" id="status">
                                            @foreach($statusArr as $status)
                                            <option value="{{$status}}" {{$ad->status == $status ? 'selected' : ''}}>{{$status}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if(isset($ad->adFeature) && count($ad->adFeature) >0)
                                    @foreach($ad->adFeature as $feature)
                                    {!! $features[$feature->features_name] !!}
                                    @endforeach
                                    @endif
                                    
                                </div>
                                                       <div class="col-lg-12" style="padding-left:0px;">
                                <div class="form-group">
                                    <label class="form-label">Specifications</label>
                                
                                    @if(isset($ad->adSpecification) && count($ad->adSpecification)>0)
                                    @foreach($ad->adSpecification as $specifications)
                                    <div id="row">
                                        <div class="input-group mb-3">
                                            
                                            <input type="text" class="form-control m-input" name="specifications[]" value="{{$specifications->specification}}">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-danger DeleteRow" 
                                                        type="button">
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    <div id="row">
                                    <div class="input-group mb-3">
                                        
                                        <input type="text" class="form-control m-input" name="specifications[]">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-danger DeleteRow" 
                                                    type="button">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                    </div>
                                    <div id="newinput"></div>
                                    <button id="rowAdder" type="button" class="btn btn-dark">
                                        <i class="fas fa-plus"></i>Add More
                                    </button>
                                </div>
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
var yearInput = document.getElementById("yeardiv");
    var monthInput = document.getElementById("monthdiv");
    var approxInput = document.getElementById("approxdiv");
    
    var avgwtInput = document.getElementById("avgwtdiv");
    var avgwtInInput = document.getElementById("avgwtindiv");
    
    var wtInput = document.getElementById("wtdiv");
    var wtInInput = document.getElementById("wtindiv");
     
    if(typeof(yearInput) != 'undefined' && yearInput != null)
    {
        $(monthInput).insertAfter($(yearInput));
    }
    if(typeof(approxInput) != 'undefined' && approxInput != null)
    {
        $(approxInput).insertAfter($(monthInput));
    }
    
    if(typeof(avgwtInput) != 'undefined' && avgwtInput != null)
    {
        $(avgwtInInput).insertAfter($(avgwtInput));
    }
    
    if(typeof(wtInput) != 'undefined' && wtInput != null)
    {
        $(wtInInput).insertAfter($(wtInput));
    }
    
     var approxfieldInput = document.getElementById("age_approx");
    if(typeof(approxfieldInput) != 'undefined' && approxfieldInput != null)
    {
        var checkval = $(approxfieldInput).val();
        
        if(checkval == 'yes')
        {
            document.getElementById("age_approx").checked = true;

        }
    }
    // document.getElementById('image').addEventListener('change', function(event) {
    //     const file = event.target.files[0];
    //     if (file) {
    //         const reader = new FileReader();
    //         reader.onload = function(e) {
    //             document.getElementById('imgView').src = e.target.result;
    //             document.getElementById('imgView').style = 'block';
    //         };
    //         reader.readAsDataURL(file);
    //     }
    // });
    $(function() {
        // Multiple images preview in browser
        var imagesPreview = function(input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#image').on('change', function() {
            imagesPreview(this, 'div.gallery');
        });
    });
    $(document).on('change', '#category_id', function(event) {
        $('#subcat_div').html("");
        let category_id = $(this).val();
        $.ajax({
            url: `{{ URL::to('fetch-subcategory/${category_id}') }}`,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    $('.category_div').after(result.html);
                  //  if(result.html == 0)
                    //{
                        fetchformData(category_id, 0)
                    //}
                //} else {
                    //toastr.error('error encountered ' + result.msgText);
                //}
            }
            }
        });
    });
    //if($("#subcategory_id").length != 0) {
        
        $(document).on('change', '#subcategory_id', function(event) {
            let subcategory_id = $(this).val();
            let category_id = $('#category_id').val();
            fetchformData(category_id, subcategory_id);
        });
   // }
    $(document).on('change', '#brand_category', function(event) {
        $('#brand_id').html("");
        let brand_category = $(this).val();
        $.ajax({
            url: `{{ URL::to('fetch-brand-options/${brand_category}') }}`,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    $('#brand_id').append(result.html);
                } else {
                    //toastr.error('error encountered ' + result.msgText);
                }
            },
        });
    });
    function fetchformData(catid, subcatid)
    {
        $('.features-sec').html("")
        $.ajax({
            url: `{{ URL::to('fetch-form-data/${catid}/${subcatid}') }}`,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    $('.features-sec').append(result.html);
                    $('#brands').append(result.brands);
                } else {
                    //toastr.error('error encountered ' + result.msgText);
                }
            }
        });
    }
    $(document).ready(function(){
        var ad_id = $('#ad_id').val();
        $.ajax({
            url: `{{ URL::to('fetch-feature-form-data/${ad_id}') }}`,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    $.each(result.features, function(index, item) {
                    // access the properties of each user
                    var key = item.features_name;
                    var value = item.features;
                    $(`#${key}`).val(value);
                    });
                } else {
                    //toastr.error('error encountered ' + result.msgText);
                }
            },
        });
    })  
    if($("#vehicle_type").length != 0) {
        
        $(document).on('change', '#vehicle_type', function(event) {
            let vehicle_type = $(this).val();
            fetchfueltype(vehicle_type);
        });
    }
    
    function fetchfueltype(vehicle_type)
    {
        $('#fuel_type').html("")
        $.ajax({
            url: `{{ URL::to('fetch-fuel-type/${vehicle_type}') }}`,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    $('#fuel_type').append(result.html);
                    
                } else {
                    toastr.error('error encountered ' + result.msgText);
                }
            },
        });
    }
   $("#rowAdder").click(function () {
    newRowAdd =
        '<div id="row"> <div class="input-group m-3">' +
        '<input type="text" class="form-control m-input" name="specifications[]">' +
        '<div class="input-group-append">' +
        '<button class="btn btn-danger DeleteRow"  type="button">' +
        '<i class="fas fa-trash"></i> Delete</button> </div>' +
        '</div> </div>';

    $('#newinput').append(newRowAdd);
});

    $("body").on("click", ".DeleteRow", function () {
        $(this).parents("#row").remove();
    })
</script>
@endpush
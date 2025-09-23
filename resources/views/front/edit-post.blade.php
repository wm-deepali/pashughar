@extends('front.layouts.master')

@section('title')
Ad Post
@endsection
@push('after-styles')
<link rel="stylesheet" href="{{asset('front/css/custom/ad-post.css')}}">
@endpush
@section('content')
<style>
    div.gallery img
    {
        width:60px;
    }
    #rowAdder {
        margin-left: 17px;
    }
</style>
<!--=====================================
            ADPOST PART START
=======================================-->
<section class="adpost-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
           
                <form class="adpost-form" action="{{ route('user.update-ad-post', base64_encode($ad->id)) }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="adpost-card">
                        <div class="adpost-title">
                            <h3>Ad Information</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Ad Title</label>
                                    <input type="text" class="form-control" name="title" value="{{$ad->title}}" placeholder="Type your product title here" required>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 category_div">
                                <div class="form-group">
                                    <label class="form-label">Category</label>
                                    <select class="form-control custom-select" name="category_id" id="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$ad->category_id == $category->id ? 'selected': ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 subcategory_div">
                                <div class="form-group">
                                    <label class="form-label">SubCategory</label>
                                    <select class="form-control custom-select" name="subcategory_id" id="subcategory_id" required>
                                        <option value="">Select SubCategory</option>
                                        @foreach($subcategories as $subcategory)
                                        <option value="{{$subcategory->id}}" {{($ad->subcategory_id !='' && $ad->subcategory_id == $subcategory->id) ? 'selected': ''}}>{{$subcategory->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Price</label>
                                    <input type="number" class="form-control" name="price" value="{{$ad->price}}" placeholder="Enter your pricing amount" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Price Type</label>
                                    <select class="form-control custom-select" name="price_type" id="price_type" required>
                                        <option value="Fixed" {{$ad->price_type == 'Fixed' ? 'selected': ''}}>Fixed</option>
                                        <option value="Negotiable"{{$ad->price_type == 'Negotiable' ? 'selected': ''}}>Negotiable</option>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">ad description</label>
                                    <textarea class="form-control" name="description" placeholder="Describe your message" required>{{$ad->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-control" name="location" id="location" value="{{$ad->location}}" required>
                                </div>
                            </div>
                            
                            <div class="col-lg-12 features-sec" style="display: contents;">
                            @if(isset($ad->adFeature) && count($ad->adFeature) >0)
                            @foreach($ad->adFeature as $feature)
                            {!! $features[$feature->features_name] !!}
                            @endforeach
                            @endif

                            </div>
                            
                            
                            
                            <div class="form-group col-md-12">
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
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Specifications</label>
                                
                                    @if(isset($ad->adSpecification) && count($ad->adSpecification)>0)
                                    @foreach($ad->adSpecification as $specifications)
                                    <div id="row">
                                        <div class="input-group m-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-danger" 
                                                        id="DeleteRow" 
                                                        type="button">
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </button>
                                            </div>
                                            <input type="text" class="form-control m-input" name="specifications[]" value="{{$specifications->specification}}">
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    <div class="input-group m-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-danger" 
                                                    id="DeleteRow" 
                                                    type="button">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </button>
                                        </div>
                                        <input type="text" class="form-control m-input" name="specifications[]">
                                    </div>
                                    <div id="newinput"></div>
                                    <button id="rowAdder" type="button" class="btn btn-dark">
                                        <i class="fas fa-plus"></i>Add More
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="adpost-card">
                        <div class="adpost-title">
                            <h3>SEO Details</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $ad->meta_title }}" placeholder="Enter Meta Title" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Meta Keywords</label>
                                    <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ $ad->meta_keyword }}" placeholder="Meta keywords here" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Description </label>
                                    <textarea class="form-control" name="meta_description" placeholder="Meta Description" required>{{$ad->meta_description}}</textarea>
                                    
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                    <div class="adpost-card">
                        <div class="adpost-title">
                            <h3>Author Information</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="author_name" value="{{$ad->author_name ?? ''}}" placeholder="Your Name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="author_email" value="{{$ad->author_email ?? ''}}" placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Number</label>
                                    <input type="number" class="form-control" name="author_mobile" value="{{$ad->author_mobile ?? ''}}" placeholder="Your Number" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" name="author_address" value="{{$ad->author_address ?? ''}}" placeholder="Your Address" required>
                                </div>
                            </div>
                            <div class="form-group text-right">
                            <button class="btn btn-inline">
                                <i class="fas fa-check-circle"></i>
                                <span>Update your ad</span>
                            </button>
                        </div>
                        </div>
                    </div>
                   
                </form>
                
                    
                
            </div>
           
        </div>
    </div>
</section>
<!--=====================================
            ADPOST PART END
=======================================-->
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
        $('#subcategory_id').html('');
         
        let category_id = $(this).val();
        $.ajax({
            url: `{{ URL::to('fetch-subcategory/${category_id}') }}`,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    $('#subcategory_id').html(result.html);
                     // $('.category_div').after(result.htmlb);
                    // if(result.html == " ")
                    // {
                       
                        fetchformData(category_id, 0);
                        
                    //}
                } else {
                    toastr.error('error encountered ' + result.msgText);
                }
            },
        });
        
    });
    //if($("#subcategory_id").length != 0) {
        
         $(document).on('change', '#subcategory_id', function(event) {
            let subcategory_id = $(this).val();
            let category_id = $('#category_id').val();
            fetchformData(category_id, subcategory_id);
        });
   // }
    $(document).on('change', '#brand_category_id', function(event) {
        $('#brand_div').html("");
        let brand_category_id = $(this).val();
        $.ajax({
            url: `{{ URL::to('fetch-brand/${brand_category_id}') }}`,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    $('.brand_category_div').after(result.html);
                    
                } else {
                    //toastr.error('error encountered ' + result.msgText);
                }
            }
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
        var ad_id = '{{$ad->id}}';
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
            }
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
            '<div class="input-group-prepend">' +
            '<button class="btn btn-danger" id="DeleteRow" type="button">' +
            '<i class="fas fa-trash"></i> Delete</button> </div>' +
            '<input type="text" class="form-control m-input" name="specifications[]"> </div> </div>';

        $('#newinput').append(newRowAdd);
    });
    $("body").on("click", "#DeleteRow", function () {
        $(this).parents("#row").remove();
    })
</script>
@endpush
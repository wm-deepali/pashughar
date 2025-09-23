
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
        .img-div {
    position: relative;
    width: 46%;
    float:left;
    margin-right:5px;
    margin-left:5px;
    margin-bottom:10px;
    margin-top:10px;
}

.image {
    opacity: 1;
    display: block;
    width: 100%;
    max-width: auto;
    transition: .5s ease;
    backface-visibility: hidden;
}

.middle {
    /*transition: .5s ease;*/
    opacity: 1;
    position: absolute;
    top: 15%;
    left: 24%;
    /*transform: translate(-50%, -50%);*/
    /*-ms-transform: translate(-50%, -50%);*/
    text-align: center;
}

.img-div:hover .image {
    opacity: 0.3;
}

.img-div:hover .middle {
    opacity: 1;
}
</style>
<!--=====================================
            ADPOST PART START
=======================================-->
<section class="adpost-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
           
                <form class="adpost-form" action="{{ route('user.save-ad-post') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="adpost-card">
                        <div class="adpost-title">
                            <h3>Ad Information</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Ad Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Type your product title here" required>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 category_div">
                                <div class="form-group">
                                    <label class="form-label">Category</label>
                                    <select class="form-control custom-select" name="category_id" id="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 subcategory_div">
                                <div class="form-group">
                                    <label class="form-label">Sub Category</label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control custom-select" required="" fdprocessedid="b99x0f">
                                        </select>
                                </div>
                            </div>
                              
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Price</label>
                                    <input type="number" class="form-control" name="price" placeholder="Enter your pricing amount" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Price Type</label>
                                    <select class="form-control custom-select" name="price_type" id="price_type" required>
                                        <option value="Fixed">Fixed</option>
                                        <option value="Negotiable">Negotiable</option>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="col-lg-12" id="locationdiv">
                                <div class="form-group">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-control" name="location" id="location" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">ad description</label>
                                    <textarea class="form-control" name="description" placeholder="Describe your message" required></textarea>
                                </div>
                            </div>
                            
                            <div class="col-lg-12 features-sec" style="display: contents;">
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Specifications</label>
                                    <div id="row">
                                    <div class="input-group mb-3">
                                        
                                        <input type="text" class="form-control m-input" name="specifications[]">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-danger" 
                                                    id="DeleteRow" 
                                                    type="button">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </button>
                                        </div>
                                    </div></div>
                                    <div id="newinput"></div>
                                    <button id="rowAdder" style="margin-left:0px" type="button" class="btn btn-dark">
                                        <i class="fas fa-plus"></i>Add More
                                    </button>
                                    
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Ad Multiple Image </label>
                                    <input type="file" id="image" class="form-control" name="image[]" multiple="multiple"  accept="image/png, image/jpeg" required>
                                    <div class="gallery"></div>
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
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" placeholder="Enter Meta Title" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Meta Keywords</label>
                                    <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ old('meta_keyword') }}" placeholder="Meta keywords here" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Description </label>
                                    <textarea class="form-control" name="meta_description" placeholder="Meta Description" required></textarea>
                                    
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
                                    <input type="text" class="form-control" name="author_name" value="{{Auth::guard('member')->user()->full_name ?? ''}}" placeholder="Your Name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="author_email" value="{{Auth::guard('member')->user()->email ?? ''}}" placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Number</label>
                                    <input type="number" class="form-control" name="author_mobile" value="{{Auth::guard('member')->user()->mobile ?? ''}}" placeholder="Your Number" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" name="author_address" value="{{Auth::guard('member')->user()->address ?? ''}}" placeholder="Your Address" required>
                                </div>
                            </div>
                            <div class="form-group text-right price-btn">
                            <button class="btn btn-inline">
                                <i class="fas fa-check-circle"></i>
                                <span>Post your ad</span>
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
    
    
    
    
    
    
    
    /* $(function() {
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
    });*/
    
    $(document).ready(function() {
  var fileArr = [];
   $("#image").change(function(){
      // check if fileArr length is greater than 0
       if (fileArr.length > 0) fileArr = [];
     
        $('.gallery').html("");
        var total_file = document.getElementById("image").files;
        if (!total_file.length) return;
        for (var i = 0; i < total_file.length; i++) {
          if (total_file[i].size > 1048576) {
            return false;
          } else {
            fileArr.push(total_file[i]);
            $('.gallery').append("<div class='img-div' id='img-div"+i+"'><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-responsive image img-thumbnail' title='"+total_file[i].name+"'><div class='middle'><button id='action-icon' value='img-div"+i+"' class='' role='"+total_file[i].name+"'><i class='fa fa-trash'></i></button></div></div>");
          }
        }
   });
  
  $('body').on('click', '#action-icon', function(evt){
      var divName = this.value;
      var fileName = $(this).attr('role');
      $(`#${divName}`).remove();
    
      for (var i = 0; i < fileArr.length; i++) {
        if (fileArr[i].name === fileName) {
          fileArr.splice(i, 1);
        }
      }
    document.getElementById('image').files = FileListItem(fileArr);
      evt.preventDefault();
  });
  
   function FileListItem(file) {
            file = [].slice.call(Array.isArray(file) ? file : arguments)
            for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
            if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
            for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
            return b.files
        }
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
        
        //  let brand_category_id = $(this).val();
        // $.ajax({
        //     url: `{{ URL::to('fetch-brand/${brand_category_id}') }}`,
        //     type: 'GET',
        //     dataType: 'json',
        //     success: function(result) {
        //         if (result.success) {
        //             $('.category_div').after(result.html);
                    
        //         } else {
        //             //toastr.error('error encountered ' + result.msgText);
        //         }
        //     },
        // });
        
        
    });
    //if($("#subcategory_id").length != 0) {
        
        $(document).on('change', '#subcategory_id', function(event) {
            let subcategory_id = $(this).val();
            let category_id = $('#category_id').val();
            fetchformData(category_id, subcategory_id);
        });
   // }
    $(document).on('change', '#brand_category_id', function(event) {
        
        let brand_category_id = $(this).val();
        $.ajax({
            url: `{{ URL::to('fetch-brand/${brand_category_id}') }}`,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    $('.brand_category_div').after(result.html);
                    
                } else {
                    toastr.error('error encountered ' + result.msgText);
                }
            },
        });
    });

    function fetchformData(catid, subcatid)
    {
        
        $('.features-sec').html("")
        $('#branddiv').html('');
        
        $.ajax({
            url: `{{ URL::to('fetch-form-data/${catid}/${subcatid}') }}`,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    $('.features-sec').append(result.html);
                     $('#brands').append(result.brands);
                     
                    var branddiv = document.getElementById("branddiv");
                    
                    if(typeof(branddiv) != 'undefined' && branddiv != null)
                    {
                       
                        var locationdiv = document.getElementById("locationdiv");
                        $('#locationdiv').removeClass('col-lg-12');
                        $('#locationdiv').addClass('col-lg-6');
                         
                        $(branddiv).insertAfter($(locationdiv));
                    }
                    
                    
                    var yearInput = document.getElementById("yeardiv");
                    var monthInput = document.getElementById("monthdiv");
                    var approxInput = document.getElementById("approxdiv");
                    
                    var avgwtInput = document.getElementById("avgwtdiv");
                    var avgwtInInput = document.getElementById("avgwtindiv");
                    
                    var wtInput = document.getElementById("wtdiv");
                    var wtInInput = document.getElementById("wtindiv");
                    
                    var minqty = document.getElementById("minqty");
                    var availqty = document.getElementById("availqty");
                    
                    if(typeof(minqty) != 'undefined' && minqty != null)
                    {
                        $(availqty).insertAfter($(minqty));
                    }
                     
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
                    
                    
                    if(typeof(yearInput) != 'undefined' && yearInput != null && typeof(avgwtInput) != 'undefined' && avgwtInput != null)
                    {
                        $(avgwtInput).insertAfter($(approxInput));
                        $(avgwtInInput).insertAfter($(avgwtInput));
                    }
                    
                    if(typeof(yearInput) != 'undefined' && yearInput != null && typeof(wtInput) != 'undefined' && wtInput != null)
                    {
                        $(wtInput).insertAfter($(approxInput));
                        $(wtInInput).insertAfter($(wtInput));
                    }
                    
                    
                } else {
                    toastr.error('error encountered ' + result.msgText);
                }
            },
        });
    }
    //if($("#vehicle_type").length != 0) {
        
        $(document).on('change', '#vehicle_type', function(event) {
            let vehicle_type = $(this).val();
            //alert(vehicle_type);
            fetchfueltype(vehicle_type);
        });
    //}
    
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
        ' <div id="row"><div class="input-group mb-3">' +
        '<input type="text" class="form-control m-input" name="specifications[]">' +
        '<div class="input-group-append">' +
        '<button class="btn btn-danger" id="DeleteRow" type="button">' +
        '<i class="fas fa-trash"></i> Delete</button> </div>' +
        '</div> </div>';

    $('#newinput').append(newRowAdd);
});
    $("body").on("click", "#DeleteRow", function () {
        $(this).parents("#row").remove();
    })
</script>
@endpush
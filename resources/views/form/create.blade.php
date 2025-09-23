@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add  Form Features</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Form Features</li>
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
                            <a href="{{route('form-features.index')}}" class="btn btn-outline-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{route('form-features.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" class="form-control" id="category_id">
                                            <option value="">Select</option>
                                            @foreach($categories as $data)
                                                <option value="{{$data->id}}">{{$data->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="subcategory_id">Sub Category</label>
                                        <select name="subcategory_id" class="form-control" id="subcategory_id">
                                            
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h6>If don't select then option view in form features. Then only form some detail</h6>
                                    </div>
                                    
                                    @foreach((array)$features as $key=>$val)
                                    <div class="form-group col-md-4">
                                        <div class="icheck-primary">
                                        <input type="checkbox" id="{{$key}}" name="features[]" value="{{$key}}">
                                        <label for="{{$key}}">{{ucwords(str_replace('_', ' ', $key))}}</label> 
                                    </div></div>
                                    @endforeach
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
    $(document).on('change', '#category_id', function(event) {
        $('#subcategory_id').html("");
        let category_id = $(this).val();
        $.ajax({
            url: `{{ URL::to('fetch-subcategory-options/${category_id}') }}`,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    $('#subcategory_id').append(result.html);
                    
                    if(result.brands==1){
                        $('#branddetail').show();
                        $('#brands').val('brands');
                    }
                    else{
                        $('#branddetail').hide();
                        $('#brands').val('');
                    }
                } else {
                    //toastr.error('error encountered ' + result.msgText);
                }
            },
        });
    });
</script>
@endpush
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
            <h1>Edit SEO Deatils</h1>
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
                            <form action="{{route('manage-seo.update',$result->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Page Name</label>
                                        <select name="name" class="form-control" id="name" required>
                                            <option value="">Select Page</option>
                                            @foreach($slugs as $data)
                                                <option value="{{$data->slug}}"{{$data->slug == $result->name ? 'selected' : ''}}>{{$data->display}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $result->meta_title) }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ old('meta_keyword', $result->meta_keyword) }}" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description" required>{{ old('meta_description', $result->meta_description) }}</textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="canonical">Canonical URL</label>
                                    <input type="text" class="form-control" id="canonical" name="canonical" value="{{ old('canonical', $result->canonical) }}" required>
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

@endpush
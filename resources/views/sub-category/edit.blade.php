@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Categories</li>
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
                            <a href="{{ route('master.subcategory.index') }}" class="btn btn-outline-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="card-body">
                            <!-- Edit Category Form -->
                            <form id="editCategoryForm" method="post" action="{{ route('master.subcategory.update', $subcategory->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" class="form-control" id="category_id">
                                             <option value="">Select</option>
                                           @foreach($categories as $data)
                                                <option value="{{$data->id}}" {{$data->id == $subcategory->category_id ? 'selected': ''}}>{{$data->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $subcategory->name) }}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label for="meta_title">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $subcategory->meta_title) }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ old('meta_keyword', $subcategory->meta_keyword) }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description">{{ old('meta_description', $subcategory->meta_description) }}</textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="canonical_url">Canonical URL</label>
                                    <input type="text" class="form-control" id="canonical_url" name="canonical_url" value="{{ old('canonical_url', $subcategory->canonical_url) }}">
                                </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="text-md-right">
                                        <button type="submit" class="btn btn-primary">Update Sub Category</button>
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

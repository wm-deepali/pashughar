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
                <?php    Session::forget('success'); ?>
            </div>
        @endif

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="d-grid d-md-flex justify-content-md-end m-3">
                                <a href="{{ route('master.category.index') }}" class="btn btn-outline-primary"><i
                                        class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            </div>
                            <div class="card-body">
                                <!-- Edit Category Form -->
                                <form id="editCategoryForm" method="post"
                                    action="{{ route('master.category.update', $category->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name', $category->name) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" class="form-control" id="slug" name="slug"
                                            value="{{ old('slug', $category->slug) }}" required>
                                        <small class="form-text text-muted">This will be used in the URL (e.g.,
                                            /category/my-category)</small>
                                    </div>


                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                        <img id="imgView" class="mt-2"
                                            src="{{ $category->image ? Storage::url($category->image) : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg' }}"
                                            alt="Current Image" width="160">
                                    </div>


                                    <div class="form-group">
                                        <label for="bottom_categories">Popular Category</label>
                                        <select type="text" class="form-control" required id="bottom_categories"
                                            name="bottom_categories">
                                            <option value="">Select Your Choice</option>
                                            <option value="yes" @if($category->bottom_categories == 'yes') selected @endif>Yes
                                            </option>
                                            <option value="no" @if($category->bottom_categories == 'no') selected @endif>No
                                            </option>
                                        </select>


                                    </div>

                                    <div class="form-group" id="bottomimage" @if($category->bottom_categories == "yes")
                                    style="display:block" @else style="display:none" @endif>
                                        <label for="bottom_image">Bottom Image</label>
                                        <input type="file" class="form-control" id="bottom_image" name="bottom_image">
                                        <img id="imgViews" class="mt-2"
                                            src="{{ $category->bottom_image ? Storage::url($category->bottom_image) : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg' }}"
                                            alt="Current Image" width="160">
                                    </div>



                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                                            value="{{ old('meta_title', $category->meta_title) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_keyword">Meta Keyword</label>
                                        <input type="text" class="form-control" id="meta_keyword" name="meta_keyword"
                                            value="{{ old('meta_keyword', $category->meta_keyword) }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea class="form-control" id="meta_description"
                                            name="meta_description">{{ old('meta_description', $category->meta_description) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="canonical_url">Canonical URL</label>
                                        <input type="text" class="form-control" id="canonical_url" name="canonical_url"
                                            value="{{ old('canonical_url', $category->canonical_url) }}">
                                    </div>

                                    <div class="col-md-12">
                                        <div class="text-md-right">
                                            <button type="submit" class="btn btn-primary">Save Category</button>
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

    <script>

        // Auto-generate slug from Name field
        document.getElementById('name').addEventListener('keyup', function () {
            let slug = this.value.toLowerCase()
                .replace(/[^a-z0-9]+/g, '-') // replace non-alphanumeric with hyphen
                .replace(/^-+|-+$/g, '');    // remove leading/trailing hyphens
            document.getElementById('slug').value = slug;
        });

        document.getElementById('bottom_categories').addEventListener('change', function (event) {
            var value = $(this).val();
            if (value == 'yes') {
                document.getElementById('bottomimage').style.display = "block";
            }
            else {
                document.getElementById('bottomimage').style.display = "none";
            }

        });


        document.getElementById('image').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('imgView').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script>
        document.getElementById('bottom_image').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('imgViews').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

    </script>
@endsection
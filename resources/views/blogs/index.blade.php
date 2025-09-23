@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Blogs</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blogs</li>
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
                            <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#addBlog">Add</a>
                        </div>
                        <div class="card-body">
                            <table id="categoriesTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Create Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogs as $key=>$blog)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$blog->title}}</td>
                                            <td>{{ $blog->created_at ? $blog->created_at->format('Y-m-d') : 'N/A' }}</td>
                                            <td>
                                                @if($blog->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editBlogModal-{{$blog->id}}"><i class="fas fa-edit"></i></a>
                                                <form id="delete-country-{{ $blog->id }}" action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" class="btn btn-danger" onclick="confirmDelete({{ $blog->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editBlogModal-{{$blog->id}}" tabindex="-1" role="dialog" aria-labelledby="editBlogModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="{{ route('blogs.update', $blog->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editCountryModalLabel">Edit Page</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="title">Title</label>
                                                                <input type="text" class="form-control" id="title" name="title" placeholder="Title :" value="{{$blog->title}}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="short_description">Short Description</label>
                                                                <input type="text" class="form-control" id="short_description" name="short_description" placeholder="Short Description :" value="{{$blog->short_description}}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="detail">Detail Content</label>
                                                                <textarea name="detail_content" placeholder="Write post here..." class="w-full border border-gray-400 p-1 bg-white rounded focus:outline-none summernote">{{$blog->detail_content}}</textarea>
                                                            </div>

                                                            <!-- Upload Thumbnail Image -->
                                                            <div class="form-group">
                                                                <label for="thumb_image">Upload Thumbnail Image</label>
                                                                <input type="file" class="form-control" id="thumb_image" name="thumb_image" accept="image/*">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="thumb_alt">Thumbnail Alt Tag</label>
                                                                <input type="text" class="form-control" id="thumb_alt" name="thumb_alt" placeholder="Enter alt text for thumbnail" value="{{$blog->thumb_alt}}">
                                                            </div>

                                                            <!-- Upload Banner Image -->
                                                            <div class="form-group">
                                                                <label for="banner_image">Upload Banner Image</label>
                                                                <input type="file" class="form-control" id="banner_image" name="banner_image" accept="image/*">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="banner_alt">Banner Alt Tag</label>
                                                                <input type="text" class="form-control" id="banner_alt" name="banner_alt" placeholder="Enter alt text for banner" value="{{$blog->banner_alt}}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="meta_title">Meta Title</label>
                                                                <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Title :" value="{{$blog->meta_title}}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="meta_keyword">Meta Keyword</label>
                                                                <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" placeholder="Meta Keyword :" value="{{$blog->meta_keyword}}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="meta_description">Meta Description</label>
                                                                <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Meta Description :" value="{{$blog->meta_description}}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="canonical">Canonical</label>
                                                                <input type="text" class="form-control" id="canonical" name="canonical" placeholder="Canonical :" value="{{$blog->meta_description}}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" id="edit_country_status{{ $blog->id}}" name="status" value="1"  {{ $blog->status == 1 ? 'checked' : '' }}>
                                                                    <label class="custom-control-label" for="edit_country_status{{ $blog->id}}">Active</label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add Country Modal -->
<div class="modal fade" id="addBlog" tabindex="-1" role="dialog" aria-labelledby="addPageLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addCountryForm" method="post" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addBlogLabel">Add Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title :" value="{{old('title')}}" required>
                    </div>

                    <div class="form-group">
                        <label for="short_description">Short Description</label>
                        <input type="text" class="form-control" id="short_description" name="short_description" placeholder="Short Description :" value="{{old('short_description')}}" required>
                    </div>

                    <div class="form-group">
                        <label for="detail">Detail Content</label>
                        <textarea name="detail_content" placeholder="Write post here..." class="w-full border border-gray-400 p-1 bg-white rounded focus:outline-none summernote">{{old('detail_content')}}</textarea>
                    </div>

                    <!-- Upload Thumbnail Image -->
                    <div class="form-group">
                        <label for="thumb_image">Upload Thumbnail Image</label>
                        <input type="file" class="form-control" id="thumb_image" name="thumb_image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="thumb_alt">Thumbnail Alt Tag</label>
                        <input type="text" class="form-control" id="thumb_alt" name="thumb_alt" placeholder="Enter alt text for thumbnail" value="{{old('thumb_alt')}}">
                    </div>

                    <!-- Upload Banner Image -->
                    <div class="form-group">
                        <label for="banner_image">Upload Banner Image</label>
                        <input type="file" class="form-control" id="banner_image" name="banner_image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="banner_alt">Banner Alt Tag</label>
                        <input type="text" class="form-control" id="banner_alt" name="banner_alt" placeholder="Enter alt text for banner" value="{{old('banner_alt')}}">
                    </div>

                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Title :" value="{{old('meta_title')}}">
                    </div>

                    <div class="form-group">
                        <label for="meta_keyword">Meta Keyword</label>
                        <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" placeholder="Meta Keyword :" value="{{old('meta_keyword')}}">
                    </div>

                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Meta Description :" value="{{old('meta_description')}}">
                    </div>

                    <div class="form-group">
                        <label for="canonical">Canonical</label>
                        <input type="text" class="form-control" id="canonical" name="canonical" placeholder="Canonical :" value="{{old('meta_description')}}">
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" checked>
                            <label class="custom-control-label" for="status">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmDelete(countryId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-country-' + countryId).submit();
            }
        })
    }
</script>
@endsection

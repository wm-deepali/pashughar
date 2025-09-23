@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Comments</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Comments</li>
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
                        {{-- <div class="d-grid d-md-flex justify-content-md-end m-3">
                            <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#addBlog">Add</a>
                        </div> --}}
                        <div class="card-body">
                            <table id="categoriesTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Comment</th>
                                        <th>Create Date</th>
                                        <th>Approve Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($comments as $key=>$comment)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$comment->blog->title}}</td>
                                            <td>{{$comment->name}}</td>
                                            <td>{{$comment->email}}</td>
                                            <td>{{$comment->comment}}</td>

                                            <td>{{ $comment->created_at ? $comment->created_at->format('Y-m-d') : 'N/A' }}</td>
                                            <td>
                                                @if($comment->approve == 1)
                                                    <span class="badge badge-success">Approve</span>
                                                @else
                                                    <span class="badge badge-danger">Not Approve</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editCommentModal-{{$comment->id}}"><i class="fas fa-edit"></i></a>
                                                <form id="delete-country-{{ $comment->id }}" action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" class="btn btn-danger" onclick="confirmDelete({{ $comment->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editCommentModal-{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="{{ route('comments.update', $comment->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editCountryModalLabel">Edit Comment</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Approve Comment</label>
                                                                <div>
                                                                    <input type="checkbox" name="approve" value="1" {{ $comment->approve == 1 ? 'checked' : '' }}>
                                                                    <label >Approve</label>
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

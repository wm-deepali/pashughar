@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Pages</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pages</li>
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
                            <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#addPage">Add</a>
                        </div>
                        <div class="card-body">
                            <table id="categoriesTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Canonical</th>
                                        <th>Create Date</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pages as $key=>$page)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$page->name}}</td>
                                            <td>{{$page->canonical}}</td>
                                            <td>{{ $page->created_at ? $page->created_at->format('Y-m-d') : 'N/A' }}</td>
                                            <td>
                                                @if($page->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editPageModal-{{$page->id}}"><i class="fas fa-edit"></i></a>
                                                <form id="delete-country-{{ $page->id }}" action="{{ route('pages.destroy', $page->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" class="btn btn-danger" onclick="confirmDelete({{ $page->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editPageModal-{{$page->id}}" tabindex="-1" role="dialog" aria-labelledby="editPageModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="{{ route('pages.update', $page->id) }}">
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
                                                                <label for="name">Page Name</label>
                                                                <input type="text" class="form-control" id="name" name="name" placeholder="Name :" value="{{$page->name}}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="heading">Heading</label>
                                                                <input type="text" class="form-control" id="heading" name="heading" placeholder="Heading :" value="{{$page->heading}}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="detail">Detail</label>
                                                                <textarea name="detail_content" placeholder="Write post here..." class="w-full border border-gray-400 p-1 bg-white rounded focus:outline-none summernote">{{$page->detail_content}}</textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="meta_title">Meta Title</label>
                                                                <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Title :" value="{{$page->meta_title}}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="meta_keyword">Meta Keyword</label>
                                                                <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" placeholder="Meta Keyword :" value="{{$page->meta_keyword}}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="meta_description">Meta Description</label>
                                                                <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Meta Description :" value="{{$page->meta_description}}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="canonical">Canonical</label>
                                                                <input type="text" class="form-control" id="canonical" name="canonical" placeholder="Canonical :" value="{{$page->canonical}}">
                                                            </div>


                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" id="edit_country_status" name="status" value="1"  {{ $page->status == 1 ? 'checked' : '' }}>
                                                                    <label class="custom-control-label" for="edit_country_status">Active</label>
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
<div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="addPageLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addCountryForm" method="post" action="{{ route('pages.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addPageLabel">Add Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Page Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name :" value="{{old('name')}}" required>
                    </div>

                    <div class="form-group">
                        <label for="heading">Heading</label>
                        <input type="text" class="form-control" id="heading" name="heading" placeholder="Heading :" value="{{old('heading')}}" required>
                    </div>

                    <div class="form-group">
                        <label for="detail">Detail</label>
                        <textarea name="detail_content" placeholder="Write post here..." class="w-full border border-gray-400 p-1 bg-white rounded focus:outline-none summernote">{{old('detail_content')}}</textarea>
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

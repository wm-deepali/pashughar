@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Brands</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Brands</li>
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
                            <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#addBrandModal">Add</a>
                        </div>
                        <div class="card-body">
                            <table id="categoriesTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Created At</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($brands as $key=>$brand)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$brand->name}}</td>
                                            <td>{{ isset($brand->categories) ? $brand->categories->name : ''}}</td>
                                            <td>{{$brand->created_at}}</td>
                                            <td>
                                                @if($brand->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editBrandModal-{{$brand->id}}"><i class="fas fa-edit"></i></a>
                                                <form id="delete-brand-{{ $brand->id }}" action="{{ route('master.brand.destroy', $brand->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" class="btn btn-danger" onclick="confirmDelete({{ $brand->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editBrandModal-{{$brand->id}}" tabindex="-1" role="dialog" aria-labelledby="editBrandModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="{{ route('master.brand.update', $brand->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editBrandModalLabel">Edit Brand</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="edit_state_name">Name</label>
                                                                <input type="text" class="form-control" id="edit_state_name" name="name" value="{{ $brand->name }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="edit_state">Category</label>
                                                                <select class="form-control" id="edit_state" name="brand_category_id">
                                                                    @if(isset($categories) && count($categories)>0)
                                                                    @foreach($categories as $category)
                                                                        <option value="{{$category->id}}" {{$brand->brand_category_id == $category->id ? 'selected':''}}>{{$category->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="edit_brand_image_{{ $brand->id }}">Image</label>
                                                                <input type="file" class="form-control" id="edit_brand_image_{{ $brand->id }}" name="image" accept="image/*" onchange="previewImage(this, 'edit_preview_{{$brand->id}}')">
                                                                <img id="edit_preview_{{$brand->id}}" src="{{ $brand->image ? Storage::url($brand->image) : '#' }}" alt="Image Preview" style="margin-top: 10px; max-width: 100%; {{ $brand->image ? '' : 'display:none;' }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox"  class="custom-control-input" id="edit_city_status{{$brand->id}}" name="status" {{ $brand->status == 1 ? 'checked' : '' }}>
                                                                    <label class="custom-control-label" for="edit_city_status{{$brand->id}}">Active</label>
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
<div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="addBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addCityForm" method="post" action="{{ route('master.brand.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addBrandModalLabel">Add Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="city_name">Name</label>
                        <input type="text" class="form-control" id="city_name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_state">Category</label>
                        <select class="form-control" id="edit_state" name="brand_category_id">
                            <option value="">Select</option>
                            @if(isset($categories) && count($categories)>0)
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brand_image">Image</label>
                        <input type="file" class="form-control" id="brand_image" name="image" accept="image/*" onchange="previewImage(this, 'add_preview')">
                        <img id="add_preview" src="#" alt="Image Preview" style="display:none; margin-top: 10px; max-width: 100%;">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="city_status" name="status" value="1" checked>
                            <label class="custom-control-label" for="city_status">Active</label>
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
    function confirmDelete(brandId) {
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
                document.getElementById('delete-brand-' + brandId).submit();
            }
        })
    }
    function previewImage(input, previewId) {
        var preview = document.getElementById(previewId);
        var reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }
</script>
@endsection

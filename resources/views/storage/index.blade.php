@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Storage</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Storage</li>
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
                            <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#addStorageModal">Add</a>
                        </div>
                        <div class="card-body">
                            <table id="categoriesTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Size</th>
                                        <th>Type</th>
                                        <th>Created At</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($storages as $key=>$construct)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$construct->data}}</td>
                                            <td>{{$construct->size}}</td>
                                            <td>{{$construct->created_at}}</td>
                                            <td>
                                                @if($construct->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editStorageModal-{{$construct->id}}"><i class="fas fa-edit"></i></a>
                                                <form id="delete-storage-{{ $construct->id }}" action="{{ route('master.storage.destroy', $construct->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" class="btn btn-danger" onclick="confirmDelete({{ $construct->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editStorageModal-{{$construct->id}}" tabindex="-1" role="dialog" aria-labelledby="editJobModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="{{ route('master.storage.update', $construct->id) }}">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editJobModalLabel">Edit Storage</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="edit_country_name">Size</label>
                                                                <input type="text" class="form-control" id="edit_country_name" name="value" value="{{ $construct->data }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="size">Type</label>
                                                                <select class="form-control" name="size" id="size">
                                                                    <option value="{{$construct->size}}">{{$construct->size}}</option>
                                                                    <option value="KB">KB</option>
                                                                    <option value="MB">MB</option>
                                                                    <option value="GB">GB</option>
                                                                    <option value="TB">TB</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" id="edit_country_status" name="status" {{ $construct->status == 1 ? 'checked' : '' }}>
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
<div class="modal fade" id="addStorageModal" tabindex="-1" role="dialog" aria-labelledby="addStorageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addCountryForm" method="post" action="{{ route('master.storage.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addStorageModalLabel">Add Storage</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="country_name">Size</label>
                        <input type="text" class="form-control" id="country_name" name="value" required>
                    </div>
                    <div class="form-group">
                        <label for="size">Type</label>
                        <select class="form-control" name="size" id="size">
                            <option value="KB">KB</option>
                            <option value="MB">MB</option>
                            <option value="GB">GB</option>
                            <option value="TB">TB</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="country_status" name="status" value="1" checked>
                            <label class="custom-control-label" for="country_status">Active</label>
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
    function confirmDelete(storageId) {
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
                document.getElementById('delete-storage-' + storageId).submit();
            }
        })
    }
</script>
@endsection

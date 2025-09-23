@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Operating Systems</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Operating Systems</li>
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
                            <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#addOperatingSystemModal">Add</a>
                        </div>
                        <div class="card-body">
                            <table id="categoriesTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Company Name</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($operating_systems as $key=>$os)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$os->name}}</td>
                                            <td>{{$os->company_name}}</td>
                                            <td><img src="{{ url($os->image) }}" alt="Image" width="70"></td>
                                            <td>{{$os->created_at}}</td>
                                            <td>
                                                @if($os->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editOperatingSystemModal-{{$os->id}}"><i class="fas fa-edit"></i></a>
                                                <form id="delete-operating-system-{{ $os->id }}" action="{{ route('master.operating.system.destroy', $os->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" class="btn btn-danger" onclick="confirmDelete({{ $os->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editOperatingSystemModal-{{$os->id}}" tabindex="-1" role="dialog" aria-labelledby="editOperatingSystemModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="{{ route('master.operating.system.update', $os->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editOperatingSystemModalLabel">Edit Operating System</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="edit_os_name">Name</label>
                                                                <input type="text" class="form-control" id="edit_os_name" name="name" value="{{ $os->name }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="edit_os_company_name">Company Name</label>
                                                                <input type="text" class="form-control" id="edit_os_company_name" name="company_name" value="{{ $os->company_name }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="edit_os_image">Image</label>
                                                                <input type="file" class="form-control-file" id="edit_os_image" name="image">
                                                                <small>Current Image: <img src="{{ url($os->image) }}" alt="Image" width="50"></small>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" id="edit_os_status" name="status" value="{{$os->status}}" {{ $os->status == 1 ? 'checked' : '' }}/>
                                                                    <label class="custom-control-label" for="edit_os_status">Active</label>
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

<!-- Add Operating System Modal -->
<div class="modal fade" id="addOperatingSystemModal" tabindex="-1" role="dialog" aria-labelledby="addOperatingSystemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addOperatingSystemForm" method="post" action="{{ route('master.operating.system.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addOperatingSystemModalLabel">Add Operating System</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="os_name">Name</label>
                        <input type="text" class="form-control" id="os_name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="os_company_name">Company Name</label>
                        <input type="text" class="form-control" id="os_company_name" name="company_name" required>
                    </div>
                    <div class="form-group">
                        <label for="os_image">Image</label>
                        <input type="file" class="form-control-file" id="os_image" name="image">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="os_status" name="status" value="1" checked>
                            <label class="custom-control-label" for="os_status">Active</label>
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
    function confirmDelete(osId) {
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
                document.getElementById('delete-operating-system-' + osId).submit();
            }
        })
    }
</script>
@endsection

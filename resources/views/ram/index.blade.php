@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ram</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ram</li>
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
                            <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#addRamModal">Add</a>
                        </div>
                        <div class="card-body">
                            <table id="categoriesTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Capacity</th>
                                        <th>Type</th>
                                        <th>Speed(MHZ)</th>
                                        <th>Created At</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rams as $key=>$construct)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$construct->capacity}}</td>
                                            <td>{{$construct->type}}</td>
                                            <td>{{$construct->speed}}</td>
                                            <td>{{$construct->created_at}}</td>
                                            <td>
                                                @if($construct->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editRamModal-{{$construct->id}}"><i class="fas fa-edit"></i></a>
                                                <form id="delete-ram-{{ $construct->id }}" action="{{ route('master.ram.destroy', $construct->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" class="btn btn-danger" onclick="confirmDelete({{ $construct->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editRamModal-{{$construct->id}}" tabindex="-1" role="dialog" aria-labelledby="editRamModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="{{ route('master.ram.update', $construct->id) }}">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editRamModalLabel">Edit Ram</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="edit_country_name">Capacity</label>
                                                                <select class="form-control" name="capacity" id="size">
                                                                    <option value="{{$construct->capacity}}">{{$construct->capacity}}</option>
                                                                    <option value="2GB">2GB</option>
                                                                    <option value="4GB">4GB</option>
                                                                    <option value="8GB">8GB</option>
                                                                    <option value="16GB">16GB</option>
                                                                    <option value="32GB">32GB</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="type">Type</label>
                                                                <select class="form-control" name="type" id="type">
                                                                    <option value="{{$construct->type}}">{{$construct->type}}</option>
                                                                    <option value="DDR2">DDR2</option>
                                                                    <option value="DDR3">DDR3</option>
                                                                    <option value="DDR4">DDR4</option>
                                                                    <option value="DDR5">DDR5</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="speed">Speed(MHZ)</label>
                                                                <input type="text" class="form-control" id="speed" name="speed" value="{{$construct->speed}}" required>
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
<div class="modal fade" id="addRamModal" tabindex="-1" role="dialog" aria-labelledby="addRamModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addCountryForm" method="post" action="{{ route('master.ram.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addRamModalLabel">Add Ram</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_country_name">Capacity</label>
                        <select class="form-control" name="capacity" id="size">
                            <option value="">None</option>
                            <option value="2GB">2GB</option>
                            <option value="4GB">4GB</option>
                            <option value="8GB">8GB</option>
                            <option value="16GB">16GB</option>
                            <option value="32GB">32GB</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" name="type" id="type">
                            <option value="">None</option>
                            <option value="DDR2">DDR2</option>
                            <option value="DDR3">DDR3</option>
                            <option value="DDR4">DDR4</option>
                            <option value="DDR5">DDR5</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="speed">Speed(MHZ)</label>
                        <input type="text" id="speed" class="form-control" name="speed" required>
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
                document.getElementById('delete-ram-' + storageId).submit();
            }
        })
    }
</script>
@endsection

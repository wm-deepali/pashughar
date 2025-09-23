@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Zipcode</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Zipcode</li>
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
                            <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#addPincodeModal">Add</a>
                        </div>
                        <div class="card-body">
                            <table id="categoriesTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Pincode</th>
                                        <th>City</th>
                                        <th>Created At</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pincodes as $key=>$pincode)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$pincode->pincode}}</td>
                                            <td>{{$pincode->city->name}}</td>
                                            <td>{{$pincode->created_at}}</td>
                                            <td>
                                                @if($pincode->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editPincodeModal-{{$pincode->id}}"><i class="fas fa-edit"></i></a>
                                                <form id="delete-pincode-{{ $pincode->id }}" action="{{ route('master.pincode.destroy', $pincode->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" class="btn btn-danger" onclick="confirmDelete({{ $pincode->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editPincodeModal-{{$pincode->id}}" tabindex="-1" role="dialog" aria-labelledby="editPincodeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="{{ route('master.pincode.update', $pincode->id) }}">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editCityModalLabel">Edit Pincode</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="edit_pincode">Pincode</label>
                                                                <input type="number" class="form-control" id="edit_pincode" name="pincode" value="{{ $pincode->pincode }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="edit_city">City</label>
                                                                <select class="form-control select2" id="edit_city" name="city_id">
                                                                    @foreach($cities as $city)
                                                                        <option value="{{$city->id}}" {{$pincode->city_id == $city->id ? 'selected':''}}>{{$city->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" id="edit_city_status" name="status" {{ $pincode->status == 1 ? 'checked' : '' }}>
                                                                    <label class="custom-control-label" for="edit_city_status">Active</label>
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
<div class="modal fade" id="addPincodeModal" tabindex="-1" role="dialog" aria-labelledby="addPincodeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addCityForm" method="post" action="{{ route('master.pincode.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addLocationModalLabel">Add Pincode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pincode">Pincode</label>
                        <input type="number" class="form-control" id="pincode" name="pincode" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_city">City</label>
                        <select class="form-control select2" id="edit_city" name="city_id">
                            <option value="">Select</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
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
    function confirmDelete(pincodeId) {
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
                document.getElementById('delete-pincode-' + pincodeId).submit();
            }
        })
    }
</script>
@endsection

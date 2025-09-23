@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Enquiry</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Enquiry</li>
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
                            {{-- <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#addFaq">Add</a> --}}
                        </div>
                        <div class="card-body">
                           <table id="categoriesTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Telephones</th>
                                        <th>Order Qty</th>
                                        <th>Category</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Zip Code</th>
                                        <th>Details</th>
                                        <th>Create Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($enquries as $key=>$enqurie)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$enqurie->name ?? ""}}</td>
                                            <td>{{ $enqurie->email ?? ""}}</td>
                                            <td>{{ $enqurie->mobile ?? ""}}</td>
                                            <td>{{ $enqurie->telephones ?? ""}}</td>
                                            <td>{{ $enqurie->order_qty ?? ""}}</td>
                                            <td>{{ $enqurie->category->name ?? ""}}</td>
                                            <td>{{ $enqurie->state->name ?? ""}}</td>
                                            <td>{{ $enqurie->city->name ?? ""}}</td>
                                            <td>{{ $enqurie->code ?? ""}}</td>
                                            <td>{{ $enqurie->detail ?? ""}}</td>
                                            <td>{{ $enqurie->created_at ? $enqurie->created_at->format('Y-m-d') : 'N/A' }}</td>

                                            <td>
                                                {{-- <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editFaqModal-{{$enqurie->id}}"><i class="fas fa-edit"></i></a> --}}
                                                <form id="delete-country-{{ $enqurie->id }}" action="{{ route('enquirys.destroy', $enqurie->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" class="btn btn-danger" onclick="confirmDelete({{ $enqurie->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        {{-- <div class="modal fade" id="editFaqModal-{{$enqurie->id}}" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="{{ route('enquirys.update', $enqurie->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editCountryModalLabel">Edit Enquiry</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>


                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> --}}
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
<div class="modal fade" id="addFaq" tabindex="-1" role="dialog" aria-labelledby="addPageLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addCountryForm" method="post" action="{{ route('faq.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addFaqLabel">Add Faq</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="qustion">Question</label>
                        <input type="text" class="form-control" id="qustion" name="qustion" placeholder="Question :" value="{{old('qustion')}}" required>
                    </div>

                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <textarea name="answer" placeholder="Write post here..." class="w-full border border-gray-400 p-1 bg-white rounded focus:outline-none summernote">{{old('answer')}}</textarea>
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

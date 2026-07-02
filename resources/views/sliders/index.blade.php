@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Sliders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Slider List</li>
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
               @php Session::forget('success'); @endphp
            </div>
        @endif
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="d-grid d-md-flex justify-content-md-end m-3">
                                <a href="{{ route('sliders.create') }}" class="btn btn-primary">Add Slider</a>
                            </div>
                            <div class="card-body">
                                <table id="categoriesTable" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                           <th>#</th>
                                            <th>Title</th>
                                            <th>Mobile Image</th>
                                            <th>Desktop Image</th>
                                            <th>Status</th>
                                            <th width="180">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @forelse($sliders as $slider)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $slider->title }}</td>
                                                    <td>
                                                        <img src="{{ asset('storage/'.$slider->mobile_image) }}" 
                                                             width="80">
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset('storage/'.$slider->desktop_image) }}" 
                                                             width="120">
                                                    </td>
                                                    <td>
                                                        @if($slider->status)
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('sliders.edit', $slider->id) }}" 
                                                           class="btn btn-sm btn-warning">Edit</a>
                                
                                                        <form action="{{ route('sliders.destroy', $slider->id) }}" 
                                                              method="POST" 
                                                              style="display:inline-block"
                                                              onsubmit="return confirm('Delete this slider?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No sliders found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
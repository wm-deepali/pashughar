@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Features</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Form Features</li>
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
                            <a href="{{route('form-features.create')}}" class="btn btn-outline-danger">Add</a>
                        </div>
                        <div class="card-body">
                            <table id="categoriesTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Features</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($features as $key=>$type)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{$type->category->name ?? ''}}</td>
                                            <td>{{$type->subcategory->name ?? ''}}</td>
                                            <td>
                                              @php 
                                              $data=str_replace("[" ,"",$type->features); #
                                              $data1=str_replace('"' ,"",$data); #
                                              $data2=str_replace(']' ,"",$data1); #
                                                $data3=str_replace('_' ," ",$data2); #
                                                $data4=str_replace('null' ," ",$data3); #
                                          
                                              echo($data4);
                                              @endphp
                                          

                                           @if($type->features == null)
                                                {{ucwords(str_replace("_", " ", (implode(", ",json_decode($type->features)))))}}
                                            @endif
                                            </td>
                                            <td>
                                                <a href="{{route('form-features.edit', $type->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                <form id="delete-feature-{{ $type->id }}" action="{{ route('form-features.destroy', $type->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" class="btn btn-danger" onclick="confirmDelete({{ $type->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmDelete(featureId) {
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
                document.getElementById('delete-feature-' + featureId).submit();
            }
        })
    }
</script>
@endsection

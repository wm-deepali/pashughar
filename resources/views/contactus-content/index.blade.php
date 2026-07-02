@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage About</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Contact Us Content</li>
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
                        @if(count($abouts) == 0)
                        <div class="d-grid d-md-flex justify-content-md-end m-3">
                            <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#addContactUsContent">Add</a>
                        </div>
                        @endif
                        <div class="card-body">
                            <table id="categoriesTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Address Line 1</th>
                                        <th>Address Line 2</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($abouts as $key=>$about)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$about->mobile}}</td>
                                            <td>{{ $about->email }}</td>
                                            <td>{!! $about->address_line1 !!}</td>
                                            <td>{!! $about->address_line2 ?? "-" !!}</td>
                                            
                                            <td>
                                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editontactModal-{{$about->id}}"><i class="fas fa-edit"></i></a>
                                                
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editontactModal-{{$about->id}}" tabindex="-1" role="dialog" aria-labelledby="editontactModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="post" action="{{ route('contactus-content.update', $about->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editCountryModalLabel">Edit Contact Us Content</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="mobile">Mobile Number</label>
                                                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Heading :" value="{{$about->mobile}}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="email" class="form-control" id="email" name="email" placeholder="Email :" value="{{$about->email}}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="address_line1">Adress Line 1</label>
                                                                <textarea name="address_line1" placeholder="Write post here..." class="w-full border border-gray-400 p-1 bg-white rounded focus:outline-none summernote">{{$about->address_line1}}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="address_line2">Adress Line 2</label>
                                                                <textarea name="address_line2" placeholder="Write post here..." class="w-full border border-gray-400 p-1 bg-white rounded focus:outline-none summernote">{{$about->address_line2}}</textarea>
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
<div class="modal fade" id="addContactUsContent" tabindex="-1" role="dialog" aria-labelledby="addPageLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addCountryForm" method="post" action="{{ route('contactus-content.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addFaqLabel">Add ContactUs Content</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile :" value="{{old('mobile')}}" required>
                    </div>

                    <div class="form-group">
                        <label for="short_description">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email :" value="{{old('email')}}" required>
                    </div>

                    <div class="form-group">
                        <label for="detail_content">Address Line 1</label>
                        <textarea name="address_line1" placeholder="Write post here..." class="w-full border border-gray-400 p-1 bg-white rounded focus:outline-none summernote">{{old('address_line1')}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="detail_content">Address Line 2</label>
                        <textarea name="address_line2" placeholder="Write post here..." class="w-full border border-gray-400 p-1 bg-white rounded focus:outline-none summernote">{{old('address_line2')}}</textarea>
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

@endsection

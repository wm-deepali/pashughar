@extends('layouts.app')

@section('content')
<style>
    .text-con-label {
    font-size: 13px;
}
</style>
<div class="container-fluid">
    <section class="content-header">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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
                        </div>
                        <div class="card-body">
                            <table id="categoriesTable" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Profile Pic</th>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Email Verified</th>
                                        <th>Mobile Verified</th>
                                        <th>Total Ads</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $key=>$user)
                                        <tr>
                                            <td>
                                                @if(isset($user->profile_pic) && $user->profile_pic !='')
                                        @if (strpos($user->profile_pic,'https') !== false) 
                                        <img class="mt-2 img-fluid" src="{{$user->profile_pic}}" alt="User Image" style="height:70px;">
                                        @else
                                        <img class="mt-2 img-fluid" src="{{ asset('storage').'/'.$user->profile_pic}}" alt="User Image" style="height:70px;">
                                        @endif
                                        @else
                                        <img class="mt-2 img-fluid" src="{{asset('front/images/avatar/user.png')}}" alt="User Image" style="height:70px;">
                                        @endif
                                            </td>
                                            <th scope="row">{{ $user->member_id }}</th>
                                            <td>{{$user->full_name ?? ''}}</td>
                                            <td>{{$user->mobile ?? ''}}</td>
                                            <td>{{$user->email ?? ''}}</td>
                                            <td>{{$user->email_verified_at ?? ''}}</td>
                                            <td>{{$user->mobile_verified_at ?? ''}}</td>
                                            <td>{{$user->ads->count() ?? ''}}</td>
                                            <td>{{$user->status ?? ''}}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-success preview-user" userid="{{ $user->id }}" title="View User"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('manage-users.edit', $user->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                <form id="delete-user-{{ $user->id }}" action="{{ route('manage-users.destroy', $user->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" class="btn btn-danger" onclick="confirmDelete({{ $user->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
<div class="modal fade" id="preview-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
@push('after-script')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    function confirmDelete(userId) {
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
                document.getElementById('delete-user-' + userId).submit();
            }
        })
    }
    $(document).on('click','.preview-user',function(event){
      let userid = $(this).attr('userid');
      $.ajax({
        url:`{{ URL::to('manage-users/${userid}') }}`,
        type:'GET',
        dataType:'json',
        success:function(result){
          if (result.msgCode=='200') {
            $('#preview-user').html(result.html);
            $('#preview-user').modal('show');
            $('#preview-user').css('opacity', '1');
            $('#preview-user').css('top', '12%');
          } else {
            alert(result.msgText);
          }
        },
        error:function(error) {
            alert(error.statusText);
          
        }
      })
    })
</script>
@endpush

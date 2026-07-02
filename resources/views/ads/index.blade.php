@extends('layouts.app')

@section('content')

    <style>
        .text-con-label {
            font-size: 13px;
        }
        .status-tabs .nav-link {
            font-weight: 500;
        }
        .status-tabs .badge {
            margin-left: 6px;
        }
        .filter-card {
            background: #f8f9fa;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <div class="container-fluid">
        <section class="content-header">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ads Post</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ads Post</li>
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

        <!-- ===== Status Tabs ===== -->
        <ul class="nav nav-tabs status-tabs mb-3">
            @php
                $tabs = [
                    'Pending'   => $pendingAdsCount,
                    'Published' => $publishedAdsCount,
                    'Expired'   => $expiredAdsCount,
                    'Rejected'  => $rejectedAdsCount,
                ];
            @endphp
            @foreach($tabs as $tabStatus => $tabCount)
                <li class="nav-item">
                    <a class="nav-link {{ $activeStatus == $tabStatus ? 'active' : '' }}"
                       href="{{ route('manage-ads.index', array_merge(request()->except('status'), ['status' => $tabStatus])) }}">
                        {{ $tabStatus }} Ads
                        <span class="badge {{ $activeStatus == $tabStatus ? 'bg-light text-dark' : 'bg-secondary' }}">
                            {{ $tabCount }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>

        <!-- ===== Filters ===== -->
        <div class="card filter-card mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('manage-ads.index') }}" class="row g-2 align-items-end">
                    <input type="hidden" name="status" value="{{ $activeStatus }}">

                    <div class="col-md-3">
                        <label class="text-con-label mb-1">Category</label>
                        <select name="category_id" id="filterCategory" class="form-control form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ ($filters['category_id'] ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="text-con-label mb-1">Sub Category</label>
                        <select name="subcategory_id" id="filterSubCategory" class="form-control form-select">
                            <option value="">All Sub Categories</option>
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}"
                                    data-category="{{ $subcategory->category_id }}"
                                    {{ ($filters['subcategory_id'] ?? '') == $subcategory->id ? 'selected' : '' }}>
                                    {{ $subcategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="text-con-label mb-1">Date From</label>
                        <input type="date" name="date_from" class="form-control"
                               value="{{ $filters['date_from'] ?? '' }}">
                    </div>

                    <div class="col-md-2">
                        <label class="text-con-label mb-1">Date To</label>
                        <input type="date" name="date_to" class="form-control"
                               value="{{ $filters['date_to'] ?? '' }}">
                    </div>

                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('manage-ads.index', ['status' => $activeStatus]) }}" class="btn btn-outline-secondary">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- ===== Ads Table (filtered by active tab) ===== -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title mb-0">{{ $activeStatus }} Ads</h3>
                            </div>
                            <div class="card-body">
                                <table id="categoriesTable" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User Name/Mobile</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Views</th>
                                            <th>Status</th>
                                            <th>Expires At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ads as $key => $ad)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{$ad->user->full_name ?? ''}}<br />{{$ad->user->mobile ?? ''}}</td>
                                                <td>{{$ad->title ?? ''}}</td>
                                                <td>{{$ad->category->name ?? ''}}</td>
                                                <td>{{$ad->price ?? ''}}</td>
                                                <td>{{$ad->views ?? ''}}</td>
                                                <td>
                                                    @if($ad->status == 'Published')
                                                        <span class="badge bg-success">Published</span>
                                                    @elseif($ad->status == 'Expired')
                                                        <span class="badge bg-danger">Expired</span>
                                                    @elseif($ad->status == 'Pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif($ad->status == 'Rejected')
                                                        <span class="badge bg-dark">Rejected</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ $ad->status ?? '' }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($ad->expire_at)
                                                        @if(\Carbon\Carbon::parse($ad->expire_at)->isPast())
                                                            <span class="text-danger">
                                                                {{ \Carbon\Carbon::parse($ad->expire_at)->format('d M, Y') }} (Expired)
                                                            </span>
                                                        @else
                                                            <span class="text-success">
                                                                {{ \Carbon\Carbon::parse($ad->expire_at)->format('d M, Y') }}
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span class="text-muted">No Expiry</span>
                                                    @endif
                                                </td>

                                                <!-- ===== Action Dropdown ===== -->
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                            id="actionDropdown{{ $ad->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Actions
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $ad->id }}">
                                                            <li>
                                                                <a class="dropdown-item preview-ad" href="javascript:void(0)" adid="{{ $ad->id }}">
                                                                    <i class="fa fa-eye me-2"></i> Preview
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{route('manage-ads.edit', $ad->id)}}">
                                                                    <i class="fas fa-edit me-2"></i> Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{route('seller-ads-enquiries', $ad->id)}}">
                                                                    <i class="fas fa-envelope me-2"></i> Enquiries
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="{{route('buy-now-enquiries', $ad->id)}}">
                                                                    <i class="fas fa-bag-shopping me-2"></i> Buy Now Enquiries
                                                                </a>
                                                            </li>

                                                            @if($ad->status == 'Expired')
                                                                <li>
                                                                    <a class="dropdown-item text-success extend-expiry" href="javascript:void(0)"
                                                                        data-ad-id="{{ $ad->id }}" data-ad-title="{{ $ad->title }}">
                                                                        <i class="fa fa-calendar-plus me-2"></i> Extend Expiry Date
                                                                    </a>
                                                                </li>
                                                            @endif

                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <a class="dropdown-item text-danger" href="#" onclick="confirmDelete({{ $ad->id }})">
                                                                    <i class="fa fa-trash me-2"></i> Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <form id="delete-ad-{{ $ad->id }}"
                                                        action="{{ route('manage-ads.destroy', $ad->id) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
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

    <!-- Preview Ad Modal -->
    <div class="modal fade" id="preview-ad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    </div>

    <!-- Extend Expiry Modal -->
    <div class="modal fade" id="extendExpiryModal" tabindex="-1" aria-labelledby="extendExpiryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="extendExpiryForm" method="POST" action="">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="extendExpiryModalLabel">Extend Expiry Date</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Extending expiry for: <strong id="extendAdTitle"></strong></p>
                        <div class="mb-3">
                            <label for="new_expire_at" class="form-label">New Expiry Date</label>
                            <input type="date" name="expire_at" id="new_expire_at" class="form-control"
                                   min="{{ date('Y-m-d') }}" required>
                        </div>
                        <small class="text-muted">Ad ka status "Published" ho jayega aur ye dubara site pe visible ho jayega.</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Extend & Republish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
@push('after-script')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
        function confirmDelete(adId) {
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
                    document.getElementById('delete-ad-' + adId).submit();
                }
            })
        }

        $(document).on('click', '.preview-ad', function (event) {
            let adid = $(this).attr('adid');
            $.ajax({
                url: `{{ URL::to('manage-ads/${adid}') }}`,
                type: 'GET',
                dataType: 'json',
                success: function (result) {
                    if (result.msgCode == '200') {
                        $('#preview-ad').html(result.html);
                        $('#preview-ad').modal('show');
                        $('#preview-ad').css('opacity', '1');
                    } else {
                        alert(result.msgText);
                    }
                },
                error: function (error) {
                    alert(error.statusText);
                }
            })
        })

        // ===== Extend Expiry Modal handling =====
        $(document).on('click', '.extend-expiry', function () {
            let adId = $(this).data('ad-id');
            let adTitle = $(this).data('ad-title');
            let actionUrl = "{{ url('manage-ads') }}/" + adId + "/extend-expiry";

            $('#extendAdTitle').text(adTitle);
            $('#extendExpiryForm').attr('action', actionUrl);
            $('#extendExpiryModal').modal('show');
        });

        // ===== Category -> SubCategory dependent filter =====
        $(document).on('change', '#filterCategory', function () {
            let categoryId = $(this).val();
            let $subSelect = $('#filterSubCategory');

            $subSelect.find('option').each(function () {
                let optCategory = $(this).data('category');
                if (!categoryId || $(this).val() === '' || optCategory == categoryId) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            // Reset subcategory selection if it doesn't belong to the chosen category
            let currentSubCategory = $subSelect.find('option:selected');
            if (categoryId && currentSubCategory.data('category') != categoryId && currentSubCategory.val() !== '') {
                $subSelect.val('');
            }
        });
    </script>
@endpush
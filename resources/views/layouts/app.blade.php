<x-laravel-ui-adminlte::adminlte-layout>
    <body class="hold-transition sidebar-mini layout-fixed">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
       

        {{-- chandan --}}
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

       
       <style>
            /* Style for the Select2 container */
            .select2-container {
                width: 100% !important;
            }
            .select2-container .select2-selection--single {
                height: 40px;
                border: 1px solid #ced4da;
                border-radius: 0.25rem;
                padding: 0.375rem 0.75rem;
            }

            .select2-container .select2-selection--single .select2-selection__rendered {
                color: #495057;
                padding-left: 0;
                padding-right: 0;
                line-height: 1.5;
            }

            .select2-container .select2-selection--single .select2-selection__arrow {
                height: 40px;
                right: 10px;
            }

            .select2-container--default .select2-results__option--highlighted[aria-selected] {
                background-color: #007bff;
                color: white;
            }

            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                background-color: #007bff;
                border-color: #006fe6;
                color: white;
                padding: 0 10px;
                margin-top: 4px;
            }

        </style>
        <div class="wrapper">
            <!-- Main Header -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                </ul>
                @php
                    $profileSetting = App\Models\ProfileSetting::first();
                @endphp
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ url('/').'/storage/app/'.$profileSetting->header_logo}}"
                                class="user-image img-circle elevation-2" alt="User Image">
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-primary">
                                <img src="{{ url('/').'/storage/app/'.$profileSetting->header_logo}}"
                                    class="img-circle elevation-2" alt="User Image">
                                <p>
                                    {{ Auth::user()->name }}
                                    <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                <a href="#" class="btn btn-default btn-flat float-right"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Sign out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <!-- Left side column. contains the logo and sidebar -->
            @include('layouts.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                
                @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
                @endif
                @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
                @endif
                @if($errors->any())
                <div class="alert alert-danger">
                    {{$errors->first()}}
                </div>
                @endif


                @yield('content')
            </div>

            <!-- Main Footer -->
            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 3.1.0
                </div>
                <strong>Copyright &copy; 2025 Pashughar 2024, Designed & Developer By <a href="https://webmingo.in">Web Mingo</a>.</strong> All rights
                reserved.
            </footer>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <!-- <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script> -->
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

        @stack('after-script')
        <script>
            $(document).ready( function () {
                $('.select2').each(function() {
                    $(this).select2({
                        placeholder: 'Select an option',
                        allowClear: true
                    });
                });
                $('#categoriesTable').DataTable({
                    autoWidth: false,
                    order: [0, "ASC"],
                    processing: true,
                    serverSide: false,
                    searchDelay: 2000,
                    paging: true,
                   "initComplete": function(settings, json){
                        $('#categoriesTable').wrap('<div class="table-responsive"></div>');
                    }
                });
            } );
        </script>

        <script type="text/javascript">
            $('.summernote').summernote({
                placeholder: 'Show your writing creativity here...',
                tabsize: 2,
                height: 300,
                callbacks: {
                    onImageUpload: function(files) {
                        // upload image to server and create imgNode...
                        for (let i = 0; i < files.length; i++) {
                            uploadImage(files[i]);
                        }
                    },
                    onImageUploadError: function() {
                        console.log('error');
                    },
                    onMediaDelete: function(target) {
                        deleteImage(target[0].src)
                    }
                }
            });

            const insertImage = (url) => {
                let imgNode = $('<img>').attr('src', url)
                $('#summernote').summernote('insertNode', imgNode[0]);
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            const uploadImage = (file) => {
                let form = new FormData();
                form.append('image', file);

                $.ajax({
                    method: 'POST',
                    url: "{{route('pages.addEditorImage')}}",
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: form,
                    beforeSend: () => {
                        // console.log('beforeSend');
                    },
                    success: function(result) {
                        console.log(result);
                        insertImage(result.url)
                    },
                    error: function(error) {
                        console.log("error", error);
                    }
                });
            }

            const deleteImage = (url) => {
                let form = new FormData();
                form.append('url', url);

                $.ajax({
                    method: 'POST',
                    url: "{{route('pages.deleteEditorImage')}}",
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: form,
                    beforeSend: () => {
                        // console.log('beforeSend');
                    },
                    success: function(result) {
                        toast.info(result.msg)
                    },
                    error: function(error) {
                        console.log("error", error);
                    }
                });
            }
        </script>
    </body>
</x-laravel-ui-adminlte::adminlte-layout>

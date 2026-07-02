@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Sliders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Slider</li>
                    </ol>
                </div>
            </div>
        </section>
       
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="d-grid d-md-flex justify-content-md-end m-3">
                                
                            </div>
                            <div class="card-body">
                                 <form action="{{ route('sliders.update', $slider->id) }}" 
                                      method="POST" 
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                            
                                    @include('sliders.form')
                            
                                    <button type="submit" class="btn btn-primary">
                                        Update Slider
                                    </button>
                                    <a href="{{ route('sliders.index') }}" 
                                       class="btn btn-secondary">Back</a>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    

    

@endsection
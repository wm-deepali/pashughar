@extends('front.layouts.app')

@section('title')
    {{$blog->title}}
@endsection

@section('metatags')
    {!! getDetailsPageMetaTag($blog->meta_title ?? 'Pashughar', $blog->meta_keyword, $blog->meta_description, $blog->canonical) !!}
@endsection

@section('page_name') blog details @endsection

@section('page_asset') blog details @endsection

@push('after-styles')
    <link rel="stylesheet" href="{{asset('front/css/custom/index.css')}}">
@endpush

@section('content')
    @include('front.layouts.includes.single-banner-price')

    <!--=====================================
                Price PART START
    =======================================-->
    <section class="blog-details-part">
        <div class="container">
            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h5>{{ Session::get('success') }}</h5>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <?php    Session::forget('success'); ?>
                    </div>
                @endif
                <div class="col-lg-12 m-auto">
                    <div class="blog-details-title">
                        <h2><a href="#">{{$blog->title}}</a></h2>
                    </div>
                    <ul class="blog-details-meta" style="padding-left:0px">
                        <li>
                            <a href="#">
                                <i class="far fa-user"></i>
                                <p>Pashughar Team</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="far fa-calendar-alt"></i>
                                <p>{{ $blog->created_at ? $blog->created_at->format('Y-m-d') : 'N/A' }}</p>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="far fa-comments"></i>
                                <p>{{count($blog->comments)}} Comment</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="far fa-share-square"></i>
                                <p>0 Share</p>
                            </a>
                        </li>
                    </ul>
                    <div class="blog-details-image">
                        <img src="{{ $blog->banner_image ? url($blog->banner_image) : asset('front/images/no-image.jpg') }}"
                            alt="blog-details">
                    </div>
                    <div class="blog-details-content">
                        <div class="description">
                            <p>{{$blog->short_description}}</p>
                        </div>
                        <div class="sub-content">
                            {!! $blog->detail_content !!}
                        </div>
                    </div>
                    <div class="blog-details-widget">
                        <ul class="tag-list">
                            <li>
                                <h4>Tags:</h4>
                            </li>
                            <li><a href="#">Afar Logistics</a></li>
                            <li><a href="#">Live Cattle Stocks</a></li>
                            <li><a href="#">Free Listing</a></li>
                        </ul>
                        <ul class="share-list">
                            <li>
                                <h4>Share:</h4>
                            </li>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-behance"></i></a></li>
                            <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                        </ul>
                    </div>
                    <div class="blog-details-author">
                        <div class="author-intro">
                            <a href="#"><img src="{{asset('front/images/afarlogo.png')}}" alt="author"></a>
                            <h4><a href="#">Afar Team</a></h4>
                            <p><a href="#">https://afaraltmart.com</a></p>
                        </div>
                        <div class="author-content">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                            </ul>
                            <p>{{$blog->short_description}}</p>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($blogs as $blogshow)
                            <div class="col-md-6 col-lg-6">
                                <div class="blog-card">
                                    <div class="blog-img">
                                        <img src="{{ $blog->thumb_image ? url($blog->thumb_image) : asset('front/images/no-image.jpg') }}"
                                            alt="blog">
                                        <div class="blog-overlay">
                                            <span class="advertise">advertise</span>
                                        </div>
                                    </div>
                                    <div class="blog-content">
                                        <a href="#" class="blog-avatar">
                                            <img src="{{asset('front/images/favicona.png')}}" alt="avatar">
                                        </a>
                                        <ul class="blog-meta">
                                            <li>
                                                <i class="fas fa-user"></i>
                                                <p><a href="#">Afar Team</a></p>
                                            </li>
                                            <li>
                                                <i class="fas fa-clock"></i>
                                                <p>{{ $blogshow->created_at ? $blogshow->created_at->format('Y-m-d') : 'N/A' }}
                                                </p>
                                            </li>
                                        </ul>
                                        <div class="blog-text">
                                            <h4><a href='{{route('blogs.show', $blogshow->slug)}}'>{{$blogshow->title}}</a></h4>
                                            <p>{{ \Illuminate\Support\Str::limit($blogshow->short_description, 150) }}</p>
                                        </div>
                                        <a href="{{route('blogs.show', $blogshow->slug)}}" class="blog-read">
                                            <span>read more</span>
                                            <i class="fas fa-long-arrow-alt-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-lg-12">
                            <div class="blog-details-navigate">
                                <a href="#">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                    <span>Previous Post</span>
                                </a>
                                <a href="#">
                                    <span>Next Post</span>
                                    <i class="fas fa-long-arrow-alt-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="blog-details-comment">
                        <div class="comment-title">
                            <h3>Comments ({{count($blog->comments)}})</h3>
                        </div>
                        <ul class="comment-list">
                            {{-- <li>
                                <div class="comment">
                                    <div class="comment-author">
                                        <a href="#"><img src="{{asset('front/images/afarlogo.png')}}" alt="comment"></a>
                                        <button class="btn btn-inline">
                                            <i class="fas fa-reply-all"></i>
                                            <span>reply</span>
                                        </button>
                                    </div>
                                    <div class="comment-content">
                                        <h4>
                                            <a href="#">MironMahmud</a>
                                            <span>02 February 2020</span>
                                        </h4>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero ab aperiam corrupti
                                            maiores animi nisi ratione maxime quae in doloremque corporis tempore earum ut
                                            voluptas exercitationem.</p>
                                    </div>
                                </div>
                                <ul>
                                    <li>
                                        <div class="comment">
                                            <div class="comment-author">
                                                <a href="#"><img src="{{asset('front/images/afarlogo.png')}}"
                                                        alt="comment"></a>
                                                <button class="btn btn-inline">
                                                    <i class="fas fa-reply-all"></i>
                                                    <span>reply</span>
                                                </button>
                                            </div>
                                            <div class="comment-content">
                                                <h4>
                                                    <a href="#">LabonnoKhan</a>
                                                    <span>02 February 2020</span>
                                                </h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero ab aperiam
                                                    corrupti maiores animi nisi ratione maxime quae in doloremque corporis
                                                    tempore earum ut voluptas exercitationem.</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li> --}}

                            @foreach($blog->comments as $key => $comment)
                                <li class="comment-item" style="{{ $key >= 5 ? 'display: none;' : '' }}">
                                    <div class="comment">
                                        <div class="comment-author">
                                            <a href="#"><img src="{{ asset('front/images/afarlogo.png') }}" alt="comment"></a>
                                            <button class="btn btn-inline">
                                                <i class="fas fa-reply-all"></i>
                                                <span>reply</span>
                                            </button>
                                        </div>
                                        <div class="comment-content">
                                            <h4>
                                                <a href="#">{{ $comment->name }}</a>
                                                <span>{{ $comment->created_at ? $comment->created_at->format('Y-m-d') : 'N/A' }}</span>
                                            </h4>
                                            <p>{{ $comment->comment }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                            @if(count($blog->comments) > 5)
                                <div class="form-btn price-btn">
                                    <button type="button" id="load-all-comments" class="btn btn-inline">Load All
                                        Comment</button>
                                </div>
                            @endif
                        </ul>
                    </div>
                    <div class="blog-details-form">
                        <div class="form-title">
                            <h3>Leave Your Comment</h3>
                        </div>
                        <form method="post" action="{{ route('comment.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="blog_id" value="{{$blog->id}}">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Your Name"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Your Email"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="comment" placeholder="Your Comment"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-btn price-btn">
                                        <button type="submit" class="btn btn-inline">
                                            <i class="fas fa-tint"></i>
                                            <span>Drop your comment</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--=====================================
                    PRICE PART END
    =======================================-->
@endsection
@push('after-script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.js"></script>
    <script>
        $(".pay_now").on("click", function () {
            Swal.fire({
                title: 'Are you sure?',

                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Subcribe Free'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).attr('subscription_id');

                    $.ajax({
                        asset: '{{asset("free-subscription")}}',
                        method: 'POST',
                        data: { id: id, '_token': "{{csrf_token()}}" },
                        success: function (data) {
                            console.log(data);
                            if (data.success) {
                                Swal.fire(
                                    "Package Purchased Successfully."
                                );
                                setTimeout(function () {
                                    location.reload();
                                }, 100);
                            } else {
                                Swal.fire(
                                    data.msgText
                                );
                            }
                        }
                    });
                }
            })

        });
    </script>

    <script>
        document.getElementById('load-all-comments').addEventListener('click', function () {
            // Find all hidden comments
            const hiddenComments = document.querySelectorAll('.comment-item[style*="display: none;"]');
            console.log(hiddenComments)
            // Show all hidden comments
            hiddenComments.forEach(comment => comment.style.display = '');

            // Optionally hide the "Load All Comments" button
            this.style.display = 'none';
        });
    </script>
@endpush
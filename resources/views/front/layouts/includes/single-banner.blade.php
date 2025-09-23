<!--=====================================
                  SINGLE BANNER PART START
=======================================-->
<style>
    @media (max-width: 575px) {
    .single-banner {
        padding: 15px 0px 81px;
    }
}
</style>
<section class="inner-section single-banner" >
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>@yield('page_name')</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" style="color:#fff" aria-current="page">@yield('page_url')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================
            SINGLE BANNER PART END
=======================================-->
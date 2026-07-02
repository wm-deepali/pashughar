<style>
    .pgh-banner-section {
    margin-top: 10px; /* optional spacing after header */
    height: auto;
    overflow: hidden;
    position: relative;
}

#pghHeroCarousel,
#pghHeroCarousel .carousel-inner,
#pghHeroCarousel .carousel-item,
#pghHeroCarousel .carousel-item img {
    height: auto;
    width: 100%;
}

#pghHeroCarousel .carousel-item img {
    object-fit: cover;          /* images fill area without stretching */
    object-position: center;
}

/* Dots (indicators) styling */
.carousel-indicators {
    bottom: 10px;               /* closer to bottom */
    margin-bottom: 0;
}

.carousel-indicators li {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.7);
    border: 1px solid #fff;
    margin: 0 6px;
    cursor: pointer;
}

.carousel-indicators .active {
    background-color: #fff;
    border-color: #2f855a;      /* your primary color, change if needed */
}

/* Arrows - make them subtle */
.carousel-control-prev,
.carousel-control-next {
    width: 8%;
    opacity: 0.6;
    transition: opacity 0.3s;
}

.carousel-control-prev:hover,
.carousel-control-next:hover {
    opacity: 1;
}

/* Caption (optional text overlay) */
.carousel-caption {
    background: rgba(0, 0, 0, 0.4);
    border-radius: 8px;
    padding: 8px 16px;
    bottom: 30%;
}

.carousel-caption h5 {
    font-size: 1.4rem;
    margin-bottom: 5px;
}

.carousel-caption p {
    font-size: 1rem;
    margin: 0;
}
#pghHeroCarousel .carousel-item {
    background-color: #000; /* white blank remove */
}

#pghHeroCarousel .carousel-item img {
    display: block;
}


/* Mobile adjustments */
@media (max-width: 767px) {
    .carousel-caption {
        display: none !important;   /* hide text on small screens */
    }
    
    .carousel-indicators li {
        width: 8px;
        height: 8px;
    }
}
</style>
@php
$sliders = gethomepageSlider();
@endphp
<!-- Banner Section -->
<section class="pgh-banner-section">
    <div id="pghHeroCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="5000">

        <!-- Indicators (dots) -->
        <ol class="carousel-indicators">
            <li data-target="#pghHeroCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#pghHeroCarousel" data-slide-to="1"></li>
            <li data-target="#pghHeroCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Slides -->
        <div class="carousel-inner">
            
            @foreach($sliders['desktop_sliders'] as $key => $slider)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                
                 <img rel="preload" as="image" src="{{ $slider['image'] }}" alt="{{ $slider['title'] ?? 'Cow Livestock' }}">
                

            </div>
            @endforeach
            
            <!--<div class="carousel-item active">-->
            <!--    <img rel="preload" as="image" src="{{ asset('front/images/pashughar-sellers.png') }}" alt="Cow Livestock">-->
                
                
            <!--</div>-->

            <!--<div class="carousel-item">-->
            <!--    <img rel="preload" as="image" src="{{ asset('front/images/colarge.png') }}" alt="Goat Livestock">-->
                
            <!--</div>-->

            <!--<div class="carousel-item">-->
            <!--    <img class="d-block w-100" src="{{ asset('front/images/pashughar-banner-buyer.png') }}" alt="Poultry">-->
                
            <!--</div>-->
        </div>

    </div>
</section>
<section class="pgh-banner-section-mobile">
    <div id="pghHeroCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="5000">

        <!-- Indicators (dots) -->
        <ol class="carousel-indicators">
            <li data-target="#pghHeroCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#pghHeroCarousel" data-slide-to="1"></li>
            <li data-target="#pghHeroCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Slides -->
        <div class="carousel-inner">
            @foreach($sliders['mobile_sliders'] as $key => $slider)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                
                 <img rel="preload" as="image" src="{{ $slider['image'] }}" alt="{{ $slider['title'] ?? 'Cow Livestock' }}">
                

            </div>
            @endforeach
            
            <!--<div class="carousel-item active">-->
            <!--    <img rel="preload" as="image" src="{{ asset('front/images/pashughar-banner1.png') }}" alt="Cow Livestock">-->
                
                
            <!--</div>-->

            <!--<div class="carousel-item">-->
            <!--    <img rel="preload" as="image" src="{{ asset('front/images/pashughar-banner1.png') }}" alt="Goat Livestock">-->
                
            <!--</div>-->

            <!--<div class="carousel-item">-->
            <!--    <img class="d-block w-100" src="{{ asset('front/images/pashughar-banner2.png') }}" alt="Poultry">-->
                
            <!--</div>-->
        </div>

    </div>
</section>
 <div class="marque-section"style="width:100%;height:40px;background:#397839;padding:0px 10px;display:flex;align-item:center;"><marquee><ul style="color:#fff;display:flex;gap:20px;height:40px;text-align:center;margin:0px;"><li style="display:flex;align-items:center;">* Welcome to Pashughar.com, You can List & View Livestock and Dairy Farm Products.</li><li style="display:flex;align-items:center;"> * Register Today and Get Early Bird Offer</li></ul></marquee></div>
 
<script>
document.addEventListener("DOMContentLoaded", function () {

    const carousel = document.getElementById("pghHeroCarousel");
    const images = carousel.querySelectorAll(".carousel-item img");

    let loaded = 0;

    // Stop carousel until images load
    $('.carousel').carousel('pause');

    images.forEach(img => {
        const loader = new Image();
        loader.src = img.src;

        loader.onload = () => {
            loaded++;

            // start ONLY after all images are fully loaded
            if (loaded === images.length) {
                $('.carousel').carousel({
                    interval: 5000
                });
            }
        };
    });

});
</script>


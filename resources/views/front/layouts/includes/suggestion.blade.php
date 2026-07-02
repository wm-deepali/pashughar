<!--=====================================
            SUGGEST PART START
=======================================-->
<style>
    .bamdik {
        display:flex;
        justify-content:center;
        align-items:center;
    }
    .dandik {
        display:flex;
        justify-content:center;
        align-items:center;
    }
</style>
<section class="suggest-part">
    <div class="container">
        <div class="suggest-slider slider-arrow">
        @if(!empty($suggestCategories) && count($suggestCategories) > 0)
        @foreach($suggestCategories as $category)
            <a class='suggest-card' href="{{route('category-details', $category->slug)}}">
                <img src="{{asset('storage')}}/{{$category->image}}" alt="car">
                <h6>{{$category->name}}</h6>
                <!--<p>({{isset($category->ads) && $category->ads !='' ? $category->ads->where('status', 'Published')->count() : 0}})</p>-->
            </a>
        @endforeach
        @endif  
        
         <a class='suggest-card' href="{{route('category-details', $category->slug)}}">
                <img src="{{ asset('front/images/add-more.png') }}" alt="car">
                <h6> More</h6>
                
            </a>
        </div>
    </div>
</section>

<!--=====================================
            SUGGEST PART END
=======================================-->
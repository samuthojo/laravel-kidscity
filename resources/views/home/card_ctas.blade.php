<section id="cardCtas" style="position: relative;">
    <div class="section-wrapper">
        <div class="row">
            @foreach(\App\FeaturedBanner::banner_list() as $cat)
                <a href="#" class="col-xs-4">
                    <div class="card-cta layout center-center">
                        <div class="image" style="background-image: url({{$cat->image()}});"></div>
                        <h3>BEST SELLERS</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
<div class="section-wrapper">
	<h3 id="featuredTitle" style="margin-bottom: 10px;">Clothing Categories</h3>
	<div class="home-grid">
		<div class="row featured-row">
			@foreach(\App\CategoryBanner::banner_list() as $cat)
				<div class="col-md-4">
					<div class="feature-section-title layout vertical end-justified" style="
							background-image: url({{$cat->image()}});">
						<div class="title-text">
							{{--<h3>{{$cat->name}}</h3>--}}
							{{--<p>Wanna see your handsome champ look mighty fly? Okay then, let's do it.</p>--}}
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</div>

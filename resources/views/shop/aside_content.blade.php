<div class="filter-group">
	<div class="filter-title">
		<h3>Brands</h3>
	</div>
	<div class="filter-options">
		<a href="#" class="option active">
			All
		</a>
		<a href="#" class="option">
			Phillips
		</a>
		<a href="#" class="option">
			Sony G
		</a>
		<a href="#" class="option">
			Gucci
		</a>
	</div>
</div>

<div class="filter-group">
	<div class="filter-title">
		<h3>Category</h3>
	</div>
	<div class="filter-options">
		<?php
			for ($i=0; $i < count($categories) ; $i++) {
				$category_class =
					$i == $category ? 'active' : '';

				$category_link = $i == 0 ? '' : '?category=' . $i;
				$link = "shop.php" . $category_link;

				echo '
					<a href="'.$link.'" class="option '. $category_class .' ">
						'. $categories[$i] .'
					</a>
				';
			}
		?>
	</div>
</div>

<div class="filter-group">
	<div class="filter-title">
		<h3>Gender</h3>
	</div>
	<div class="filter-options">
		<div class="option-wrapper">
			<input type="checkbox" name="" id="group1" value="girls">
			<label for="group1" class="option">
				<i class="fa fa-home"></i>
				Girls
			</label>
		</div>
		<div class="option-wrapper">
			<input type="checkbox" name="" id="group2" value="boys">
			<label for="group2" class="option">
				<i class="fa fa-home"></i>
				Boys
			</label>
		</div>
	</div>
</div>


<div class="filter-group">
	<div class="filter-title">
		<h3>Color</h3>
	</div>
	<div class="filter-options">
		<div class="option-wrapper">
			<input type="checkbox" name="" id="flock1">
			<label for="flock1" class="option">
				<i class="fa fa-home"></i>
				Red
			</label>
		</div>
		<div class="option-wrapper">
			<input type="checkbox" name="" id="flock2">
			<label for="flock2" class="option">
				<i class="fa fa-home"></i>
				Green
			</label>
		</div>
		<div class="option-wrapper">
			<input type="checkbox" name="" id="flock3">
			<label for="flock3" class="option">
				<i class="fa fa-home"></i>
				Blue
			</label>
		</div>
	</div>
</div>

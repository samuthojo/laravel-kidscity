<div id="actionBar" class="layout justified center">
	<div id="productsTitle">
		<h3>Kids Wear</h3>
		<span>Showing products 1 - 12 of 30</span>
	</div>

	<div id="sorter" class="layout center">
		<span>sort by: </span>
		&emsp;
		<select id="sorterInput">
			<option value="value 1">New Arrivals</option>
			<option value="value 2">Most Popular</option>
			<option value="value 3">Price</option>
			<option value="value 3">Top Rated</option>
		</select>
	</div>
</div>
<div id="productsGrid">
	<p style="display: none;">
		No products found.
	</p>
	<div class="row">
		<?php
			for ($i=0; $i < 12; $i++) {
				$name = "Cloth for Boys " . $i;
				$price = round(rand(12000, 30000), -3);
				$image_url = "images/real_cloths/boy". (($i%9) + 1) .".png";
				echo '<div class="col-md-4">';
					include 'includes/templates/shop/product.php';
				echo '</div>';
			}
		?>

		<?php
			for ($i=0; $i < 12; $i++) {
				$name = "Girls dressing " . $i;
				$price = round(rand(12000, 30000), -3);
				$image_url = "images/real_cloths/girl". (($i%9) + 1) .".png";
				echo '<div class="col-md-4">';
					include 'includes/templates/shop/product.php';
				echo '</div>';
			}
		?>
	</div>
</div>
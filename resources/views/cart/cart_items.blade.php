<?php
	for ($i=0; $i < 4; $i++) {
		$name = "Cloth for Boys " . $i;
		$price = round(rand(12000, 30000), -3);
		$image_url = "images/real_cloths/boy". (($i%9) + 1) .".png";

		include 'includes/templates/cart/cart_item.php';
	}
?>
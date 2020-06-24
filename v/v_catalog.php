<main>
	<?php
		if (isset($catalog)) {
			foreach ($catalog as $product) {
				echo '<div class="product"><a href="index.php?c=page&act=product&id=' . $product["id"] . '"><img class="img" src="'. $product["image"] . '" alt="Изображение" title="'. $product["title"] . '"></a>
				<span class="product__title">'. $product["title"] . '</span></div>';
			}
		}
	?>
</main>
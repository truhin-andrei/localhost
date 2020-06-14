<main class="catalog">
	<?php
	if (isset($catalog)) :
		foreach ($catalog as $product) :	?>
			<div class="catalog-item">
				<a href="index.php?c=page&act=product&id=<?= $product["id_good"] ?>">
					<img src='../img/1.jpg' alt="Изображение" height='200'>
					<p><?= $product["name"] ?> </p>
				</a>

			</div>
	<?php endforeach;
	endif;
	?>

</main>
<script>
	window.onload = function() {
		document.getElementById('buy').onclick = function() {
			document.getElementById('buy').style.display = "none";
			document.getElementById('buying_form').style.display = "block";
		};
	}
</script>
<div class="product">
	<h1><span><?= $product["name"] ?></span></h1>
	<img src="../img/1.jpg" height="300" alt="Good" title="<?= $product["name"] ?>" target="_blank">
	<p class="content"><?= $product["description"] ?></p>
	<h3><?= $product["price"] ?> $</h3>
	<?php
	if ($user_id) {
		echo "<button id='buy'>Купить</button>
			<div id='buying_form'>
				<span>Какое количество товара?</span>
				<form method='post' name='buying_form'>
					<input type='number' name='count' required>
					<input type='submit' name='button' value='Добавить в корзину'>
				</form>
			</div>";
	}
	?>
</div>
<?php if (isset($text)) {
	echo "<script>alert('$text')</script>";
} ?>
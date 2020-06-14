<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
	<div id="menu">
		<a href="index.php">Главная</a> |
		<a href="index.php?c=page&act=catalog">Каталог</a> |
		<?php
		if ($user['user_name']) {
			echo '<a href="index.php?c=user&act=info">Личный кабинет</a> | <a href="index.php?c=page&act=basket">Моя корзина</a> | <a href="index.php?c=user&act=logout">Выйти (' . $user['user_name'] . ')</a>';
			if ($user['role']) {
				echo ' | <a href="index.php?c=admin&act=orders">Управление заказами</a>';
			}
		} else {
			echo '<a href="index.php?c=user&act=login">Войти</a> | <a href="index.php?c=user&act=reg">Регистрация</a>';
		}
		?>
	</div>
	<div id="content">
		<?= $content ?>
	</div>
	<div id="footer">
		<p>2020</p>
	</div>
</body>

</html>
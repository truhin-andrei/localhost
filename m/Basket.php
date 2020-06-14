<?php

include_once 'SQL.php';

class Basket extends SQL
{

	public $order_id, $product_id, $user_id, $count, $status;

	public function getBasket($user_id)
	{

		return parent::Select('basket', 'user_id', $user_id, true);
	}

	public function addProduct($product_id, $user_id, $count)
	{

		$object = [
			'product_id' => $product_id,
			'user_id' => $user_id,
			'count' => strip_tags($count)
		];

		$query = 'INSERT INTO basket (id_user, id_good, price, is_in_order, amount) VALUES ( :user_name , :user_login , :user_password )';
		parent::Insert($query, $object, false);

		parent::Insert('basket', $object);
		return 'Товар успешно добавлен в корзину!';
	}
}

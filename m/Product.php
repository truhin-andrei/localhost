<?php

include_once 'SQL.php';

class Product extends SQL
{

	public $product_id, $product_image, $product_title, $product_content, $product_price;

	public function getAllProducts()
	{
		$query = ' SELECT * FROM goods ';
		return parent::Query($query);
	}

	public function getProduct($id_good)
	{
		$query = "SELECT * FROM goods WHERE id_good = :id_good";
		return parent::Query($query, ['id_good' => $id_good]);
	}
}

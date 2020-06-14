<?php
include_once 'm/Product.php';
include_once 'm/Basket.php';

class C_Page extends C_Base
{

	public function action_index()
	{

		$this->title .= ' | Главная';
		$this->content = $this->Template('v/v_index.php', array());
	}

	public function action_catalog()
	{

		$product_object = new Product();
		$catalog = $product_object->getAllProducts();

		$this->title .= ' | Каталог';
		$this->content = $this->Template('v/v_catalog.php', array('catalog' => $catalog));
	}

	public function action_product($id)
	{

		$product_object = new Product();
		$product = $product_object->getProduct($id);
		if (isset($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];
		} else {
			$user_id = false;
		}
		var_dump($product);
		$this->title .= ' | ' . $product['name'];
		$this->content = $this->Template('v/v_product.php', array('product' => $product[0], 'user_id' => $user_id));

		if ($this->isPost()) {
			$new_basket = new Basket();
			$result = $new_basket->addProduct($product['id'], $user_id, $_POST['count']);
			$this->content = $this->Template('v/v_product.php', array('product' => $product, 'user_id' => $user_id, 'text' => $result));
		}
	}

	public function action_basket()
	{

		if (isset($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];
		} else {
			$user_id = false;
		}

		$basket_object = new Basket();
		$basket = $basket_object->getBasket($user_id);

		$this->title .= ' | Корзина заказов';
		$this->content = $this->Template('v/v_basket.php', array('products' => $basket));
	}
}

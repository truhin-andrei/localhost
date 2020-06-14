<?php

include_once 'config/db.php';

class SQL
{

	private static $instance;
	private $db;

	public static function Instance()
	{

		if (self::$instance == null) {
			self::$instance = new SQL();
		}

		return self::$instance;
	}

	public function __construct()
	{

		//setlocale(LC_ALL, 'ru_RU.UTF8');
		$this->db = new PDO(
			DRIVER . ':host=' . SERVER . ';dbname=' . DB,
			USERNAME,
			PASSWORD,
			[
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			]
		);
	}

	public function Query($query, $param = array(), $fetchAll = true)
	{
		$res = $this->db->prepare($query);
		$res->execute($param);

		if ($fetchAll) {
			return $res->fetchAll();
		} else {
			return $res->fetch();
		}
	}
	//"SELECT order_id, product_id, count, title, price FROM basket AS T1 INNER JOIN products AS T2 ON T1.product_id = T2.id WHERE T1.user_id = " . $_SESSION["user_id"]

	public function Insert($query, $param = array())
	{

		$res = $this->db->prepare($query);
		$res->execute($param);

		return $this->db->lastInsertId();
	}

	public function Update($table, $object, $where)
	{

		$sets = array();

		foreach ($object as $key => $value) {

			$sets[] = "$key=:$key";

			if ($value === NULL) {
				$object[$key] = 'NULL';
			}
		}

		$sets_s = implode(',', $sets);
		$query = "UPDATE $table SET $sets_s WHERE $where";

		$res = $this->db->prepare($query);
		$res->execute($object);

		if ($res->errorCode() != PDO::ERR_NONE) {
			$info = $res->errorInfo();
			die($info[2]);
		}

		return $res->rowCount();
	}


	public function Delete($table, $where)
	{

		$query = "DELETE FROM $table WHERE $where";
		$res = $this->db->prepare($query);
		$res->execute();

		if ($res->errorCode() != PDO::ERR_NONE) {
			$info = $res->errorInfo();
			die($info[2]);
		}

		return $res->rowCount();
	}

	public function Password($name, $password)
	{

		return strrev(md5($name)) . md5($password);
	}
}

<?php

include_once 'SQL.php';

class User extends SQL
{

	public $user_id, $user_login, $user_name, $user_password;

	public function getUser($id)
	{
		$query = ' SELECT * FROM user WHERE id_user = :id ';
		return parent::Query($query, ['id' => $id])[0];
	}

	public function newUser($name, $login, $password)
	{

		$object = [
			'user_name' => strip_tags($name),
			'user_login' => strip_tags($login),
			'user_password' => parent::Password(strip_tags($name), strip_tags($password))
		];

		$query = ' SELECT * FROM user WHERE user_login = :user_login ';
		$user = parent::Query($query, ['user_login' => strip_tags($login)])[0];


		if (!$user) {
			$query = 'INSERT INTO user (user_name, user_login, user_password) VALUES ( :user_name , :user_login , :user_password )';
			parent::Insert($query, $object, false);
			return 'Вы успешно зарегистрировались!';
		} else {
			return 'Пользователь с таким логином уже зарегистрирован!';
		}
	}

	public function login($login, $password)
	{
		$query = ' SELECT * FROM user WHERE user_login = :user_login ';

		$user = parent::Query($query, ['user_login' => strip_tags($login)])[0];

		if ($user) {

			if ($user['user_password'] == parent::Password($user['user_name'], strip_tags($password))) {
				$_SESSION['user_id'] = $user['id_user'];
				return 'Добро пожаловать в систему, ' . $user['user_name'] . '!';
			} else {
				return 'Пароль не верный!';
			}
		} else {
			return 'Пользователь с таким логином не зарегистрирован!';
		}
	}

	public function logout()
	{

		if (isset($_SESSION["user_id"])) {
			unset($_SESSION["user_id"]);
			session_destroy();
			return true;
		} else {
			return false;
		}
	}
}

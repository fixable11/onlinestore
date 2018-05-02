<?php

class Users
{

	/**
	 * Метод регистрации нового пользователя
	 * 
	 * @param  string $email   email
	 * @param  string $pwdSHA  пароль
	 * @param  string $name    имя пользователя
	 * @param  string $phone   телефон
	 * @param  string $address адрес пользователя
	 * @return array           массив пользовательских данных
	 */
	public static function registerNewUser($email, $pwdSHA, $name = '', $phone = '', $address = '')
	{
		$email = htmlspecialchars($email);
		$name = htmlspecialchars($name);
		$phone = htmlspecialchars($phone);
		$address = htmlspecialchars($address);
		
		$sql = "INSERT INTO
		users (`email`, `pwd`, `name`, `phone`, `address`)
		VALUES (:email, :pwdSHA, :name, :phone, :address)";

		$query = DB::db_query($sql, ['email' => $email, 'pwdSHA' => $pwdSHA, 'name' => $name,
		'phone' => $phone, 'address' => $address]);

		if($query){
			$sql = "SELECT * FROM `users`
			WHERE (`email` = :email and `pwd` = :pwdSHA)
			LIMIT 1";

			$query = DB::db_query($sql, ['email' => $email, 'pwdSHA' => $pwdSHA]);
			$rs = $query->fetchAll(PDO::FETCH_ASSOC);
			
			if(isset($rs[0])){
				$rs[0]['success'] = 1;
			} else {
				$rs[0]['success'] = 0;
			}

		} else {
			$rs[0]['success'] = 0;
		}

		return $rs;
	}

	/**
	 * Проверка email'а на его наличие в БД
	 * 
	 * @param  string $email email
	 * @return array       	 массив об успехе операции
	 */
	public static function checkUserEmail($email)
	{
		$query = DB::db_query("SELECT id FROM users WHERE email = :email", ['email' => $email]);

		if($query) {
			return $query->fetch(PDO::FETCH_ASSOC);
		} else {
			return null;
		}
	}

	/**
	 * Пользовательская афторизация
	 * 
	 * @param  string $email email(login)
	 * @param  string $pwd   пароль
	 * @return array       	 массив пользовательских данных
	 */
	public static function loginUser($email, $pwd)
	{
		$email = htmlspecialchars($email);
		$pwd = crypt($pwd, '$5$rounds=5000$salt$');

		$sql = "SELECT * FROM `users` 
		WHERE (`email` = :email and `pwd` = :pwd)
		LIMIT 1";

		$query = DB::db_query($sql, ['email' => $email, 'pwd' => $pwd]);
		$rs = $query->fetchAll(PDO::FETCH_ASSOC);

		if(isset($rs[0])){
			$rs[0]['success'] = 1;
		} else {
			$rs[0]['success'] = 0;
		}

		return $rs;
	}

	/**
	 * 
	 * Изменение пользовательских данных
	 * 
	 * @param  string $name    имя пользователя
	 * @param  string $phone   телефон
	 * @param  string $address адрес
	 * @param  string $pwd1    новый пароль
	 * @param  string $pwd2    повтор нового пароля
	 * @param  string $curPwd  текущий пароль
	 * @return boolean         TRUE в случае успеха операции
	 */
	public static function updateUserData($name, $phone, $address, $pwd1, $pwd2, $curPwd)
	{
		$email = htmlspecialchars($_SESSION['user']['email']);
		$name = htmlspecialchars($name);
		$phone = htmlspecialchars($phone);
		$address = htmlspecialchars($address);
		$pwd1 = trim($pwd1);
		$pwd2 = trim($pwd2);

		$newPwd = null;

		if($pwd1 && ($pwd1 == $pwd2)){

			if(strlen($pwd1) < 6 || strlen($pwd2) < 6){
				return [false, 'Новый пароль не должен быть короче 6 символов'];
			}
			if(strlen($pwd1) > 15 || strlen($pwd2) > 15){
				return [false, 'Новый пароль не должен быть больше 15 символов'];
			}

			$newPwd = crypt($pwd1, '$5$rounds=5000$salt$');

		} else {

			if($pwd1 || $pwd2){
				return [false, 'Пароли не совпадают'];
			}

		}

		$sql = "UPDATE `users` SET";

		if($newPwd){
			$sql .= " `pwd` = :newPwd, ";
		}

		$sql .= "`name` = :name,
		`phone` = :phone,
		`address` = :address
		WHERE `email` = :email AND `pwd` = :curPwd
		LIMIT 1";
		
		if($newPwd){
			$rs = DB::db_query($sql, ['newPwd' => $newPwd, 'name' => $name, 
			'phone' => $phone, 'address' => $address,
			'email' => $email, 'curPwd' => $curPwd]);
		} else {
			$rs = DB::db_query($sql, ['name' => $name, 
			'phone' => $phone, 'address' => $address,
			'email' => $email, 'curPwd' => $curPwd]);
		}

		return [$rs,$newPwd];
	}

	/**
	 * Получение текущих пользовательских заказов
	 * 
	 * @return array массив пользовательских заказов
	 */
	public static function getCurUserOrders()
	{
		$userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;
		$rs = Orders::getOrdersWithProductsByUser($userId);

		return $rs;
	}

}
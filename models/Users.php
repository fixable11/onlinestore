<?php

class Users
{

/**
 *	Model for user's table
 * 
 */
	
/**
 * Register new User
 * 
 * @param  string $email  email
 * @param  string $pwdSHA password 
 * @param  string $name   user name
 * @param  string $phone  phone
 * @param  string $address user's address
 * @return array new user data array
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
 * Check email (if there is email in DB)
 * 
 * @param  [type] $email [description]
 * @return [type]        [description]
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
 * User authorization
 * 
 * @param  string $email email(login)
 * @param  string $pwd   password
 * @return array       	 array of user data
 */
public static function loginUser($email, $pwd){
	$email = htmlspecialchars($email);
	$pwd = crypt($pwd, 'salt');

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
 * Change user's data
 * 
 * @param  string $name   user name
 * @param  string $phone  telephone
 * @param  string $address address
 * @param  string $pwd1   new password
 * @param  string $pwd2   repeat new password
 * @param  string $curPwd current password
 * @return boolean        TRUE in case of success
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

		$newPwd = crypt($pwd1, 'salt');
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

public static function getCurUserOrders()
{
	$userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;
	$rs = Orders::getOrdersWithProductsByUser($userId);

	return $rs;
}

}
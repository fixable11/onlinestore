<?php

/**
 * UserController.php (/user/*)
 */
class UserController
{

	/**
	 * Тестовый метод генерации POST запросов
	 */
	public function checkAction()
	{
		$url = 'http://localhost:3000/user/register/';
		$data = array('email' => 'qwe6321', 'pwd1' => '123', 'pwd2' => '123');

		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === FALSE) { echo "error"; }
	}

	/**
	 * Метод регистрации нового пользователя
	 *
	 * @return json Массив об успехе операции регистрации
	 */
	public function registerAction()
	{
		$email = isset($_POST['email']) ? $_POST['email'] : null;
		$email = trim($email);
		$email = htmlspecialchars($email);

		$pwd1 = isset($_POST['pwd1']) ? $_POST['pwd1'] : null;
		$pwd2 = isset($_POST['pwd2']) ? $_POST['pwd2'] : null;

		$phone = isset($_POST['phone']) ? $_POST['phone'] : null;
		$address = isset($_POST['address']) ? $_POST['address'] : null;

		$name = isset($_POST['name']) ? $_POST['name'] : null;
		$name = trim($name);
		$name = htmlspecialchars($name);

		$resData = null;
		$resData = $this->checkRegisterParams($email, $pwd1, $pwd2);

		if(!$resData && Users::checkUserEmail($email)){
			$resData['success'] = false;
			$resData['message'][] = 'Пользователь с таким email ('.$email.') уже зарегистрирован';
		}

		if(!$resData){

			$pwdSHA = crypt($pwd1, '$5$rounds=5000$salt$');
			$userData = Users::registerNewUser($email, $pwdSHA, $name, $phone, $address);
			$userData = $userData[0];

			if($userData['success']){
				$resData['message'][] = 'Пользователь успешно зарегистрирован!';
				$resData['success'] = 1;

				$resData['userName'] = $userData['name'] ?? $userData['email'];

				$_SESSION['user'] = $userData;
				$_SESSION['user']['displayName'] = $userData['name'] ?? $userData['email'];
			} else {
				$resData['success'] = 0;
				$resData['message'][] = 'Ошибка регистрации';
			}
		}

		echo json_encode($resData);

		return true;
	}

	/**
	 * Метод выхода пользователя (logout)
	 * 
	 * @return json Массив об успехе операции выхода (logout)
	 */
	public function logoutAction()
	{
		if(isset($_SESSION['user'])){
			unset($_SESSION['user']);
		//unset($_SESSION['cart']);
			$resData['success'] = 1; 
		} else {
			$resData['success'] = 0; 
		}

		echo json_encode($resData);

		return true;
	}

	/**
	 * Метод пользовательского входа (login)
	 * 
	 * @return json Массив данных об успехе входа (login)
	 */
	public function loginAction()
	{
		$email = isset($_POST['email']) ? $_POST['email'] : null;
		$email = trim($email);

		$pwd = isset($_REQUEST['pwd']) ? $_REQUEST['pwd'] : null;
		$pwd = trim($pwd);

		$userData = Users::loginUser($email, $pwd);

		$userData = $userData[0];

		if($userData['success']){
			
			$_SESSION['user'] = $userData;
			$_SESSION['user']['displayName'] = $userData['name'] ?? $userData['email'];

			$resData = $_SESSION['user'];
			$resData['success'] = 1;
		} else {
			$resData['success'] = 0;
			$resData['message'][] = 'Неверный логин или пароль';
		}

		echo json_encode($resData);
		
		return true;
	}

	/**
	 * Формирование главной страницы пользователя
	 */
	public function indexAction()
	{
		if(!isset($_SESSION['user'])){
			redirect('/');
		}

		$pageTitle = 'Страница пользователя';

		$rsUserOrders = Users::getCurUserOrders();
		
		echo loadTemplate('header', [
			'pageTitle' => $pageTitle,
		]);

		echo loadTemplate('searchAndLogin', [
			'pageTitle' => $pageTitle,
		]);
		
		echo loadTemplate('user', [
			'rsUserOrders' => $rsUserOrders
		]);

		echo loadTemplate('footer', [
			
		]);

		return true;
	}

	/**
	 * Проверка регистрационных данных
	 * 
	 * @param  string $email email
	 * @param  string $pwd1  пароль
	 * @param  string $pwd2  повтор пароля
	 * @return array 				 результат
	 */
	private function checkRegisterParams($email, $pwd1, $pwd2)
	{
		$res = null;

		if(!$email){
			$res['success'] = false;
			$res['message'][] = 'Введите email';
		}

		if(!$pwd1){
			$res['success'] = false;
			$res['message'][] = 'Введите пароль';
		} else{
			if(strlen($pwd1) < 6){
				$res['success'] = false;
				$res['message'][] = 'Пароль должен быть не короче 6 символов';
			}

			if(strlen($pwd1) > 15){
				$res['success'] = false;
				$res['message'][] = 'Пароль должен быть не больше 15 символов';
			}
		}

		if(!$pwd2){
			$res['success'] = false;
			$res['message'][] = 'Введите повтор пароля';
		} else {
			if($pwd1 != $pwd2){
				$res['success'] = false;
				$res['message'][] = 'Пароли не совпадают';
			}
		}

		return $res;
	}

	/**
	 * Обновление пользовательских данных
	 * 
	 * @return json Массив о результате изменения данных
	 */
	public function updateAction()
	{
		if(!isset($_SESSION['user'])){
			redirect('/');
		}

		$resData = array();

		$phone = isset($_POST['phone']) ? $_POST['phone'] : null;
		$address = isset($_REQUEST['address']) ? $_REQUEST['address'] : null;
		$name = isset($_POST['name']) ? $_POST['name'] : null;
		$pwd1 = isset($_POST['pwd1']) ? $_POST['pwd1'] : null;
		$pwd2 = isset($_POST['pwd2']) ? $_POST['pwd2'] : null;
		$curPwd = isset($_POST['curPwd']) ? $_POST['curPwd'] : null;

		$curPwdSHA = crypt($curPwd, '$5$rounds=5000$salt$');

		if(!$curPwd || ($_SESSION['user']['pwd'] != $curPwdSHA)){

			$resData['success'] = 0;
			$resData['message'] = 'Текущий пароль не верный';

			echo json_encode($resData);

			return true;
		}

		$res = Users::updateUserData($name, $phone, $address, $pwd1, $pwd2, $curPwdSHA);
		if($res[1]){
			$curPwdSHA = $res[1];
		}
		if($res[0]){
			$resData['success'] = 1;
			$resData['message'] = 'Данные сохранены';
			$resData['userName'] = $name;

			$_SESSION['user']['name'] = $name;
			$_SESSION['user']['phone'] = $phone;
			$_SESSION['user']['address'] = $address;
			$_SESSION['user']['pwd'] = $curPwdSHA;
			$_SESSION['user']['displayName'] = $name ? $name : $_SESSION['user']['email'];
		} else {
			$resData['success'] = 0;
			$resData['message'] = $res[1] ?? 'Ошибка сохранения данных';
		}

		echo json_encode($resData);

		return true;
	}

}
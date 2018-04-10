<?php


/**
 * AdminController.php (/admin/*)
 */
class AdminController
{

	/**
	 * Тестовая функция генерации POST запроса
	 */
	public function checkAction()
	{
		$url = 'http://localhost:3000/admin/addproduct/';
		$data = array('itemName' => 'newName', 'itemPrice' => '10000', 'itemCatId' => '1');

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

		return true;
	}


	/**
	 * Метод формирования страницы админ панели
	 * 
	 * Метод позволяет добавлять и удалять категории товаров
	 */
	public function indexAction()
	{
		$pageTitle = 'Управление сайтом';

		$rsCategories = Categories::getAllMainCategories();
		$rsSubCats = Categories::getAllCategories();

		echo loadTemplate('header', [
			'pageTitle' => $pageTitle,
		]);

		echo loadTemplate('searchAndLogin', [
			'pageTitle' => $pageTitle,
		]);

		echo loadAdminTemplate('admin', [
			'pageTitle' => 'Добавление категории',
			'rsCategories' => $rsCategories,
			'rsSubCats' => $rsSubCats
		]);

		echo loadTemplate('footer', [

		]);

		return true;
	}

	/**
	 * Метод добавление новой категории
	 * 
	 * @return json Информация об успехе
	 */
	public function addnewcatAction()
	{
		$catName = $_POST['newCategoryName'] ?? null;
		$catParentId = isset($_POST['generalCatId']) ? $_POST['generalCatId'] : null;
		$symlink = $_POST['symlink'] != "" ? $_POST['symlink'] : null;

		// Выдача ошибки при отсутствии имени категории и символической ссылки 
		if(($catName && $symlink) === false){
			echo json_encode(array('message' => 'Ошибка!'));
			return true;
		}

		$res = Categories::insertCat($catName, $catParentId, $symlink);
		if($res){
			$resData['success'] = 1;
			$resData['message'][] = 'Категория добавлена';
			$resData['name'] = $catName;
			$resData['id'] = $res;
		} else {
			$resData['success'] = 0;
			$resData['message'][] = 'Ошибка добавления категории';

			if($symlink !== null){
				$resData['message'][] = ' Символическая ссылка должна быть уникальной';
			}

		}

		echo json_encode($resData);

		return true;
	}

	/**
	 * Метод удаления категории
	 * 
	 * @return json Информация об успехе
	 */
	public function deletecatAction()
	{
		$catId = $_POST['catId'];
		$catName = $_POST['catName'];

		$res = Categories::deleteCat($catId);

		if($res){
			$resData['success'] = 1;
			$resData['message'][] = 'Категория "' . $catName . '" успешно удалена';
			$resData['catId'] = $catId;
		} else {
			$resData['success'] = 0;
			$resData['message'][] = 'Ошибка удаления категории';
		}

		echo json_encode($resData);

		return true;
	}

	/**
	 * Страница админ категорий
	 * 
	 * Метод позволяет изменять родительскую категорию 
	 * 
	 * @return json Информация об успехе
	 */
	public function categoryAction()
	{
		$rsCategories = Categories::getAllCategories();
		$rsMainCategories = Categories::getAllMainCategories();

		$pageTitle = 'Управление сайтом';

		echo loadTemplate('header', [
			'pageTitle' => $pageTitle,

		]);

		echo loadTemplate('searchAndLogin', [
			'pageTitle' => $pageTitle,
		]);

		echo loadAdminTemplate('adminCategory', [
			'rsCategories' => $rsCategories,
			'rsMainCategories' => $rsMainCategories,
			'pageTitle' => 'Смена категории',
		]);

		echo loadTemplate('footer', [

		]);

		return true;
	}

	/**
	 * Страница категорий
	 * 
	 * Метод позволяет изменять родительскую категорию 
	 * 
	 * @return json Информация об успехе
	 */
	public function updatecategoryAction()
	{
		$itemId = $_POST['itemId'];
		$parentId = $_POST['parentId'];
		$newName = $_POST['newName'];

		$res = Categories::updateCategoryData($itemId, $parentId, $newName);

		if($res){
			$resData['success'] = 1;
			$resData['message'] = "Категория успешно обновлена";
		} else {
			$resData['success'] = 0;
			$resData['message'] = 'Ошибка изменения данных категории';
		}

		echo json_encode($resData);

		return true;
	}

	/**
	 * Метод формирования страницы продуктов
	 */
	public function productsAction()
	{
		$rsCategories = Categories::getAllCategories();
		$rsProducts = Products::getProducts();

		$pageTitle = 'Управление сайтом';

		echo loadTemplate('header', [
			'pageTitle' => $pageTitle,
		]);

		echo loadTemplate('searchAndLogin', [
			'pageTitle' => $pageTitle,
		]);

		echo loadAdminTemplate('adminProducts', [
			'rsCategories' => $rsCategories,
			'pageTitle' => 'Добавление товара',
			'rsProducts' => $rsProducts
		]);

		echo loadTemplate('footer', [

		]);

		return true;
	}

	/**
	 * Метод добавления нового продукта
	 * 
	 * @return json Информация об успехе
	 */
	public function addproductAction()
	{
		$itemName = $_POST['itemName'];
		$itemPrice = $_POST['itemPrice'];
		$itemDesc = $_POST['itemDesc'] ?? '';
		$itemCat = $_POST['itemCatId'];

		$res = Products::insertProduct($itemName, $itemPrice, $itemDesc, $itemCat);

		if($res){
			$resData['success'] = 1;
			$resData['message'] = 'Продукт успешно добавлен';
		} else {
			$resData['success'] = 0;
			$resData['message'] = 'Ошибка добавления продукта';
		}

		echo json_encode($resData);

		return true;
	}

	/**
	 * 
	 * Метод обновления названия, цены, категории, описания, статуса продукта
	 * 
	 * @return json Информация об успехе
	 */
	public function updateproductAction()
	{
		$itemId = $_POST['itemId'];
		$itemName = $_POST['itemName'];
		$itemPrice = $_POST['itemPrice'];
		$itemStatus = $_POST['itemStatus'];
		$itemDesc = $_POST['itemDesc'];
		$itemCat = $_POST['itemCatId'];

		$res = Products::updateProduct($itemId, $itemName, $itemPrice,
			$itemStatus, $itemDesc, $itemCat);

		if($res){
			$resData['success'] = 1;
			$resData['message'] = 'Изменения успешно внесены';
		} else {
			$resData['success'] = 0;
			$resData['message'] = 'Ошибка изменения данных';
		}

		echo json_encode($resData);

		return true;
	}

	/**
	 * Метод загрузки изображения
	 * 
	 * @return json Информация об успехе
	 */
	public function uploadAction()
	{
		$maxSize = 2 * 1024 * 1024;
		
		if($_FILES['filename']['size']  > $maxSize){
			$resData['message'] = "Размер файла превышает 2 мегабайта";

			echo json_encode($resData);

			return true;
		}

		$itemId = $_POST['itemId'];
		$ext = pathinfo($_FILES['filename']['name'], PATHINFO_EXTENSION);
		$newFileName = $itemId . '.' . $ext;

		if(is_uploaded_file($_FILES['filename']['tmp_name'])){
			$src =  '/web/img/products/' . $newFileName;
			$res = move_uploaded_file($_FILES['filename']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $src);

			if($res){
				$updated = Products::updateProductImage($itemId, $newFileName);
				$resData['message'] = "Файл успешно добавлен!";	
				$resData['src'] = $src;	

				echo json_encode($resData);

				return true;

			} else {
				$resData['message'] = "Ошибка загрузки данных";	

				echo json_encode($resData);

				return true;
			}
			
		} else {
			$resData['message'] = "Ошибка загрузки данных";	

			echo json_encode($resData);

			return true;
		}	
	}

	/**
	 * Метод формирования страницы заказов пользователей
	 */
	public function ordersAction()
	{
		$rsOrders = Orders::getOrders();

		$pageTitle = 'Управление сайтом';

		echo loadTemplate('header', [
			'pageTitle' => $pageTitle,
		]);

		echo loadTemplate('searchAndLogin', [
			'pageTitle' => $pageTitle,
		]);

		echo loadAdminTemplate('adminOrders', [
			'rsOrders' => $rsOrders,
			'pageTitle' => 'Заказы'
		]);

		echo loadTemplate('footer', [

		]);

		return true;
	}

	/**
	 * Метод смены статуса заказа пользователя
	 * 
	 * @return json Информация об успехе
	 */
	public function setorderstatusAction()
	{
		$itemId = $_POST['itemId'];
		$status = $_POST['status'];

		$res = Orders::updateOrderStatus($itemId, $status);

		if($res){
			$resData['success'] = 1;
		} else {
			$resData['success'] = 0;
			$resData['message'] = 'Ошибка установки статуса';
		}

		echo json_encode($resData);

		return true;
	}

	/**
	 * Установка даты оплаты заказа
	 * 
	 * @return json Информация об успехе
	 */
	public function setorderdatepaymentAction()
	{
		$itemId = $_POST['itemId'];
		$datePayment = $_POST['datePayment'];

		$res = Orders::updateOrderDatePayment($itemId ,$datePayment);

		if($res){
			$resData['success'] = 1;
		} else {
			$resData['success'] = 0;
			$resData['message'] = 'Ошибка установки даты оплаты';
		}

		echo json_encode($resData);

		return true;
	}

}
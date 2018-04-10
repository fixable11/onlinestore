<?php 

/**
 * CartController.php (/cart/*)
 */
class CartController
{

	/**
	 * Метод добавления товаров в корзину
	 *
	 * @param integer $itemId Id продукта, который нужно добавить в корзину
	 * @return json 					Массив об успехе операции добавления
	 */
	public function addtocartAction($itemId)
	{
		$itemId = htmlspecialchars($itemId);
		$itemId = intval($itemId);
		
		if(empty($itemId)) return true;
		$array_search = null;
		$resData = array();

		$key = array_search($itemId, array_column($_SESSION['products'], 'id'));

		if(isset($_SESSION['products']) && $key === false){

			$item = Products::getProductById($itemId);
			$_SESSION['products'][] = $item;
			$_SESSION['cntItems'] = count($_SESSION['products']);

			$resData['cntItems'] = count($_SESSION['products']);
			$resData['success'] = 1;
			$resData['name'] = $item['name'];
			$resData['image'] = $item['image'];
			$resData['price'] = $item['price'];
			$resData['id'] = $item['id'];
			
		} else {
			$resData['success'] = 0;
		}
		
		echo json_encode($resData);

		return true;
	}

	/**
	 * Метод удаления товаров из корзины
	 * 
	 * @param string $itemId ID товара, который нужно удалить
	 * @return json 				 Массив об успехе операции
	 */
	public function removefromcartAction($itemId)
	{

		$itemId = htmlspecialchars($itemId);
		$itemId = intval($itemId);

		if(empty($itemId)) return true;

		$resData = array();
		$key = array_search($itemId, array_column($_SESSION['products'], 'id'));
		
		if($key !== false){
			foreach($_SESSION['products'] as $item => $value){
				if($value['id'] == $itemId) break;
			}

			unset($_SESSION['products'][$item]);
			$_SESSION['cntItems'] = count($_SESSION['products']);
			$resData['cntItems'] = count($_SESSION['products']);
			
			$resData['success'] = 1;
		} else {
			$resData['success'] = 0;
		}

		echo json_encode($resData);

		return true;
	}


	/**
	 * Метод формирования страницы заказа
	 */
	public function orderAction()
	{
		$sesProducts = isset($_SESSION['products']) ? $_SESSION['products'] : array();

		$itemsIds = array();

		foreach($sesProducts as $item){
			$itemsIds[] = $item['id'];
		}

		if(!$itemsIds){
			redirect('/');
			return true;
		}
		
		$itemsCnt = array();
		foreach ($itemsIds as $item) {
			
			$postVar = 'itemCnt_' . $item;
			$itemsCnt[$item] = isset($_POST[$postVar]) ? $_POST[$postVar] : null;
		}

		$rsProducts = Products::getProductsFromArray($itemsIds);

		$i = 0;
		$totalPrice = 0;

		foreach ($rsProducts as &$item) {
			
			$item['cnt'] = isset($itemsCnt[$item['id']]) ? $itemsCnt[$item['id']] : 1;
			if($item['cnt']){
				$item['realPrice'] = $item['cnt'] * $item['price'];
				$totalPrice += $item['realPrice'];
			} else {
				unset($rsProducts[$i]);
			}
			$i++;

		}
		
		if(!$rsProducts){
			echo("Корзина пуста");
			return;
		}

		$_SESSION['saleCart'] = $rsProducts;

		if(!isset($_SESSION['user'])){
			$hideLoginBox = true;
		}

		$pageTitle = 'Заказ';

		$rsCategories = Categories::getAllMainCatsWithChildren();

		$arUser = $_SESSION['user'] ?? null;

		echo loadTemplate('header', [
			'pageTitle' => $pageTitle,
		]);

		echo loadTemplate('searchAndLogin', [
			'pageTitle' => $pageTitle,
		]);

		echo loadTemplate('order', [
			'rsProducts' => $rsProducts,
			'arUser' => $arUser,
			'totalPrice' => $totalPrice
		]);
		
		echo loadTemplate('footer', [
			
		]);
		
		return true;
	}


	/**
	 * Метод сохранения заказа
	 *
	 * @return json Массив данных об успехе операции
	 */
	public function saveorderAction()
	{
		$cart = isset($_SESSION['saleCart'])  ? $_SESSION['saleCart'] : null;

		if(!$cart){
			$resData['success'] = 0;
			$resData['message'] = 'Нет товаров для заказа';

			echo json_encode($resData);
			return true;
		}

		$fio = $_POST['fio'];
		$phone = $_POST['phone'];
		$adress = $_POST['address'];

		$orderId = Orders::makeNewOrder($fio, $phone, $adress);

		if(!$orderId){
			$resData['success'] = 0;
			$resData['message'] = 'Ошибка создания заказа';

			echo json_encode($resData);
			return true;
		}
		$res = Purchase::setPurchaseForOrder($orderId, $cart);
		
		if($res){
			
			$resData['success'] = 1;
			$resData['message'] = 'Заказ сохранен';
			unset($_SESSION['saleCart']);
			unset($_SESSION['cart']);
			unset($_SESSION['products']);
			unset($_SESSION['cntItems']);

		} else {
			$resData['success'] = 0;
			$resData['message'] = 'Ошибка внесения данных для заказа №' . $orderId;
		}

		echo json_encode($resData);

		return true;
	}

}
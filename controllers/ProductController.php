<?php

/**
 * ProductController.php (/product/*)
 */
class ProductController
{

	/**
	 * Формирование страницы продукта
	 *
	 */
	public function indexAction($id) 
	{
		$itemId = $id ?? null;
		if($itemId == null) exit();

		$rsProduct = Products::getProductById($itemId);
		
		$itemInCart = 0;
		if(in_array($itemId, $_SESSION['products'])){
			$itemInCart = 1;
		}

		$pageTitle = 'Страница продукта';

		$cartCntItems = count($_SESSION['products']);

		echo loadTemplate('header', [
			'pageTitle' => $pageTitle,
		]);

		echo loadTemplate('product', [
			'rsProduct' => $rsProduct,
			'itemInCart' => $itemInCart
		]);
		
		echo loadTemplate('footer', [

		]);

		return true;
	}

}
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
		$rsCategory = Categories::getCatById($rsProduct['category_id']);
		$symlink = $rsCategory['symlink'];
		$rsParentCategory = Categories::getCatById($rsCategory['parent_id']);

		$itemInCart = 0;
		if(in_array($itemId, $_SESSION['products'])){
			$itemInCart = 1;
		}

		$pageTitle = 'Страница продукта';

		$cartCntItems = count($_SESSION['products']);

		echo loadTemplate('header', [
			'pageTitle' => $pageTitle,
		]);

		echo loadTemplate('searchAndLogin', [
			'pageTitle' => $pageTitle,
		]);

		echo loadTemplate('product', [
			'rsProduct' => $rsProduct,
			'itemInCart' => $itemInCart,
			'symlink' => $symlink,
			'rsParentCategory' => $rsParentCategory
		]);

		echo loadTemplate('footer', [

		]);

		return true;
	}

}
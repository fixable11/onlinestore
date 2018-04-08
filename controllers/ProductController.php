<?php

/**
 * ProductController.php
 *
 * Controller page of product 
 * 
 */

class ProductController
{


/**
 * Formation page of product
 *
 */
public function indexAction($id) {
	$itemId = $id ?? null;
		if($itemId == null) exit();
	// get product data
	$rsProduct = Products::getProductById($itemId);
	// get all categories
	


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
<?php

/**
 * IndexController.php ('/')
 */
class IndexController
{

	/**
	 * Главная страница сайта
	 * 
	 * @param  string  $price диапазон цены
	 * @param  integer $page  номер страницы
	 */
	public function indexAction($price = null, $page = 1)
	{	
		if($price){
			$price = explode('-', $price);
			$lowPrice = $price[0];
			$highPrice = $price[1];
			$rsProducts = Products::getAllProductsByPrice($page, $lowPrice, $highPrice);
		} else {
			$rsProducts = Products::getAllProducts($page);
		}
		
		$minPrice = Products::getMinPrice();
		$maxPrice = Products::getMaxPrice();
	
		$rsCategories = Categories::getAllMainCatsWithChildren();
	
		$pageTitle = 'Главная страница сайта';

		if($price){
			$total = Products::getTotalProductsByPrice($lowPrice, $highPrice);
		} else {
			$total = Products::getTotalProducts();
		}
		
		$total = $total['count'];
		
		$pagination = new Pagination($total, $page, Products::SHOW_BY_DEFAULT, 'p-');

		echo loadTemplate('header', [
			'pageTitle' => $pageTitle,
		]);
		
		echo loadTemplate('index', [
			'rsProducts' => $rsProducts,
			'rsCategories' => $rsCategories,
			'pagination' => $pagination,
			'minPrice' => $minPrice,
			'maxPrice' => $maxPrice,
			'lowPrice' => $lowPrice ?? null,
			'highPrice' => $highPrice ?? null
		]);

		echo loadTemplate('footer', [

		]);

		return true;
	}

}
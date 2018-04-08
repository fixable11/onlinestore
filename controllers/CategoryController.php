<?php

/**
 * CategoryController.php (/category/*)
 */

class CategoryController
{

	public function indexAction($price = null, $catId = 0, $page = 1)
	{	
		
		$rsCategory = Categories::getCatById($catId);

		//if(($rsCategory['parent_id']) == 0){
		//	$rsChildCats = Categories::getChildrenForCat($catId);
		//} else {
		//	$rsProducts = Products::getProductsByCat($catId);
		//}
		//
		$minPrice = Products::getMinPrice();
		$maxPrice = Products::getMaxPrice();

		if($price){
			$price = explode('-', $price);
			$lowPrice = $price[0];
			$highPrice = $price[1];
			$rsProducts = Products::getProductsByCatByPrice($catId, $page, $lowPrice, $highPrice);
		} else {
			$rsProducts = Products::getProductsByCat($catId, $page);
		}
		
		$rsSubCategories = Products::getSubCatsByParentId($catId);


		$rsCategories = Categories::getAllMainCatsWithChildren();
		
		if($price){
			$total = Products::getTotalProductsInCategoryByPrice($catId, $lowPrice, $highPrice);
		} else {
			$total = Products::getTotalProductsInCategory($catId);
		}

		$total = $total['count'];

		$pagination = new Pagination($total, $page, Products::SHOW_BY_DEFAULT, 'p-');

		$pageTitle = 'Товары категории ' . $rsCategory['name'];

		echo loadTemplate('header', [
			'pageTitle' => $pageTitle,
		]);

		echo loadTemplate('index', [
			'rsProducts' => $rsProducts ?? null,
			'rsCategories' => $rsCategories ?? null,
			'rsCategory' => $rsCategory ?? null,
			'pagination' => $pagination ?? null,
			'rsSubCategories' => $rsSubCategories ?? null,
			'minPrice' => $minPrice,
			'maxPrice' => $maxPrice,
			'lowPrice' => $lowPrice ?? null,
			'highPrice' => $highPrice ?? null
		]);

		echo loadTemplate('footer', [

		]);
		
		return true;
	}

	public function filterAction($price = null, $catId = 0, ...$symlinks)
	{	
		
		$page = $symlinks[count($symlinks) - 1];
		$page = substr($page, 2);
		$page = intval($page);

		$minPrice = Products::getMinPrice();
		$maxPrice = Products::getMaxPrice();

		if(!$page){
			$page = 1;
		}
		
		$subcatsIds = Categories::getIdsBySymLinks($symlinks);
		
		if($price){
			$price = explode('-', $price);
			$lowPrice = $price[0];
			$highPrice = $price[1];
			$rsProducts = Products::getProductsByCatIdsByPrice($lowPrice, $highPrice, $subcatsIds, $page);
		} else {
			$rsProducts = Products::getProductsByCatIds($subcatsIds, $page);
		}

		$rsSubCategories = Products::getSubCatsByParentId($catId);


		$rsCategories = Categories::getAllMainCatsWithChildren();
		

		if($price){
			$total = Products::getTotalProductsByCatIdsByPrice($lowPrice, $highPrice, $subcatsIds);
		} else {
			$total = Products::getTotalProductsByCatIds($subcatsIds);
		}
	
		$total = $total['count'];

		$pagination = new Pagination($total, $page, Products::SHOW_BY_DEFAULT, 'p-');

		$pageTitle = 'Товары категории ' . 'Телефоны';
		echo loadTemplate('header', [
			'pageTitle' => $pageTitle,
		//	'rsCategories' => $rsCategories,
		//'cartCntItems' => $cartCntItems
		]);
		echo loadTemplate('index', [
			'rsProducts' => $rsProducts ?? null,
			'rsCategories' => $rsCategories ?? null,
			'rsCategory' => $rsCategory ?? null,
			'pagination' => $pagination ?? null,
			'rsSubCategories' => $rsSubCategories ?? null,
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
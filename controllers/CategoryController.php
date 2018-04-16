<?php

/**
 * CategoryController.php (/category/*)
 */
class CategoryController
{

	/**
	 * Выборка категории товаров без учета фильтра
	 * 
	 * @param  integer $price диапазон цены
	 * @param  integer $catId id категории
	 * @param  integer $page  номер страницыы
	 */
	public function indexAction($price = null, $catId = 0, $page = 1)
	{	
		$rsCategory = Categories::getCatById($catId);

		$minPrice = Products::getMinPriceByParentId($catId);
		$maxPrice = Products::getMaxPriceByParentId($catId);

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

	/**
	 * Выборка категории товаров с учетом фильтра
	 * 
	 * @param  integer $price диапазон цены
	 * @param  integer $catId id категории
	 * @param  integer $symlinks сиволические ссылка категории по фильтру
	 */
	public function filterAction($price = null, $catId = 0, ...$symlinks)
	{	

		$page = $symlinks[count($symlinks) - 1];

		$page = substr($page, 2);
		$page = intval($page);

		//Если в конце URI содержится p-*, то * станет номером страницы 
		if(!$page){
			//иначе номер страницы будет равен 1
			$page = 1;
		}
		
		$subcatsIds = Categories::getIdsBySymLinks($catId, $symlinks);

		$catIds = array();
		foreach($subcatsIds as $item){
			$catIds[] = $item['id'];
		}

		$minPrice = Products::getMinPrice($catIds);
		$maxPrice = Products::getMaxPrice($catIds);

		if($price){
			$price = explode('-', $price);
			$lowPrice = $price[0];
			$highPrice = $price[1];
			$rsProducts = Products::getProductsByCatIdsByPrice($lowPrice, $highPrice, $subcatsIds, $page);
		} else {
			$rsProducts = Products::getProductsByCatIds($subcatsIds, $page);
		}

		$rsSubCategories = Products::getSubCatsByParentId($catId);
		$rsCategory = Categories::getCatById($catId);
		$rsCategories = Categories::getAllMainCatsWithChildren();
		
		if($price){
			$total = Products::getTotalProductsByCatIdsByPrice($lowPrice, $highPrice, $subcatsIds);
		} else {
			$total = Products::getTotalProductsByCatIds($subcatsIds);
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

}
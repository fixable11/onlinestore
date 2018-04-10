<?php

/**
 * SearchController.php (/search/*)
 */
class SearchController
{

	/**
	 * Формирование страницы поиска
	 */
	public function indexAction()
	{	
		$query = $_GET['query'] ?? null;
		$page = $_GET['p'] ?? null;

		if($page){
			$page = rtrim($page, '/');
			if(!preg_match('~[1-9]+$~', $page)){
				$page = 1;
			}
		} else {
			$page = 1;
		}
		
		$total = null;
		$query = trim($query);
		$query = preg_replace('~/(.*)~', '', $query);
    $query = htmlspecialchars($query);

    $msg = '';

		if(!empty($query)){

			if(strlen($query) < 3){
				$msg = '<div class="searchMsgBox__title">Слишком короткий поисковый запрос.</div>';
			} else if(strlen($query) > 30){
				$msg = '<div class="searchMsgBox__title">Слишком длинный поисковый запрос.</div>';
			} else {

				$result = Categories::searchByTitle($query);
				$trigger = false;
				if(empty($result)){
					$result = Products::searchByTitle($query);
					$trigger = true;	
				}
				
				if(!empty($result)){
					if($trigger){
						$total = Products::getTotalProductsByIds($result);
						$rsProducts = Products::getProductsByIds($result, $page);
					} else {
						$total = Products::getTotalProductsByCatIds($result);
						$rsProducts = Products::getProductsByCatIds($result, $page);
					}
					$amount = count($result);
					$total = $total['count'];
					$msg = '<div class="searchMsgBox__title">По запросу "' .$query. '" найдено совпадений: <span class="searchMsgBox__amount">' .$total. '</span></div>';
				} else {
					$msg = '<div class="searchMsgBox__title">По вашему запросу "' .$query. '" ничего не найдено.</div>';
				}

			}

		} else {
			$msg = '<div class="searchMsgBox__title">Задан пустой поисковый запрос.</div>';
		}

		$pagination = new Pagination($total, $page, Products::SHOW_BY_DEFAULT, '', true);

		$pageTitle = 'Поиск по сайту';

		echo loadTemplate('header', [
			'pageTitle' => $pageTitle,
		]);

		echo loadTemplate('search', [
			'rsProducts' => $rsProducts ?? null,
			'pagination' => $pagination ?? null,
			'msg' => $msg ?? null
		]);

		echo loadTemplate('footer', [

		]);

		return true;
	}

}
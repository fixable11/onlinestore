<?php


/**
 * AboutController.php (/about/*)
 */

class AboutController
{

	/**
	 * Формирование страницы доставка и оплата
	 * 
	 * @return bool Остановка цикла перебора маршрутов при true
	 */
	public function deliveryAction()
	{
		
		$cartCntItems = count($_SESSION['cntItems']);

		$pageTitle = 'Доставка и оплата';

		echo loadTemplate('header', [
			'pageTitle' => $pageTitle,
		]);

		echo loadTemplate('searchAndLogin', [

		]);

		echo loadTemplate('about-delivery', [
			'pageTitle' => $pageTitle,
		]);
		
		echo loadTemplate('footer', [

		]);

		return true;
	}

	/**
	 * Формирование страницы доставка и оплата
	 * 
	 * @return bool Остановка цикла перебора маршрутов при true
	 */
	public function guaranteesAction()
	{

		$pageTitle = 'Гарантии';

		echo loadTemplate('header', [
			'pageTitle' => $pageTitle,
		]);

		echo loadTemplate('searchAndLogin', [
			
		]);

		echo loadTemplate('about-guarantees', [
			'pageTitle' => $pageTitle,
		]);
		
		echo loadTemplate('footer', [

		]);

		return true;
	}

	/**
	 * Формирование страницы доставка и оплата
	 * 
	 * @return bool Остановка цикла перебора маршрутов при true
	 */
	public function contactsAction()
	{

		$pageTitle = 'Контакты';

		echo loadTemplate('header', [
			'pageTitle' => $pageTitle,
		]);

		echo loadTemplate('searchAndLogin', [
			
		]);

		echo loadTemplate('about-contacts', [
			'pageTitle' => $pageTitle,
		]);
		
		echo loadTemplate('footer', [

		]);

		return true;

	}

	public function usAction()
	{

		$pageTitle = 'О нас';

		echo loadTemplate('header', [
			'pageTitle' => $pageTitle,
		]);

		echo loadTemplate('searchAndLogin', [
			
		]);

		echo loadTemplate('about-us', [
			'pageTitle' => $pageTitle,
		]);
		
		echo loadTemplate('footer', [

		]);

		return true;

	}

}
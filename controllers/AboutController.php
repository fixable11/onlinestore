<?php


/**
 * AboutController.php (/about/*)
 */
class AboutController
{

	/**
	 * Формирование страницы доставка и оплата
	 */
	public function deliveryAction()
	{
	
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
	 * Формирование страницы гарантий
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
	 * Формирование страницы контактов
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

	/**
	 * Формирование страницы о нас
	 */
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
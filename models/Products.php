<?php

class Products
{
	
	//Лимит товаров на странице
	const SHOW_BY_DEFAULT = 6;

	/**
	 * Получение продуктов согласно номеру страницы
	 * и категории
	 * 
	 * @param  integer $catId id категории
	 * @param  integer $page  номер страницы
	 * @return array         	массив продуктов
	 */
	public static function getProductsByCat($catId = 0, $page = 1)
	{	
		$catId = intval($catId);

		$lim = self::SHOW_BY_DEFAULT;
		$offset = ($page - 1) * self::SHOW_BY_DEFAULT;

		$sql = 'SELECT products.id, products.category_id, products.name, products.price, products.image, products.status 
		FROM products LEFT JOIN categories ON products.category_id = categories.id 
		WHERE parent_id = :catId 
		AND status = "1"
		LIMIT :lim OFFSET :offset';

		$query = DB::db_query($sql, ['catId' => $catId, 'lim' => $lim, 'offset' => $offset]);

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Получение продуктов в зависимости от их категории и цены
	 * 
	 * @param  integer $catId      id категории
	 * @param  integer $page       номер страницы
	 * @param  integer  $lowPrice  нижний предел цены
	 * @param  integer  $highPrice верхний предел цены
	 * @return array               массив продуктов
	 */
	public static function getProductsByCatByPrice($catId = 0, $page = 1, $lowPrice, $highPrice)
	{	
		$catId = intval($catId);

		$lim = self::SHOW_BY_DEFAULT;
		$offset = ($page - 1) * self::SHOW_BY_DEFAULT;

		$sql = 'SELECT products.id, products.category_id, products.name, products.price, products.image, products.status 
		FROM products LEFT JOIN categories ON products.category_id = categories.id 
		WHERE parent_id = :catId 
		AND price BETWEEN :lowPrice AND :highPrice 
		AND status = 1 
		LIMIT :lim OFFSET :offset';

		$query = DB::db_query($sql, ['catId' => $catId, 'lowPrice' => $lowPrice, 'highPrice' => $highPrice,
		'lim' => $lim, 'offset' => $offset]);

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Получение все продуктов согласно номеру их страницы
	 * 
	 * @param  integer $page номер страницы
	 * @return array         массив продуктов
	 */
	public static function getAllProducts($page = 1)
	{
		$lim = self::SHOW_BY_DEFAULT;
		$offset = ($page - 1) * self::SHOW_BY_DEFAULT;

		$sql = "SELECT *
		FROM `products`
		ORDER BY category_id
		LIMIT :lim OFFSET :offset";

		$query = DB::db_query($sql, ['lim' => $lim, 'offset' => $offset]);

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	
	/**
	 * Получение всех продуктов согласно их цене
	 * 
	 * @param  integer $page      номер страницы
	 * @param  integer $lowPrice  нижний предел цены
	 * @param  integer $highPrice верхний предел цены
	 * @return array              массив продуктов
	 */
	public static function getAllProductsByPrice($page = 1, $lowPrice, $highPrice)
	{
		$lim = self::SHOW_BY_DEFAULT;
		$offset = ($page - 1) * self::SHOW_BY_DEFAULT;

		$sql = "SELECT *
		FROM `products`
		WHERE `price` BETWEEN :lowPrice AND :highPrice
		AND status = '1'
		ORDER BY category_id
		LIMIT :lim OFFSET :offset";

		$query = DB::db_query($sql, ['lim' => $lim, 'offset' => $offset,
		'lowPrice' => $lowPrice, 'highPrice' => $highPrice]);

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Получение наименьшей цены товара согласно определенным категориям
	 *
	 * @param  array $catIds id'шники категорий
	 * @return integer       колонка наибольшей цены
	 */
	public static function getMinPrice($catIds = null)
	{	
		if($catIds){
			$catIds = implode(',', $catIds);
			$sql = 'SELECT products.price FROM products 
			LEFT JOIN categories ON products.category_id = categories.id 
			WHERE categories.id IN ('.$catIds.')
			AND products.status = "1"
			ORDER BY products.price ASC';
			$query = DB::db_query($sql);
		} else {
			$sql = "SELECT `price`
			FROM `products` 
			WHERE `price` = (SELECT MIN(price) FROM `products`)";
			$query = DB::db_query($sql);
		}

		return $query->fetchColumn();
	}
	
	/**
	 * Получение наибольшей цены товара согласно определенным категориям
	 *
	 * @param  array $catIds id'шники категорий
	 * @return integer       колонка наибольшей цены
	 */
	public static function getMaxPrice($catIds = null)
	{	
		if($catIds){
			$catIds = implode(',', $catIds);
			$sql = 'SELECT products.price FROM products 
			LEFT JOIN categories ON products.category_id = categories.id 
			WHERE categories.id IN ('.$catIds.')
			AND products.status = "1"
			ORDER BY products.price DESC';
			$query = DB::db_query($sql);
		} else {
			$sql = "SELECT `price`
			FROM `products` 
			WHERE `price` = (SELECT MAX(price) FROM `products`)";
			$query = DB::db_query($sql);
		}

		return $query->fetchColumn();
	}

	/**
	 * Получение наименьшей цены товара согласно его родительской категории
	 *
	 * @param  integer $catId  id категории
	 * @return integer         колонка наибольшей цены
	 */
	public static function getMinPriceByParentId($catId = null)
	{	
		if($catId){
			$sql = 'SELECT products.price FROM products 
			LEFT JOIN categories ON products.category_id = categories.id 
			WHERE parent_id = :catId
			AND products.status = "1"
			ORDER BY products.price ASC';
			$query = DB::db_query($sql, ['catId' => $catId]);
		} else {
			$sql = "SELECT `price`
			FROM `products` 
			WHERE `price` = (SELECT MIN(price) FROM `products`)";
			$query = DB::db_query($sql);
		}

		return $query->fetchColumn();
	}

	/**
	 * Получение наибольшей цены товара согласно его родительской категории
	 *
	 * @param  integer $catIds id категории
	 * @return integer         колонка наибольшей цены
	 */
	public static function getMaxPriceByParentId($catId = null)
	{	
		if($catId){
			$sql = 'SELECT products.price FROM products 
			LEFT JOIN categories ON products.category_id = categories.id 
			WHERE parent_id = :catId
			AND products.status = "1"
			ORDER BY products.price DESC';
			$query = DB::db_query($sql, ['catId' => $catId]);
		} else {
			$sql = "SELECT `price`
			FROM `products` 
			WHERE `price` = (SELECT MAX(price) FROM `products`)";
			$query = DB::db_query($sql);
		}

		return $query->fetchColumn();
	}

	/**
	 * Получение продукта по его id
	 * 
	 * @param  integer $itemId id продукта
	 * @return array           массив с полями одного продукта
	 */
	public static function getProductById($itemId)
	{
		$itemId = intval($itemId);
		$query = DB::db_query('SELECT * FROM products WHERE id = :itemId', ['itemId' => $itemId]);

		return $query->fetch(PDO::FETCH_ASSOC);
	}
	
	/**
	 * Получение продуктов по id категории
	 * 
	 * @param  integer $itemsId id категории товаров
	 * @return array          	массив продуктов
	 */
	public static function getProductsById($itemsId)
	{
		$itemId = intval($itemId);

		$sql = 'SELECT * FROM products WHERE category_id = :itemsId';
		$query = DB::db_query($sql, ['itemsId' => $itemsId]);

		return $query->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Получение списка всех продуктов из массива id'шников
	 * требуемых товаров
	 * 
	 * @param  array $itemIds array of products ID's
	 * @return array array of products data
	 */
	public static function getProductsFromArray($itemIds)
	{
		$strIds = implode($itemIds, ', ');
		
		$query = DB::db_query('SELECT * FROM products WHERE id in ('.$strIds.')');

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	
	/**
	 * Получение всех продуктов вне зависимости от номера стариницы
	 * 
	 * @return array массив всех продуктов
	 */
	public static function getProducts()
	{
		$sql = "SELECT *
		FROM `products`
		ORDER BY id ASC";

		$query = DB::db_query($sql);

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	
	/**
	 * Получение количества продуктов определенной категории по их id
	 * 
	 * @param  integer $catId id категории
	 * @return integer        количество товаров определенной категории
	 */
	public static function getAmountByCategoryId($catId)
	{
		$sql = 'SELECT COUNT(*) AS amount 
		FROM products 
		WHERE category_id = :catId';

		$query = DB::db_query($sql, ['catId' => $catId]);

		return $query->fetchColumn();
	}
	
	/**
	 * Получение id'шников подкатегорий в зависимости от
	 * id родительской категории
	 * 
	 * @param  integer $catId id родительской категории
	 * @return array         	массив с номерами подкатегорий
	 */
	public static function getSubCatsByParentId($catId)
	{
		$sql = "SELECT *
		FROM `categories`
		WHERE parent_id = :catId";

		$query = DB::db_query($sql, ['catId' => $catId]);

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Получение продуктов в зависимости от id'шников 
	 * подкатегорий
	 * 
	 * @param  integer  $subcatsIds id'шники подкатегорий
	 * @param  integer $page        номер страницы
	 * @return array                массив продуктов
	 */
	public static function getProductsByCatIds($subcatsIds, $page = 1)
	{
		$offset = ($page - 1) * self::SHOW_BY_DEFAULT;
		$lim = self::SHOW_BY_DEFAULT;

		$sql = "SELECT *
		FROM `products`
		WHERE category_id IN (";

		$params = array();
		
		foreach($subcatsIds as $item){
			$params[] = $item['id'];
		}

		$params = implode(', ', $params);

		$sql .= $params . ") AND status ='1'";
		$sql .= " LIMIT " . $lim;
		$sql .= " OFFSET " . $offset;
		
		$query = DB::db_query($sql);

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	
	/**
	 * Получение продуктов в зависимости от id'шников 
	 * подкатегорий и от диапозона их цены
	 * 
	 * @param  integer  $lowPrice   нижний предел цены
	 * @param  integer  $highPrice  верхний предел цены
	 * @param  integer  $subcatsIds id'шники подкатегорий
	 * @param  integer  $page       номер страницы
	 * @return array              	массив продуктов
	 */
	public static function getProductsByCatIdsByPrice($lowPrice, $highPrice, $subcatsIds, $page = 1)
	{
		$offset = ($page - 1) * self::SHOW_BY_DEFAULT;
		$lim = self::SHOW_BY_DEFAULT;

		$sql = "SELECT *
		FROM `products`
		WHERE category_id IN (";

		$params = array();
		
		foreach($subcatsIds as $item){
			$params[] = $item['id'];
		}

		$params = implode(', ', $params);

		$sql .= $params . ") AND price BETWEEN :lowPrice AND :highPrice 
		AND status = 1 LIMIT " . $lim;
		$sql .= " OFFSET " . $offset;
		
		$query = DB::db_query($sql, ['lowPrice' => $lowPrice, 'highPrice' => $highPrice]);

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	
	/**
	 * Получение продуктов по id'шникам подкатегорий
	 * 
	 * @param  integer  $subcatsIds id'шники подкатегорий
	 * @param  integer $page        номер страницы
	 * @return array                массив продуктов
	 */
	public static function getProductsByIds($subcatsIds, $page = 1)
	{
		$offset = ($page - 1) * self::SHOW_BY_DEFAULT;
		$lim = self::SHOW_BY_DEFAULT;

		$sql = "SELECT *
		FROM `products`
		WHERE id IN (";

		$params = array();

		foreach($subcatsIds as $item){
			$params[] = $item['id'];
		}

		$params = implode(', ', $params);

		$sql .= $params . ") AND status ='1'";
		$sql .= " LIMIT " . $lim;
		$sql .= " OFFSET " . $offset;

		$query = DB::db_query($sql);

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Поиск по указанному заголовку
	 * 
	 * @param  string $title значение для поиска
	 * @return array         id'шники найденых товаров
	 */
	public static function searchByTitle($title)
	{
		$title = "%$title%";
		$sql = 'SELECT `id`
		FROM products
		WHERE `name` LIKE :title_1 OR `type` LIKE :title_2';

		$query = DB::db_query($sql, ['title_1' => $title, 'title_2' => $title]);
		$rs = $query->fetchAll(PDO::FETCH_ASSOC);

		return $rs;
	}
	
	/**
	 * Добавление продукта
	 * 
	 * @param  string  $itemName  имя продукта
	 * @param  integer $itemPrice цена продукта
	 * @param  string  $itemDesc  описание продукта
	 * @param  integer $itemCat   id категории
	 * @return integer            количество затронутых строк
	 */
	public static function insertProduct($itemName, $itemPrice, $itemDesc = '', $itemCat)
	{
		$sql = "INSERT INTO products
		SET
		`name` = :itemName,
		`price` = :itemPrice,
		`description` = :itemDesc,
		`category_id` = :itemCat";

		$query = DB::db_query($sql, ['itemName' => $itemName, 'itemPrice' => $itemPrice,
			'itemDesc' => $itemDesc, 'itemCat' => $itemCat]);

		return $query->rowCount();
	}
	
	/**
	 * Обновление данных о продукте
	 *
	 * @param  integer  $itemId      id изменяемого продукта
	 * @param  string   $itemName    имя продукта
	 * @param  integer  $itemPrice   цена продукта
	 * @param  integer  $itemStatus  статус продукта 1 или 0
	 * @param  string   $itemDesc    описание продукта
	 * @param  integer  $itemCat     категори продукта
	 * @param  string   $newFileName имя изображения
	 * @return integer               количество затронутых строк
	 */
	public static function updateProduct($itemId, $itemName, $itemPrice,
		$itemStatus, $itemDesc, $itemCat, $newFileName = null)
	{
		$set = array();

		if($itemName){
			$set[] = "`name` = :itemName";
			$param['itemName'] = $itemName;
		}

		if($itemPrice > 0){
			$set[] = "`price` = :itemPrice";
			$param['itemPrice'] = $itemPrice;
		}

		if($itemStatus !== null){
			$set[] = "`status` = :itemStatus";
			$param['itemStatus'] = $itemStatus;
		}

		if($itemDesc !== null){
			$set[] = "`description` = :itemDesc";
			$param['itemDesc'] = $itemDesc;
		}

		if($itemCat){
			$set[] = "`category_id` = :itemCat";
			$param['itemCat'] = $itemCat;
		}

		if($newFileName){
			$set[] = "`image` = :newFileName";
			$param['newFileName'] = $newFileName;
		}

		$setStr = implode($set, ", ");
		$sql = "UPDATE products
		SET {$setStr}
		WHERE id = :itemId";
		$param['itemId'] = $itemId;

		$query = DB::db_query($sql, $param);
		
		return $query->rowCount();
	}

	/**
	 * Обновление изображения продукта
	 * 
	 * @param  integer $itemId   		id продукта
	 * @param  string $newFileName  имя изображения
	 * @return integer        			количество затронутных строк
	 */
	public static function updateProductImage($itemId, $newFileName)
	{
		$rs = Products::updateProduct($itemId, null, null, null, null, null, $newFileName);

		return $rs;
	}

	/**
	 * Получение списка продуктов по id категории
	 * 
	 * @param  integer $catId id категории
	 * @param  integer $page  номер страницы
	 * @return array          массив продуктов
	 */
	public static function getProductsListByCategory($catId = null, $page = 1)
	{
		if($catId){
			$page = intval($page);
			$offset = ($page - 1) * self::SHOW_BY_DEFAULT;

			$products = array();

			$sql = "SELECT * FROM `products` WHERE status = '1' AND `category_id` = :catId
							ORDER BY id ASC
							LIMIT ".self::SHOW_BY_DEFAULT
							." OFFSET :offset";
			
			$query = DB::db_query($sql, ['catId' => $catId, 'offset' => $offset]);
			$rs = $query->fetchAll(PDO::FETCH_ASSOC);

			return $rs;
		}
	}
	
	/**
	 * Получение количества товаров в зависимости от категории
	 *
 	 * @param  integer $catId 		 id категории
	 * @return integer 						 количество товаров
	 */
	public static function getTotalProductsInCategory($catId)
	{
		$sql = 'SELECT COUNT(*) AS count FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE parent_id = :catId AND status ="1"';

		$query = DB::db_query($sql, ['catId' => $catId]);

		return $query->fetch(PDO::FETCH_ASSOC);
	}
	
	/**
	 * Получение количества товаров в зависимости от id категории
	 * и от диапозона цены
	 *
 	 * @param  integer $catId 		 id категории
	 * @param  integer $lowPrice   нижний предел цены
	 * @param  integer $highPrice  верхний предел цены
	 * @return integer 						 количество товаров
	 */
	public static function getTotalProductsInCategoryByPrice($catId, $lowPrice, $highPrice)
	{
		$sql = 'SELECT COUNT(*) AS count FROM products 
		LEFT JOIN categories ON products.category_id = categories.id 
		WHERE parent_id = :catId 
		AND price BETWEEN :lowPrice AND :highPrice 
		AND status = 1';

		$query = DB::db_query($sql, ['catId' => $catId, 'lowPrice' => $lowPrice, 'highPrice' => $highPrice]);

		return $query->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Получение количества товаров в зависимости от id'шников 
	 * подкатегорий 
	 *
	 * @param  integer $subcatsIds id'шники подкатегорий
	 * @return integer 						 количество товаров
	 */
	public static function getTotalProductsByCatIds($subcatsIds)
	{
		$params = array();
		foreach($subcatsIds as $item){
			$params[] = $item['id'];
		}
		$sql = "SELECT COUNT(*) AS count FROM products 
		WHERE category_id IN (";
		$sql .= implode(', ', $params);
		$sql .= ") AND status ='1'";

		$query = DB::db_query($sql);

		return $query->fetch(PDO::FETCH_ASSOC);
	}
	
	/**
	 * Получение количества товаров в зависимости от id'шников 
	 * подкатегорий и от диапозона цены
	 *
	 * @param  integer $lowPrice   нижний предел цены
	 * @param  integer $highPrice  верхний предел цены
	 * @param  integer $subcatsIds id'шники подкатегорий
	 * @return integer             количество товаров
	 */
	public static function getTotalProductsByCatIdsByPrice($lowPrice, $highPrice, $subcatsIds)
	{
		$params = array();
		foreach($subcatsIds as $item){
			$params[] = $item['id'];
		}
		$sql = "SELECT COUNT(*) AS count FROM products 
		WHERE category_id IN (";
		$sql .= implode(', ', $params);
		$sql .= ") AND price BETWEEN :lowPrice AND :highPrice AND status = 1";

		$query = DB::db_query($sql, ['lowPrice' => $lowPrice, 'highPrice' => $highPrice ]);

		return $query->fetch(PDO::FETCH_ASSOC);
	}
	
	/**
	 * Получение общего количества товаров по id'шникам
	 * 
	 * @param  integer $Ids id'шники товаров
	 * @return integer 			количество товаров
	 */
	public static function getTotalProductsByIds($Ids)
	{
		$params = array();
		foreach($Ids as $item){
			$params[] = $item['id'];
		}
		$sql = "SELECT COUNT(*) AS count FROM products 
		WHERE id IN (";
		$sql .= implode(', ', $params);
		$sql .= ") AND status ='1'";

		$query = DB::db_query($sql);

		return $query->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Получение общего количества товаров
	 * 
	 * @return integer количество товаров
	 */
	public static function getTotalProducts()
	{
		$sql = 'SELECT COUNT(*) AS count FROM products WHERE `status` = 1';

		$query = DB::db_query($sql);

		return $query->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Получение количества товаров в зависимости от диапозона цены
	 * 
	 * @param  integer $lowPrice  нижний предел цены
	 * @param  integer $highPrice верхний предел цены
	 * @return integer            количество товаров
	 */
	public static function getTotalProductsByPrice($lowPrice, $highPrice)
	{
		$sql = 'SELECT COUNT(*) AS count FROM products 
						WHERE `price` BETWEEN :lowPrice AND :highPrice 
						AND `status` = 1';

		$query = DB::db_query($sql, ['lowPrice' => $lowPrice, 'highPrice' => $highPrice]);

		return $query->fetch(PDO::FETCH_ASSOC);
	}


}
<?php

class Products
{

	const SHOW_BY_DEFAULT = 3;


/**
 * Get last added products
 * 
 * @param  iteger $limit - products limit
 * @return array - products array
 */
public static function getLastProducts($limit = null)
{
	$sql = 'SELECT * FROM `products` ORDER BY `id` DESC';
	if($limit){
		$sql .= ' LIMIT :limit';
	}
	
	$query = DB::db_query($sql, ['limit' => $limit]);

	return $query->fetchAll(PDO::FETCH_ASSOC);
}


public static function getProductsByCat ($catId = 0, $page = 1)
{	

	$catId = intval($catId);

	$lim = self::SHOW_BY_DEFAULT;
	$offset = ($page - 1) * self::SHOW_BY_DEFAULT;

	$sql = 'SELECT products.id, products.category_id, products.name, products.price, products.image, products.status FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE parent_id = :catId LIMIT :lim OFFSET :offset';

	$query = DB::db_query($sql, ['catId' => $catId, 'lim' => $lim, 'offset' => $offset]);

	return $query->fetchAll(PDO::FETCH_ASSOC);
}

public static function getProductsByCatByPrice ($catId = 0, $page = 1, $lowPrice, $highPrice)
{	

	$catId = intval($catId);

	$lim = self::SHOW_BY_DEFAULT;
	$offset = ($page - 1) * self::SHOW_BY_DEFAULT;

	$sql = 'SELECT products.id, products.category_id, products.name, products.price, products.image, products.status FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE parent_id = :catId AND price BETWEEN :lowPrice AND :highPrice AND status = 1 LIMIT :lim OFFSET :offset';

	$query = DB::db_query($sql, ['catId' => $catId, 'lowPrice' => $lowPrice, 'highPrice' => $highPrice,
													 'lim' => $lim, 'offset' => $offset]);

	return $query->fetchAll(PDO::FETCH_ASSOC);
}



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

public static function getAllProductsByPrice($page = 1, $lowPrice, $highPrice)
{

	$lim = self::SHOW_BY_DEFAULT;
	$offset = ($page - 1) * self::SHOW_BY_DEFAULT;

	$sql = "SELECT *
	FROM `products`
	WHERE `price` BETWEEN :lowPrice AND :highPrice
	ORDER BY category_id
	LIMIT :lim OFFSET :offset";

	$query = DB::db_query($sql, ['lim' => $lim, 'offset' => $offset,
														'lowPrice' => $lowPrice, 'highPrice' => $highPrice]);


	return $query->fetchAll(PDO::FETCH_ASSOC);
}


public static function getMinPrice()
{

	
	$sql = "SELECT `price`
	FROM `products` 
	WHERE `price` = (SELECT MIN(price) FROM `products`)";

	$query = DB::db_query($sql);


	return $query->fetchColumn();
}

public static function getMaxPrice()
{

	
	$sql = "SELECT `price`
	FROM `products` 
	WHERE `price` = (SELECT MAX(price) FROM `products`)";

	$query = DB::db_query($sql);


	return $query->fetchColumn();
}

/**
 * [getProductById description]
 * @param  integer $itemId product ID
 * @return array data array of product
 */
public static function getProductById($itemId)
{
	$itemId = intval($itemId);
	$query = DB::db_query('SELECT * FROM products WHERE id = :itemId', ['itemId' => $itemId]);

	return $query->fetch(PDO::FETCH_ASSOC);
}

public static function getProductsById($itemsId)
{
	$itemId = intval($itemId);
	$query = DB::db_query('SELECT * FROM products WHERE category_id = :itemsId', ['itemsId' => $itemsId]);

	return $query->fetch(PDO::FETCH_ASSOC);
}

/**
 * Get list of products from array of ID's
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

public static function getProducts()
{
	$sql = "SELECT *
	FROM `products`
	ORDER BY id ASC";

	$query = DB::db_query($sql);


	return $query->fetchAll(PDO::FETCH_ASSOC);
}

public static function getSubCatsByParentId($catId)
{
	$sql = "SELECT *
	FROM `categories`
	WHERE parent_id = :catId";

	$query = DB::db_query($sql,['catId' => $catId]);


	return $query->fetchAll(PDO::FETCH_ASSOC);
}



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

	$sql .= $params . ") LIMIT " . $lim;
	$sql .= " OFFSET " . $offset;
	
	$query = DB::db_query($sql);


	return $query->fetchAll(PDO::FETCH_ASSOC);
}

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

	$sql .= $params . ") LIMIT " . $lim;
	$sql .= " OFFSET " . $offset;
	
	$query = DB::db_query($sql);


	return $query->fetchAll(PDO::FETCH_ASSOC);
}

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

public static function updateProductImage($itemId, $newFileName)
{
	$rs = Products::updateProduct($itemId, null, null, null, null, null, $newFileName);

	return $rs;
}

public static function getProductsListByCategory($catId = false, $page = 1)
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

public static function getTotalProductsInCategory($catId)
{

	$sql = 'SELECT COUNT(*) AS count FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE parent_id = :catId';

	$query = DB::db_query($sql, ['catId' => $catId]);

	return $query->fetch(PDO::FETCH_ASSOC);
}

public static function getTotalProductsInCategoryByPrice($catId, $lowPrice, $highPrice)
{


	$sql = 'SELECT COUNT(*) AS count FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE parent_id = :catId AND price BETWEEN :lowPrice AND :highPrice AND status = 1';

	$query = DB::db_query($sql, ['catId' => $catId, 'lowPrice' => $lowPrice, 'highPrice' => $highPrice]);

	return $query->fetch(PDO::FETCH_ASSOC);
}

public static function getTotalProductsByCatIds($subcatsIds)
{
	$params = array();
	foreach($subcatsIds as $item){
		$params[] = $item['id'];
	}
	$sql = "SELECT COUNT(*) AS count FROM products WHERE category_id IN (";
	$sql .= implode(', ', $params);
	$sql .= ")";

	
	$query = DB::db_query($sql);

	return $query->fetch(PDO::FETCH_ASSOC);
}

public static function getTotalProductsByCatIdsByPrice($lowPrice, $highPrice, $subcatsIds)
{
	$params = array();
	foreach($subcatsIds as $item){
		$params[] = $item['id'];
	}
	$sql = "SELECT COUNT(*) AS count FROM products WHERE category_id IN (";
	$sql .= implode(', ', $params);
	$sql .= ") AND price BETWEEN :lowPrice AND :highPrice AND status = 1";

	
	$query = DB::db_query($sql, ['lowPrice' => $lowPrice, 'highPrice' => $highPrice ]);

	return $query->fetch(PDO::FETCH_ASSOC);
}

public static function getTotalProductsByIds($Ids)
{
	$params = array();
	foreach($Ids as $item){
		$params[] = $item['id'];
	}
	$sql = "SELECT COUNT(*) AS count FROM products WHERE id IN (";
	$sql .= implode(', ', $params);
	$sql .= ")";

	
	$query = DB::db_query($sql);

	return $query->fetch(PDO::FETCH_ASSOC);
}


public static function getTotalProducts()
{

	$sql = 'SELECT COUNT(*) AS count FROM products WHERE `status` = 1';

	$query = DB::db_query($sql);

	return $query->fetch(PDO::FETCH_ASSOC);
}

public static function getTotalProductsByPrice($lowPrice, $highPrice)
{

	$sql = 'SELECT COUNT(*) AS count FROM products 
					WHERE `price` BETWEEN :lowPrice AND :highPrice AND `status` = 1';

	$query = DB::db_query($sql, ['lowPrice' => $lowPrice, 'highPrice' => $highPrice]);

	return $query->fetch(PDO::FETCH_ASSOC);
}


}
<?php

class Categories
{

	/**
	 * Получение дочерних категорий с помощью id родительской категории
	 * 
	 * @param  integer $catId  id категории
	 * @return array              массив дочерних категорий
	 */
	public static function getChildrenForCat($catId)
	{
		$sql = "SELECT * FROM `categories` WHERE parent_id = :catId";
		$query = DB::db_query($sql, ['catId' => $catId]);

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	* Получение всех главных категорий и их подкатегорий(дочерних категорий)
	* 
	* @return array массив категорий
	* 
	*/
	public static function getAllMainCatsWithChildren()
	{
	    $query = DB::db_query("SELECT * FROM `categories` WHERE parent_id = 0");

	    while($row = $query->fetch(PDO::FETCH_ASSOC)){
	    	$rsChildren = Categories::getChildrenForCat($row['id']);

	    	if($rsChildren){
	    		$row['children'] = $rsChildren;
	    	}
	    	$rsArray[] = $row;

	    }

	    return $rsArray;
	}

	/**
	 * Получение данных категории по id
	 * 
	 * @param  integer $catID id категории
	 * @return array          строка определенной категории
	 */
	public static function getCatById($catId)
	{
		$catId = intval($catId);
		$query = DB::db_query("SELECT * FROM categories WHERE id = :catId", ['catId' => $catId]);

		return $query->fetch(PDO::FETCH_ASSOC);
	}

	/**
	 * Получение id товаров по их символическим ссылкам
	 * 
	 * @param  array $symlinks массив символических ссылок
	 * @return array           массив id'шников товаров
	 */
	public static function getIdsBySymLinks(...$symlinks)
	{
		$sql = "SELECT id
		FROM `categories`
		WHERE symlink IN ('";

		$params = implode("', '" ,$symlinks[0]);
		$params .= "')";
		$sql .= $params;

		$query = DB::db_query($sql);

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Получение всех гланых категорий (не включая дочерние)
	 * 
	 * @return array массив главных категорий
	 */
	public static function getAllMainCategories()
	{
		$sql = 'SELECT * FROM categories WHERE parent_id = 0';

		$query = DB::db_query($sql);
		$rs = $query->fetchAll(PDO::FETCH_ASSOC);

		return $rs;
	}

	/**
	 * [insertCat description]
	 * 
	 * @param  string  $catName     имя добавляемой категории
	 * @param  integer $catParentId id родительской категории
	 * @param  string  $symlink     символическая ссылка категории
	 * @return integer              id новой категории
	 */
	public static function insertCat($catName, $catParentId = 0, $symlink)
	{	
		$sql = "INSERT INTO 
		categories (`parent_id`, `name`, `symlink`)
		VALUES (:catParentId, :catName, :symlink)";

		$query = DB::db_query($sql, 
		['catParentId' => $catParentId, 
		'catName' => $catName, 
		'symlink' => $symlink]);

		return $query->lastInsertId();
	}

	/**
	 * Метод удаления категории
	 * 
	 * @param  integer $catId id категории
	 * @return integer        число затронутых строк
	 */
	public static function deleteCat($catId)
	{	
		$sql = "DELETE FROM
		categories WHERE `id` = :catId 
		LIMIT 1";

		$query = DB::db_query($sql, ['catId' => $catId]);
		
		return $query->rowCount();
	}

	/**
	 * Получение всех категорий
	 * 
	 * @return array массив всех категорий
	 */
	public static function getAllCategories()
	{
		$sql = 'SELECT *
		FROM categories
		ORDER BY parent_id ASC';

		$query = DB::db_query($sql);

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Метод обновления категорий
	 * 
	 * @param  integer $itemId   id категории
	 * @param  integer $parentId id родительской категории
	 * @param  string  $newName  имя новой категории
	 * @return boolean           TRUE в случае успешного обновления           
	 */
	public static function updateCategoryData($itemId, $parentId = -1, $newName = '')
	{
		$set = array();
		$param = array();

		if($newName){
			$set[] = "`name` = :newName";
			$param['newName'] = $newName;
		}

		if($parentId >= 0){
			$set[] = "`parent_id` = :parentId";
			$param['parentId'] = $parentId;
		}

		$setStr = implode($set, ", ");
		$sql = "UPDATE categories
		SET {$setStr}
		WHERE id = :itemId";

		$param['itemId'] = $itemId;

		$query = DB::db_query($sql, $param);

		return $query;
	}

	/**
	 * Поиск по определенному заголовку
	 * 
	 * @param  string $title ключевое слово для поиска
	 * @return array         массив категорий искомых товаров
	 */
	public static function searchByTitle($title)
	{
		$title = "%$title%";
		$sql = 'SELECT `id`
		FROM categories
		WHERE `name` LIKE :title_1 OR `symlink` LIKE :title_2';

		$query = DB::db_query($sql, ['title_1' => $title, 'title_2' => $title]);

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

}
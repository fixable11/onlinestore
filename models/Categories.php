<?php

class Categories
{

	const SHOW_BY_DEFAULT = 3;
/**
 * Get children categories for $catId
 * @param  integer $catId - ID of category
 * @return array - array of children categories
 */

public static function getChildrenForCat($catId)
{
	$query = DB::db_query("SELECT * FROM `categories` WHERE parent_id = :catId", ['catId' => $catId]);
	return $query->fetchAll(PDO::FETCH_ASSOC);
}


/**
* Get main categories with children ones
* 
* @return array - array of categories
* 
*/

public static function getAllMainCatsWithChildren()
{
    $query = DB::db_query("SELECT * FROM `categories` WHERE parent_id = 0");
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
    	$rsChildren = self::getChildrenForCat($row['id']);

    	if($rsChildren){
    		$row['children'] = $rsChildren;
    	}
    	$rsArray[] = $row;
    }
    return $rsArray;
}

/**
 * Get categories data by id
 * 
 * @param  integer $catID category ID
 * @return array - string of the category
 */
public static function getCatById($catId)
{
	$catId = intval($catId);
	$query = DB::db_query("SELECT * FROM categories WHERE id = :catId", ['catId' => $catId]);

	return $query->fetch(PDO::FETCH_ASSOC);

}


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
 * Get all main categories (categories that are not child)
 * @return [type] [description]
 */
public static function getAllMainCategories()
{
	$sql = 'SELECT * FROM categories WHERE parent_id = 0';

	$query = DB::db_query($sql);

	$rs = $query->fetchAll(PDO::FETCH_ASSOC);

	return $rs;
}



/**
 * Add new category
 * @param  string  $catName     Category name
 * @param  integer $catParentId ID of the parent category
 * @return integer 							id of the new category
 */
public static function insertCat($catName, $catParentId = 0, $symlink)
{	
	if(!empty($symlink)){
		$sql = 'SELECT * FROM `categories` WHERE symlink = :symlink';
		$query = DB::db_query($sql, ['symlink' => $symlink]);
		
		if(!empty($query->fetch(PDO::FETCH_ASSOC))){
			return false;
		}
	}
	$sql = "INSERT INTO 
					categories (`parent_id`, `name`, `symlink`)
					VALUES (:catParentId, :catName, :symlink)";
	$query = DB::db_query($sql, ['catParentId' => $catParentId, 
													 'catName' => $catName,
													 'symlink' => $symlink]);
	$query = DB::db_query("SELECT LAST_INSERT_ID()");
	$id = $query->fetchColumn();
	return $id;
}


public static function deleteCat($catId)
{	

	$sql = "DELETE FROM
					categories WHERE `id` = :catId LIMIT 1";
	$query = DB::db_query($sql, ['catId' => $catId]);
	
	$rs = $query->rowCount();
	return $rs;
}


/**
 * Get all categories
 * 
 * @return array array of categories
 */
public static function getAllCategories()
{
	$sql = 'SELECT *
					FROM categories
					ORDER BY parent_id ASC';

	$query = DB::db_query($sql);

	$rs = $query->fetchAll(PDO::FETCH_ASSOC);
	return $rs;
}

/**
 * 
 * Update categories
 * 
 * @param  integer  $itemId  category ID
 * @param  integer $parentId ID of the main category
 * @param  string  $newName  New category name
 * @return [type]            
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

	$rs = $query;

	return $rs;
}

public static function searchByTitle($title)
{
	$title = "%$title%";
	$sql = 'SELECT `id`
	FROM categories
	WHERE `name` LIKE :title_1 OR `symlink` LIKE :title_2';

	$query = DB::db_query($sql, ['title_1' => $title, 'title_2' => $title]);

	$rs = $query->fetchAll(PDO::FETCH_ASSOC);
	return $rs;

}


}
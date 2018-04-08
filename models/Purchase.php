<?php

class Purchase
{

/**
 * inclusion in DB products which are tied to the order
 * 
 * @param integer $orderId order ID
 * @param array $cart array of the busket 
 * @return boolean TRUE in case of successful addition
 */
public static function setPurchaseForOrder($orderId, $cart)
{

	$sql = "INSERT INTO purchase
					(order_id, product_id, price, amount)
					VALUES ";
	$values = array();
	$param = array();
	$i = 0;
	foreach($cart as $item){

		$values[] = "(:orderId_{$i}, :itemId_{$i}, :itemPrice_{$i}, :itemCnt_{$i})";
		$param['orderId_'.$i] = $orderId;
		$param['itemId_'.$i] = $item['id'];
		$param['itemPrice_'.$i] = $item['price'];
		$param['itemCnt_'.$i] = $item['cnt'];
	
		$i++;

	}

	$sql .= implode(', ', $values);		

	

	$query = DB::db_query($sql, $param);
	
	return $query;
}

public static function getPurchaseForOrder($orderId)
{

	$sql = "SELECT `pe`.*, `ps`.name
					FROM purchase as `pe` 
					JOIN products as `ps` ON `pe`.product_id = `ps`.id
					WHERE `pe`.order_id = :orderId";

	$rs = DB::db_query($sql, ['orderId' => $orderId]);
	return $rs->fetchAll(PDO::FETCH_ASSOC);
}

}
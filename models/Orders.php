<?php

class Orders{

	/**
	 * Creating order
	 * 
	 * @param  string $name   
	 * @param  string $phone  
	 * @param  string $address
	 * @return interger ID of the created order
	 */

	public static function makeNewOrder($fio, $phone, $address)
	{
		$userId = $_SESSION['user']['id'];
		$comment = "id пользователя: {$userId} <br>
								ФИО: {$fio} <br>
								Телефон: {$phone} <br>
								Адрес: {$address}";
		$dateCreated = date('Y.m.d H:i:s');
		$userIp = $_SERVER['REMOTE_ADDR'];

		$sql = "INSERT INTO
						`orders` (`user_id`, `date_created`, `date_payment`,
											`status`, `comment`, `user_ip`)
						VALUES (:userId, :dateCreated, null,
										'0', :comment, :userIp)";
		
		$rs = DB::db_query($sql, ['userId' => $userId, 'dateCreated' => $dateCreated, 
										'comment' => $comment, 'userIp' => $userIp]);
		if($rs){
			$sql = "SELECT id
							FROM orders
							ORDER BY id DESC
							LIMIT 1";
			$query = DB::db_query($sql);
			$rs = $query->fetchAll(PDO::FETCH_ASSOC);

			if(isset($rs[0])){
				return $rs[0]['id'];
			}
		}

		return false;
	}

	public static function getOrdersWithProductsByUser($userId)
	{
		$userId = intval($userId);
		$sql = "SELECT * FROM orders 
						WHERE `user_id` = :userId
						ORDER BY id DESC";

		$query = DB::db_query($sql, ['userId' => $userId]);
		$rs = array();
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$rsChildren = Purchase::getPurchaseForOrder($row['id']);

			if($rsChildren){
				$row['children'] = $rsChildren;
				$rs[] = $row;
			}
		}
		

		return $rs;
	}

	public static function getOrders()
	{
		$sql = "SELECT o.*, u.name, u.email, u.phone, u.address
						FROM orders AS `o`
						LEFT JOIN users AS `u` ON o.user_id = u.id
						ORDER BY id DESC";
		$query = DB::db_query($sql);

		$rs = array();
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			$rsChildren = Orders::getProductsForOrder($row['id']);

			if($rsChildren){
				$row['children'] = $rsChildren;
				$rs[] = $row;
			}
		}
		return $rs;
	}

	public static function getProductsForOrder($orderId)
	{
		$sql = "SELECT *
						FROM purchase AS pe
						LEFT JOIN products AS ps
						ON pe.product_id = ps.id
						WHERE (`order_id` = :orderId)";
	  $query = DB::db_query($sql, ['orderId' => $orderId]);

	  return $query->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function updateOrderStatus($itemId, $status)
	{
		$status = intval($status);
		$sql = "UPDATE orders 
						SET `status` = :status
						WHERE id = :itemId";
		$query = DB::db_query($sql, ['status' => $status, 'itemId' => $itemId]);

		return $query->rowCount();
	}

	public static function updateOrderDatePayment($itemId, $datePayment)
	{
		$sql = "UPDATE orders
						SET `date_payment` = :datePayment
						WHERE id = :itemId";

		$query = DB::db_query($sql, ['datePayment' => $datePayment, 'itemId' => $itemId]);

		return $query->rowCount();
	}

}
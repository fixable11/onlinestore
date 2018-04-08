<section class="cartBox">
	<div class="cartBoxWrap">
		<div class="container">
			<h1 class="cartBox__title"><?=$pageTitle?></h1>
			<? if(!isset($rsProducts)): ?>
				<div class="cartBox__empty">В корзине пусто</div>
			<? else: ?>
				<form class="cartBox__form" action="/cart/order/" method="POST">
					<h3 class="cartBox__subtitle">Данные заказа</h3>
					<table class="cartBox__table">
						<tr class="cartBox__tr">
							<td class="cartBox__td">№</td>
							<td class="cartBox__td">Наименование</td>
							<td class="cartBox__td">Количество</td>
							<td class="cartBox__td">Цена зза единицу</td>
							<td class="cartBox__td">Цена</td>
							<td class="cartBox__td">Дейсвие</td>	
						</tr>
						<? foreach($rsProducts as $item):  static $count = 1;?>
							<tr>
								<td class="cartBox__td"><?=$count++;?></td>
								<td class="cartBox__td"><a href="/product/<?=$item['id']?>/"><?=$item['name']?></a></td>
								<td class="cartBox__td"><input type="text" name="itemCnt_<?=$item['id']?>" id="itemCnt_<?=$item['id']?>" value="1" data-id='<?=$item['id']?>' class="itemCnt"></td>
								<td class="cartBox__td"><span id="itemPrice_<?=$item['id']?>" class='itemPrice' value="<?=$item['price']?>" data-id="<?=$item['id']?>"><?=$item['price']?></span></td>
								<td class="cartBox__td"><span id="itemRealPrice_<?=$item['id']?>" class='itemRealPrice'><?=$item['price']?></span></td>
								<td class="cartBox__td">
									<a href="#" id="removeCart_<?=$item['id']?>" class="removeFromCart" data-id='<?=$item['id']?>'>Удалить из корзины</a>
									<a href="#" id="addCart_<?=$item['id']?>" class='addToCart hideme' data-id='<?=$item['id']?>'>Восстановить</a>
								</td>
							</tr>
						<? endforeach; ?>
					</table>
					<input class="cartBox__submit" type="submit" value="Оформить заказ">
				</form>
			<? endif; ?>
		</div>
	</div>
</section>
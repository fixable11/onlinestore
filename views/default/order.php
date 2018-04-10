<section class="orders">
	<div class="ordersWrap">
		<div class="container">
			<h2 class="orders__title">Оформление заказа</h2>
			<div class="orders__products">
				<div class="orders__productsTitleWrap">		
					<h3 class="orders__productsTitle">Товары в заказе</h3>
				</div>
				<? foreach ($rsProducts as $item): static $count = 1; ?>
					<div class="orders__productsItem orderItem">
						<div class="orderItem__left">		
							<a href="/product/<?=$item['id']?>/" class="orderItem__imgWrap">
								<img src="/web/img/products/<?=$item['image']?>" alt="product" class="orderItem__img">
							</a>
							<a href="/product/<?=$item['id']?>/" class="orderItem__title"><?=$item['name']?></a>
						</div>
						<div class="orderItem__right">		
							<div class="orderItem__priceBlock">
								<div class="orderItem__priceTitle">Цена</div>
								<div class="orderItem__price"><?=$item['price'];?> грн</div>
							</div>
							<div class="orderItem__amountBlock">
								<div class="orderItem__amountTitle">Количество</div>
								<div class="orderItem__amount"><?=$item['cnt'];?> шт</div>						
							</div>
							<div class="orderItem__totalBlock">
								<div class="orderItem__totalTitle">Сумма</div>
								<div class="orderItem__total"><?=$item['realPrice'];?> грн</div>
							</div>
						</div>
					</div>
				<? endforeach; ?>

				<div class="orders__totalBlock">
					<div class="orders__totalLeft">
						<? if (isset($arUser)): ?>
							<h3 class="orders__userTitle">Данные заказчика</h3>
							<div class="orders__infoBox" >
								<table class="orders__infoTable infoTable">
									<tr class="infoTable__tr">
										<td class="infoTable__td infoTable__td-first">ФИО</td>
										<td class="infoTable__td infoTable__td-last"><input type="text" name="fio" class="infoTable__input infoTable__fio" value="<?=$arUser['name'];?>"></td>
									</tr>
									<tr class="infoTable__tr"> 
										<td class="infoTable__td infoTable__td-first">Телефон</td>
										<td class="infoTable__td infoTable__td-last"><input type="text" name="phone" class="infoTable__input infoTable__phone" value="<?=$arUser['phone'];?>"></td>
									</tr>
									<tr class="infoTable__tr">
										<td class="infoTable__td infoTable__td-first">Адрес</td>
										<td class="infoTable__td infoTable__td-last"><textarea name="address" class="infoTable__textarea infoTable__address"><?=$arUser['address'];?></textarea></td>
									</tr>
								</table>
							</div>
						<? else: ?>
							<div class="orders__autho">Прежде чем оформить заказ вам необходимо <a href="#" class="orders__register">зарегистрироваться</a> или <a href="#" class="orders__login">авторизироваться</a></div>
						<? endif; ?>
					</div>
					<div class="orders__totalRight">
						<div class="orders__total">Итого: <strong class="orders__totalStr"><?=$totalPrice?> грн</strong></div>
						<? if (isset($arUser)): ?>
							<button class="orders__pay">Оформить заказ</button>
						<? else: ?>	
							<button class="orders__pay orders__pay-inactive">Оформить заказ</button>
						<? endif; ?>
					</div>
				</div>
				

			</div>
		</div>
	</section>
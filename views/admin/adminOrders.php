<section class="adminOrders">
	<div class="adminOrdersWrap">
		<div class="container">		
			<h1 class="adminOrders__title"><?=$pageTitle?></h1>
			<ul class="adminOrders__nav">
				<li class="adminOrders__navTitle">Меню:</li>
				<li class="adminOrders__navItem">
					<a href="/admin/" class="adminOrders__navLink">Главная</a>
				</li>
				<li class="adminOrders__navItem">
					<a href="/admin/category/" class="adminOrders__navLink">Категории</a>
				</li>
				<li class="adminOrders__navItem">
					<a href="/admin/products/" class="adminOrders__navLink">Товар</a>
				</li>
				<li class="adminOrders__navItem">
					<a href="/admin/orders/" class="adminOrders__navLink">Заказы</a>
				</li>
			</ul>
			<? if(!isset($rsOrders)): ?>
				<div class="adminOrders__text">Нет заказов</div>
			<? else: ?>
				<div class="adminOrders__tableWrap">
					<table class="adminOrders__table">
						<tr class="adminOrders__tr">
							<td class="adminOrders__td">№</td>
							<td class="adminOrders__td">Действие</td>
							<td class="adminOrders__td">ID заказа</td>
							<td class="adminOrders__td">Статус</td>
							<td class="adminOrders__td">Дата создания</td>
							<td class="adminOrders__td">Дата оплаты</td>
							<td class="adminOrders__td">Дополнительная информация</td>
							<td class="adminOrders__td">Дата изменения заказа</td>
						</tr>
						<? foreach($rsOrders as $item): static $i = 0; ?>
							<tr class="adminOrders__tr">
								<td class="adminOrders__td"><?=$i++?></td>
								<td class="adminOrders__td"><button class="adminOrders__showBtn" data-id="<?=$item['id']?>">Показать товар заказа</button></td>
								<td class="adminOrders__td"><?=$item['id']?></td>
								<td class="adminOrders__td">
									<label class="adminOrders__label">
										<input type="checkbox" class="adminOrders__checkbox" data-id="<?=$item['id']?>" <?if($item['status']):?> checked <?endif;?> >
										<span class="adminOrders__mark"></span>
									</label>
									<div class="adminOrders__checkboxSubtext">Закрыт</div>
									
								</td>
								<td class="adminOrders__td"><?=$item['date_created']?></td>
								<td class="adminOrders__td">
									<input type="text" class="adminOrders__input adminOrders__inputDate" data-id="<?=$item['id']?>" value="<?=$item['date_payment']?>">
									<button class="adminOrders__btn adminOrders__btnDate" data-id="<?=$item['id']?>" >Сохранить</button>
								</td>
								<td class="adminOrders__td"><?=$item['comment']?></td>
								<td class="adminOrders__td"><?=$item['date_modification']?></td>
							</tr>
							<tr class="adminOrders__td adminOrders__td-none" data-id="<?=$item['id']?>">
								<td colspan="8">
									<? if($item['children']): ?>
										<table class="adminOrders__table adminOrders__table-subtable">
											<tr class="adminOrders__tr adminOrders__tr-subtr">
												<td class="adminOrders__td adminOrders__td-subleft adminOrders__td-f">№</td>
												<td class="adminOrders__td adminOrders__td-subtd adminOrders__td-f">ID</td>
												<td class="adminOrders__td adminOrders__td-subtd adminOrders__td-f">Название</td>
												<td class="adminOrders__td adminOrders__td-subtd adminOrders__td-f">Цена</td>
												<td class="adminOrders__td adminOrders__td-subright adminOrders__td-f">Количество</td>
											</tr>
											<? foreach($item['children'] as $itemChild): static $c = 0; ?>
												<tr class="adminOrders__tr adminOrders__tr-subtr">
													<td class="adminOrders__td adminOrders__td-subleft"><?=$c++?></td>
													<td class="adminOrders__td adminOrders__td-subtd"><?=$itemChild['id']?></td>
													<td class="adminOrders__td adminOrders__td-subtd"><a href="/product/<?=$itemChild['id']?>/"><?=$itemChild['name']?></a></td>
													<td class="adminOrders__td adminOrders__td-subtd"><?=$itemChild['price']?></td>
													<td class="adminOrders__td adminOrders__td-subright"><?=$itemChild['amount']?></td>
												</tr>
											<? endforeach; ?>
										</table>
									<? endif; ?>
								</td>
							</tr>
						<? endforeach; ?>
					</table>
				</div>
			<? endif; ?>
		</div>
	</div>
</section>
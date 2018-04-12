<? if(isset($_SESSION['user'])):
$arUser = $_SESSION['user'];
endif; ?>
<section class="userBox">
	<div class="userBoxWrap">
		<div class="container">
			<h1 class="userBox__title">Ваши регистрационные данные:</h1>
			<div class="userBox__tableCont">
				<table class="userBox__table">
					<tr class="userBox__tr">
						<td class="userBox__td">Логин (email)</td>
						<td class="userBox__td"><?=$arUser['email']?></td>
					</tr>
					<tr class="userBox__tr">
						<td class="userBox__td">Имя</td>
						<td class="userBox__td"><input type="text" name="name" class="userBox__input" value="<?=$arUser['name']?>"></td>
					</tr>
					<tr class="userBox__tr">
						<td class="userBox__td">Телефон</td>
						<td class="userBox__td"><input type="text" name="phone" class="userBox__input" value="<?=$arUser['phone']?>"></td>
					</tr>
					<tr class="userBox__tr">
						<td class="userBox__td">Адрес</td>
						<td class="userBox__td"><textarea name="address" class="userBox__textarea" cols="30" rows="10"><?=$arUser['address'];?></textarea></td>
					</tr>
					<tr class="userBox__tr">
						<td class="userBox__td">Новый пароль</td>
						<td class="userBox__td"><input name="pwd2" type="password" class="userBox__input" value=""></td>
					</tr>
					<tr class="userBox__tr">
						<td class="userBox__td">Повтор пароля</td>
						<td class="userBox__td"><input name="pwd1" type="password" class="userBox__input" value=""></td>
					</tr>
					<tr class="userBox__tr">
						<td class="userBox__td">Для того чтобы сохранить данные введите текущий пароль</td>
						<td class="userBox__td"><input name="curPwd" type="password" class="userBox__input" value=""></td>
					</tr>
					<tr class="userBox__tr">
						<td class="userBox__td"><button class="userBox__logout">Выйти</button></td>
						<td class="userBox__td"><input type="button" value="Сохранить изменения" class="userBox__save"></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</section>
<section class="userOrderBox">
	<div class="userOrderBoxWrap">
		<div class="container">
			<h2 class="userOrderBox__title">Заказы:</h2>
			<? if (!isset($rsUserOrders)): ?>
				<h3 class="userOrderBox__subtitle">Нет заказов</h3>
			<? else: ?>
				<div class="userOrderBox__tableWrap">
					<table class="userOrderBox__table">
						<tr class="userOrderBox__td">
							<td class="userOrderBox__td">№</td>
							<td class="userOrderBox__td">Действие</td>
							<td class="userOrderBox__td">ID заказа</td>
							<td class="userOrderBox__td">Статус заказа</td>
							<td class="userOrderBox__td">Дата создания</td>
							<td class="userOrderBox__td">Дата оплаты</td>
							<td class="userOrderBox__td">Дополнительная информация</td>
						</tr>
						<? foreach ($rsUserOrders as $item): static $i = 0;?>
							<tr class="userOrderBox__td">
								<td class="userOrderBox__td"><?=$i++?></td>
								<td class="userOrderBox__td"><button class="userOrderBox__showBtn" data-id="<?=$item['id']?>">Показать товар заказа</button></td>
								<td class="userOrderBox__td"><?=$item['id']?></td>
								<td class="userOrderBox__td"><?=$item['status']?></td>
								<td class="userOrderBox__td"><?=$item['date_created']?></td>
								<td class="userOrderBox__td"><?=$item['date_payment']?></td>
								<td class="userOrderBox__td"><?=$item['comment']?></td>
							</tr>
							<tr class="userOrderBox__tr userOrderBox__tr-none" data-id="<?=$item['id']?>">
								<td colspan='7'>
									<? if($item['children']): ?>
										<table class="userOrderBox__table userOrderBox__table-subtable">
											<tr class="userOrderBox__tr">
												<td class="userOrderBox__td userOrderBox__td-subleft userOrderBox__td-f">№</td>
												<td class="userOrderBox__td userOrderBox__td-subtd userOrderBox__td-f">ID</td>
												<td class="userOrderBox__td userOrderBox__td-subtd userOrderBox__td-f">Название</td>
												<td class="userOrderBox__td userOrderBox__td-subtd userOrderBox__td-f">Цена</td>
												<td class="userOrderBox__td  userOrderBox__td-subright userOrderBox__td-f">Количество</td>
											</tr>
											<? $c = 1; ?>
											<? foreach($item['children'] as $itemChild):  ?>
												<tr class="userOrderBox__tr">
													<td class="userOrderBox__td userOrderBox__td-subleft"><?=$c++;?></td>
													<td class="userOrderBox__td userOrderBox__td-subtd"><?=$itemChild['id']?></td>
													<td class="userOrderBox__td userOrderBox__td-subtd"><a href="/product/<?=$itemChild['id']?>"><?=$itemChild['name']?></a></td>
													<td class="userOrderBox__td userOrderBox__td-subtd"><?=$itemChild['price']?></td>
													<td class="userOrderBox__td userOrderBox__td-subright"><?=$itemChild['amount']?></td>
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
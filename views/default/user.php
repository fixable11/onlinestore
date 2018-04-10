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
			<? if (!$rsUserOrders): ?>
				Нет заказов
			<? else: ?>
				<table>
					<tr>
						<th>№</th>
						<th>Действие</th>
						<th>Действие</th>
						<th>ID заказа</th>
						<th>Дата создания</th>
						<th>Дата оплаты</th>
						<th>Дополнительная информация</th>
					</tr>
					<? foreach ($rsUserOrders as $item): static $i = 0;?>
						<tr>
							<td><?=$i++?></td>
							<td><a href="#" id="showProducts" data-id="<?=$item['id']?>">Показать товар заказа</a></td>
							<td><?=$item['id']?></td>
							<td><?=$item['status']?></td>
							<td><?=$item['date_created']?></td>
							<td><?=$item['date_payment']?></td>
							<td><?=$item['comment']?></td>
						</tr>
						<tr class="hideme" id="purchasesForOrderId_<?=$item['id']?>">
							<td colspan='7'>
								<? if($item['children']): ?>
									<table>
										<tr>
											<th>№</th>
											<th>ID</th>
											<th>Название</th>
											<th>Цена</th>
											<th>Количество</th>
										</tr>
										<? foreach($item['children'] as $itemChild): static $i = 0; ?>
											<tr>
												<td><?=$i++?></td>
												<td><?=$itemChild['id']?></td>
												<td><a href="/product/<?=$itemChild['id']?>"><?=$itemChild['name']?></a></td>
												<td><?=$itemChild['price']?></td>
												<td><?=$itemChild['amount']?></td>
											</tr>
										<? endforeach; ?>
									</table>
								<? endif; ?>
							</td>
						</tr>
					<? endforeach; ?>
				</table>
			<? endif; ?>
		</div>
	</div>
</section>
<section class="addProduct">
	<div class="addProductWrap">
		<div class="container">
			<h1 class="changeCategory__title"><?=$pageTitle?></h1>
			<ul class="changeCategory__nav">
				<li class="changeCategory__navTitle">Меню:</li>
				<li class="changeCategory__navItem">
					<a href="/admin/" class="changeCategory__navLink">Главная</a>
				</li>
				<li class="changeCategory__navItem">
					<a href="/admin/category/" class="changeCategory__navLink">Категории</a>
				</li>
				<li class="changeCategory__navItem">
					<a href="/admin/products/" class="changeCategory__navLink">Товар</a>
				</li>
				<li class="newCategory__navItem">
					<a href="/admin/orders/" class="changeCategory__navLink">Заказы</a>
				</li>
			</ul>
			<div class="addProduct__tableWrap">
				<table class="addProduct__table">
					<tr class="addProduct__tr">
						<td class="addProduct__td">Название</td>
						<td class="addProduct__td">Цена</td>
						<td class="addProduct__td">Категория</td>
						<td class="addProduct__td">Описание</td>
						<td class="addProduct__td">Добавить товар</td>
					</tr>

					<tr class="addProduct__tr">
						<td class="addProduct__td">
							<input type="text" value="" class="addProduct__input addProduct__addName">
						</td>
						<td class="addProduct__td">
							<input type="text" value="" class="addProduct__input addProduct__addPrice">
						</td>
						<td class="addProduct__td">
							<select class="addProduct__select addProduct__addSelect">
								<option value="0">Главная категория</option>
								<? foreach($rsCategories as $itemCat): ?>
									<option value="<?=$itemCat['id']?>"><?=$itemCat['name']?></option>
								<? endforeach; ?>
							</select>
						</td>
						<td class="addProduct__td">
							<textarea class="addProduct__textarea addProduct__addDesc"></textarea>
						</td>
						<td class="addProduct__td">
							<button class="addProduct__btn addProduct__addBtn">Добавить</button>
						</td>
					</tr>
				</table>

				<table class="addProduct__table">
					<? foreach($rsProducts as $item): static $i = 0; ?>

						<tr class="addProduct__tr">
							<td class="addProduct__td addProduct__td-name">№</td>
							<td class="addProduct__td addProduct__td-name">ID</td>
							<td class="addProduct__td addProduct__td-name">Название</td>
							<td class="addProduct__td addProduct__td-name">Цена</td>
							<td class="addProduct__td addProduct__td-name">Категория</td>
							<td class="addProduct__td addProduct__td-name">Описание</td>
						</tr>

						<tr class="addProduct__tr">
							<td class="addProduct__td" rowspan="3"><?=$i++?></td>
							<td class="addProduct__td" rowspan="3"><?=$item['id']?></td>
							<td class="addProduct__td">
								<input type="text"  value="<?=$item['name']?>" data-id="<?=$item['id']?>" class="addProduct__input addProduct__inpName">
							</td class="addProduct__td">
							<td class="addProduct__td">
								<input type="text"  value="<?=$item['price']?>" data-id="<?=$item['id']?>" class="addProduct__input addProduct__inpPrice">
							</td>
							<td class="addProduct__td">
								<select class="addProduct__select" data-id="<?=$item['id']?>">
									<option value="0">Главная категория</option>
									<? foreach($rsCategories as $itemCat): ?>
										<option value="<?=$itemCat['id']?>" <? if ($item['category_id'] == $itemCat['id']): ?>selected <? endif; ?> ><?=$itemCat['name']?></option>
									<? endforeach; ?>
								</select>
							</td>
							<td class="addProduct__td">
								<textarea class="addProduct__textarea" data-id="<?=$item['id']?>">
									<?=$item['description']?>
								</textarea>
							</td>
						</tr>

						<tr class="addProduct__tr">
							<td class="addProduct__td addProduct__td-name"></td>
							<td class="addProduct__td addProduct__td-name">Удалить</td>
							<td class="addProduct__td addProduct__td-name" class="addProduct__td">Изображение</td>
							<td class="addProduct__td addProduct__td-name">Сохранить изменения</td>
						</tr>

						<tr class="addProduct__tr">
							<td class="addProduct__td"></td>
							<td class="addProduct__td">
								<label class="addProduct__label">
									<input type="checkbox" class="addProduct__checkbox" data-id="<?=$item['id']?>" class="addProduct__checkbox" <? if($item['status'] == 0): ?> checked="checked" <? endif; ?> >
									<span class="addProduct__mark"></span>
								</label>
							</td>
							<td class="addProduct__td">
								<img data-id="<?=$item['id']?>" src="/web/img/products/<?=$item['image']?>" alt="product_img" class="addProduct__img" height="100" width="auto">
								<form id="<?=$item['id']?>" class="addProduct__uploadForm" method="post" enctype="multipart/form-data">
									<div class="addProduct__fileUpload">
										<label class="addProduct__btn addProduct__chooseFile">
											<div class="addProduct__fileDesc">Выберите файл</div>
											<input type="file" name="filename" data-id="<?=$item['id']?>" class="addProduct__inpFile">
										</label>
									</div>
									<div class="addProduct__filePath">Размер файла не более 2МБ</div>
									<input type="hidden" class="addProduct__inpId" name="itemId" data-id="<?=$item['id']?>" value="<?=$item['id']?>">
									<button type="button" data-id="<?=$item['id']?>" class="addProduct__btn addProduct__submit">Загрузить</button>
								</form>
							</td>
							<td class="addProduct__td">
								<button class="addProduct__btn addProduct__changeBtn" data-id="<?=$item['id']?>" >Сохранить</button>
							</td>
						</tr>
					<? endforeach; ?>

				</table>
			</div>
		</div>
	</div>
</section>
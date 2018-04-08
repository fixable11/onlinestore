<section class="changeCategory">
	<div class="changeCategoryWrap">
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
			<div class="changeCategory__tableWrap">
				<table class="changeCategory__table">
					<tr class="changeCategory__tr">
						<td class="changeCategory__td changeCategory__td-center" colspan="5"><div class="changeCategory__tableTitle">Смена категории</div></td>
					</tr>
					<tr class="changeCategory__tr">
						<td class="changeCategory__td">№</td>
						<td class="changeCategory__td">ID</td>
						<td class="changeCategory__td">Название</td>
						<td class="changeCategory__td">Родительская категория</td>
						<td class="changeCategory__td">Действие</td>
					</tr>
					<? foreach($rsCategories as $item): static $i = 0; ?>
						<tr class="changeCategory__tr">
							<td class="changeCategory__td"><?=$i++?></td>
							<td class="changeCategory__td"><?=$item['id']?></td>
							<td class="changeCategory__td">
								<input type="text" class="changeCategory__input" data-id="<?=$item['id']?>" value="<?=$item['name']?>">
							</td>
							<td class="changeCategory__td">
								<select class="changeCategory__select" data-id="<?=$item['id']?>">
									<option value="0">Главная категория</option>
									<? foreach($rsMainCategories as $mainItem): ?>
										<option value="<?=$mainItem['id']?>" <? if ($item['parent_id'] == $mainItem['id']): ?>selected <? endif; ?> ><?=$mainItem['name']?></option>
									<? endforeach; ?>
								</select>
							</td>
							<td class="changeCategory__td">
								<button class="changeCategory__btn" data-id="<?=$item['id']?>">Сохранить</button>
							</td>
						</tr>
					<? endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</section>

<section class="newCategory">
	<div class="newCategoryWrap">
		<div class="container">
			<h1 class="newCategory__title"><?=$pageTitle?></h1>
			<ul class="newCategory__nav">
				<li class="newCategory__navTitle">Меню:</li>
				<li class="newCategory__navItem">
					<a href="/admin/" class="newCategory__navLink">Главная</a>
				</li>
				<li class="newCategory__navItem">
					<a href="/admin/category/" class="newCategory__navLink">Категории</a>
				</li>
				<li class="newCategory__navItem">
					<a href="/admin/products/" class="newCategory__navLink">Товар</a>
				</li>
				<li class="newCategory__navItem">
					<a href="/admin/orders/" class="newCategory__navLink">Заказы</a>
				</li>
			</ul>
			<div class="newCategory__tableWrap">
			<table class="newCategory__table">
				<tr class="newCategory__tr">
					<td class="newCategory__td newCategory__td-center" colspan="2"><div class="newCategory__tableTitle">Добавление новой категории</div></td>
				</tr>
				<tr class="newCategory__tr">
					<td class="newCategory__td"><div class="newCategory__name">Новая категория*:</div></td>
					<td class="newCategory__td"><input type="text" class="newCategory__input newCategory__inpNew" placeholder="название категории" name="newCategoryName" value=""></td>
				</tr>
				<tr class="newCategory__tr">
					<td class="newCategory__td"><div class="newCategory__name">Являеется подкатегорией для*:</div></td>
					<td class="newCategory__td"><select name="generalCatId" class="newCategory__select newCategory__selectAdd"><
						<option class="newCategory__option" value="0">Главная</option>
						<? foreach($rsCategories as $item): ?>
							<option class="newCategory__option" value="<?=$item['id']?>"><?=$item['name']?></option>
						<? endforeach; ?>
					</select></td>
				</tr>
				<tr class="newCategory__tr">
					<td class="newCategory__td"><div class="newCategory__name">Символическая ссылка*:</div></td>
					<td class="newCategory__td"><input type="text" class="newCategory__input newCategory__inpSym" placeholder="symlink" name="symlink" value=""></td>
				</tr>
				<tr class="newCategory__tr">
					<td class="newCategory__td"></td>
					<td class="newCategory__td"><button type="button" class="newCategory__btn newCategory__add">Добавить категорию</button></td>
				</tr>
				<tr class="newCategory__tr">
					<td class="newCategory__td newCategory__td-center" colspan="2"><div class="newCategory__tableTitle">Удаление категории</div></td>
				</tr>
				<tr class="newCategory__tr">
					<td class="newCategory__td"><div class="newCategory__name">Название категории*:</div></td>
					<td class="newCategory__td">
						<select name="subCatId" class="newCategory__select newCategory__selectDelete"><
						<? foreach($rsSubCats as $item): ?>
							<option class="newCategory__option" value="<?=$item['id']?>"><?=$item['name']?></option>
						<? endforeach; ?>
					</select>
				</td>
				</tr>
				<tr class="newCategory__tr">
					<td class="newCategory__td"></td>
					<td class="newCategory__td"><button type="button" class="newCategory__btn newCategory__delete">Удалить категорию</button></td>
				</tr>
			</table>
			</div>
		</div>
	</div>
</section>

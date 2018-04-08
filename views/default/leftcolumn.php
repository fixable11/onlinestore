<div class="leftColumn">
	<div id="leftMenu">
		<ul class="menuCaption">Меню
			<? foreach ($rsCategories as $item): ?>
				<li>
					<a href="/category/<?=$item['id']?>/"><?=$item['name'];?></a><br>
					<? if (isset($item['children'])):?>
						<? foreach($item['children'] as $itemChild):?>
							--<a href="/category/<?=$itemChild['id']?>/"><?=$itemChild['name'];?></a><br>
						<? endforeach;?>
					<? endif;?>
				</li>
			<? endforeach; ?>
		</ul>
	</div>

	<? global $arUser; if(isset($arUser)): ?>
	<div id="userBox">
		<a href="/user/" id="userLink"><?=$arUser['displayName']?></a><br>
		<a href="/user/logout/" id="logout">Выход</a>
	</div>
<? else: ?>
	<div id="userBox" class="hideme">
		<a href="#" id="userLink"></a><br>
		<a href="/user/logout/" id="logout">Выход</a>
	</div>
	<? if(!isset($hideLoginBox)): ?>
		<div id="loginBox">
			<div class="menuCaption">Авторизация</div>
			<input type="text" id="loginEmail" name="loginEmail" value=""><br>
			<input type="password" name="loginPwd" id="loginPwd" value=""><br>
			<input type="button" name="" value="Войти" id="loginButton">
		</div>

		<div id="registerBox">
			<div class="menuCaption showHidden">Регистрация</div>
			<div id="registerBoxHidden">
				email: <br>
				<input type="text" id="email" name="email" value=""><br>
				пароль: <br>
				<input type="password" id="pwd1" name="pwd1" value=""><br>
				повторите пароль: <br>
				<input type="password" id="pwd2" name="pwd2" value=""><br>
				<input type="button" value="Зарегистрироваться" class="buttonRegister">
			</div>
		</div>
	<? endif;?>

<? endif; ?>

<div class="" style="float: left; margin-left: 40px;">
	<div class="menuCaption">Корзина</div>
	<a href="/cart/">В корзине</a>
	<span id="cartCntItems">
		<? global $cartCntItems; if ($cartCntItems > 0): echo $cartCntItems; else: echo "пусто"; endif;?>
	</span>
</div>
</div>



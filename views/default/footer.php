		<footer class="mainFoot">
			<div class="mainFootWrap">
				<div class="container">
					<div class="row">
						<div class="col-xl-3 col-lg-2 col-md-12 align-self-center">
							<a href="/" class="footerLogo">
								<svg class="footerLogo__img">
									<use xlink:href="/web/img/vectorsprites/fa.svg#logo" />
								</svg>
							</a>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
							<nav class="footerNav">
								<h4 class="footerNav__title">Навигация</h4>
								<ul class="footerNav__wrap">
									<li class="footerNav__item">
										<a href="/" class="footerNav__link">Главная</a>
									</li>
									<li class="footerNav__item">
										<a href="/about/delivery/" class="footerNav__link">Доставка и оплата</a>
									</li>
									<li class="footerNav__item">
										<a href="/about/guarantees/" class="footerNav__link">Гарантии</a>
									</li>
									<li class="footerNav__item">
										<a href="/about/contacts/" class="footerNav__link">Контакты</a>
									</li>
									<li class="footerNav__item">
										<a href="/about/us/" class="footerNav__link">О нас</a>
									</li>
								</ul>
							</nav>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
							<nav class="footerNav">
								<h4 class="footerNav__title">График работы Call-центра</h4>
								<ul class="footerNav__wrap">
									<li class="footerNav__item">
										Пн-Пт: с 09:00 до 20:00 
									</li>
									<li class="footerNav__item">
										Сб: с 10:00 до 18:00
									</li>
									<li class="footerNav__item">
										Вс: с 10:00 до 17:00
									</li>
								</ul>
							</nav>
						</div>
						<div class="col-xl-3 col-lg-3 col-md-12">
							<div class="footerPhone">
								<div class="footerPhone__wrap">
									<svg class="footerPhone__icon">
										<use xlink:href="/web/img/vectorsprites/fa.svg#phone" />
									</svg>
								</div>
								<div class="footerPhone__phone">(098)-886-03-54</div>
							</div>
							<div class="footerSocIcons">
								<ul class="footerSocIcons__wrap">
									<li class="footerSocIcons__item">
										<a href="#" class="footerSocIcons__link">
											<svg class="footerSocIcons__linkIcon">
												<use xlink:href="/web/img/vectorsprites/fa.svg#facebook" />
											</svg>
										</a>
									</li>
									<li class="footerSocIcons__item">
										<a href="#" class="footerSocIcons__link">
											<svg class="footerSocIcons__linkIcon">
												<use xlink:href="/web/img/vectorsprites/fa.svg#facebook" />
											</svg>
										</a>
									</li>
									<li class="footerSocIcons__item">
										<a href="#" class="footerSocIcons__link">
											<svg class="footerSocIcons__linkIcon">
												<use xlink:href="/web/img/vectorsprites/fa.svg#facebook" />
											</svg>
										</a>
									</li>
									<li class="footerSocIcons__item">
										<a href="#" class="footerSocIcons__link">
											<svg class="footerSocIcons__linkIcon">
												<use xlink:href="/web/img/vectorsprites/fa.svg#facebook" />
											</svg>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<div id="overlay">
			<div class="popupRegisterBox">
				<div class="popupRegisterBox__content">		
					<button class="popupRegisterBox__close">
						<svg class="popupRegisterBox__closeImg">
							<use xlink:href="/web/img/vectorsprites/fa.svg#times" />
						</svg>
					</button>
					<h3 class="popupRegisterBox__text">Регистрация</h3>
					<form class="popupRegisterBox__form">		
						<input type="email" name="email" class="popupRegisterBox__login" placeholder="Email" required>
						<input type="password" name="pwd1" class="popupRegisterBox__pwd popupRegisterBox__pwd1" placeholder="Пароль" required>
						<input type="password" name="pwd2" class="popupRegisterBox__pwd popupRegisterBox__pwd2" placeholder="Повторите пароль" required>
						<button type="submit" class="popupRegisterBox__register">Зарегистрироваться</button>
					</form>
					<ul class="popupRegisterBox__message">

					</ul>
					<div class="popupRegisterBox__bot">Уже зарегистрированы?
						<a href="#" class="popupRegisterBox__autho">Войти</a>
					</div>
				</div>
			</div>
			<div class="popupLoginBox">
				<div class="popupLoginBox__content">		
					<button class="popupLoginBox__close">
						<svg class="popupLoginBox__closeImg">
							<use xlink:href="/web/img/vectorsprites/fa.svg#times" />
						</svg>
					</button>
					<h3 class="popupLoginBox__text">Авторизация</h3>
					<form class="popupLoginBox__form">
						<input type="text" name="email" class="popupLoginBox__login" placeholder="Email" required>
						<input type="password" name="pwd" class="popupLoginBox__pwd" placeholder="Пароль" required>
						<button type="submit" class="popupLoginBox__entrance">Войти</button>
					</form>
					<ul class="popupLoginBox__message">

					</ul>
					<div class="popupLoginBox__bot">
						<a href="#" class="popupLoginBox__forget">Забыли пароль?</a> /
						<a href="#" class="popupLoginBox__register">Регистрация</a>
					</div>
				</div>
			</div>
			<div class="popupBasketCart">
				<div class="popupBasketCart__content">		
					<button class="popupBasketCart__close">
						<svg class="popupBasketCart__closeImg">
							<use xlink:href="/web/img/vectorsprites/fa.svg#times" />
						</svg>
					</button>
					<h3 class="popupBasketCart__title">Корзина</h3>
					<form action="/cart/order/" method="POST" class="popupBasketCart__form">
						<div class="popupBasketCart__inner">
							<? if(!empty($_SESSION['cntItems'])): ?>
								<? foreach($_SESSION['products'] as $item): ?>
									<div class="popupBasketCart__item" data-id="<?=$item['id'];?>">
										<a href="/product/<?=$item['id'];?>/" class="popupBasketCart__itemImgWrap">
											<img src="/web/img/products/<?=$item['image']?>" alt="cart_img" class="popupBasketCart__itemImg">
										</a>
										<h4 class="popupBasketCart__itemName"><?=$item['name'];?></h4>
										<div class="popupBasketCart__itemPrice" data-id="<?=$item['id'];?>" data-price="<?=$item['price'];?>"><?=$item['price'];?> грн</div>
										<div class="popupBasketCart__itemAmountBox">
											<button class="popupBasketCart__itemAmountLess" data-id="<?=$item['id'];?>">-</button>
											<div class="popupBasketCart__itemAmountWrap">
												<input type="text" maxlength="2" name="itemCnt_<?=$item['id'];?>" class="popupBasketCart__itemAmount" value="1" data-id="<?=$item['id'];?>"> шт.
											</div>
											<button class="popupBasketCart__itemAmountMore" data-id="<?=$item['id'];?>">+</button>
										</div>
										<div class="popupBasketCart__itemRealPrice" data-id="<?=$item['id'];?>"><?=$item['price'];?> грн</div>
										<button class="popupBasketCart__itemClose">
											<svg class="popupBasketCart__itemCloseImg">
												<use xlink:href="/web/img/vectorsprites/fa.svg#times" />
											</svg>
										</button>	
									</div>
								<? endforeach; ?>
							<? else: ?>
								<h4 class="popupBasketCart__empty">Ваша корзина пуста.</h4>
							<? endif; ?>
						</div>
						<div class="popupBasketCart__buttons">
							<? if(!empty($_SESSION['cntItems'])): ?>
								<a href="#" class="popupBasketCart__cont">Продолжить покупки</a>
								<button type="submit" class="popupBasketCart__checkout">Оформить заказ</button>
							<? endif; ?>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="/web/js/scripts.min.js"></script>
		<script src="/web/js/admin.js"></script>
	</div>
</body>
</html>
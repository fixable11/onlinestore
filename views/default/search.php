<section class="searchAndLogin">
	<div class="container">
		<div class="searchAndLoginBox">
			<div class="searchAndLoginBoxWrap">
				<form class="searchBox searchBox-mod" action="/search/">
					<input type="text" name="query" class="searchBox__search" placeholder="Поиск по сайту">
					<button class="searchBox__btn">
						<svg class="searchBox__btnIcon">
							<use xlink:href="/web/img/vectorsprites/fa.svg#search" />
						</svg>
					</button>
				</form>
				<div class="cartAndLoginBlock">
					<div class="basketCart">
						<div class="basketCart__logo">
							<svg class="basketCart__logoImg">
								<use xlink:href="/web/img/vectorsprites/fa.svg#shopping-cart" />
							</svg>
						</div>
						<div class="basketCart__text">Корзина</div>
						<div class="basketCart__amountWrap">
							<div class="basketCart__amount"><? if(!empty($_SESSION['cntItems'])) echo $_SESSION['cntItems']; else echo '0'; ?></div>
						</div>
					</div>
					<div class="userBlock <? if(!isset($_SESSION['user'])) echo 'd-none' ?>">
						<button class="userBlock__personal">
							<div class="userBlock__logoutText">Личный кабинет</div>
							<svg class="userBlock__logoutImg">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/web/img/vectorsprites/fa.svg#user"></use>
							</svg>
						</button>
						<button class="userBlock__logout">
							<div class="userBlock__logoutText">Выход</div>
							<svg class="userBlock__logoutImg">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/web/img/vectorsprites/fa.svg#user"></use>
							</svg>
						</button>
					</div>
					<div class="registerBlock <? if(isset($_SESSION['user'])) echo 'd-none' ?>">
						<button class="loginBox">
							<div class="loginBox__text">Войти</div>
							<svg class="loginBox__user">
								<use xlink:href="/web/img/vectorsprites/fa.svg#user" />
							</svg>
						</button>
						<button class="registerBox">
							<div class="registerBox__text">Регистрация</div>
							<svg class="registerBox__user">
								<use xlink:href="/web/img/vectorsprites/fa.svg#user" />
							</svg>
						</button>
					</div>	
				</div>	
			</div>		
		</div>
		<div class="searchMsgBox">
			<div class="searchMsgBoxWrap">
				<div class="row">
					<div class="col">
						<?=$msg;?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="search">
	<div class="searchWrap">
		<div class="container">
			<main class="productCartMain">
				<div class="row">
					<? if($rsProducts): ?>
						<? foreach($rsProducts as $item): ?>
							<div class="col-md-4 col-sm-6 col-12">
								<div class="productCart">
											<div class="productCartWrap">
												<a href="/product/<?=$item['id']?>/" class="productCart__imgWrap">
													<img src="/web/img/products/<?=$item['image']?>" alt="cart_img" class="productCart__img" width="200">
												</a>
												<h3 class="productCart__title"><?=$item['name']?></h3>
												<div class="productCart__color">black</div>
												<div class="productCart__price"><?=$item['price']?> грн</div>
												<div class="productCart__botSect">
													<a href="/product/<?=$item['id']?>/" class="productCart__look">Посмотреть</a>
													<button class="productCart__addWrap <? foreach($_SESSION['products'] as $id) if($id['id'] == $item['id']) echo 'productCart__addWrap-active';?>" data-id="<?=$item['id']?>">
														<div class="productCart__addText"></div>
														<svg class="productCart__addBasket">
															<use xlink:href="/web/img/vectorsprites/fa.svg#shopping-cart" />
														</svg>
													</button>
												</div>
											</div>	
										</div>
							</div>
						<? endforeach;?>
					<? endif;?>
				</div>
			</main>
			
		</div>
		<section class="pagination">
			<div class="container">
				<? if(!empty($pagination->total)): ?>
					<div class="paginationBox">
						<div class="paginationBoxWrap paginationBoxWrap-mod">
							<?=$pagination->get();?>
							<ul class="paginationBox__items d-none">
								<li class="paginationBox__item">
									<a href='#' class="paginationBox__leftArrow">
										<svg class="paginationBox__leftArrowIcon">
											<use xlink:href="/web/img/vectorsprites/fa.svg#angle-left" />
										</svg>
									</a>
								</li>
								<li class="paginationBox__item">
									<a href="#" class="paginationBox__link">1</a>
								</li>
								<li class="paginationBox__item">
									<a href="#" class="paginationBox__link">1</a>
								</li>
								<li class="paginationBox__item">
									<a href="#" class="paginationBox__link">1</a>
								</li>
								<li class="paginationBox__item">
									<a href="#" class="paginationBox__link">1</a>
								</li>
								<li class="paginationBox__item">
									<a href="#" class="paginationBox__link">1</a>
								</li>
								<li class="paginationBox__item">
									<a href='#' class="paginationBox__rightArrow">
										<svg class="paginationBox__leftArrowIcon">
											<use xlink:href="/web/img/vectorsprites/fa.svg#angle-right" />
										</svg>
									</a>
								</li>
							</ul>
						</div>
					</div>
				<? endif; ?>
			</div>
		</section>
	</div>
</section>

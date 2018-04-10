<? //if(strrpos($_SERVER['REQUEST_URI'], 'p-') === false):?>
<section class="sliderTop">
	<div class="sliderTopWrap">
		<div class="container">
			<div class="sliderTopOwl owl-carousel owl-theme">
				<div class="sliderTopOwl__item sliderTop__item-1">
					<div class="row">
						<div class="col-md-6 col-sm-12 col offset-md-1">
							<h2 class="sliderTop__title">iPhone 6 32Gb Black</h2>
							<div class="sliderTop__imgWrap">
								<img class="sliderTop__img d-md-none" src="/web/img/phone.png" alt="phone">
							</div>
							<p class="sliderTop__descr">At first, for some time, I was not able to answer him one word; but as he had taken me in his arms I held fast by him, or I should have fallen to the ground.</p>
							<a href="#" class="sliderTop__btn">Buy now</a>
						</div>
					</div>
				</div>
				<div class="sliderTopOwl__item sliderTop__item-1">
					<div class="row">
						<div class="col-md-7 col-sm-12 col offset-md-1">
							<h2 class="sliderTop__title">iPhone 6 32Gb Black</h2>
							<div class="sliderTop__imgWrap">
								<img class="sliderTop__img d-md-none" src="/web/img/phone.png" alt="phone">
							</div>
							<p class="sliderTop__descr">At first, for some time, I was not able to answer him one word; but as he had taken me in his arms I held fast by him, or I should have fallen to the ground.</p>
							<a href="#" class="sliderTop__btn">Buy now</a>
						</div>
					</div>
				</div>
				<div class="sliderTopOwl__item sliderTop__item-1">
					<div class="row">
						<div class="col-md-6 col-sm-12 col-12 offset-md-1">
							<h2 class="sliderTop__title">iPhone 6 32Gb Black</h2>
							<div class="sliderTop__imgWrap">
								<img class="sliderTop__img d-md-none" src="/web/img/phone.png" alt="phone">
							</div>
							<p class="sliderTop__descr">At first, for some time, I was not able to answer him one word; but as he had taken me in his arms I held fast by him, or I should have fallen to the ground.</p>
							<a href="#" class="sliderTop__btn">Buy now</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<? //endif; ?>
<div class="products">
	<div class="productsWrap">
		<section class="searchAndLogin">
			<div class="container">
				<div class="searchAndLoginBox">
					<div class="searchAndLoginBoxWrap">
						<form class="searchBox" action="/search/">
							<input type="text" name="query" class="searchBox__search" placeholder="Поиск по сайту">
							<button class="searchBox__btn" type="submit">
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
			</div>
		</section>
		<section class="productsCustom">
			<div class="container">
				<div class="customLine">
					<div class="customLineWrap">
						<div class="customLine__price price">
							<div class="price__title">Цена</div>
							<input type="text" class="price__min" maxlength="6" data-min="<?=$minPrice?>" value="<? if(isset($lowPrice)) echo $lowPrice; ?>"> - 
							<input type="text" class="price__max" maxlength="6" data-max="<?=$maxPrice?>" value="<? if(isset($highPrice)) echo $highPrice; ?>">
							<button class="price__ok">ОК</button>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="productsCartsAndCategories">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="productsCartsAndCategories__titleWrap">Товары категории: <h3 class="productsCartsAndCategories__title"><? $rsCategory['name'] = $rsCategory['name'] ?? null; if($rsCategory['name']) echo $rsCategory['name']; else echo 'Все категории'; ?></h3></div>
					</div>
					<div class="col-lg-3">
						<aside class="accordionCategories">
							<ul class="accordionCategories__wrap">
								<li class="accordionCategories__item">
									<span class="accordionCategories__title">Категории товаров</span>
									<ul class="accordionCategories__submenu accordionCategories__submenu-default">
										<li class="accordionCategories__submenuItem">
											<a href="/" class="accordionCategories__submenuTitle">Все категории</a>
										</li>
										<? foreach ($rsCategories as $item): ?>
											<li class="accordionCategories__submenuItem">
												<a href="/<?=$item['symlink']?>/" class="accordionCategories__submenuTitle"><?=$item['name'];?></a>
											</li>
										<? endforeach ; ?>
									</ul>
								</li>
								<li class="accordionCategories__item">
									<span class="accordionCategories__title">Brand Focus</span>
									<ul class="accordionCategories__submenu">
										<li class="accordionCategories__submenuItem">
											<a href="#" class="accordionCategories__submenuTitle">Lorem ipsum.</a>
										</li>
										<li class="accordionCategories__submenuItem">
											<a href="#" class="accordionCategories__submenuTitle">Lorem ipsum.</a>
										</li>
										<li class="accordionCategories__submenuItem">
											<a href="#" class="accordionCategories__submenuTitle">Lorem ipsum.</a>
										</li>
									</ul>
								</li>
								<li class="accordionCategories__item">
									<span class="accordionCategories__title">Hi-Tech</span>
									<ul class="accordionCategories__submenu">
										<li class="accordionCategories__submenuItem">
											<a href="#" class="accordionCategories__submenuTitle">Cell phones</a>
										</li>
										<li class="accordionCategories__submenuItem">
											<a href="#" class="accordionCategories__submenuTitle">Cameras</a>
										</li>
										<li class="accordionCategories__submenuItem">
											<a href="#" class="accordionCategories__submenuTitle">Computers</a>
										</li>
										<li class="accordionCategories__submenuItem">
											<a href="#" class="accordionCategories__submenuTitle">TV. audio</a>
										</li>
										<li class="accordionCategories__submenuItem">
											<a href="#" class="accordionCategories__submenuTitle">Video games</a>
										</li>
									</ul>
								</li>
								<li class="accordionCategories__item">
									<span class="accordionCategories__title">Sale</span>
									<ul class="accordionCategories__submenu">
										<li class="accordionCategories__submenuItem">
											<a href="#" class="accordionCategories__submenuTitle">Cell phones</a>
										</li>
										<li class="accordionCategories__submenuItem">
											<a href="#" class="accordionCategories__submenuTitle">Cameras</a>
										</li>
										<li class="accordionCategories__submenuItem">
											<a href="#" class="accordionCategories__submenuTitle">Computers</a>
										</li>
										<li href="#" class="accordionCategories__submenuItem">
											<a href="#" class="accordionCategories__submenuTitle">TV. audio</a>
										</li>
										<li class="accordionCategories__submenuItem">
											<a href="#" class="accordionCategories__submenuTitle">Video games</a>
										</li>
									</ul>
								</li>
							</ul>
						</aside>
						<? $rsSubCategories = $rsSubCategories ?? null; ?>
						<? if($rsSubCategories): ?>
							<aside class="productsSet">
								<div class="productsSet__title">Available</div>
								<div class="productsSet__available">
									<div class="productsSet__availableWrap">
										<label class="productsSet__availableLabel">
											<input type="radio" name="available" class="productsSet__availableRad">
											<span class="productsSet__availableChecked"></span>			
										</label>
										<span class="productsSet__availableText">In Storage</span>
										<span class="productsSet__availableAmount">55</span>
									</div>
									<div class="productsSet__availableWrap">
										<label class="productsSet__availableLabel">
											<input type="radio" name="available" class="productsSet__availableRad">
											<span class="productsSet__availableChecked"></span>				
										</label>
										<span class="productsSet__availableText">In Online-Shop</span>
										<span class="productsSet__availableAmount">55</span>
									</div>
								</div>
								<div class="productsSet__title">Brands</div>
								<div class="productsSet__brands">

									<? foreach($rsSubCategories as $item): ?>
										<? $symlink = Categories::getCatById($item['parent_id']); ?>
										<div class="productsSet__brandsWrap">
											<label class="productsSet__brandsLable" data-parentcat="<?=$symlink['symlink'];?>" data-symlink="<?=$item['symlink'];?>">
												<input type="checkbox" name="brands" class="productsSet__brandsCheck">
												<span class="productsSet__brandsMark"></span>
											</label>
											<span class="productsSet__brandsText">
												<? $name = explode(" ", $item['name']); echo $name[1];?>
											</span>
											<span class="productsSet__brandsAmount">55</span>
										</div>
									<? endforeach; ?>

								</div>	
							</aside>
						<? endif; ?>
					</div>
					<div class="col-lg-9 col-md-12">
						<main class="productCartMain">
							<div class="row">
								<? foreach($rsProducts as $item): ?>
									<div class="col-md-4 col-sm-6 col-12">
										<div class="productCart">
											<div class="productCartWrap">
												<a href="/product/<?=$item['id']?>/" class="productCart__imgWrap">
													<img src="/web/img/products/<?=$item['image']?>" alt="cart_img" class="productCart__img">
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
							</div>
						</main>
					</div>
				</div>
			</div>
		</section>
		<section class="pagination">
			<div class="container">
			</div>
			<div class="container">
				<div class="paginationBox">
					<div class="paginationBoxWrap">
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
			</div>
		</section>
		<section class="bestSellers">
			<div class="container">
				<div class="bestSellersBox">
					<div class="bestSellersBoxWrap">
						<div class="bestSellersBox__titleLine">
							<h3 class="bestSellersBox__title">Рекомендуемые товары</h3>
						</div>		
						<div class="bestSellersBox__owlWrap owl-carousel owl-theme">
							<div class="bestSellersBox__col">
								<div class="bestSellersBox__card">
									<div class="bestSellersBox__cardTop">
										<a href="/product/26/" class="bestSellersBox__cardLink">
											<img src="/web/img/products/26.png" alt="iphoneX" class="bestSellersBox__cardImg">
										</a>
									</div>	
									<div class="bestSellersBox__cardBot">
										<h3 class="bestSellersBox__cardTitle">Iphone X</h3>
										<div class="bestSellersBox__cardColor">Black</div>
										<div class="bestSellersBox__cardPriceWrap">
											<div class="bestSellersBox__cardDiscount">$39.99</div>
											<div class="bestSellersBox__cardPrice">$29.99</div>		
										</div>
									</div>
								</div>
							</div>
							<div class="bestSellersBox__col">
								<div class="bestSellersBox__card">
									<div class="bestSellersBox__cardTop">
										<a href="/product/26/" class="bestSellersBox__cardLink">
											<img src="/web/img/products/26.png" alt="iphoneX" class="bestSellersBox__cardImg">
										</a>
									</div>	
									<div class="bestSellersBox__cardBot">
										<h3 class="bestSellersBox__cardTitle">Iphone X</h3>
										<div class="bestSellersBox__cardColor">Black</div>
										<div class="bestSellersBox__cardPriceWrap">
											<div class="bestSellersBox__cardDiscount">$39.99</div>
											<div class="bestSellersBox__cardPrice">$29.99</div>		
										</div>
									</div>
								</div>
							</div>
							<div class="bestSellersBox__col">
								<div class="bestSellersBox__card">
									<div class="bestSellersBox__cardTop">
										<a href="/product/26/" class="bestSellersBox__cardLink">
											<img src="/web/img/products/26.png" alt="iphoneX" class="bestSellersBox__cardImg">
										</a>
									</div>	
									<div class="bestSellersBox__cardBot">
										<h3 class="bestSellersBox__cardTitle">Iphone X</h3>
										<div class="bestSellersBox__cardColor">Black</div>
										<div class="bestSellersBox__cardPriceWrap">
											<div class="bestSellersBox__cardDiscount">$39.99</div>
											<div class="bestSellersBox__cardPrice">$29.99</div>		
										</div>
									</div>
								</div>
							</div>
							<div class="bestSellersBox__col">
								<div class="bestSellersBox__card">
									<div class="bestSellersBox__cardTop">
										<a href="/product/26/" class="bestSellersBox__cardLink">
											<img src="/web/img/products/26.png" alt="iphoneX" class="bestSellersBox__cardImg">
										</a>
									</div>	
									<div class="bestSellersBox__cardBot">
										<h3 class="bestSellersBox__cardTitle">Iphone X</h3>
										<div class="bestSellersBox__cardColor">Black</div>
										<div class="bestSellersBox__cardPriceWrap">
											<div class="bestSellersBox__cardDiscount">$39.99</div>
											<div class="bestSellersBox__cardPrice">$29.99</div>		
										</div>
									</div>
								</div>
							</div>
							<div class="bestSellersBox__col">
								<div class="bestSellersBox__card">
									<div class="bestSellersBox__cardTop">
										<a href="/product/26/" class="bestSellersBox__cardLink">
											<img src="/web/img/products/26.png" alt="iphoneX" class="bestSellersBox__cardImg">
										</a>
									</div>	
									<div class="bestSellersBox__cardBot">
										<h3 class="bestSellersBox__cardTitle">Iphone X</h3>
										<div class="bestSellersBox__cardColor">Black</div>
										<div class="bestSellersBox__cardPriceWrap">
											<div class="bestSellersBox__cardDiscount">$39.99</div>
											<div class="bestSellersBox__cardPrice">$29.99</div>		
										</div>
									</div>
								</div>
							</div>
							<div class="bestSellersBox__col">
								<div class="bestSellersBox__card">
									<div class="bestSellersBox__cardTop">
										<a href="/product/26/" class="bestSellersBox__cardLink">
											<img src="/web/img/products/26.png" alt="iphoneX" class="bestSellersBox__cardImg">
										</a>
									</div>	
									<div class="bestSellersBox__cardBot">
										<h3 class="bestSellersBox__cardTitle">Iphone X</h3>
										<div class="bestSellersBox__cardColor">Black</div>
										<div class="bestSellersBox__cardPriceWrap">
											<div class="bestSellersBox__cardDiscount">$39.99</div>
											<div class="bestSellersBox__cardPrice">$29.99</div>		
										</div>
									</div>
								</div>
							</div>
							<div class="bestSellersBox__col">
								<div class="bestSellersBox__card">
									<div class="bestSellersBox__cardTop">
										<a href="/product/26/" class="bestSellersBox__cardLink">
											<img src="/web/img/products/26.png" alt="iphoneX" class="bestSellersBox__cardImg">
										</a>
									</div>	
									<div class="bestSellersBox__cardBot">
										<h3 class="bestSellersBox__cardTitle">Iphone X</h3>
										<div class="bestSellersBox__cardColor">Black</div>
										<div class="bestSellersBox__cardPriceWrap">
											<div class="bestSellersBox__cardDiscount">$39.99</div>
											<div class="bestSellersBox__cardPrice">$29.99</div>		
										</div>
									</div>
								</div>
							</div>
							<div class="bestSellersBox__col">
								<div class="bestSellersBox__card">
									<div class="bestSellersBox__cardTop">
										<a href="/product/26/" class="bestSellersBox__cardLink">
											<img src="/web/img/products/26.png" alt="iphoneX" class="bestSellersBox__cardImg">
										</a>
									</div>	
									<div class="bestSellersBox__cardBot">
										<h3 class="bestSellersBox__cardTitle">Iphone X</h3>
										<div class="bestSellersBox__cardColor">Black</div>
										<div class="bestSellersBox__cardPriceWrap">
											<div class="bestSellersBox__cardDiscount">$39.99</div>
											<div class="bestSellersBox__cardPrice">$29.99</div>		
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</section>
	</div>
</div>
<section class="customers">
	<div class="container">
		<div class="customersBox">
			<div class="customersBoxWrap">
				<h2 class="customersBox__title">Что о нас говорят покупатели</h2>
				<h3 class="customersBox__subtitle">Lorem ipsum dolor sit amet, consectetur.	</h3>
				<div class="row justify-content-center">
					<div class="col-xl-3 col-lg-4 col-md-4 col-sm-8 col-12">
						<div class="customersBox__itemWrap">
							<div class="customersBox__itemTop">
								<div class="customersBox__itemImgWrap">
									<img src="/web/img/customer_1.jpg" alt="customer" class="customersBox__itemImg">
								</div>
								<h4 class="customersBox__itemName">Cellia Fields</h4>
								<div class="customersBox__itemSpec">UX Expert</div>
							</div>
							<p class="customersBox__itemText">This I have produced as a scantling
								of Jack's grea eloquence and the force of his reasoning upon such
							abstuse matters.</p>
						</div>	
					</div>
					<div class="col-xl-3 col-lg-4 col-md-4 col-sm-8 col-12">
						<div class="customersBox__itemWrap">
							<div class="customersBox__itemTop">
								<div class="customersBox__itemImgWrap">
									<img src="/web/img/customer_1.jpg" alt="customer" class="customersBox__itemImg">
								</div>
								<h4 class="customersBox__itemName">Cellia Fields</h4>
								<div class="customersBox__itemSpec">UX Expert</div>
							</div>
							<p class="customersBox__itemText">This I have produced as a scantling
								of Jack's grea eloquence and the force of his reasoning upon such
							abstuse matters.</p>
						</div>
					</div>
					<div class="col-xl-3 col-lg-4 col-md-4 col-sm-8 col-12">
						<div class="customersBox__itemWrap">
							<div class="customersBox__itemTop">
								<div class="customersBox__itemImgWrap">
									<img src="/web/img/customer_1.jpg" alt="customer" class="customersBox__itemImg">
								</div>
								<h4 class="customersBox__itemName">Cellia Fields</h4>
								<div class="customersBox__itemSpec">UX Expert</div>
							</div>
							<p class="customersBox__itemText">This I have produced as a scantling
								of Jack's grea eloquence and the force of his reasoning upon such
							abstuse matters.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
</section>

<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="utf-8">
	<title><?=$pageTitle?></title>
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Template Basic Images Start -->
	<meta property="vk:image"  content="/web/img/favicon/apple-touch-icon-180x180.png" />
	<meta property="og:image" content="/web/img/favicon/apple-touch-icon-180x180.png">
	<link rel="icon" href="/web/img/favicon/apple-touch-icon-180x180.png" type="image/png" sizes="180x180">
	<link rel="apple-touch-icon" sizes="180x180" href="/web/img/favicon/apple-touch-icon-180x180.png">
	<!-- Template Basic Images End -->
	
	<!-- Custom Browsers Color Start -->
	<meta name="theme-color" content="#000">
	<!-- Custom Browsers Color End -->

	<link rel="stylesheet" href="/web/css/main.min.css">
	<link rel="stylesheet" href='/web/libs/mmenu/jquery.mmenu.all.css'>
	<script src="/web/libs/svg4everybody/svg4everybody.min.js"></script>
	<script>svg4everybody();</script>
	<script id="__bs_script__">//<![CDATA[
	document.write("<script async src='/browser-sync/browser-sync-client.js?v=2.23.5'><\/script>".replace("HOST", location.hostname));
	//]]></script>
	<script async="" src="/browser-sync/browser-sync-client.js?v=2.23.5"></script>
</head>
<body>
	<div class="wrapper">
		<div class="content">
			<header class="mainHead">
				<div class="mainHeadWrap">
					<div class="container">
						<div class="row no-gutters">
							<div class="col-md-2 col-sm-2 col-2 d-md-block d-lg-none">
								<div class="mobileMenu">
									<div class="mobileMenuWrap">
										<nav class="headerNav" id="my-menu">
											<ul class="headerNav__wrap">
												<li class="headerNav__item">
													<svg class="headerNav__icon">
														<use xlink:href="/web/img/vectorsprites/fa.svg#home" />
													</svg>
													<a href="/" id="ds" class="headerNav__link headerNav__link-active">Главная</a>
												</li>
												<li class="headerNav__item">
													<svg class="headerNav__icon">
														<use xlink:href="/web/img/vectorsprites/fa.svg#list" />
													</svg>
													<a href="#" id="ds" class="headerNav__link headerNav__link-active">Категории</a>
													<ul class="headerNav__wrap">
														<li class="headerNav__item">
															<a href="/" class="headerNav__link">Все категории</a>
														</li>
														<li class="headerNav__item">
															<a href="/phones/" class="headerNav__link">Телефоны</a>
															<ul class="headerNav__wrap">
																<li class="headerNav__item">
																	<a href="/phones/filter/apple/" class="headerNav__link">Телефоны Apple</a>
																</li>
																<li class="headerNav__item">
																	<a href="/phones/filter/samsung/" class="headerNav__link">Телефоны Samsung</a>
																</li>
																<li class="headerNav__item">
																	<a href="/phones/filter/meizu/" class="headerNav__link">Телефоны Meizu</a>
																</li>
															</ul>
														</li>
														<li class="headerNav__item">
															<a href="/tablets/" class="headerNav__link">Планшеты</a>
														</li>
													</ul>
												</li>
												<li class="headerNav__item">
													<svg class="headerNav__icon">
														<use xlink:href="/web/img/vectorsprites/fa.svg#info-circle" />
													</svg>
													<a href="#" class="headerNav__link">Информация</a>
													<ul class="headerNav__wrap">
														<li class="headerNav__item">
															<a href="/about/delivery/" class="headerNav__link">Доставка и оплата</a>
														</li>
														<li class="headerNav__item">
															<a href="/about/guarantees/" class="headerNav__link">Гарантии</a>
														</li>
														<li class="headerNav__item">
															<a href="/about/contacts/" class="headerNav__link">Контакты</a>
														</li>
														<li class="headerNav__item">
															<a href="/about/us/" class="headerNav__link">О нас</a>
														</li>
													</ul>
												</li>
											</ul>
										</nav>
										<div id="my-button" class="hamburger">
											<span class="hamburger__line"></span>
											<span class="hamburger__line"></span>
											<span class="hamburger__line"></span>
										</div>
									</div>		
								</div>
							</div>
							<div class="col-md-7 col-sm-7 col-6 d-md-block d-lg-none">
								<div class="mobileSearch">
									<div class="mobileSearchWrap">
										<form class="searchBox searchBox-mobile" action="/search/">
											<input type="text" name="query" class="searchBox__search" placeholder="Поиск">
											<button class="searchBox__btn" type="submit">
												<svg class="searchBox__btnIcon">
													<use xlink:href="/web/img/vectorsprites/fa.svg#search" />
												</svg>
											</button>
										</form>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-3 col-4 d-md-block d-lg-none">
								<div class="mobileCartAndLogin">
									<div class="mobileCartAndLoginWrap">
										<div class="registerBlockMobile">
											<? if(!isset($_SESSION['user'])): ?>
												<a href="#" class="loginBoxMobile loginBoxMobile-login">
													<svg class="loginBoxMobile__user">
														<use xlink:href="/web/img/vectorsprites/fa.svg#user" />
													</svg>
												</a>
											<? else: ?>
												<a href="/user/" class="loginBoxMobile loginBoxMobile-unlogin">
													<svg class="loginBoxMobile__user">
														<use xlink:href="/web/img/vectorsprites/fa.svg#user" />
													</svg>
												</a>
											<? endif ;?>
										</div>
										<div class="basketCart">
											<div class="basketCart__logo">
												<svg class="basketCart__logoImg">
													<use xlink:href="/web/img/vectorsprites/fa.svg#shopping-cart" />
												</svg>
											</div>
											<div class="basketCart__amountWrap">
												<div class="basketCart__amount"><? if(!empty($_SESSION['cntItems'])) echo $_SESSION['cntItems']; else echo '0'; ?></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-2 d-md-none d-lg-block">
								<a href="/" class="headerLogo">
									<svg class="headerLogo__img">
										<use xlink:href="/web/img/vectorsprites/fa.svg#logo" />
									</svg>
								</a>	
							</div>
							<div class="col-lg-7 d-md-none d-lg-block">
								<nav class="headerNav">
									<ul class="headerNav__wrap">
										<li class="headerNav__item">
											<a href="/about/delivery/" class="headerNav__link <? if($_SERVER['REQUEST_URI'] == '/about/delivery/') echo 'headerNav__link-active';?>">Доставка и оплата</a>
										</li>
										<li class="headerNav__item">
											<a href="/about/guarantees/" class="headerNav__link <? if($_SERVER['REQUEST_URI'] == '/about/guarantees/') echo 'headerNav__link-active';?>">Гарантии</a>
										</li>
										<li class="headerNav__item">
											<a href="/about/contacts/" class="headerNav__link <? if($_SERVER['REQUEST_URI'] == '/about/contacts/') echo 'headerNav__link-active';?>">Контакты</a>
										</li>
										<li class="headerNav__item">
											<a href="/about/us/" class="headerNav__link <? if($_SERVER['REQUEST_URI'] == '/about/us/') echo 'headerNav__link-active';?>">О нас</a>
										</li>
									</ul>
								</nav>
							</div>
							<div class="col-lg-3 d-md-none d-lg-block">
								<div class="headerContacts">
									<div class="headerContacts__wrap">
										<div class="headerContacts__iconWrap">
											<svg class="headerContacts__icon">
												<use xlink:href="/web/img/vectorsprites/fa.svg#phone" />
											</svg>
										</div>
										<div class="headerContacts__phone">+380 999 99 99</div>
									</div>
								</div>	
							</div>
						</div>
					</div>
				</div>
			</header>


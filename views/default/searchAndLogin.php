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
	</div>
</section>
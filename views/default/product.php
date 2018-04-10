<section class="product">
	<div class="productWrap">
		<div class="container">	
			<div class="row justify-content-center">
				<div class="col-12">
					<div class="product__nameWrap">
						<ul class="product__linkingWrap">
							<li class="product__linkingItem">
								<a href="#" class="product__linkingLink">lorem</a><span class="product__linkingAngle">&gt;</span>
							</li>
							<li class="product__linkingItem">
								<a href="#" class="product__linkingLink">lorem</a><span class="product__linkingAngle">&gt;</span>
							</li>
							<li class="product__linkingItem">
								<a href="#" class="product__linkingLink">lorem</a><span class="product__linkingAngle">&gt;</span>
							</li>
						</ul>
						<h1 class="product__title"><?=$rsProduct['name']?></h1>
					</div>
				</div>
				<div class="col-lg-7 col-md-12 col-12">
					<div class="productSlider">
						<div class="productSlider__code">Код товара: <strong class="productSlider__codeStrong">123456</strong></div>		
						<div id="owl-sync" class="productSlider__owlWrap owl-carousel owl-theme">
							<div class="productSlider__imgWrap">
								<img class="productSlider__img" src="/web/img/products/<?=$rsProduct['image']?>" alt="product">
							</div>
							<div class="productSlider__imgWrap">
								<img class="productSlider__img" src="/web/img/products/<?=$rsProduct['image']?>" alt="product">
							</div>
							<div class="productSlider__imgWrap">
								<img class="productSlider__img" src="/web/img/products/<?=$rsProduct['image']?>" alt="product">
							</div>
							<div class="productSlider__imgWrap">
								<img class="productSlider__img" src="/web/img/products/<?=$rsProduct['image']?>" alt="product">
							</div>
							<div class="productSlider__imgWrap">
								<img class="productSlider__img" src="/web/img/products/<?=$rsProduct['image']?>" alt="product">
							</div>
							<div class="productSlider__imgWrap">
								<img class="productSlider__img" src="/web/img/products/<?=$rsProduct['image']?>" alt="product">
							</div>
							<div class="productSlider__imgWrap">
								<img class="productSlider__img" src="/web/img/products/<?=$rsProduct['image']?>" alt="product">
							</div>
						</div>
						<div id="for-owl-sync" class="productSlider__owlWrap-sync owl-carousel owl-theme">
							<div class="productSlider__imgWrap productSlider__imgWrap-sync">
								<img class="productSlider__img productSlider__img-sync" src="/web/img/products/<?=$rsProduct['image']?>" alt="product">
							</div>
							<div class="productSlider__imgWrap productSlider__imgWrap-sync">
								<img class="productSlider__img productSlider__img-sync" src="/web/img/products/<?=$rsProduct['image']?>" alt="product">
							</div>
							<div class="productSlider__imgWrap productSlider__imgWrap-sync">
								<img class="productSlider__img productSlider__img-sync" src="/web/img/products/<?=$rsProduct['image']?>" alt="product">
							</div>
							<div class="productSlider__imgWrap productSlider__imgWrap-sync">
								<img class="productSlider__img productSlider__img-sync" src="/web/img/products/<?=$rsProduct['image']?>" alt="product">
							</div>
							<div class="productSlider__imgWrap productSlider__imgWrap-sync">
								<img class="productSlider__img productSlider__img-sync" src="/web/img/products/<?=$rsProduct['image']?>" alt="product">
							</div>
							<div class="productSlider__imgWrap productSlider__imgWrap-sync">
								<img class="productSlider__img productSlider__img-sync" src="/web/img/products/<?=$rsProduct['image']?>" alt="product">
							</div>
							<div class="productSlider__imgWrap productSlider__imgWrap-sync">
								<img class="productSlider__img productSlider__img-sync" src="/web/img/products/<?=$rsProduct['image']?>" alt="product">
							</div>

						</div>
					</div>
				</div>
				<div class="col-lg-5 col-md-12 col-12">
					<div class="productDescrAndAdd">
						<div class="row">
							<div class="col-lg-12 col-md-6 col-12 align-self-stretch ">
								<div class="productDescr">
									<p class="productDescr__text">Краткое описание: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni culpa, modi repudiandae nam totam libero. Omnis commodi itaque, temporibus. Vitae esse, incidunt, debitis</p>
								</div>
							</div>
							<div class="col-lg-12 col-md-6 col-12 align-self-stretch ">
								<div class="productAddToCart">
									<div class="productAddToCart__inStock">Есть в наличии</div>		
									<div class="productAddToCart__price">Цена: <?=$rsProduct['price']?> <span class="productAddToCart__currency">грн</span></div>
									<button class="productAddToCart__add <? foreach($_SESSION['products'] as $id) if($id['id'] == $rsProduct['id']) echo 'productAddToCart__add-active';?>" data-id="<?=$rsProduct['id']?>"><span class="productAddToCart__text"><? if(array_search($rsProduct['id'], array_column($_SESSION['products'], 'id')) !== false) echo 'Товар добавлен в'; else echo "Добавить в"; ?></span><svg class="productAddToCart__logoImg">
										<use xlink:href="/web/img/vectorsprites/fa.svg#shopping-cart" />
									</svg></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="characteristics">
	<div class="characteristicsWrap">
		<div class="container">	
			<h2 class="characteristics__title"><strong class="characteristics__titleStr">Технические характеристики</strong> <?=$rsProduct['name']?></h2>
			<table class="characteristics__table">
				<tr class="characteristics__tr">
					<td class="characteristics__td">Lorem ipsum dolor.</td>
					<td class="characteristics__td">Lorem ipsum dolor.</td>
				</tr>
				<tr class="characteristics__tr">
					<td class="characteristics__td">Lorem ipsum dolor.</td>
					<td class="characteristics__td">Lorem ipsum dolor.</td>
				</tr>
				<tr class="characteristics__tr">
					<td class="characteristics__td">Lorem ipsum dolor.</td>
					<td class="characteristics__td">Lorem ipsum dolor.</td>
				</tr>
				<tr class="characteristics__tr">
					<td class="characteristics__td">Lorem ipsum dolor.</td>
					<td class="characteristics__td">Lorem ipsum dolor.</td>
				</tr>
				<tr class="characteristics__tr">
					<td class="characteristics__td">Lorem ipsum dolor.</td>
					<td class="characteristics__td">Lorem ipsum dolor.</td>
				</tr>
				<tr class="characteristics__tr">
					<td class="characteristics__td">Lorem ipsum dolor.</td>
					<td class="characteristics__td">Lorem ipsum dolor.</td>
				</tr>
				<tr class="characteristics__tr">
					<td class="characteristics__td">Lorem ipsum dolor.</td>
					<td class="characteristics__td">Lorem ipsum dolor.</td>
				</tr>
			</table>
		</div>	
	</div>
</section>
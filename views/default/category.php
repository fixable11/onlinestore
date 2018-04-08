<h1>Товары категории <?=$rsCategory['name']?></h1>

<?  if(isset($rsProducts)) foreach ($rsProducts as $item): ?>
	<div class="" style="float:left; padding: 0px 30px 40px 0px;">
		<a href="/product/<?=$item['id']?>/"> 
			<img src="/images/products/<?=$item['image']?>" alt="" width="100">
		</a><br>
		<a href="/product/<?=$item['id']?>/"><?=$item['id']?></a>
	</div>
<? endforeach; ?>

<? if(isset($rsChildCats)) foreach ($rsChildCats as $item): ?>
	<h2><a href="/category/<?=$item['id']?>/"><?=$item['name']?></a></h2>
<? endforeach; ?>
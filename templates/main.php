<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Тестовое задание</title>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
	<header></header>
	<div class="modal-container">
		<div class="overlay"></div>
		<div class="modal-content">
			<button class="modal-close"></button>
			<h3 class="modal-content__title">Инструкция</h3>
			<p>После публикации сделайте скрин, что вы его написали и отправьте своему куратору, чтобы мы добавили вам спецкурс в личный кабинет.</p>
			<p>После публикации сделайте скрин, что вы его написали и отправьте своему куратору, чтобы мы добавили вам спецкурс в личный кабинет.</p>
			<p>После публикации сделайте скрин, что вы его написали и отправьте своему куратору, чтобы мы добавили вам спецкурс в личный кабинет.</p>
			<p>После публикации сделайте скрин, что вы его написали и отправьте своему куратору, чтобы мы добавили вам спецкурс в личный кабинет.</p>
		</div>
	</div>
	
	
	<main class="container">
        <?php if(isset($_SESSION['authorization'])):?>
		<section class="balance">
			<h2 class="balance__title">Ваш баланс:</h2>
			<div class="schet">
				<img class="schet__coin" src="/assets/coin.png" width="40" height="40">
				<span><?=$_SESSION['balance'];?></span>
				<img class="schet__et" src="/assets/et.png" height="38" width="46">
			</div>
		</section>
		<section class="obmen">
			<h2 class="obmen__title">Варианты обмена на скидку</h2>
			<a class="obmen-href-modal">Инструкция</a>
			<ul class="obmen-list">
				<?php foreach ($products as $product) :?>
					<li class="obmen-item" id="tovar-<?=$product['id']?>">
						<div class="schet">
							<img class="schet__coin" src="/assets/coin.png" width="14" height="14">
							<span><?=$product['price']?></span>
							<img class="schet__et" src="/assets/et.png" height="15" width="13">
						</div>
						<img class="obmen-item__img" src="<?=$product['imgsrc']?>">
						<div class="skidka-info">
							<span class="skidka-info__cifra"><?=$product['skidka']?></span> <span class="skidka-info__txt"><?=$product['description']?></span>
						</div>
						<?php if(in_array($product['id'], $userProducts)):?>
							<button class="obmen-item__button obmen-item__button--active">Уже использовано</button>
						<?php else:?>
							<form method="post">
								<input name="tovarid" value="<?=$product['id']?>" type="hidden">
								<input name="price" value="<?=$product['price']?>" type="hidden">
								<button type="submit" class="obmen-item__button obmen-item__button--yellow">Использовать скидку</button>
							</form>
						<?php endif;?>
						
					</li>
				<?php endforeach?>
					<!-- <li class="obmen-item">
						<div class="schet">
							<img class="schet__coin" src="/assets/coin.png" width="14" height="14">
							<span>50</span>
							<img class="schet__et" src="/assets/et.png" height="15" width="13">
						</div>
						<img class="obmen-item__img" src="/assets/phone.png">
						<div class="skidka-info">
							<span class="skidka-info__cifra">50%</span> <span class="skidka-info__txt">на звонки ST (x2)</span>
						</div>
						<button class="obmen-item__button obmen-item__button--yellow obmen-item__button--active">Уже использовано</button>
					</li> -->	
			</ul>
		</section>
        <?php endif;?>
        
		<section class="authorization">
			<?php if($_SESSION['authorization'] !==1):?>
				<h2>Авторизация</h2>
				<form method="post">
					<input name="login" type="text">
					<input name="pass" type="password">
					<input type="submit" value="Войти">
				</form>
			<?php else:?>
				<h2>Логин:</h2>
				<p><?=$_SESSION['userName']?></p>
				<a href = "/logout.php">Разлогиниться</a>
			<?php endif;?>
		</section>
		
		<?php if($errors):?>
		<section class="errors">
			<h2>Предупреждения</h2>
			<?php foreach ($errors as $error) :?>
				<p><?=$error;?></p>
			<?php endforeach;?>
		</section>
		<?php endif?>

	</main>

	<footer></footer>
<script src="/js/main.js" type="text/javascript"></script>
</body>
</html>
<?php
require_once __DIR__ . '/init.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
	$errors = [];
}
$products = [];
$userProducts = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	if($_POST['login']){
		$userInfo = getPasswordUser($link, $_POST['login']);
		if($userInfo){
			if( $userInfo['pass'] === $_POST['pass']){
				$_SESSION['login'] = $_POST['login'];
				$_SESSION['authorization'] = 1;
				$_SESSION['userName'] = $userInfo['login'];
			}
			else{
				$errors['login'] = 'Неверный пароль';
			}
		}
		else{
			$errors['login'] = 'Пользователь не найден';
		}
	}
	if($_POST['price']){
		if($_SESSION['balance']<$_POST['price']){
			$errors['price'] = 'Не хватает средств для получения товара';
		}
		else{
			if(!checkUserProduct($link, $_SESSION['login'], $_POST['tovarid'])){
				buyProduct($link, $_SESSION['login'], $_POST['tovarid']);
			}
			header("Location:/");
			exit();
		}
	}
}

if(isset($_SESSION['login'])){
	$_SESSION['balance'] = getUserBalans($link, $_SESSION['login']);
	$products = getProduct($link);
	$dbUserProducts = getUserProduct($link, $_SESSION['login']);
	if($dbUserProducts){
		foreach ($dbUserProducts as $product) {
			array_push($userProducts, $product['product_id']);
		}
	}
}

$layout_content = include_template('main.php',[
	'products' => $products,
	'userProducts' => $userProducts,
	'errors' => $errors,
]);

print($layout_content);
<?php
function dbConnect($config)
{
    $link = mysqli_connect($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['database']);
    mysqli_set_charset($link, "utf8");
    mysqli_options($link, MYSQLI_OPT_INT_AND_FLOAT_NATIVE, $config);
    return $link;
}

function getPasswordUser($link, $login){
    $sql = "SELECT pass,login FROM users WHERE login =" . "'" . $login . "'";
    $result = mysqli_query($link, $sql);
    if ( $result->num_rows===0 ){
        return false;
    }
    $userInfo = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $userInfo[0];
}

function getUserBalans($link, $login){
    $id = getUserId($link, $login);
    $coins = getUserCoins($link, $id);
    $cost = getUserCost($link, $id);
    $balans = $coins - $cost;
    return $balans;
}

function getUserCoins($link, $id) : int
{
    $sql = 'SELECT SUM(price) as sum_price FROM (SELECT DISTINCT(action), price FROM coins where user_id=' . $id . ' GROUP BY action,price) as a';
    $result = mysqli_query($link, $sql);
    if ( $result->num_rows===0 ){
        return false;
    }
    $coins = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if ($coins[0]['sum_price'] === null){
        return false;
    }
    return $coins[0]['sum_price'];
}

function getUserCost($link, $id) : int
{   
    $sql = 'SELECT SUM(price) as sum_price FROM orders_users LEFT JOIN products on orders_users.product_id = products.id WHERE user_id=' . $id;
    $result = mysqli_query($link, $sql);
    if ( $result->num_rows===0 ){
        return false;
    }
    $cost = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if ($cost[0]['sum_price'] === null){
        return false;
    }
    return $cost[0]['sum_price'];
}

function getUserId($link, $login){
    $sql = "SELECT id FROM users WHERE login =" . "'" . $login . "'";
    $result = mysqli_query($link, $sql);
    if ( $result->num_rows===0 ){
        return false;
    }
    $id = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $id[0]['id'];
}

function getProduct($link){
    $sql = "SELECT * FROM products";
    $result = mysqli_query($link, $sql);
    if ( $result->num_rows===0 ){
        return false;
    }
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $products;
}

function getUserProduct($link, $login){
    $id = getUserId($link, $login);
    $sql = "SELECT product_id FROM orders_users WHERE user_id=" . $id;
    $result = mysqli_query($link, $sql);
    if ( $result->num_rows===0 ){
        return false;
    }
    $userProducts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $userProducts;
}

function checkUserProduct($link, $login, $productId){
    $id = getUserId($link, $login);
    $sql = "SELECT product_id FROM orders_users WHERE user_id=" . $id . " AND product_id=" . $productId;
    $result = mysqli_query($link, $sql);
    if ( $result->num_rows===0 ){
        return false;
    }
    return true;
}

function buyProduct($link, $login, $tovarid){
    $id = getUserId($link, $login);
    $sql = "INSERT INTO orders_users (user_id, product_id) VALUES ($id, $tovarid)";
    $result = mysqli_query($link, $sql);
    return;
}
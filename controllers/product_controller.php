<?php defined("CATALOG") or die("Access denied");

include 'main_controller.php';
include "models/{$view}_model.php";


$get_one_product = get_one_product($product_alias);
/*
Перевірка на звернення до неіснуючого товару
*/
if(!$get_one_product) {
    header("HTTP/1.1 404 Not Found");
    include "views/{$options['theme']}/404.php";
    exit;
}

//отримуєм ID категорії
$category_id = $get_one_product['parent'];


//comments ID товара
$product_id = $get_one_product['id'];

//кількість коментарів
$count_comments = count_comments($product_id);

//отримання коментів до товару
$get_comments = get_comments($product_id);
//дерево коментів
$comments_tree = map_tree($get_comments);
//HTML код коментарів
$comments = categories_to_string($comments_tree, 'comments_template.php');


include 'libs/breadcrumbs.php';

include "views/{$options['theme']}/{$view}.php";

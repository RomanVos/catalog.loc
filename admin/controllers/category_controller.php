<?php defined("CATALOG") or die("Access denied");

include 'main_controller.php';
include "models/{$view}_model.php";
include "../models/{$view}_model.php";

if (!isset($category_alias)) $category_alias = null;
$category_id = get_id($categories, $category_alias);

include '../libs/breadcrumbs.php';

/*
 Перевірка на звернення до неіснуючої категорії
 */
if ($category_alias && !$category_id) {
    http_response_code(404);
    include "views/404.php";
    exit;
}

//ID дочірніх категорій
$ids = cats_id($categories, $category_id);
$ids = !$ids ? $category_id : $ids . $category_id;

/******************Pagination******************/

//кількість товарів на сторінку
$perpage = 15;

//загальна кількість товарів
$count_goods = get_count_goods($ids);
//необхідна к-сть сторінок
$count_pages = ceil($count_goods / $perpage);
if (!$count_pages) $count_pages = 1; //min. 1 page

//отримання запрошеної сторінки
if (isset($_GET['page'])) {
    $page = (int)$_GET['page'];
    if ($page < 1) $page = 1;
} else {
    $page = 1;
}
//якщо запрошена сторінка більше максимума
if ($page > $count_pages) $page = $count_pages;

//початкова позиція для запроса
$start_pos = ($page - 1) * $perpage;

$pagination = pagination($page, $count_pages);

/******************Pagination******************/

$products = get_products($ids, $start_pos, $perpage);

include "views/{$view}.php";

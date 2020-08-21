<?php defined("CATALOG") or die("Access denied");

include 'main_controller.php';
include "models/{$view}_model.php";

if(!isset($category_id)) $category_id = null;

include 'libs/breadcrumbs.php';

//ID дочірніх категорій
$ids = cats_id($categories, $category_id);
$ids = !$ids ? $category_id : rtrim($ids, ",");

/******************Pagination******************/

//кількість товарів на сторінку
$perpage = ( isset($_COOKIE['per_page']) && (int)$_COOKIE['per_page']) ? $_COOKIE['per_page'] : PERPAGE;

//загальна кількість товарів
$count_goods = get_count_goods($ids);
//необхідна к-сть сторінок
$count_pages = ceil($count_goods / $perpage);
if(!$count_pages) $count_pages = 1; //min. 1 page

//отримання запрошеної сторінки
if(isset($_GET['page'])){
    $page = (int)$_GET['page'];
    if($page < 1) $page = 1;
}else{
    $page = 1;
}
//якщо запрошена сторінка більше максимума
if($page > $count_pages) $page = $count_pages;

//початкова позиція для запроса
$start_pos = ($page - 1) * $perpage;

$pagination = pagination($page, $count_pages);

/******************Pagination******************/

$products = get_products($ids, $start_pos, $perpage);

include "views/{$view}.php";



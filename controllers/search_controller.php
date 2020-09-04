<?php defined("CATALOG") or die("Access denied");

include 'main_controller.php';
include "models/{$view}_model.php";

if(isset ($_GET['term']) ) {
    $result_search = search_autocomplete();
    exit( json_encode($result_search) );
}elseif( isset($_GET['search']) && $_GET['search'] ){

    /******************Pagination******************/

//кількість товарів на сторінку
    $perpage = $options['pagination'];

//загальна кількість товарів
    $count_goods = count_search();
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
    $result_search = search($start_pos, $perpage);
}else{
    $result_search = 'А що Ви шукаєте?';
}

$breadcrumbs = "<a href='" . PATH . "'>Головна</a> / <li>Результати пошуку</li>";


include "views/{$options['theme']}/{$view}.php";
<?php defined("CATALOG") or die("Access denied");

//хлібні крошки
$breadcrumbs_array = breadcrumbs($categories, $category_id);

if($breadcrumbs_array){
    $breadcrumbs = "<a href='" .PATH. "'>Головна</a> / ";
    foreach ($breadcrumbs_array as $category_id => $title){
        $breadcrumbs .= "<a href='" .PATH. "category/{$category_id}'>{$title}</a> / ";
    }
    if(!isset($get_one_product)){
        $breadcrumbs = rtrim($breadcrumbs, " / ");
        $breadcrumbs = preg_replace("#(.+)?<a.+>(.+)</a>$#", "$1$2", $breadcrumbs);
    }else{
        $breadcrumbs .= $get_one_product['title'];
    }

}else{
    $breadcrumbs = "<a href='" .PATH. "'>Головна</a> / Каталог";
}
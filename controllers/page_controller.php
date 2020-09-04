<?php defined("CATALOG") or die("Access denied");

include 'main_controller.php';
include "models/{$view}_model.php";

$page = get_one_page($page_alias);

if(!$page){
    header("HTTP/1.1 404 Not Found");
    include "views/{$options['theme']}/404.php";
    exit;
}

$breadcrumbs = "<a href='" . PATH . "'>Головна</a> / {$page['title']}";


include "views/{$options['theme']}/{$view}.php";
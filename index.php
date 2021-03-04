<?php
define("CATALOG", TRUE);
session_start();
include 'config.php';

//роутінг
$routes = [
    ['url' => '#^$|^\?#', 'view' => 'category'],
    ['url' => '#^product/(?P<product_alias>[a-z0-9-]+)#i', 'view' => 'product'],
    ['url' => '#^category/(?P<category_alias>[a-z0-9-]+)#i', 'view' => 'category'],
    ['url' => '#^login#i', 'view' => 'login'],
    ['url' => '#^logout#i', 'view' => 'logout'],
    ['url' => '#^forgot#i', 'view' => 'forgot'],
    ['url' => '#^registration#i', 'view' => 'registration'],
    ['url' => '#^add_comment#i', 'view' => 'add_comment'],
    ['url' => '#^page/(?P<page_alias>[a-z0-9-]+)#i', 'view' => 'page'],
    ['url' => '#^search#i', 'view' => 'search']
];

// http://catalog.loc/site/index.php
$app_path = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

// http://catalog.loc/site/
$app_path = preg_replace('#[^/]+$#', '', $app_path);
define("PATH", $app_path);

// http://catalog.loc/site/page/about
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// page/about
$url = str_replace(PATH, '', $url);

foreach ($routes as $route) {
    if( preg_match($route['url'], $url, $match) ){
        $view = $route['view'];
        break;
    }
}

if( empty($match) ){
    header("HTTP/1.1 404 Not Found");
    include "views/404.php";
    exit;
}

extract($match);
include "controllers/{$view}_controller.php";

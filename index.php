<?php
define("CATALOG", TRUE);
session_start();
include 'config.php';

//роутінг
$routes = array(
    array('url' => '#^$|^\?#', 'view' => 'category'),
    array('url' => '#^product/(?P<product_alias>[a-z0-9-]+)#i', 'view' => 'product'),
    array('url' => '#^category/(?P<category_alias>[a-z0-9-]+)#i', 'view' => 'category'),
    array('url' => '#^add_comment#i', 'view' => 'add_comment'),
    array('url' => '#^login#i', 'view' => 'login'),
    array('url' => '#^logout#i', 'view' => 'logout'),
    array('url' => '#^forgot#i', 'view' => 'forgot'),
    array('url' => '#^reg#i', 'view' => 'reg'),
    array('url' => '#^page/(?P<page_alias>[a-z0-9-]+)#i', 'view' => 'page'),
    array('url' => '#^search#i', 'view' => 'search')

);

//$url = str_replace('/catalog/', '', $_SERVER['REQUEST_URI']);
$url = ltrim($_SERVER['REQUEST_URI'], '/');

foreach ($routes as $route) {
        $view = null;
    if( preg_match($route['url'], $url, $match) ){
        $view = $route['view'];
        break;
    }
}

if( empty($match) ){
    include VIEW . '404.php';
    exit;
}

extract($match);

include "controllers/{$view}_controller.php";

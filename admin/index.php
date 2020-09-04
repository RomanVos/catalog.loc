<?php

define("CATALOG", TRUE);
session_start();
require_once '../config.php';

// http://catalog.loc/admin/index.php
$app_path = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
// http://catalog.loc/admin/
$app_path = preg_replace('#[^/]+$#', '', $app_path);
define("PATH", $app_path);
// http://catalog.loc/admin/login
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
// login
$url = str_replace(PATH, '', $url);

$site_url = rtrim( str_replace('admin', '', PATH), '/' );
define("SITE", $site_url);

$routes = [
	['url' => '#^$|^\?#', 'view' => 'options'],
	['url' => '#^login#i', 'view' => 'login'],
    ['url' => '#^category/(?P<category_alias>[a-z0-9-]+)#i', 'view' => 'category'],
    ['url' => '#^category#', 'view' => 'category'],
    ['url' => '#^edit-product/(?P<product_id>[a-z0-9-]+)|^edit-product#i', 'view' => 'edit_product'],
];

foreach ($routes as $route) {
	if( preg_match($route['url'], $url, $match) ){
		$view = $route['view'];
		break;
	}
}

if( empty($match) ){
	header("HTTP/1.1 404 Not Found");
	include '../' . VIEW . '404.php';
	exit;
}

require_once 'controllers/main_controller.php';

extract($match);
include "controllers/{$view}_controller.php";

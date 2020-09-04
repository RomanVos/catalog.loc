<?php defined("CATALOG") or die("Access denied");

require_once "models/{$view}_model.php";
include 'main_controller.php';

if( isset($_GET['title'])) {
    if (update_price()){
        exit('Ціна змінена');
    }else{
        exit('Помилка зміни!');
    }
}

if(isset($_GET['id'])){
    if(del_product()){
        exit('OK');
    }else{
        exit('NO');
    }
}

if( isset($_POST['edit_product'])) {
    edit_product();
    redirect();
}

$get_one_product = get_one_product($product_id);
if( !$get_one_product){
    http_response_code(404);
    include 'views/404.php';
    exit;
}

$id = $get_one_product['parent'];

include '../libs/breadcrumbs.php';

require_once "views/{$view}.php";

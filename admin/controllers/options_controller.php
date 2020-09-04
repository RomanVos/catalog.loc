<?php defined("CATALOG") or die("Access denied");

require_once "models/{$view}_model.php";

if( isset($_GET['title']) ){
    if( save_options()){
        exit('Налаштування збережені');
    }else{
        exit('Помилка збереження налаштувань');
    }
}

$get_options = get_options();
$themes = get_themes();

require_once "views/{$view}.php";

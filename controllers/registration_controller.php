<?php defined("CATALOG") or die("Access denied");

include 'main_controller.php';
include "models/{$view}_model.php";

if(isset($_POST['val'])){
    echo access_field();
    exit;
}
if(isset($_POST['reg'])) {
    registration();
    redirect();
}

$breadcrumbs = "<li><a href='" . PATH . "'>Головна</a></li> / <li>Реєстрація</li>";

include "views/{$options['theme']}/{$view}.php";

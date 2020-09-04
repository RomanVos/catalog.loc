<?php defined("CATALOG") or die("Access denied");

include 'main_controller.php';
include "models/{$view}_model.php";

if( isset($_SESSION['auth']['user']) ) redirect(PATH);

if( isset($_POST['fpass'])){
    forgot();
    redirect();
}
//якщо є ссилка на відновлення пароля
elseif(isset($_GET['forgot'])){
    access_change();
    $breadcrumbs = "<a href ='" . PATH ."'>Головна</a> / Відновлення пароля";
    include "views/{$options['theme']}/{$view}.php";
}

// відправлено новий пароль
elseif(isset($_POST['change_pass'])){
change_forgot_password();
redirect( PATH . "forgot/?forgot=" . $_POST['hash']);
}
else{
    redirect(PATH);
}

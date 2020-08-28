<?php defined("CATALOG") or die("Access denied");

function clear_hash(){
    if( isset($_COOKIE['hash'] ) ) {
        global $connection;
        $hash = mysqli_real_escape_string($connection, $_COOKIE['hash']);
        $query = "UPDATE users SET remember = '' WHERE `remember` = '$hash'";
        mysqli_query($connection, $query);
        setcookie('hash', '', time() - 3600);
    }
 }

<?php defined("CATALOG") or die("Access denied");

define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "root");
define("DB", "catalog");
define("PATH", "http://catalog.loc/");
define("PERPAGE", 5);

$option_perpage = array(5,10,15,20);

$connection = @mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die("Нет соединения с БД");
mysqli_set_charset($connection, "utf8") or die("Не установлена кодировка соединения");
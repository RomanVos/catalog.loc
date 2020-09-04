<?php defined("CATALOG") or die("Access denied");

define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "root");
define("DB", "catalog");
//define("PATH", "http://catalog.loc/");
//define("VIEW", "views/apple/");
define("PRODUCTIMG", "user_files/products/");
//define("PERPAGE", 6);

$option_perpage = array(5,10,15,20);

$connection = @mysqli_connect(DBHOST, DBUSER, DBPASS, DB) or die("No connection to DB");
mysqli_set_charset($connection, "utf8") or die("Connection encoding not set");
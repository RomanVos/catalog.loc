<?php defined("CATALOG") or die("Access denied");

include "models/main_model.php";
include 'models/logout_model.php';

clear_hash();
unset($_SESSION['auth']);
redirect();
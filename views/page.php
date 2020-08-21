<?php defined("CATALOG") or die("Access denied"); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php if( isset($breadcrumbs)) echo strip_tags($breadcrumbs)?></title>
    <link rel="stylesheet" href="<?=PATH?>views/style.css">
</head>
<body>
<div class="wrapper">

    <div class="sidebar">
        <?php include 'sidebar.php'?>
    </div>

    <div class="content">

        <?php include 'menu.php'?>

        <p><?php if( isset($breadcrumbs)) echo $breadcrumbs;?></p>
        <br>
        <hr>

        <?php if( isset($page['text'])) echo $page['text']?>
    </div>

</div>
<script src="<?=PATH?>views/js/jquery-1.9.0.min.js"></script>
<script src="<?=PATH?>views/js/jquery.accordion.js"></script>
<script src="<?=PATH?>views/js/jquery.cookie.js"></script>

<script src="<?=PATH?>views/js/workscript.js"></script>
</body>
</html>
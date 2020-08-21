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

        <h3>Відновлення пароля</h3>

        <!-- помилки зміни пароля -->
        <?php if( isset($_SESSION['forgot']['change_error']) ): ?>
            <div class="error"><?=$_SESSION['forgot']['change_error']?></div>
            <?php unset($_SESSION['forgot']); ?>

            <div class="form auth">
                <form action="<?=PATH?>forgot" method="post">
                    <p>
                        <label for="new_password">Новий пароль:</label>
                        <input type="text" name="new_password" id="new_password">
                    </p>
                    <input type="hidden" name="hash" value="<?=$_GET['forgot']?>">
                    <p class="submit">
                        <input type="submit" value="Змінити пароль" name="change_pass">
                    </p>
                </form>
            </div>

            <!-- пароль змінено -->
        <?php elseif( isset($_SESSION['forgot']['ok']) ): ?>
            <div class="ok"><?=$_SESSION['forgot']['ok']?></div>
            <?php unset($_SESSION['forgot']); ?>

        <!-- Помилки доступа на зміну пароля -->
        <?php elseif(isset($_SESSION['forgot']['errors'])): ?>
            <div class="error"><?=$_SESSION['forgot']['errors']?></div>
            <?php unset($_SESSION['forgot']['errors']); ?>

            <!-- тільки зайшли -->
        <?php else: ?>
            <div class="form auth">
                <form action="<?=PATH?>forgot" method="post">
                    <p>
                        <label for="new_password">Новий пароль:</label>
                        <input type="text" name="new_password" id="new_password">
                    </p>
                    <input type="hidden" name="hash" value="<?=$_GET['forgot']?>">
                    <p class="submit">
                        <input type="submit" value="Змінити пароль" name="change_pass">
                    </p>
                </form>
            </div>

        <?php endif; ?>

    </div>
</div>
<script src="<?=PATH?>views/js/jquery-1.9.0.min.js"></script>
<script src="<?=PATH?>views/js/jquery.accordion.js"></script>
<script src="<?=PATH?>views/js/jquery.cookie.js"></script>

<script src="<?=PATH?>views/js/workscript.js"></script>
</body>
</html>

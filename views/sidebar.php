<?php  defined("CATALOG") or die("Access denied"); ?>

<div class="form auth">
    <!-- Авторизація  -->
    <div id="auth">
        <?php if(!isset($_SESSION['auth']['user'])):?>
            <form action="<?=PATH?>login" method="post">
                <p>
                    <label for="login">Логін:</label>
                    <input type="text" name="login" id="login">
                </p>
                <p>
                    <label for="password">Пароль:</label>
                    <input type="password" name="password" id="password">
                </p>
                <p class="submit">
                    <input type="submit" value="Вхід" name="log_in">
                </p>
            </form>
                 <p><a href="<?=PATH?>reg">Реєстрація</a> | <a id="forgot-link" href="#">Забули пароль?</a></p>

                 <?php if( isset($_SESSION['auth']['errors'])): ?>
                <div class="error"><?=$_SESSION['auth']['errors']?></div>
                 <?php unset($_SESSION['auth']);?>
                <?php endif;?>

            <?php if( isset($_SESSION['auth']['ok'])): ?>
                <div class="ok"><?=$_SESSION['auth']['ok']?></div>
                <?php unset($_SESSION['auth']);?>
            <?php endif;?>

                <?php else: ?>
                <p>
                 Привіт <b><?=htmlspecialchars($_SESSION['auth']['user'])?>!</b>
                </p>
                <p><a href="<?=PATH?>logout">Вихід</a></p>
                 <?php endif; ?>
    </div>

    <!-- Відновлення пароля  -->
    <div id="forgot">
        <form action="<?=PATH?>forgot" method="post">
            <p>
                <label for="email">Email при реєстрації:</label>
                <input type="text" name="email" id="email">
            </p>
            <p class="submit">
                <input type="submit" value="Відправити пароль" name="fpass">
            </p>
        </form>
        <p><a id="auth-link" href="#">Вхід на сайт</a></p>
    </div>

</div>

<ul class="category">
    <?php if(isset($categories_menu)) echo $categories_menu ?>
</ul>
<?php require_once 'header.php' ?>

<div class="page-wrap"> <!-- class="page-wrap" -->

    <div id="auth">
    <form action="<?=PATH?>login" method="post">
        <ul class="auth-user">
            <li>
                <input name="login" type="text" class="login" placeholder="Введіть ваш логін" />
            </li>
            <li>
                <input name="password" type="password" class="password" placeholder="Введіть ваш пароль" />
            </li>
            <li>
                <input type="checkbox" name="remember"/> Запам'ятати?
            </li>
            <li>
                <input class="lisubmit" name="log_in" type="submit" value="Відправити" alt=""/>
            </li>
        </ul>
        <a id="forgot-link" href="#">Забули пароль?</a>
        <a href="<?=PATH?>registration">Зареєструватися</a>
    </form>
<?php if( isset($_SESSION['auth']['errors']) ) : ?>
    <div class="error"><?=$_SESSION['auth']['errors']?></div>
<?php unset($_SESSION['auth'])?>
<?php endif;?>
    </div>

</div> <!-- class="page-wrap" -->

<?php require_once 'footer.php' ?>

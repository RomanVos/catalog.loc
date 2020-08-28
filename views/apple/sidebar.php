<div class="sidebar-wrap"> <!-- class="sidebar-wrap" -->

    <div class="block-body"> <!-- class="block-body" -->
        <?php if(!isset($_SESSION['auth']['user'])): ?>
            <div class="block-title">Вхід</div>
        <?php else: ?>
            <div class="block-title">Міні-профіль</div>
        <?php endif; ?>

<div id="auth">
    <?php if(!isset($_SESSION['auth']['user'])): ?>
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
            <a href="<?=PATH?>reg">Зареєструватися</a>
        </form>

    <?php if( isset($_SESSION['auth']['errors'])): ?>
        <div class="error"><?=$_SESSION['auth']['errors']?></div>
        <?php unset($_SESSION['auth']);?>
    <?php endif;?>

    <?php if( isset($_SESSION['auth']['ok'])): ?>
       <div class="ok"><?=$_SESSION['auth']['ok']?></div>
        <?php unset($_SESSION['auth']);?>
    <?php endif;?>

    <?php else: ?>
       <p class="s1">
            Привіт <?=htmlspecialchars($_SESSION['auth']['user'])?>!
       </p>
        <p class="s1">Ви в групі: <?php if($_SESSION['auth']['is_admin']) echo 'Адміністратори'; else echo'Користувачі';?></p>
        <p><a href="<?=PATH?>logout">Вихід</a></p>
    <?php endif; ?>
</div> <!-- auth -->

  <!-- Відновлення пароля  -->
  <div id="forgot">
      <form action="<?PATH?>forgot" method="post">
      <ul class="auth-user">
          <li>
              <input type="text" name="email" id="email" class="login" placeholder="Введіть ваш email">
          </li>
          <li>
              <input type="submit" value="Відправити пароль" name="fpass">
          </li>
      </ul>
      </form>
      <p><a id="auth-link" href="#">Вхід на сайт</a></p>
  </div> <!-- Відновлення пароля  -->

    </div> <!-- class="block-body" -->

    <div class="block-body"> <!-- class="block-body" -->
        <div class="block-title">Каталог</div>
        <ul class="catalog">
            <?php echo $categories_menu;?>
        </ul>
    </div> <!-- class="block-body" -->

</div> <!-- class="sidebar-wrap" -->
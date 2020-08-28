<?php require_once 'header.php'?>


<div class="page-wrap"> <!-- class="page-wrap" -->

    <div class="content"> <!-- class="content" -->

        <ul class="breadcrumbs">
            <?=$breadcrumbs?>
        </ul>

        <div class="content-page">
            <h1 class="product_title">Відновлення пароля</h1>

            <!-- помилки зміни пароля -->
            <?php if( isset($_SESSION['forgot']['change_error']) ): ?>
            <div class="error"><?=$_SESSION['forgot']['change_error']?></div>
            <?php unset($_SESSION['forgot']); ?>

            <form action="<?=PATH?>forgot" method="post">
                <table width="730" border="0" cellspacing="2" cellpadding="0" class="regtable">
                    <tr>
                        <td>Новий пароль: <span style="color:red;">*</span></td>
                        <td><input type="text" name="new_password" /></td>
                    </tr>
                    <tr>
                        <input type="hidden" name="hash" value="<?=$_GET['forgot']?>">
                        <td>Поля позначені <span style="color:red;">*</span> обов'язкові для заповнення</td>
                        <td><input type="submit" value="Змінити пароль" name="change_pass" class="regbtn" /></td>
                    </tr>
                </table>
            </form>

                <!-- пароль змінений -->
            <?php elseif( isset($_SESSION['forgot']['ok']) ): ?>
                <div class="ok"><?=$_SESSION['forgot']['ok']?></div>
                <?php unset($_SESSION['forgot']); ?>

                <!-- помилки доступа на зміну пароля -->
            <?php elseif(isset($_SESSION['forgot']['errors'])): ?>
            <div class="error"><?=$_SESSION['forgot']['errors']?></div>
            <?php unset($_SESSION['forgot']['errors']); ?>

                <!-- тільки зайшли -->
            <?php else: ?>
            <form action="<?=PATH?>forgot" method="post">
                <table width="730" border="0" cellspacing="2" cellpadding="0" class="regtable">
                    <tr>
                        <td>Новий пароль: <span style="color:red;">*</span></td>
                        <td><input type="text" name="new_password" /></td>
                    </tr>
                    <tr>
                        <input type="hidden" name="hash" value="<?=$_GET['forgot']?>">
                        <td>Поля позначені <span style="color:red;">*</span> обов'язкові для заповнення</td>
                        <td><input type="submit" value="Змінити пароль" name="change_pass" class="regbtn" /></td>
                    </tr>
                </table>
            </form>

            <?php endif; ?>

            <div class="clr"></div>
        </div> <!-- class="content-page" -->

    </div> <!-- class="content" -->

    <?php require_once 'sidebar.php'?>

</div> <!-- class="page-wrap" -->

<?php require_once 'footer.php'?>

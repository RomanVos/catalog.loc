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

        <h3>Реєстрація</h3>

        <?php if (isset($_SESSION['reg']['success'])): ?>
            <div class="ok"><?=$_SESSION['reg']['success']?></div>

            <?php elseif (!isset($_SESSION['auth']['user'])): ?>
        <div class="form">
            <form action="<?=PATH?>reg" method="post">
                <p>
                    <label for="name_reg">Ім'я:</label>
                    <input type="text" name="name_reg" id="name_reg">
                </p>
                <p>
                    <label for="email_reg">Email:</label>
                    <input class="access" type="text" data-field="email" name="email_reg" id="email_reg">
                    <span></span>
                </p>
                <p>
                    <label for="login_reg">Логін:</label>
                    <input class="access" type="text" data-field="login" name="login_reg" id="login_reg">
                    <span></span>
                </p>
                <p>
                    <label for="password_reg">Пароль:</label>
                    <input type="password" name="password_reg" id="password_reg">
                </p>
                <p class="submit">
                    <input type="submit" value="Зареєструватись" name="reg">
                </p>
            </form>
        </div>

            <?php if(isset($_SESSION['reg']['errors'])): ?>
            <br><div class="error">
                <?=$_SESSION['reg']['errors']; ?>
            </div>
            <?php endif; ?>

        <?php endif; unset($_SESSION['reg']);?>
    </div>
</div>
<script src="<?=PATH?>views/js/jquery-1.9.0.min.js"></script>
<script src="<?=PATH?>views/js/jquery.accordion.js"></script>
<script src="<?=PATH?>views/js/jquery.cookie.js"></script>

<script>
    $(document).ready(function() {

        $(".access").change(function () {
            var $this = $(this);
            var val = $.trim($this.val());
            var dataField = $this.attr('data-field');
            var span = $this.next();

            if(val == ''){
                span.removeClass().addClass('reg-cross');
            }else{
                span.removeClass().addClass('reg-loader');
                $.ajax({
                    url: '<?=PATH?>reg',
                    type: 'POST',
                    data: {val: val, dataField: dataField},
                    success: function(res){
                        if(res == 'no'){
                            span.removeClass().addClass('reg-cross');
                        }else{
                            span.removeClass().addClass('reg-check');
                        }
                    }
                });
            }

        });
    });
</script>
<script src="<?=PATH?>views/js/workscript.js"></script>
</body>
</html>
<?php defined("CATALOG") or die("Access denied"); ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title><?php if( isset($breadcrumbs)) echo strip_tags($breadcrumbs)?></title>
	<link rel="stylesheet" href="<?=PATH?>views/style.css">
    <link rel="stylesheet" href="<?=PATH?>views/css/smoothness/jquery-ui-1.10.3.custom.min.css">
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
            <div id="testcolor">
            <?php $get_one_product = get_one_product($product_alias);
                 if($get_one_product): ?>
                <?= $get_one_product['title'] ."<br>PRICE = ". $get_one_product['price']."$"?>
            <?php else: ?>
                     <p>Такого товара немає</p>
            <?php endif;?>

            </div>
            <hr>
            <h3>Відгуки про товар (<?=$count_comments?>)</h3>

            <ul class="comments">
                <?php if(isset($comments)) echo $comments; ?>
            </ul>

            <button class="open-form">Додати відгук</button>

            <div id="form-wrap">
                <form action="<?=PATH?>add_comment" method="post" class="form">

                    <?php if( isset($_SESSION['auth']['user']) ): ?>
                        <p style="display: none;">
                            <label for="comment-author">Ім'я:</label>
                            <input type="text" name="comment-author" id="comment-author" value="<?=htmlspecialchars($_SESSION['auth']['user'])?>">
                        </p>
                    <?php else: ?>
                    <p><label for="comment-author">Ім'я:</label>
                        <input type="text" name="comment-author" id="comment-author">
                    </p>
                    <?php endif; ?>

                    <p>
                        <label for="comment-text">Текст:</label>
                        <textarea name="comment-text" id="comment-text" cols="30" rows="5"></textarea>
                    </p>

                    <input type="hidden" id="parent" name="parent" value="0">

                    <!--<p>
                        <input type="submit" value="Додати відгук" name="submit">
                    </p>-->
                </form>
            </div>

            <div id="loader"><span></span></div>
            <div id="errors"></div>

		</div>
	</div>
	<script src="<?=PATH?>views/js/jquery-1.9.0.min.js"></script>
    <script src="<?=PATH?>views/js/jquery-ui-1.10.3.custom.min.js"></script>
	<script src="<?=PATH?>views/js/jquery.accordion.js"></script>
	<script src="<?=PATH?>views/js/jquery.cookie.js"></script>

    <script>
        $(document).ready(function (){

            $('#errors').dialog({
                autoOpen: false,
                width: 450,
                modal: true,
                title: 'Повідомлення про помилку',
                show: {effect: 'clip', duration: 700},
                hide: {effect: 'scale', duration: 700}
            });

            $('#form-wrap').dialog({
               autoOpen: false,
               width: 450,
                modal: true,
                title: 'Додавання відгука',
                resizable: false,
                draggable: false,
                show: {effect: 'clip', duration: 700},
                hide: {effect: 'scale', duration: 700},
                buttons: {
                   "Додати відгук": function() {
                    var commentAuthor = $.trim($('#comment-author').val());
                    var commentText = $.trim($('#comment-text').val());
                    var parent = $('#parent').val();
                    var productID = <?=$product_id?>;
                    if(commentText == '' || commentAuthor == '') {
                        alert('Заповніть всі поля');
                        return;
                    }
                    $('#comment-text').val('');
                       $(this).dialog('close');

                       $.ajax({
                           url: '<?=PATH?>add_comment',
                           type: 'POST',
                           data: {commentAuthor: commentAuthor,
                                    commentText: commentText,
                                    parent: parent,
                                    productID: productID},
                           beforeSend: function() {
                               $('#loader').fadeIn();
                           },
                           success: function(res) {
                                var result = JSON.parse(res);
                                if(result.answer == 'Коментар додано'){
                                    //якщо коментар додано
                                    var showComment ='<li class="new-comment" id="comment-' + result.id + '">' + result.code + '</li>';
                                    if(parent == 0){
                                        //якщо це не відповідь
                                        $('ul.comments').append(showComment);
                                    }else{
                                        //якщо відповідь
                                        //знаходим предка li
                                        var parentComment = $this.closest('li');
                                        //дивимось чи є відповіді
                                        var childs = parentComment.children('ul');
                                        if(childs.length){
                                            //якщо відповіді є
                                            childs.append(showComment);
                                        }else{
                                            //якщо відповідей поки нема
                                            parentComment.append('<ul>' + showComment + '</ul>');
                                        }
                                    }
                                    $('#comment-'+result.id).delay(1000).show('shake', 1000);
                                }else{
                                    //якщо коментар не додано
                                    $('#errors').text(result.answer);
                                    $('#errors').delay(1000).queue(function (){
                                        $(this).dialog('open');
                                        $(this).dequeue();
                                    });
                                }

                           },
                           error: function () {
                               alert("Помилка!");
                           },
                           complete: function(){
                               $('#loader').fadeOut();
                           }
                       });

                   },
                    "Відмінити": function (){
                       $(this).dialog('close');
                        $('#comment_text').val('');
                    }
                }
            });

            $('.open-form').click(function (){
               $('#form-wrap').dialog('open');
               var parent = $(this).children().attr('data');
               $this = $(this);
               if(!parseInt(parent)) parent = 0;
               $('input[name="parent"]').val(parent);
            });

        });
    </script>
    <script src="<?=PATH?>views/js/workscript.js"></script>
</body>
</html>
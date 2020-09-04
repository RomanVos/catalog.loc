<?php require_once 'header.php'?>


<div class="page-wrap"> <!-- class="page-wrap" -->

    <div class="content"> <!-- class="content" -->

        <ul class="breadcrumbs">
            <?=$breadcrumbs?>
        </ul>

<?php if( is_array($result_search) ): ?>

    <?php foreach ($result_search as $product) : ?>

        <div class="product"> <!-- class="product" -->
            <h1><a href="<?=PATH?>product/<?=$product['alias']?>"><?=$product['title']?></a></h1>
            <div class="img-wrap">
                <img src="<?=PATH . PRODUCTIMG . $product['image']?>" alt="test" />
            </div>
            <p class="price">Ціна: <span><?=$product['price']?></span> $</p>
            <p class="views"><img align="center"  src="<?=PATH.VIEW?>img/views.jpg" alt="test" /> <span>680</span></p>
            <p class="comments"><img align="center" src="<?=PATH.VIEW?>img/comments.jpg" alt="" /> <span>61</span></p>
            <p class="permalink"><a href="<?=PATH?>product/<?=$product['alias']?>">детальніше</a></p>
        </div> <!-- class="product" -->

    <? endforeach;?>

    <div class="clr"></div>

    <?php if (isset($count_pages) && $count_pages > 1):?>
        <ul class="pagination">
            <?=$pagination?>
        </ul>
    <?php endif;?>

<?php else: ?>
    <p><b><?php echo $result_search;?></b></p>
<?php endif;?>

    </div> <!-- class="content" -->

    <?php require_once 'sidebar.php'?>

</div> <!-- class="page-wrap" -->

<?php require_once 'footer.php'?>

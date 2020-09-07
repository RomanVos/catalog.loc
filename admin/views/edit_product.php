<?php require_once 'header.php' ?>

<div class="page-wrap">
    <div class="content">
        <h1>Редагування товару</h1>
        <ul class="breadcrumbs">
            <?=$breadcrumbs_new?>
        </ul>
        <?php get_flash()?>
        <form class="form" action="" method="post">
            <div class="form-group col-md-10">
                <label for="title">Назва товару</label>
                <input type="text" class="form-control" id="title" name="title" value="<?=htmlspecialchars($get_one_product['title'])?>" required>
            </div>
            <div class="form-group col-md-10">
                <label for="price">Ціна:</label>
                <input class="form-control" type="text" name="price" id="price" value="<?= htmlspecialchars($get_one_product['price']) ?>" required>
            </div>
            <div class="form-group col-md-10">
                <label for="content">Категорія:</label>
                <select class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>

            <div class="preview">
                <img src="<?=SITE .'/'. PRODUCTIMG. $get_one_product['image']?>" alt="" width="150">
            </div>
            <div class="form-group col-md-10">
                <label for="content">Змінити зображення товару:</label>
                <div id="upload" class="upload"></div>
            </div>

            <div class="form-group col-md-10">
                <label for="content">Опис товару:</label>
                <textarea class="form-control editor" name="content" id="content"><?=$get_one_product['content']?></textarea>
            </div>
            <div class="clearfix"></div>

            <div class="col-md-10 text-right">
                <input type="hidden" name="id" value="<?=$get_one_product['id']?>">
                <input type="hidden" name="product_title" value="<?=$get_one_product['title']?>">
                <button type="submit" class="btn btn-success" name="edit_product">Змінити</button>
            </div>
        </form>
    </div>
    <div class="sidebar-wrap">
        <?php require_once 'sidebar.php';?>
    </div>
</div>

<?php require_once 'footer.php' ?>

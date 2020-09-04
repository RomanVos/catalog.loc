<?php require_once 'header.php' ?>

<div class="page-wrap">

    <div class="content">

        <h1>Список товарів</h1>
        <small>* Змініть налаштування і натисніть ENTER або клікніть поза полем вводу</small>
        <?php if($products): ?>

            <ul class="breadcrumbs">
                <?=$breadcrumbs_new?>
            </ul>
            <?php if (isset($count_pages) && $count_pages > 1):?>
                <ul class="pagination">
                    <?=$pagination?>
                </ul>
            <?php endif;?>

            <table class="zebra" data-table="edit-product">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Назва</th>
                    <th>Ціна</th>
                    <th>Редагувати</th>
                    <th>Видалити</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?=$product['id']?></td>
                        <td><?=$product['title']?></td>
                        <td>
                            <input type="text" data-id="<?=$product['id']?>" name="price" value="<?=$product['price']?>" class="edit-price">
                        </td>
                        <td>
                            <a href="<?=PATH?>edit-product/<?=$product['id']?>"><img src="<?=PATH?>views/img/edit.png" alt=""></a>
                        </td>
                        <td>
                            <img src="<?=PATH?>views/img/delete.png" class="del" data-id="<?=$product['id']?> alt="">
                        </td>
                    </tr>
                <?php endforeach;?>

                </tbody>
            </table>

            <?php if (isset($count_pages) && $count_pages > 1):?>
                <ul class="pagination">
                    <?=$pagination?>
                </ul>
            <?php endif;?>

        <?php else: ?>
            <p>В цій категорії товарів поки немає...</p>
        <?endif;?>
    </div>

    <div class="sidebar-wrap">
       <?php require_once 'sidebar.php';?>
    </div>
</div>

<?php require_once 'footer.php' ?>


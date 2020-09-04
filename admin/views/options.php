<?php require_once 'header.php' ?>

<div class="page-wrap">

    <div class="content">

    <h1>Налаштування сайта</h1>
    <small>* Змініть налаштування і натисніть ENTER або клікніть поза полем вводу</small>
    <table class="zebra" data-table="">
        <thead>
            <tr>
                <th>Налаштування</th>
                <th>Значення</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($get_options as $option) : ?>
            <tr>
            <td><?=$option['name']?></td>
            <td>
                <?php if($option['title'] == 'theme'): ?>
                    <select class="edit" name="theme">
                    <?php foreach($themes as $theme): ?>
                        <option value="<?=$theme?>"<?php if($theme == $option['value']) echo ' selected'?>><?=$theme?></option>
                    <?php endforeach;?>
                    </select>
                <?php else: ?>
                    <input type="text" name="<?=$option['title']?>" value="<?=$option['value']?>" class="edit">
                <?php endif;?>

            </td>
            </tr>
<?php endforeach;?>
        </tbody>
    </table>
    </div>
    <div class="sidebar-wrap">
        <?php require_once 'sidebar.php';?>
    </div>
</div>

<?php require_once 'footer.php' ?>

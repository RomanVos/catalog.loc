<?php defined("CATALOG") or die("Access denied"); ?>

<ul class="wrap">

    <?php if(isset($pages))?>
    <?php foreach ($pages as $link => $item_page): ?>
        <?php if($item_page === 'Головна'): ?>
            <li<?php if(isset($url)&&(!$url)) echo ' class="active"'?>><a href="<?php echo PATH?>"><?=$item_page?></a></li>
        <?php else: ?>
            <li<?php if(isset($page_alias) && $page_alias == $link) echo ' class="active"' ?>><a href="<?php echo PATH . 'page/' . $link; ?>"><?=$item_page?></a></li>
        <?php endif; ?>
    <?php endforeach;?>

</ul>
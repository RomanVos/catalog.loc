<?php  defined("CATALOG") or die("Access denied"); ?>

<li>

    <div class="comment-content<?php if ($category['is_admin']) echo ' manager';?>">
        <div class="comment_meta">
           <span>
               <b><?=htmlspecialchars($category['comment_author'])?></b></span>
            <?=$category['created']?>
        </div>
        <div>
            <?=nl2br(htmlspecialchars($category['comment_text']))?>
            <p class="open-form">
                <a class="reply" data="<?=$category['comment_id']?>">Відповісти</a>
            </p>
        </div>
    </div>
    <?php if( isset($category['childs']) && $category['childs']): ?>
        <ul>
            <?php echo categories_to_string($category['childs'], 'comments_template.php'); ?>
        </ul>
    <?php endif; ?>

</li>
<div class='comment-content<?php if($comment['is_admin']) echo ' manager'?>'>
    <div class='comment_meta'>
        <span><b>
            <?=htmlspecialchars($comment['comment_author'])?>
        </b></span>
            <?=$comment['created']?>
     </div>
        <div><?=nl2br(htmlspecialchars($comment['comment_text']))?></div>
</div>
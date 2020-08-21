<?php defined("CATALOG") or die("Access denied"); ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=strip_tags($breadcrumbs)?></title>
	<link rel="stylesheet" href="<?=PATH?>views/style.css">
</head>
<body>
	<div class="wrapper">

		<div class="sidebar">
			<?php include 'sidebar.php'?>
		</div>

		<div class="content">

            <?php include 'menu.php'?>

            <p><?php if (isset($breadcrumbs)) echo $breadcrumbs;?></p>
            <br>
            <hr>

            <div>
               <select name="perpage" id="perpage">
                    <?php if (isset($option_perpage)) foreach ($option_perpage as $option): ?>
                        <option <?php if(isset($perpage) && $perpage == $option) echo "selected";?>
                                value="<?=$option?>"><?=$option?> товарів на сторінку</option>
                    <?php endforeach;?>

                </select>
            </div>

            <?php if(isset ($products)): ?>

                <?php if( isset($count_pages) && $count_pages > 1 ): ?>
                    <div class="pagination"><?php if (isset($pagination)) echo $pagination;?></div>
                <?php endif;?>

                 <?php foreach($products as $product): ?>
                     <a href="<?=PATH?>product/<?=$product['alias']?>"><?=$product['title']?></a><br>
                 <?php endforeach;?>

                <?php if(isset($count_pages) && $count_pages > 1 ): ?>
                    <div class="pagination"><?php if(isset($pagination)) echo $pagination;?></div>
                <?php endif;?>

            <?php else: ?>
            <p>Тут товарів намає</p>
            <?php endif;?>
		</div>

	</div>
	<script src="<?=PATH?>views/js/jquery-1.9.0.min.js"></script>
	<script src="<?=PATH?>views/js/jquery.accordion.js"></script>
	<script src="<?=PATH?>views/js/jquery.cookie.js"></script>
       <script>
        $(document).ready(function(){
           $("#perpage").change(function (){
              var perPage = this.value; //$(this).val()
                $.cookie('per_page', perPage, {expires:7, path:"PATH"});
                window.location = location.href;
           });
        });
       </script>
        <script src="<?=PATH?>views/js/workscript.js"></script>
</body>
</html>
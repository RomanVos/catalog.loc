<div class="footer">
    <div class="menu"> <!-- class="menu" -->
        <?php require 'menu.php' ?>
    </div> <!-- class="/menu" -->
    <center>Різна додаткова інформація</center>
</div>

<script>
    var path = "<?=PATH?>";
    var search = "<?php if(isset($_GET['search']) ) echo htmlspecialchars($_GET['search']); else echo ''; ?>";
</script>

<script src="<?=$theme?>js/jquery-1.9.0.min.js"></script>
<script src="<?=$theme?>js/jquery-ui-1.10.4.custom.min.js"></script>
<script src="<?=$theme?>js/jquery.cookie.js"></script>
<script src="<?=$theme?>js/jquery.accordion.js"></script>
<script src="<?=$theme?>js/jquery.highlight.js"></script>
<script src="<?=$theme?>js/scripts.js"></script>

</body>
</html>

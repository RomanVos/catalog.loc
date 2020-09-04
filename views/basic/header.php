<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Каталог продукції Apple</title>
    <link rel="stylesheet" href="<?=$theme?>css/style.css" />
    <link rel="stylesheet" href="<?=$theme?>css/cupertino/jquery-ui-1.10.4.custom.css" />
</head>
<body>

<div class="header"> <!-- class="header" -->

    <div class="wrap"> <!-- class="wrap" -->

        <div class="logo">
            <h1>
                <a href="<?=PATH?>">Catalog<span>Apple</span></a>
            </h1>
            <p>Все для вашого <br /> яблучного смартфона</p>
        </div>

        <div class="slogan">
            Ласкаво просимо в католог аксесуарів
            <span>для продукції Aplle</span>
        </div>

        <form action="<?=PATH?>search/" method="get">
            <ul class="search">
                <li>
                    <input type="text" id="autocomplete" class="search" name="search" />
                </li>
                <li>
                    <input type="submit" class="search-go" name="go-search" value="пошук"  />
                </li>
            </ul>
        </form>

    </div> <!-- class="/wrap" -->

</div> <!-- class="/header" -->

<div class="menu"> <!-- class="menu" -->
  <?php require 'menu.php' ?>
</div> <!-- class="/menu" -->

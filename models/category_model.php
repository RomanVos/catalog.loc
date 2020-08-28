<?php defined("CATALOG") or die("Access denied");

/*
 отримання iD по аліасу
 */
function get_id($categories, $category_alias){
    if(!$category_alias) return false;
    foreach ($categories as $k => $v) {
        if($v['alias'] == $category_alias) return $k;
    }
    return false;
}

//отримання ID дочірніх категорій
function cats_id($array, $category_id){
    if(!$category_id) return false;

    $data = null;
    foreach($array as $item) {
        if($item['parent'] == $category_id){
            $data .= $item['id'] . ",";
            $data .= cats_id($array, $item['id']);
        }
    }
    return $data;
}
//отримання товарів
function get_products($ids, $start_pos, $perpage){
    global $connection;
    if($ids){
        $query = "SELECT * FROM products WHERE parent IN($ids) ORDER BY title LIMIT $start_pos, $perpage";
    }else{
        $query = "SELECT * FROM products ORDER BY title LIMIT $start_pos, $perpage";
    }
    $res = mysqli_query($connection, $query);
    $products = array();
    while ($row = mysqli_fetch_assoc($res)){
        $products[] = $row;
    }
    return $products;
}

//к-сть товарів
function get_count_goods($ids){
    global $connection;
    if(!$ids){
        $query = "SELECT COUNT(*) FROM products";
    }else{
        $query = "SELECT COUNT(*) FROM products WHERE parent IN($ids)";
    }
    $res = mysqli_query($connection, $query);
    $count_goods = mysqli_fetch_row($res);
    return $count_goods['0'];
}
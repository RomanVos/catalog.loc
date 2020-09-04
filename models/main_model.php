<?php defined("CATALOG") or die("Access denied");

//роздрук масива
function print_arr($array){
    echo "<pre>" . print_r($array, true) . "</pre>";
}

function get_options_use(){
    global $connection;
    $query = "SELECT * FROM options";
    $res = mysqli_query($connection, $query);
    while( $row = mysqli_fetch_assoc($res)) {
        $options[$row['title']] = $row['value'];
    }
    return $options;
}

/**
 * cookie перевірка авторизації
 **/
function check_remember(){
    // якщо користувач авторизований - виходим
    if( isset( $_SESSION['auth']['user'] ) ) return;
    // якщо користувач не запамятовувався
    if( !isset($_COOKIE['hash']) ) return;

    global $connection;
    $hash = mysqli_real_escape_string($connection, $_COOKIE['hash']);
    $query = "SELECT name, is_admin FROM users WHERE remember = '$hash'";
    $res = mysqli_query($connection, $query);
    if(mysqli_num_rows($res) == 1){
        $row = mysqli_fetch_assoc($res);
        $_SESSION['auth']['user'] = $row['name'];
        $_SESSION['auth']['is_admin'] = $row['is_admin'];
    }else{
        setcookie('hash', '', time() - 3600);
    }
}


function redirect($http = false){
    if($http) $redirect = $http;
    else $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    header("Location: $redirect");
    exit;
}

//отримання сторінок
function get_pages(){
    global $connection;
    $query = "SELECT title, alias FROM pages ORDER BY position";
    $res = mysqli_query($connection, $query);

    $pages = array();
    while($row = mysqli_fetch_assoc($res)){
        $pages[$row['alias']] = $row['title'];
    }
    return $pages;
}


//Отримання масива категорій
function get_cat(){
    global $connection;
    $query = "SELECT * FROM categories";
    $res = mysqli_query($connection, $query);

    $arr_cat = array();
    while($row = mysqli_fetch_assoc($res)){
        $arr_cat[$row['id']] = $row;
    }
    return $arr_cat;
}

//побудова дерева
function map_tree($dataset) {
    $tree = array();

    foreach ($dataset as $id=>&$node) {
        if (!$node['parent']){
            $tree[$id] = &$node;
        }else{
            $dataset[$node['parent']]['childs'][$id] = &$node;
        }
    }
    return $tree;
}

//дерево в строку HTML
function categories_to_string($data, $template = 'category_template.php'){
    $string = null;
    foreach($data as $item){
        $string .= categories_to_template($item, $template);
    }
    return $string;
}
//шаблон виводу категорій
function categories_to_template($category, $template){
    ob_start();
    include "views/{$template}";
    return ob_get_clean();
}


//посторінкова навігація
function pagination($page, $count_pages, $modrew = true)
{
    // << < 3 4 5 6 7 > >>
    $back = null;//НАЗАД
    $forward = null;//ВПЕРЕД
    $startpage = null;//НА ПОЧАТОК
    $endpage = null;//В КІНЕЦЬ
    $page2left = null;//2 СТОРІНКИ ВЛІВО
    $page1left = null;//1 СТОРІНКА ВЛІВО
    $page2right = null;//2 СТОРІНКИ ВПРАВО
    $page1right = null;//1 СТОРІНКА ВПРАВО

    $uri = "?";
    if (!$modrew) {
        // якщо є параметри в запросі
        if ($_SERVER['QUERY_STRING']) {
            foreach ($_GET as $key => $value) {
                if ($key != 'page') $uri .= "{$key}=$value&amp;";
            }
        }
    } else {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode("?", $url);
        if (isset($url[1]) && $url[1] != '') {
            $params = explode("&", $url[1]);
            foreach ($params as $param) {
                if (!preg_match("#page=#", $param)) $uri .= "{$param}&amp;";
            }
        }
    }

    if( $page > 1 ){
        $back = "<li><a class='nav-link' href='{$uri}page=" .($page-1). "'>Назад</a></li>";
    }
    if( $page < $count_pages ){
        $forward = "<li><a class='nav-link' href='{$uri}page=" .($page+1). "'>Вперед</a></li>";
    }
    if( $page > 3 ){
        $startpage = "<li><a class='nav-link' href='{$uri}page=1'>На початок</a></li>";
    }
    if( $page < ($count_pages - 2) ){
        $endpage = "<li><a class='nav-link' href='{$uri}page={$count_pages}'>В кінець</a></li>";
    }
    if( $page - 2 > 0 ){
        $page2left = "<li><a class='nav-link' href='{$uri}page=" .($page-2). "'>" .($page-2). "</a></li>";
    }
    if( $page - 1 > 0 ){
        $page1left = "<li><a class='nav-link' href='{$uri}page=" .($page-1). "'>" .($page-1). "</a></li>";
    }
    if( $page + 1 <= $count_pages ){
        $page1right = "<li><a class='nav-link' href='{$uri}page=" .($page+1). "'>" .($page+1). "</a></li>";
    }
    if( $page + 2 <= $count_pages ){
        $page2right = "<li><a class='nav-link' href='{$uri}page=" .($page+2). "'>" .($page+2). "</a></li>";
    }

    return $startpage.$back.$page2left.$page1left.'<li class="active-page">'.$page.'</li>'.$page1right.$page2right.$forward.$endpage;
}

//хлібні крошки
function breadcrumbs($array, $category_id){
    if(!$category_id) return false;

    $count = count($array);
    $breadcrumbs_array = array();
    for($i = 0; $i < $count; $i++){
        if( isset($array[$category_id])) {
            $breadcrumbs_array[$array[$category_id]['alias']] = $array[$category_id]['title'];
            $category_id = $array[$category_id]['parent'];
        }else break;
    }
    return array_reverse($breadcrumbs_array, true);
}
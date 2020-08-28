<?php defined("CATALOG") or die("Access denied");

//додавання коментаря
function add_comment(){
    global $connection;
    $comment_author = trim(mysqli_real_escape_string($connection, $_POST['commentAuthor']));
    $comment_text = trim(mysqli_real_escape_string($connection, $_POST['commentText']));
    $parent = (int)$_POST['parent'];
    $comment_product = (int)$_POST['productID'];
    $is_admin = isset($_SESSION['auth']['is_admin']) ? $_SESSION['auth']['is_admin'] : 0;

    //якщо нема ID товара
    if(!$comment_product){
        $res = array('answer' => 'Невідомий продукт');
        return json_encode($res);
    }
    //Якщо не заповнені поля
    if(empty($comment_author) OR empty($comment_text)) {
        $res = array('answer' => 'Заповніть всі поля');
        return json_encode($res);
    }

    $query = "INSERT INTO comments (comment_author, comment_text, parent, comment_product, is_admin)
                     VALUES ('$comment_author', '$comment_text', $parent, $comment_product, $is_admin)";
    $res = mysqli_query($connection, $query);
    if(mysqli_affected_rows($connection) > 0) {
        $comment_id = mysqli_insert_id($connection);
        $comment_html = get_last_comment($comment_id);
        return $comment_html;
    }else{
        $res = array('answer' => 'Помилка додавання коментаря');
        return json_encode($res);
    }

}
//Отримання доданого коментаря
function get_last_comment($comment_id) {
    global $connection;
    $query = "SELECT * FROM comments WHERE comment_id = $comment_id";
    $res = mysqli_query($connection, $query);
    $comment = mysqli_fetch_assoc($res);
    ob_start();
    include VIEW . 'new_comment.php';
    $comment_html = ob_get_clean();

    $res = array('answer' => 'Коментар додано', 'code' => $comment_html, 'id' => $comment_id);
    return json_encode($res);
}

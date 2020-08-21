<?php defined("CATALOG") or die("Access denied");

//Авторизація
function authorization(){
    global $connection;
    $login =  trim(mysqli_real_escape_string($connection, $_POST['login']));
    $password = trim($_POST['password']);
    if( empty($login) OR empty($password) ) {
        $_SESSION['auth']['errors'] = 'Поля Логін/Пароль обов\'язкові для заповнення';
    }else{
        $password = md5($password);
        $query = "SELECT `name`, is_admin FROM users WHERE login = '$login' AND password = '$password' LIMIT 1";
        $res = mysqli_query($connection, $query);
        if(mysqli_num_rows($res) == 1){
            $row = mysqli_fetch_assoc($res);
            $_SESSION['auth']['user'] = $row['name'];
            $_SESSION['auth']['is_admin'] = $row['is_admin'];
        }else{
            $_SESSION['auth']['errors'] = 'Логін або Пароль введені невірно';
        }
    }
}

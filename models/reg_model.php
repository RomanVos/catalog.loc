<?php defined("CATALOG") or die("Access denied");

function access_field() {
    global $connection;
    $fields = array('login', 'email');
    $val = trim(mysqli_real_escape_string($connection, $_POST['val']));
    $field = $_POST['dataField'];

    if(!in_array($field, $fields)) {
        return 'no';
    }
    $query = "SELECT id FROM users WHERE $field = '$val'";
    $res = mysqli_query($connection, $query);
    if(mysqli_num_rows($res) > 0){
        return "no";
    }else{
        return "yes";
    }
}

function registration() {
    global $connection;
    $errors = '';
    $fields = array('login' => 'Логін', 'email' => 'Email');
    $login = trim($_POST['login_reg']);
    $password = trim($_POST['password_reg']);
    $name = trim($_POST['name_reg']);
    $email = trim($_POST['email_reg']);
    $post = array($login, $email);

    if(empty($login)) $errors .= '<li>Не введений Логін</li>';
    if(empty($password)) $errors .= '<li>Не введений Пароль</li>';
    if(empty($name)) $errors .= '<li>Не введений Ім\'я</li>';
    if(empty($email)) $errors .= '<li>Не введений Email</li>';

    if(!empty($errors)){
        // не заповнені обовязкові поля
        $_SESSION['reg']['errors']  = "Не заповнені обовязкові поля: <ul>{$errors}</ul>";
        return;
    }
    $login = mysqli_real_escape_string($connection, $login);
    $password = md5($password);
    $name = mysqli_real_escape_string($connection, $name);
    $email = mysqli_real_escape_string($connection, $email);

    // перевірка дублювання данних
    $query = "SELECT login, email FROM users WHERE login = '$login' OR email = '$email'";
    $res = mysqli_query($connection, $query);
    if(mysqli_num_rows($res) > 0){
        $data = array();
        while($row = mysqli_fetch_assoc($res)){
            //берем те що співпадає зі змістом $_POST,тобто дублікат
            $data = array_intersect($row, $post);
            foreach($data as $k => $v){
                $keys[$k] = $k;
            }
        }
        foreach($keys as $key =>$val){
            $errors .= "<li>{$fields[$key]}</li>";
        }
        $_SESSION['reg']['errors'] = "Виберіть інші значення для полів: <ul>{$errors}</ul>";
    }

    $query = "INSERT INTO users (login, password, email, `name`)
                VALUES('$login', '$password', '$email', '$name')";
    $res = mysqli_query($connection, $query);
    if(mysqli_affected_rows($connection) > 0 ){
        $_SESSION['reg']['success'] = "Реєстрація пройшла успішно";
        $_SESSION['auth']['user'] = stripslashes($name);
        $_SESSION['auth']['is_admin'] = 0;
    }else{
        $_SESSION['reg']['errors'] = "Помилка реєстрації";
    }

}

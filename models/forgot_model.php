<?php defined("CATALOG") or die("Access denied");

//початок відновлення пароля
function forgot() {
    global $connection;
    $email = trim(mysqli_real_escape_string($connection, $_POST['email']));
    if( empty($_POST['email'])){
        $_SESSION['auth']['errors'] = 'Поле email не заповнено';
    }else{
        $query = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
        $res = mysqli_query($connection, $query);
        if(mysqli_num_rows($res) == 1){
            $expire = time() + 3600;
            $hash = md5($expire . $email);
            $query = "INSERT INTO forgot (hash, expire, email)
                        VALUES ('$hash', $expire, '$email')";
            $res = mysqli_query($connection, $query);

            if(mysqli_affected_rows($connection) > 0){
                //якщо доданий запис в таблицю forgot
                $link = PATH . "forgot/?forgot={$hash}";
                $subject = "Запит на відновлення пароля на сайті " . PATH;
                $body = "За ссилкою <a href='{$link}'>{$link}</a> ви знайдете сторінку з формою де зможете ввести новий пароль. Ссилка активна протягом 1-ї години.";
                $headers = "FROM: " . strtoupper($_SERVER['SERVER_NAME']) . "\r\n";
                $headers .= "Content-type:text-html; charset=utf-8";
                mail($email, $subject, $body, $headers);

                $_SESSION['auth']['ok'] = 'На ваш email відправлена інструкція по відновленні пароля';
            }else{
                $_SESSION['auth']['errors'] = 'Помилка!';
            }
        }else{
            $_SESSION['auth']['errors'] = 'Користувач з таким email не знайдений';
        }
    }
}

//провірка користувача на право зміни пароля
function access_change(){
    global $connection;
    $hash = trim(mysqli_real_escape_string($connection, $_GET['forgot']));
    //якщо нема хеша
    if (empty($hash)) {
        $_SESSION['forgot']['errors'] = 'Перейдіть по корректній ссилці';
        return;
    }

    $query = "SELECT * FROM forgot WHERE hash = '$hash' LIMIT 1";
    $res = mysqli_query($connection, $query);
    // якщо не знайдено hash
    if(!mysqli_num_rows($res)){
        $_SESSION['forgot']['errors'] = 'Ссилка застаріла або ви перейшли по некоректній ссилці. Пройдіть процедуру відновлення пароля знову.';
        return;
    }

    $now = time();
    $row = mysqli_fetch_assoc($res);

    // Якщо ссилка застаріла
    if($row['expire'] - $now < 0){
        $_SESSION['forgot']['errors'] = 'Ссилка застаріла. Пройдіть процедуру відновлення пароля знову.';
        return;
    }
}

//зміна пароля
function change_forgot_password(){
    global $connection;
    $hash = trim(mysqli_real_escape_string($connection, $_POST['hash']));
    $password = trim($_POST['new_password']);

    if( empty($password) ){
        $_SESSION['forgot']['change_error'] = "Пароль не введений";
        return;
    }

    $query = "SELECT * FROM forgot WHERE hash = '$hash' LIMIT 1";
    $res = mysqli_query($connection, $query);
    // якщо не знайдений hash
    if(!mysqli_num_rows($res)) return;

    $now = time();
    $row = mysqli_fetch_assoc($res);

    // якщо ссилка застаріла
    if($row['expire'] - $now < 0){
        mysqli_query($connection, "DELETE FROM forgot WHERE expire < $now");
        return;
    }

    $password = md5($password);
    mysqli_query($connection, "UPDATE users SET password = '$password' WHERE email = '{$row['email']}'");
    mysqli_query($connection, "DELETE FROM forgot WHERE email = '{$row['email']}'");
    $_SESSION['forgot']['ok'] = "Ви успішно змінили пароль. Тепер можете авторизуватись.";
}
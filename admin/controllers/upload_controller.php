<?php defined("CATALOG") or die("Access denied");

require_once "models/{$view}_model.php";

if ( !empty($_FILES)){
    if(isset($_FILES['file'])) {
        $file = 'file';
    }elseif (isset($_FILES['files'])) {
        $file = 'files';
    }else{
        $res = ['answer' => 'error', 'error' => 'Некоректне ім\'я файлу в формі'];
        exit(json_encode($res));
    }

    $path = __DIR__. '/../../user_files/products/';

    $new_name = uploadImg($file, $path, 216, 313);
    if($file == 'file'){
        $_SESSION['file'] = $new_name;
    }else{
        $_SESSION['files'][] = $new_name;
    }
    $res = array("answer" => "ok", "file" => $new_name);
    exit(json_encode($res));
}

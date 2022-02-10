<?php
/**
 * @var $db это переменная из подключаемого файла db.php
 */
session_start();

require "./db.php";

$errors = array();

if($_POST['email']===''){
    $errors[] = 'auth-email';
}

if($_POST['password']===''){
    $errors[] = 'auth-password';
}

if(!empty($errors)){
    $response = [
        "status"=>false,
        "type"=>1,
        "message"=>"Field Validity Requirement",
        "fields" => $errors
    ];

    echo json_encode($response);

    die();
}

$query = $db->prepare("SELECT * FROM users WHERE `email` = ?");
$query->execute([$_POST['email']]);

$user = $query->fetch(PDO::FETCH_LAZY);

if ($user) {
    if (password_verify($_POST['password'], $user['password']) && !empty($_POST['rememberMe'])) {
        $_SESSION['user'] = [
            "id" => $user['id'],
            "name" => $user['name'],
            "surname" => $user['surname'],
            "email" => $user['email']
        ];

        $response = [
            "status" => true,
            "message" => 'User success sign in'
        ];

        echo json_encode($response);
    } else if(password_verify($_POST['password'], $user['password']) && empty($_POST['rememberMe'])){

        $response = [
            "status" => true,
            "message" => 'User success sign in but not remembered'
        ];

        echo json_encode($response);
    }else {
        $response = [
            "status" => false,
            "message" => 'Password or email entered incorrectly'
        ];

        echo json_encode($response);
    }
}
?>
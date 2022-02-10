<?php
/**
 * @var $db это переменная из подключаемого файла db.php
 */

require_once 'db.php';

if ($_GET['token']) {
    $query = $db->prepare("SELECT * FROM users WHERE `token` = ?");
    $query->execute([$_GET['token']]);

    $user = $query->fetch(PDO::FETCH_LAZY);

    if ($user) {
        if ($user['verify'] !== 0) {

            $verify = 1;
            $token = null;
            $email = $user['email'];

            $query = "UPDATE `users` SET `token` = :token,`verify` = :verify WHERE `email` = :email";
            $params = [
                ':token' => $token,
                ':verify' => $verify,
                ':email' => $email
            ];

            $stmt = $db->prepare($query);
            $stmt->execute($params);

            echo "Email verified";
        } else {
            echo "Email already verified";
        }
    }
} else {
    echo "Something went wrong";
}
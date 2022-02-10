<?php
/**
 * @var $db это переменная из подключаемого файла db.php
 */

require("../libs/PHPMailer-master/src/PHPMailer.php");
require("../libs/PHPMailer-master/src/SMTP.php");

require "./db.php";

$errors = [];

if (trim($_POST['name']) === '') {
    $errors[] = "name";
}

if (trim($_POST['surname']) === '') {
    $errors[] = "surname";
}

if (trim($_POST['password']) === '') {
    $errors[] = "password";
}

if ($_POST['password'] != $_POST['confirmpass']) {
    $errors[] = "confirmpass";
}

if ($_POST['email'] === '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'email';
}

if (!empty($errors)) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "Check if the fields are correct",
        "fields" => $errors
    ];

    echo json_encode($response);

    die();
}

$query = $db->prepare("SELECT * FROM users WHERE `email` = ?");
$query->execute([$_POST['email']]);

$user = $query->fetch(PDO::FETCH_LAZY);

if ($user) {
    $response = [
        "status" => false,
        "type" => 1,
        "message" => "This email already exists",
        "fields" => ['email']
    ];

    echo json_encode($response);

    die();
}

if ($_POST['password'] === $_POST['confirmpass']) {
    $command = $db->prepare("INSERT INTO `users` (`email`,`token`,`password`,`name`,`surname`) VALUES (?,?,?,?,?)");

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $token = md5($email . time());
    $name = $_POST['name'];
    $surname = $_POST['surname'];

    $command->execute([$email, $token, $password, $name, $surname]);

    //Use your services to send messages, I used mailtrap;

    $phpmailer = new PHPMailer\PHPMailer\PHPMailer();
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.mailtrap.io';
    $phpmailer->CharSet = 'UTF-8';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = '';
    $phpmailer->Password = '';
    $phpmailer->IsHTML(true);
    $phpmailer->SetFrom('');
    $phpmailer->Subject = "Verify account";
    $phpmailer->AddAddress($email);

    $body = '
                <html>
                <head>
                <title>Подтвердите Email</title>
                </head>
                <body>
                <p>Что бы подтвердить Email, перейдите по <a href="http://localhost/RegAndAuth/vendor/emailVerify.php?token=' . $token . '">ссылка</a></p>
                </body>
                </html>
                ';

    $phpmailer->Body = $body;

    if (!$phpmailer->Send()) {
        $response = [
            "status" => false,
            "message" => "Mailer Error: " . $phpmailer->ErrorInfo,
        ];

        echo json_encode($response);
    } else {
        $response = [
            "status" => true,
            "message" => "Message has been send",
        ];

        echo json_encode($response);
    }

} else {
    $response = [
        "status" => false,
        "message" => "Password mismatch",
    ];

    echo json_encode($response);

    die();
}

?>

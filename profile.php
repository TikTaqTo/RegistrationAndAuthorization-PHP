<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <form>
        <h2 style="margin: 10px 0;"><?= $_SESSION['user']['name'] ?></h2>
        <h2 style="margin: 10px 0;"><?= $_SESSION['user']['surname'] ?></h2>
        <a href="#"><?= $_SESSION['user']['email'] ?></a>
        <a href="vendor/logout.php" class="logout">Выход</a>
    </form>
</body>
</html>
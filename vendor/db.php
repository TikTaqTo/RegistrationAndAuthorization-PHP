<?php
try {
    //Enter db name and password
    $db = new PDO("mysql:host=localhost;dbname=;charset=utf8", 'root', '');
}
catch(PDOException $e) {
    echo $e->getMessage();
}
?>
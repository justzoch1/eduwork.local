<?php

$site_title = "ГБПОУ РО 'КТСИА'";
$db_host = "localhost";
$db_name = "edudb";
$db_user = "root";
$db_password = "";

try {
    // Подключение к базе данных MySQL
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name;user=$db_user;password=$db_password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}

?>
<?php

$site_title = "ГБПОУ РО 'КТСИА'";
$db_host = "localhost";
$db_name = "edudb";
$db_user = "postgres";
$db_password = "111";

try {
    // Подключение к базе данных PostgreSQL с помощью драйвера PDO_PGSQL
    $conn = new PDO("pgsql:host=$db_host;dbname=$db_name;user=$db_user;password=$db_password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}


?>
<?php
session_start();
include '..\config.php';

try {
    if (!$conn) {
        throw new Exception("Failed to connect to database.");
    }

    if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'teacher')) {
        header('Location: ../user/auth/login.php');
        exit();
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<?php include '..\includes\header.php'; ?>


<script src="../assets/js/header.js"></script>

<h2>Панель администратора</h2>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link" href="#" onclick="showContent('home')">Приветствие</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" onclick="showContent('news')">Новости</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" onclick="showContent('groups')">Группы</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" onclick="showContent('students')">Студенты</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" onclick="showContent('teachers')">Преподаватели</a>
    </li>
</ul>

<div id="home" class="container mt-4">
    <h3>Добро пожаловать в панель администратора</h3>
    <p>Здесь будет содержимое выбранной страницы.</p>
</div>

<?php 

require_once('../admin/lists/news.php');
require_once('../admin/lists/group.php');
require_once('../admin/lists/student.php');
require_once('../admin/lists/teacher.php');

?>

<script src="../assets/js/module.js"></script>
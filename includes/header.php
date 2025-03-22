<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_url = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $site_title; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.tiny.cloud/1/3nk4l5fxymdn0ceq5hkucjvk88vzh4zlnb4idbe1dq96a6hu/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/"><?php echo $site_title; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto ml-auto justify-content-center">
                <li class="nav-item <?php if ($current_url == '/') echo 'active'; ?>">
                    <a class="nav-link" href="/eduwork.local/">Главная</a>
                </li>
                <li class="nav-item dropdown <?php if (strpos($current_url, '/eduwork.local/content/student_list') !== false || strpos($current_url, '/eduwork.local/content/teacher_list') !== false) echo 'active'; ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Списки
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/eduwork.local/user/lists/students">Студенты</a>
                        <a class="dropdown-item" href="/eduwork.local/user/lists/teachers">Преподаватели</a>
                        <a class="dropdown-item" href="/eduwork.local/user/lists/groups">Группы</a>
                    </div>
                </li>
                <li class="nav-item dropdown <?php if (strpos($current_url, '/eduwork.local/content/student_list') !== false || strpos($current_url, '/eduwork.local/content/teacher_list') !== false) echo 'active'; ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Материалы
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/eduwork.local/user/documents/materials/Журнал_по_воспитательной_работе">Журнал по воспитательной работе</a>
                        <a class="dropdown-item" href="/eduwork.local/user/documents/materials/Тематическое_планирование">Тематическое планирование Разговоры о важном</a>
                        <a class="dropdown-item" href="/eduwork.local/user/documents/materials/Педагогическая_характеристика">Педагогическая характеристика</a>
                        <a class="dropdown-item" href="/eduwork.local/user/documents/materials/Социальный_паспорт">Социальный паспорт</a>
                        <a class="dropdown-item" href="/eduwork.local/user/documents/materials/Активность_групп">Активность групп</a>
                        <a class="dropdown-item" href="/eduwork.local/user/documents/materials/Памятка_для_родителей">Памятка для родителей</a>
                        <a class="dropdown-item" href="/eduwork.local/user/documents/materials/Протокол_родительского_собрания">Протокол родительского собрания</a>
                    </div>
                </li>
                <li class="nav-item dropdown <?php if (strpos($current_url, '/eduwork.local/content/student_list') !== false || strpos($current_url, '/eduwork.local/content/teacher_list') !== false) echo 'active'; ?>">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Мероприятия
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/eduwork.local/user/documents/events/План_работы">План работы</a>
                        <a class="dropdown-item" href="/eduwork.local/user/documents/events/План_на_учебные_сборы">План на учебные сборы</a>
                        <a class="dropdown-item" href="/eduwork.local/user/documents/events/Отчет_воспитательной_работы">Отчет воспитательной работы</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <a class="nav-link" href="/eduwork.local/admin/admin_panel">Панель управления</a>
                        <?php elseif ($_SESSION['role'] == 'teacher'): ?>
                            <a class="nav-link" href="/eduwork.local/index">Главная</a>
                        <?php endif; ?>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/eduwork.local/modules/auth/autorize/logout">Выйти</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/eduwork.local/modules/auth/autorize/login">Авторизация</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">

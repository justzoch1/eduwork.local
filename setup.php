<?php

// Запустив этот файл по запроу /eduwork.local/setup.php вы создатите базу данных( не забудьте указать имя бд в config.php)

include 'config.php';

try {
    $sql = "CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    role TEXT NOT NULL
)";
    $conn->exec($sql);
    echo "Таблица users создана успешно.<br>";

    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = 'admin'");
    $stmt->execute();
    if ($stmt->fetchColumn() == 0) {
        $admin_password = password_hash('admin', PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, role) VALUES ('admin', '$admin_password', 'admin')";
        $conn->exec($sql);
        echo "Администратор добавлен успешно.<br>";
    }

    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = 'teacher'");
    $stmt->execute();
    if ($stmt->fetchColumn() == 0) {
        $teacher_password = password_hash('teacher', PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, role) VALUES ('teacher', '$teacher_password', 'teacher')";
        $conn->exec($sql);
        echo "Преподаватель добавлен успешно.<br>";
    }

    $sql = "CREATE TABLE IF NOT EXISTS students (
        id SERIAL PRIMARY KEY ,
        last_name TEXT NOT NULL,
        first_name TEXT NOT NULL,
        middle_name TEXT NOT NULL,
        birth_date TEXT NOT NULL,
        gender TEXT NOT NULL,
        address TEXT NOT NULL,
        phone TEXT NOT NULL,
        email TEXT NOT NULL,
        group_number TEXT NOT NULL,
        enrollment_date TEXT NOT NULL,
        graduation_date TEXT NOT NULL,
        role TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->exec($sql);
    echo "Таблица students создана успешно.<br>";

    $sql = "CREATE TABLE IF NOT EXISTS teachers (
        id SERIAL PRIMARY KEY ,
        last_name TEXT NOT NULL,
        first_name TEXT NOT NULL,
        middle_name TEXT NOT NULL,
        birth_date TEXT NOT NULL,
        gender TEXT NOT NULL,
        address TEXT NOT NULL,
        phone TEXT NOT NULL,
        email TEXT NOT NULL,
        employment_date TEXT NOT NULL,
        position TEXT NOT NULL,
        role TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->exec($sql);
    echo "Таблица teachers создана успешно.<br>";

    $sql = "CREATE TABLE IF NOT EXISTS groups (
        id SERIAL PRIMARY KEY ,
        number_group TEXT NOT NULL,
        number_students TEXT NOT NULL,
        enrollment_year TEXT NOT NULL,
        graduation_year TEXT NOT NULL,
        classroom_teacher TEXT NOT NULL,
        role TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->exec($sql);
    echo "Таблица groups создана успешно.<br>";

    $sql = "CREATE TABLE IF NOT EXISTS uploads (
        id SERIAL PRIMARY KEY,
        file_name TEXT NOT NULL,
        file_description TEXT NOT NULL,
        file_path TEXT NOT NULL,
        uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        theme TEXT
    )";
    $conn->exec($sql);
    echo "Таблица uploads создана успешно.<br>";

    $sql = "CREATE TABLE IF NOT EXISTS news (
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    description TEXT NOT NULL,
    full_description TEXT NOT NULL
    )";
    $conn->exec($sql);
    echo "Таблица news создана успешно.<br>";

    // Добавление значений в таблицы
    $sql = "INSERT INTO students (last_name, first_name, middle_name, birth_date, gender, address, phone, email, group_number, enrollment_date, graduation_date, role) 
            VALUES ('Иванов', 'Иван', 'Иванович', '1995-05-15', 'М', 'ул. Ленина, д.10', '+79123456789', 'ivanov@mail.com', 'IT-101', '2020-09-01', '2024-06-30', 'student'),
                   ('Петров', 'Петр', 'Петрович', '1996-03-20', 'М', 'ул. Пушкина, д.5', '+79234567890', 'petrov@mail.com', 'IT-102', '2021-09-01', '2025-06-30', 'student')";
    $conn->exec($sql);
    echo "Студенты добавлены успешно в таблицу students.<br>";

    $sql = "INSERT INTO teachers (last_name, first_name, middle_name, birth_date, gender, address, phone, email, employment_date, position, role) 
            VALUES ('Сидоров', 'Сидор', 'Сидорович', '1980-12-10', 'М', 'ул. Лесная, д.15', '+79345678901', 'sidorov@mail.com', '2005-09-01', 'Профессор', 'teacher'),
                   ('Иванова', 'Мария', 'Ивановна', '1985-07-25', 'Ж', 'ул. Маяковского, д.20', '+79456789012', 'ivanova@mail.com', '2010-08-01', 'Доцент', 'teacher')";
    $conn->exec($sql);
    echo "Преподаватели добавлены успешно в таблицу teachers.<br>";

    $sql = "INSERT INTO groups (number_group, number_students, enrollment_year, graduation_year, classroom_teacher, role)
            VALUES ('IT-101', '30', '2020', '2024', 'Сидоров', 'group'),
                   ('IT-102', '25', '2021', '2025', 'Иванова', 'group')";
    $conn->exec($sql);
    echo "Группы добавлены успешно в таблицу groups.<br>";

    $sql = "INSERT INTO uploads (file_name, file_description, file_path, theme)
            VALUES ('Презентация1', 'Презентация для занятия', '/uploads/presentation1.pptx', 'Обучение'),
                   ('Решения задач', 'Методички для студентов', '/uploads/exercises.pdf', 'Практика')";
    $conn->exec($sql);
    echo "Файлы добавлены успешно в таблицу uploads.<br>";

    $sql = "INSERT INTO news (name, description, full_description)
            VALUES ('Новость 1', 'Важное объявление', 'Уважаемые студенты! Важное событие состоится в следующий четверг.'),
                   ('Новость 2', 'Информация о событии', 'Дорогие преподаватели! Напоминаем, что встреча планируется на понедельник.')";
    $conn->exec($sql);
    echo "Новости добавлены успешно в таблицу news.<br>";

} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}

$conn = null;
?>

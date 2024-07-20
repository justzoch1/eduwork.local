-- Создание таблицы users
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    role TEXT NOT NULL
);

-- Проверка наличия пользователя admin и добавление его, если он отсутствует
INSERT INTO users (username, password, role)
SELECT 'admin', '$2y$10$iFg8uV2W9vM6pGZQidJ5MOeJDuGTu7IjreF34YOtJEq5VDpKJBwVy', 'admin'
WHERE NOT EXISTS (SELECT 1 FROM users WHERE username = 'admin');

-- Проверка наличия пользователя teacher и добавление его, если он отсутствует
INSERT INTO users (username, password, role)
SELECT 'teacher', '$2y$10$r6Am7r/5VNJ8tPYp6nG1sekti9p221dPKg6w19FnMK1S11rmm2XNK', 'teacher'
WHERE NOT EXISTS (SELECT 1 FROM users WHERE username = 'teacher');

-- Создание таблицы students
CREATE TABLE IF NOT EXISTS students (
    id SERIAL PRIMARY KEY,
    last_name TEXT NOT NULL,
    first_name TEXT NOT NULL,
    middle_name TEXT NOT NULL,
    birth_date DATE NOT NULL,
    gender TEXT NOT NULL,
    address TEXT NOT NULL,
    phone TEXT NOT NULL,
    email TEXT NOT NULL,
    group_number TEXT NOT NULL,
    enrollment_date DATE NOT NULL,
    graduation_date DATE NOT NULL,
    role TEXT NOT NULL DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Создание таблицы teachers
CREATE TABLE IF NOT EXISTS teachers (
    id SERIAL PRIMARY KEY,
    last_name TEXT NOT NULL,
    first_name TEXT NOT NULL,
    middle_name TEXT NOT NULL,
    birth_date DATE NOT NULL,
    gender TEXT NOT NULL,
    address TEXT NOT NULL,
    phone TEXT NOT NULL,
    email TEXT NOT NULL,
    employment_date DATE NOT NULL,
    position TEXT NOT NULL,
    role TEXT NOT NULL DEFAULT 'teacher',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Создание таблицы groups
CREATE TABLE IF NOT EXISTS groups (
    id SERIAL PRIMARY KEY,
    number_group TEXT NOT NULL,
    number_students INTEGER NOT NULL,
    enrollment_year INTEGER NOT NULL,
    graduation_year INTEGER NOT NULL,
    classroom_teacher TEXT NOT NULL,
    role TEXT NOT NULL DEFAULT 'group',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Создание таблицы uploads
CREATE TABLE IF NOT EXISTS uploads (
    id SERIAL PRIMARY KEY,
    file_name TEXT NOT NULL,
    file_description TEXT NOT NULL,
    file_path TEXT NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    theme TEXT
);

-- Создание таблицы news
CREATE TABLE IF NOT EXISTS news (
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    description TEXT NOT NULL,
    full_description TEXT NOT NULL
);

INSERT INTO students (last_name, first_name, middle_name, birth_date, gender, address, phone, email, group_number, enrollment_date, graduation_date)
VALUES
    ('Иванов', 'Иван', 'Иванович', '1995-05-15', 'М', 'ул. Ленина, д.10', '+79123456789', 'ivanov@mail.com', 'IT-101', '2020-09-01', '2024-06-30'),
    ('Петров', 'Петр', 'Петрович', '1996-03-20', 'М', 'ул. Пушкина, д.5', '+79234567890', 'petrov@mail.com', 'IT-102', '2021-09-01', '2025-06-30');

INSERT INTO teachers (last_name, first_name, middle_name, birth_date, gender, address, phone, email, employment_date, position, role) 
            VALUES ('Сидоров', 'Сидор', 'Сидорович', '1980-12-10', 'М', 'ул. Лесная, д.15', '+79345678901', 'sidorov@mail.com', '2005-09-01', 'Профессор', 'teacher'),
                   ('Иванова', 'Мария', 'Ивановна', '1985-07-25', 'Ж', 'ул. Маяковского, д.20', '+79456789012', 'ivanova@mail.com', '2010-08-01', 'Доцент', 'teacher');

INSERT INTO groups (number_group, number_students, enrollment_year, graduation_year, classroom_teacher, role)
            VALUES ('IT-101', '30', '2020', '2024', 'Сидоров', 'group'),
                   ('IT-102', '25', '2021', '2025', 'Иванова', 'group');

INSERT INTO uploads (file_name, file_description, file_path, theme)
            VALUES ('Презентация1', 'Презентация для занятия', '/uploads/presentation1.pptx', 'Обучение'),
                   ('Решения задач', 'Методички для студентов', '/uploads/exercises.pdf', 'Практика');

INSERT INTO news (name, description, full_description)
            VALUES ('Новость 1', 'Важное объявление', 'Уважаемые студенты! Важное событие состоится в следующий четверг.'),
                   ('Новость 2', 'Информация о событии', 'Дорогие преподаватели! Напоминаем, что встреча планируется на понедельник.');

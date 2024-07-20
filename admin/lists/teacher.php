<?php

include '..\config.php';
require_once '..\crud\realization\Teacher.php';

$teacher = new Teacher();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_teacher'])) {
    $teacher->create($conn);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_teacher'])) {
    $teacher->delete($conn);
}

?>

<div id="admin-content" class="container mt-4" style="display: none;">
    <h3>Добавить участника</h3>
        <div class="form-group">
            <label for="user_type">Тип участника:</label>
            <select class="form-control" id="user_type" onchange="showUserForm()">
                <option value="" selected disabled>Выберите тип участника</option>
                <option value="student">Студент</option>
                <option value="teacher">Преподаватель</option>
            </select>
        </div>

    <form method="POST" >
        <div id="teacher_form" style="display: none;">
            <div class="form-group">
                <label for="last_name">Фамилия:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="first_name">Имя:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="middle_name">Отчество:</label>
                <input type="text" class="form-control" id="middle_name" name="middle_name" required>
            </div>
            <div class="form-group">
                <label for="birth_date">Дата рождения:</label>
                <input type="date" class="form-control" id="birth_date" name="birth_date" required>
            </div>
            <div class="form-group">
                <label for="gender">Пол:</label>
                <input type="text" class="form-control" id="gender" name="gender" required>
            </div>
            <div class="form-group">
                <label for="address">Адрес:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="phone">Телефон:</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="email">Почта:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="employment_date">Дата трудоустройства:</label>
                <input type="date" class="form-control" id="employment_date" name="employment_date" required>
            </div>
            <div class="form-group">
                <label for="position">Должность</label>
                <input type="text" class="form-control" id="position" name="position" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_teacher">Добавить преподавателя</button>
        </div>
    </form>
<div>

<div id="teacher">
<h3>Список преподавателей</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>Дата рождения</th>
                <th>Пол</th>
                <th>Адрес</th>
                <th>Телефон</th>
                <th>Почта</th>
                <th>Дата трудоустройства</th>
                <th>Должность</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM teachers");
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['middle_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['birth_date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "/td>";
                echo "<td>" . htmlspecialchars($row['employment_date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['position']) . "</td>";
                echo "<td>";
                echo "<form method='post' style='display:inline-block;'>";
                echo "<input type='hidden' name='teacher_id' value='{$row['id']}'>";
                echo "<button type='submit' class='btn btn-danger' name='delete_teacher'>Удалить</button>";
                echo "</form>";
                echo "<form method='post' action='edits/teacher.php' style='display:inline-block;'>";
                echo "<input type='hidden' name='teacher_id' value='{$row['id']}'>";
                echo "<button type='submit' class='btn btn-warning' name='edit_teacher'>Редактировать</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
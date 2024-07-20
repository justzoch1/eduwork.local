<?php 

include '..\config.php';
require_once '..\crud\realization\Student.php';

$student = new Student();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_student'])) {
    $student->create($conn);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_student'])) {
    $student->delete($conn);
}

?>

<form method="POST" >
        <div id="student_form" style="display: none;">
            <div class="form-group">
                <label for="last_name">Фамилия:</label>
                <input type="text" class="form-control" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="first_name">Имя:</label>
                <input type="text" class="form-control" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="middle_name">Отчество:</label>
                <input type="text" class="form-control" name="middle_name" required>
            </div>
            <div class="form-group">
                <label for="birth_date">Дата рождения:</label>
                <input type="date" class="form-control" name="birth_date" required>
            </div>
            <div class="form-group">
                <label for="gender">Пол:</label>
                <input type="text" class="form-control" name="gender" required>
            </div>
            <div class="form-group">
                <label for="address">Адрес:</label>
                <input type="text" class="form-control" name="address" required>
            </div>
            <div class="form-group">
                <label for="phone">Телефон:</label>
                <input type="text" class="form-control" name="phone" required>
            </div>
            <div class="form-group">
                <label for="email">Почта:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="group_number">Номер группы:</label>
                <input type="text" class="form-control" name="group_number" required>
            </div>
            <div class="form-group">
                <label for="enrollment_date">Дата поступления:</label>
                <input type="date" class="form-control" name="enrollment_date" required>
            </div>
            <div class="form-group">
                <label for="graduation_date">Дата окончания:</label>
                <input type="date" class="form-control" name="graduation_date" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_student">Добавить студента</button>
        </div>
    </form>

    <div id="students">
    <h3>Список студентов</h3>
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
                <th>Номер группы</th>
                <th>Дата поступления</th>
                <th>Дата окончания</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM students");
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
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>" . htmlspecialchars($row['group_number']) . "</td>";
                echo "<td>" . htmlspecialchars($row['enrollment_date']) . "</td>";
                echo "<td>" . htmlspecialchars($row['graduation_date']) . "</td>";
                echo "<td>";
                echo "<form method='post' style='display:inline-block;'>";
                echo "<input type='hidden' name='student_id' value='{$row['id']}'>";
                echo "<button type='submit' class='btn btn-danger' name='delete_student'>Удалить</button>";
                echo "</form>";
                echo "<form method='post' action='edits/student.php' style='display:inline-block;'>";
                echo "<input type='hidden' name='student_id' value='{$row['id']}'>";
                echo "<button type='submit' class='btn btn-warning' name='edit_student'>Редактировать</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</div>
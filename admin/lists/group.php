<?php 

include '..\config.php';
require_once '..\crud\realization\Group.php';

$group = new Group();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_group'])) {
    $group->create($conn);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_group'])) {
    $group->delete($conn);
}

?>

<div id="groups" class="container mt-4" style="display: none;">
    <h3>Группы</h3>
    <div id="form">
    <button type="button" class="btn btn-primary" id="add-group-btn">Добавить группу</button>
    <form id="group_form" method="POST" style=" display: none;" >
        <div >
            <div class="form-group">
                <label for="last_name">Номер группы:</label>
                <input type="text" class="form-control" id="number_group" name="number_group" required>
            </div>
            <div class="form-group">
                <label for="first_name">Колличество студентов:</label>
                <input type="text" class="form-control" id="number_students" name="number_students" required>
            </div>
            <div class="form-group">
                <label for="middle_name">Год поступления:</label>
                <input type="text" class="form-control" id="enrollemnt_year" name="enrollemnt_year" required>
            </div>
            <div class="form-group">
                <label for="birth_date">Год окончания:</label>
                <input type="text" class="form-control" id="graduation_year" name="graduation_year" required>
            </div>
            <div class="form-group">
                <label for="gender">Классный руководитель:</label>
                <input type="text" class="form-control" id="classroom_teacher" name="classroom_teacher" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_group">Добавить группу</button>
        </div>
    </form>

    <h3>Список групп</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Номер группы</th>
                <th>Количество студентов</th>
                <th>Год поступления</th>
                <th>Год окончания</th>
                <th>Классный руководитель</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM groups");
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['number_group']) . "</td>";
                echo "<td>" . htmlspecialchars($row['number_students']) . "</td>";
                echo "<td>" . htmlspecialchars($row['enrollment_year']) . "</td>";
                echo "<td>" . htmlspecialchars($row['graduation_year']) . "</td>";
                echo "<td>" . htmlspecialchars($row['classroom_teacher']) . "</td>";
                echo "<td>";
                echo "<form method='post' style='display:inline-block;'>";
                echo "<input type='hidden' name='group_id' value='{$row['id']}'>";
                echo "<button type='submit' class='btn btn-danger' name='delete_group'>Удалить</button>";
                echo "</form>";
                echo "<form method='post' action='edits/group.php' style='display:inline-block;'>";
                echo "<input type='hidden' name='group_id' value='{$row['id']}'>";
                echo "<button type='submit' class='btn btn-warning' name='edit_group'>Редактировать</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</div>
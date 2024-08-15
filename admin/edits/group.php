<?php
session_start();
include ("../../modules/cruds/Group.php");
include ("../../config.php");

$groupObj = new Group();

if ($_SESSION['role'] != 'admin') {
    header('Location: ../user/auth/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['group_id'])) {
    $group = $groupObj->show($conn);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_group'])) {
    $groupObj->update($conn);
}
?>

<?php include '..\..\includes\header.php'; ?>

<h2>Редактировать группу</h2>
<form method="post">
    <input type="hidden" name="group_id" value="<?php echo $group['id']; ?>">
    <div class="form-group">
        <label for="last_name">Номер группы:</label>
        <input type="text" class="form-control" name="number_group" value="<?php echo $group['number_group']; ?>" required>
    </div>
    <div class="form-group">
        <label for="first_name">Колличевство студентов:</label>
        <input type="text" class="form-control" name="number_students" value="<?php echo $group['number_students']; ?>" required>
    </div>
    <div class="form-group">
        <label for="gender">Классный руководитель:</label>
        <input type="text" class="form-control" name="classroom_teacher" value="<?php echo $group['classroom_teacher']; ?>" required>
    </div>
    <div>
        <label for="enrollment_date">Год поступления:</label>
        <input type="text" class="form-control" name="enrollment_year" value="<?php echo $group['enrollment_year']; ?>" required>
    </div>
    <div class="form-group">
        <label for="graduation_date">Год окончания:</label>
        <input type="text" class="form-control" name="graduation_year" value="<?php echo $group['graduation_year']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary" name="update_group">Сохранить изменения</button>
</form>

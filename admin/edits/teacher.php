<?php
session_start();
include ("../../crud/realization/Teacher.php");
include ("../../config.php");

$teacher = new Teacher();

if ($_SESSION['role'] != 'admin') {
    header('Location: ../user/auth/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['teacher_id'])) {
    $teacher->show($conn);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_teacher'])) {
    $teacher->update($conn);
}
?>

<?php include '..\..\includes\header.php'; ?>

<h2>Редактировать преподавателя</h2>
<form method="post">
    <input type="hidden" name="teacher_id" value="<?php echo $teacher['id']; ?>">
    <div class="form-group">
        <label for="last_name">Фамилия:</label>
        <input type="text" class="form-control" name="last_name" value="<?php echo $teacher['last_name']; ?>" required>
    </div>
    <div class="form-group">
        <label for="first_name">Имя:</label>
        <input type="text" class="form-control" name="first_name" value="<?php echo $teacher['first_name']; ?>" required>
    </div>
    <div class="form-group">
        <label for="middle_name">Отчество:</label>
        <input type="text" class="form-control" name="middle_name" value="<?php echo $teacher['middle_name']; ?>" required>
    </div>
    <div class="form-group">
        <label for="birth_date">Дата рождения:</label>
        <input type="date" class="form-control" name="birth_date" value="<?php echo $teacher['birth_date']; ?>" required>
    </div>
    <div class="form-group">
        <label for="gender">Пол:</label>
        <input type="text" class="form-control" name="gender" value="<?php echo $teacher['gender']; ?>" required>
    </div>
    <div class="form-group">
        <label for="address">Адрес:</label>
        <input type="text" class="form-control" name="address" value="<?php echo $teacher['address']; ?>" required>
    </div>
    <div class="form-group">
        <label for="phone">Телефон:</label>
        <input type="text" class="form-control" name="phone" value="<?php echo $teacher['phone']; ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Почта:</label>
        <input type="email" class="form-control" name="email" value="<?php echo $teacher['email']; ?>" required>
    </div>
    <div class="form-group">
        <label for="enrollment_date">Дата трудоустройства:</label>
        <input type="text" class="form-control" name="employment_date" value="<?php echo $teacher['employment_date']; ?>" required>
    </div>
    <div class="form-group">
        <label for="graduation_date">Должность:</label>
        <input type="text" class="form-control" name="position" value="<?php echo $teacher['position']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary" name="update_teacher">Сохранить изменения</button>
</form>

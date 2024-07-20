<?php
session_start();
include ("../../crud/realization/News.php");
include ("../../config.php");

$newsObj = new News();

if ($_SESSION['role'] != 'admin') {
    header('Location: ../user/auth/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['news_id'])) {
    $news = $newsObj->show($conn);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_news'])) {
    $newsObj->update($conn);
}
?>

<?php include '..\..\includes\header.php'; ?>

<h2>Редактировать новость</h2>

<form method="post">
    <input type="hidden" name="news_id" value="<?php echo $news['id']; ?>">
    <div class="form-group">
        <label for="last_name">Название:</label>
        <input type="text" class="form-control" name="name" value="<?php echo $news['name']; ?>" required>
    </div>
    <div class="form-group">
        <label for="first_name">Описание:</label>
        <input type="text" class="form-control" name="description" value="<?php echo $news['description']; ?>" required>
    </div>
    <div class="form-group">
        <label for="gender">Подробное описание:</label>
        <input type="text" class="form-control" name="full_description" value="<?php echo $news['full_description']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary" name="update_news">Сохранить изменения</button>
</form>

<?php
session_start();
include '../../modules/cruds/News.php';
require_once '../../config.php';

$newsObj = new News($conn);

if ($_SESSION['role'] != 'admin') {
    header('Location: ../user/auth/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['news_id'])) {
    $news = $newsObj->show();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_news'])) {
    $newsObj->update();
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
        <textarea class="form-control" id="mytextarea" name="full_description" required><?php echo htmlspecialchars($news['full_description']); ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary" name="update_news">Сохранить изменения</button>
</form>

<script>
    tinymce.init({
        selector: '#mytextarea'
    });
</script>

<?php include '..\..\includes\footer.php'; ?>

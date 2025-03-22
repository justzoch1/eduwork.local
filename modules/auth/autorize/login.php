<?php

include("../../../config.php");
include("../Auth.php");

session_start();
$auth = new Auth($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $auth->login();
}
?>

<?php include '../../../includes/header.php'; ?>

<h2>Авторизация</h2>
<p>Введите ваше имя пользователя и пароль, чтобы войти в систему.</p>
<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
<form action="" method="post">
    <div class="form-group">
        <label for="username">Пользователь:</label>
        <input type="text" class="form-control" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Пароль:</label>
        <input type="password" class="form-control" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Войти</button>
</form>

<?php include '../../../includes/footer.php'; ?>

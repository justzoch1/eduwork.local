<?php

include '../../config.php';
include("../../modules/accountant/Accountant.php");

session_start();

$file = new Accountant();

if ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'teacher') {
    header('Location: ../../modules/auth/autorize/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])) {
    $file->upload($conn);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $file->delete($conn);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['download'])) {
    $file->download($conn);
}

$event = $_GET['event'] ?? "";
$stmt = $conn->prepare("SELECT * FROM uploads WHERE theme = ?");
$stmt->execute(([$event]));
$stmt->execute();
$uploads = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include '../../includes/header.php'; ?>

<div class="container">
    <h3 class="text-center">Мероприятия</h3>

    <?php if ($_SESSION['role'] == 'admin'): ?>
    <div class="upload-form">
        <h4>Загрузить файл</h4>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file_name">Название файла:</label>
                <input type="text" class="form-control" name="file_name" required>
            </div>
            <div class="form-group">
                <label for="file_description">Описание файла:</label>
                <textarea class="form-control" name="file_description" required></textarea>
            </div>
            <div class="form-group">
                <label for="file_description">Тема файла</label>
                <select name="theme[]" class="form-control" id="theme">
                <option value="План_работы">План работы</option>
                <option value="План_на_учебные_сборы">План на учебные сборы</option>
                <option value="Отчет_воспитательной_работы">Отчет воспитательной работы</option>
            </select>
            </div>
            <div class="form-group">
                <label for="file">Выберите файл:</label>
                <input type="file" class="form-control" name="file" required>
            </div>
            <button type="submit" class="btn btn-primary" name="upload">Загрузить</button>
        </form>
    </div>
    <?php endif; ?>

    <h4 class="mt-5">Загруженные файлы</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Название</th>
                <th>Описание</th>
                <th>Файл</th>
                <th>Предпросмотр</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($uploads as $upload): ?>
                <tr>
                    <td><?php echo htmlspecialchars($upload['file_name']); ?></td>
                    <td><?php echo htmlspecialchars($upload['file_description']); ?></td>
                    <td>
                        <?php
                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                        $fileExtension = pathinfo($upload['file_path'], PATHINFO_EXTENSION);
                        if (in_array($fileExtension, $imageExtensions)): ?>
                            <img src="<?php echo htmlspecialchars($upload['file_path']); ?>" alt="Preview" style="max-width: 100px;">
                        <?php else: ?>
                            <a href="<?php echo htmlspecialchars($upload['file_path']); ?>" download>Скачать</a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php
                        if (in_array($fileExtension, $imageExtensions)): ?>
                            <a href="<?php echo htmlspecialchars($upload['file_path']); ?>" target="_blank">Предпросмотр</a>
                        <?php else: ?>
                            <a href="<?php echo htmlspecialchars($upload['file_path']); ?>" download>Скачать</a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <form method="post" style="display:inline-block;">
                            <input type="hidden" name="file_id" value="<?php echo $upload['id']; ?>">
                            <button type="submit" class="btn btn-danger" name="delete">Удалить</button>
                        </form>
                        <form method="post" style="display:inline-block;">
                            <input type="hidden" name="file_path" value="<?php echo $upload['file_path']; ?>">
                            <button type="submit" class="btn btn-primary" name="download">Скачать</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../../includes/footer.php'; ?>
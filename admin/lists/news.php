<?php 

include '..\config.php';
require_once '..\modules\cruds\News.php';

$news = new News();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_news'])) {
    $news->create($conn);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_news'])) {
    $news->delete($conn);
}

?>

<div id="news" class="container mt-4" style="display: none;">
    <div id="form">
    
    <button type="button" class="btn btn-primary" id="add-news-btn">Добавить новость</button>
    <form id="news_form" method="POST" style=" display: none;" >
        <div >
            <div class="form-group">
                <label for="first_name">Название:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="middle_name">Описание:</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <div class="form-group">
                <label for="birth_date">Подробное описание:</label>
                <input type="text" class="form-control" id="full_description" name="full_description" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_news">Добавить новость</button>
        </div>
    </form>

    <h3>Список новостей</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Подробное описание</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM news ORDER BY id DESC");
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars( $row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                echo "<td>" . htmlspecialchars($row['full_description']) . "</td>";
                echo "<td>";
                echo "<form method='post' style='display:inline-block;'>";
                echo "<input type='hidden' name='news_id' value='{$row['id']}'>";
                echo "<button type='submit' class='btn btn-danger' name='delete_news'>Удалить</button>";
                echo "</form>";
                echo "<form method='post' action='edits/news.php' style='display:inline-block;'>";
                echo "<input type='hidden' name='news_id' value='{$row['id']}'>";
                echo "<button type='submit' class='btn btn-warning' name='edit_news'>Редактировать</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</div>


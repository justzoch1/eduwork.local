<?php
session_start();
include '../../config.php';
?>
<?php include '../../includes/header.php'; ?>

<div class="container">
    <h3 class="text-center">Список студентов</h3>
    <div class="row mb-3">
        <div class="col-md-6 offset-md-3">
            <form action="" method="GET" class="form-inline justify-content-center">
                <div class="form-group mr-2">
                    <input type="text" class="form-control" name="search" placeholder="Введите запрос" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Поиск</button>
                <a href="../../modules/export_excel.php?search=<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" class="btn btn-success">Скачать в EXCEL</a>
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
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
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                $stmt = $conn->prepare("SELECT * FROM students WHERE role = 'student' AND (last_name LIKE ? OR first_name LIKE ? OR middle_name LIKE ? OR group_number LIKE ?)");
                $searchParam = "%$search%";
                $stmt->execute([$searchParam, $searchParam, $searchParam, $searchParam]);
            } else {
                $stmt = $conn->prepare("SELECT * FROM students WHERE role = 'student' ORDER BY id");
                $stmt->execute();
            }
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['last_name']}</td>";
                echo "<td>{$row['first_name']}</td>";
                echo "<td>{$row['middle_name']}</td>";
                echo "<td>{$row['birth_date']}</td>";
                echo "<td>{$row['gender']}</td>";
                echo "<td>{$row['address']}</td>";
                echo "<td>{$row['phone']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['group_number']}</td>";
                echo "<td>{$row['enrollment_date']}</td>";
                echo "<td>{$row['graduation_date']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include '../../includes/footer.php'; ?>

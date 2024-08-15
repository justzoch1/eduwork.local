<?php
session_start();
include '../../config.php';
?>
<?php include '../../includes/header.php'; ?>

<div class="container">
    <h3 class="text-center">Список преподавателей</h3>
    <div class="row mb-3">
        <div class="col-md-6 offset-md-3">
            <form action="" method="GET" class="form-inline justify-content-center">
                <div class="form-group mr-2">
                    <input type="text" class="form-control" name="search" placeholder="Введите запрос" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Поиск</button>
                <a href="../../modules/export_excel.php?search=<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" class="btn btn-success ">Скачать в EXCEL</a>
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
                <th>Дата трудоустройства</th>
                <th>Должность</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                $stmt = $conn->prepare("SELECT * FROM teachers WHERE role = 'teacher' AND (last_name LIKE ? OR first_name LIKE ? OR middle_name LIKE ?)");
                $searchParam = "%$search%";
                $stmt->execute([$searchParam, $searchParam, $searchParam]);
            } else {
                $stmt = $conn->prepare("SELECT * FROM teachers WHERE role = 'teacher'");
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
                echo "<td>{$row['employment_date']}</td>";
                echo "<td>{$row['position']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</div>

<?php include '../../includes/footer.php'; ?>

<?php
session_start();
include '../../config.php';
?>
<?php include '../../includes/header.php'; ?>

<div class="container">
    <h3 class="text-center">Список групп</h3>
    <div class="row mb-3">
        <div class="col-md-6 offset-md-3">
            <form action="" method="GET" class="form-inline justify-content-center">
                <div class="form-group mr-2">
                    <input type="text" class="form-control" name="search" placeholder="Введите запрос" value="<?php echo isset($GET['search']) ? htmlspecialchars($GET['search']) : ''; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Поиск</button>
                <a href="../../modules/export_excel.php?search=<?php echo isset($GET['search']) ? htmlspecialchars($GET['search']) : ''; ?>" class="btn btn-success">Скачать в EXCEL</a>
            </form>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Номер группы</th>
                <th>Количество студентов</th>
                <th>Год поступления</th>
                <th>Год выпуска</th>
                <th>Классный руководитель</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                $stmt = $conn->prepare("SELECT *  FROM groups WHERE (number_group LIKE ? OR classroom_teacher LIKE ?)");
                $searchParam = "%$search%";
                $stmt->execute([$searchParam, $searchParam]);
            } else {
                $stmt = $conn->prepare("SELECT * FROM groups");
                $stmt->execute();
            }
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['number_group']}</td>";
                echo "<td>{$row['number_students']}</td>";
                echo "<td>{$row['enrollment_year']}</td>";
                echo "<td>{$row['graduation_year']}</td>";
                echo "<td>{$row['classroom_teacher']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include '../../includes/footer.php'; ?>
<?php
include 'config.php';

session_start();

// Получение новостей из базы данных
$stmt = $conn->prepare("SELECT * FROM news ORDER BY id DESC");
$stmt->execute();
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include 'includes/header.php'; ?>
<div class="container">
        <h3 class="text-center">Главная</h3>

        <div class="row mt-4">
            <?php foreach ($news as $new): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="assets/images/two.gif" class="card-img-top" alt="<?php echo $new['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $new['name']; ?></h5>
                        <p class="card-text"><?php echo $new['description']; ?></p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#news<?php echo $new['id']; ?>Modal">
                            Подробнее
                        </button>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="news<?php echo $new['id']; ?>Modal" tabindex="-1" role="dialog" aria-labelledby="news<?php echo $new['id']; ?>ModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="news<?php echo $new['id']; ?>ModalLabel"><?php echo $new['name']; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><?php echo $new['full_description']; ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>

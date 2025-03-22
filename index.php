<?php
include 'config.php';

session_start();

$stmt = $conn->prepare("SELECT * FROM news ORDER BY id DESC");
$stmt->execute();
$newsCollection = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include 'includes/header.php'; ?>
<div class="container">
        <h3 class="text-center">Главная</h3>

        <div class="row mt-4">
            <?php foreach ($newsCollection as $news): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="assets/images/News.gif" class="card-img-top" alt="<?php echo $news['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $news['name']; ?></h5>
                        <p class="card-text"><?php echo $news['description']; ?></p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#news<?php echo $news['id']; ?>Modal">
                            Подробнее
                        </button>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="news<?php echo $news['id']; ?>Modal" tabindex="-1" role="dialog" aria-labelledby="news<?php echo $news['id']; ?>ModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="news<?php echo $news['id']; ?>ModalLabel"><?php echo $news['name']; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><?php echo $news['full_description']; ?></p>
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

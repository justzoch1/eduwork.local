<?php
require_once '../modules/cruds/News.php';
require_once '../config.php';

$news = new News($conn);
$newsItem = $news->show();
?>

<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <h1><?php echo htmlspecialchars($newsItem['name']); ?></h1>
    <p class="text-muted"><?php echo date('d.m.Y', strtotime($newsItem['created_at'])); ?></p>
    <div id="newsContent" class="mb-4">
        <?php echo $newsItem['full_description']; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

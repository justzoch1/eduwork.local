<?php

// include("../ACrud.php");

class News {

    public function show($conn) {
        try {
            $sql = "SELECT * FROM news WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_POST['news_id']]);
            $news = $stmt->fetch(PDO::FETCH_ASSOC);
            return $news;
        } catch (PDOException $ex) {
            throw new PDOException('Возникла ошибка, пересмотрите свой запрос.');
        }
    }

    public function delete($conn) {
        try {
            $sql = "DELETE FROM news WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_POST['news_id']]);
        } catch (PDOException $ex) {
            throw new PDOException('Возникла ошибка, пересмотрите свой запрос.');
        }
    }

    public function update($conn) {
        try {
            $sql = "UPDATE news SET name = ?, description = ?, full_description = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                $_POST['name'],
                $_POST['description'],
                $_POST['full_description'],
                $_POST['news_id']
            ]);
            header('Location: ..\..\admin\admin_panel.php');
        } catch (PDOException $ex) {
            throw new PDOException('Возникла ошибка, пересмотрите свой запрос.');
        }
    }

    public function create($conn) {
        try {
            $sql = "INSERT INTO news (name, description, full_description) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                $_POST['name'],
                $_POST['description'],
                $_POST['full_description'],
            ]);
            header('Location: ..\..\admin\admin_panel.php');
            exit();
        } catch (PDOException $ex) {
            throw new PDOException('Возникла ошибка, пересмотрите свой запрос.');
        }
    }
}
?>
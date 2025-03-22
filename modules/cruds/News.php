<?php
require_once 'Crud.php';

class News extends Crud {

    public function __construct(PDO $conn) {
        parent::__construct($conn);
    }

    public function show() {
        try {
            $sql = "SELECT * FROM news WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$_POST['news_id']]);
            $news = $stmt->fetch(PDO::FETCH_ASSOC);
            return $news;
        } catch (PDOException) {
            throw new PDOException(Crud::ERROR_MESSAGE);
        }
    }

    public function delete() {
        try {
            $sql = "DELETE FROM news WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$_POST['news_id']]);
        } catch (PDOException) {
            throw new PDOException(Crud::ERROR_MESSAGE);
        }
    }

    public function update() {
        try {
            $sql = "UPDATE news SET name = ?, description = ?, full_description = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $_POST['name'],
                $_POST['description'],
                $_POST['full_description'],
                $_POST['news_id']
            ]);
            header('Location: ..\..\admin\admin_panel');
        } catch (PDOException) {
            throw new PDOException(Crud::ERROR_MESSAGE);
        }
    }

    public function create() {
        try {
            $sql = "INSERT INTO news (name, description, full_description) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $_POST['name'],
                $_POST['description'],
                $_POST['full_description'],
            ]);
        } catch (PDOException) {
            throw new PDOException(Crud::ERROR_MESSAGE);
        }
    }
}
?>
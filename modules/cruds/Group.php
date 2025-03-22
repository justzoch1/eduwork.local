<?php
require_once 'Crud.php';

class Group extends Crud {

    public function __construct(PDO $conn) {
        parent::__construct($conn);
    }

    public function show() {
        try {
            $sql = "SELECT * FROM groups WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$_POST['group_id']]);
            $group = $stmt->fetch(PDO::FETCH_ASSOC);
            return $group;
        } catch (PDOException) {
            throw new PDOException('Возникла ошибка, пересмотрите свой запрос.');
        }
    }
    
    public function delete () {
        try {
            $sql = "DELETE FROM groups WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$_POST['group_id']]);
        } catch (PDOException) {
            throw new PDOException('Возникла ошибка, пересмотрите свой запрос.');
        }
    }

    public function update() {
        try {
            $sql = "UPDATE groups SET number_group = ?, number_students = ?, enrollment_year = ?, graduation_year = ?, classroom_teacher = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $_POST['number_group'],
                $_POST['number_students'],
                $_POST['enrollment_year'],
                $_POST['graduation_year'],
                $_POST['classroom_teacher'],
                $_POST['group_id']
        ]);
        header('Location: ..\..\admin\admin_panel.php');
        } catch (PDOException) {
            throw new PDOException('Возникла ошибка, пересмотрите свой запрос.');
        }
    }

    public function create() {
        try {
            $sql = "INSERT INTO groups (number_group, number_students, enrollment_year, graduation_year, classroom_teacher, role) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $_POST['number_group'],
                $_POST['number_students'],
                $_POST['enrollemnt_year'],
                $_POST['graduation_year'],
                $_POST['classroom_teacher'],
                'groupe'
            ]);
        } catch (PDOException) {
            throw new PDOException('Возникла ошибка, пересмотрите свой запрос.');
        }
    }
}
?>
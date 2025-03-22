<?php
require_once 'Crud.php';

class Student extends Crud {

    public function __construct(PDO $conn) {
        parent::__construct($conn);
    }

    public function show() {
        try {
            $sql = "SELECT * FROM students WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$_POST['student_id']]);
            $student = $stmt->fetch(PDO::FETCH_ASSOC);
            return $student;
        } catch (PDOException) {
            throw new PDOException(Crud::ERROR_MESSAGE);
        }
    }
    
    public function delete() {
        try {
            $sql = "DELETE FROM students WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$_POST['student_id']]);
        } catch (PDOException) {
            throw new PDOException(Crud::ERROR_MESSAGE);
        }
    }

    public function update() {
        try {
            $sql = "UPDATE students SET last_name = ?, first_name = ?, middle_name = ?, birth_date = ?, gender = ?, address = ?, phone = ?, email = ?, group_number = ?, enrollment_date = ?, graduation_date = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $_POST['last_name'],
                $_POST['first_name'],
                $_POST['middle_name'],
                $_POST['birth_date'],
                $_POST['gender'],
                $_POST['address'],
                $_POST['phone'],
                $_POST['email'],
                $_POST['group_number'],
                $_POST['enrollment_date'],
                $_POST['graduation_date'],
                $_POST['student_id']
            ]);
            header('Location: ..\..\admin\admin_panel.php');
        } catch (PDOException) {
            throw new PDOException(Crud::ERROR_MESSAGE);
        }
    }

    public function create() {
        try {
            $sql = "INSERT INTO students (last_name, first_name, middle_name, birth_date, gender, address, phone, email, group_number, enrollment_date, graduation_date, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $_POST['last_name'],
                $_POST['first_name'],
                $_POST['middle_name'],
                $_POST['birth_date'],
                $_POST['gender'],
                $_POST['address'],
                $_POST['phone'],
                $_POST['email'],
                $_POST['group_number'],
                $_POST['enrollment_date'],
                $_POST['graduation_date'],
                'student'
            ]);
        } catch (PDOException) {
            throw new PDOException(Crud::ERROR_MESSAGE);
        }
    }
}
?>
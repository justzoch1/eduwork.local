<?php
require_once 'Crud.php';

class Teacher extends Crud {

    public function __construct(PDO $conn) {
        parent::__construct($conn);
    }

    public function show() {
        try {
            $sql = "SELECT * FROM teachers WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$_POST['teacher_id']]);
            $teacher = $stmt->fetch(PDO::FETCH_ASSOC);
            return $teacher;
        } catch (PDOException) {
            throw new PDOException(Crud::ERROR_MESSAGE);
        }
    }

    public function delete() {
        try {
            $sql = "DELETE FROM teachers WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$_POST['teacher_id']]);
        } catch (PDOException) {
            throw new PDOException(Crud::ERROR_MESSAGE);
        }
    }

    public function update() {
        try {
            $sql = "UPDATE teachers SET last_name = ?, first_name = ?, middle_name = ?, birth_date = ?, gender = ?, address = ?, phone = ?, email = ?, employment_date = ?, position = ? WHERE id = ?";
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
                $_POST['employment_date'],
                $_POST['position'],
                $_POST['teacher_id']
            ]);
            header('Location: ..\..\admin\admin_panel');
        } catch (PDOException) {
            throw new PDOException(Crud::ERROR_MESSAGE);
        }
    }

    public function create() {
        try {
            $sql = "INSERT INTO teachers (last_name, first_name, middle_name, birth_date, gender, address, phone, email, position, employment_date, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
                $_POST['position'],
                $_POST['employment_date'],
                'teacher'
            ]);
        } catch (PDOException) {
            throw new PDOException(Crud::ERROR_MESSAGE);
        }
    }
}
?>
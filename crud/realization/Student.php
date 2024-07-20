<?php 

// include("../ACrud.php");

class Student {

    public function show($conn) {
        try {
            $sql = "SELECT * FROM students WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_POST['student_id']]);
            $student = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            throw new PDOException('Возникла ошибка, пересмотрите свой запрос.');
        }
    }
    
    public function delete($conn) {
        try {
            $sql = "DELETE FROM students WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_POST['student_id']]);
            // header('Location: admin_panel.php');
            exit();
        } catch (PDOException $ex) {
            throw new PDOException('Возникла ошибка, пересмотрите свой запрос.');
        }
    }

    public function update($conn) {
        try {
            $sql = "UPDATE students SET last_name = ?, first_name = ?, middle_name = ?, birth_date = ?, gender = ?, address = ?, phone = ?, email = ?, group_number = ?, enrollment_date = ?, graduation_date = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
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
            header('Location: admin_panel.php');
        } catch (PDOException $ex) {
            throw new PDOException('Возникла ошибка, пересмотрите свой запрос.');
        }
    }

    public function create($conn) {
        try {
            $sql = "INSERT INTO students (last_name, first_name, middle_name, birth_date, gender, address, phone, email, group_number, enrollment_date, graduation_date, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
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
            header('Location: admin_panel.php');
        exit();
        } catch (PDOException $ex) {
            throw new PDOException('Возникла ошибка, пересмотрите свой запрос.');
        }
    }
}
?>
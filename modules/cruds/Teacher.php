<?php 

// include("../Crud.php");

class Teacher {

    public function show($conn) {
        try {
            $sql = "SELECT * FROM teachers WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_POST['teacher_id']]);
            $teacher = $stmt->fetch(PDO::FETCH_ASSOC);
            return $teacher;
        } catch (PDOException $ex) {
            throw new PDOException('Возникла ошибка, пересмотрите свой запрос.');
        }
    }

    public function delete($conn) {
        try {
            $sql = "DELETE FROM teachers WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_POST['teacher_id']]);
        } catch (PDOException $ex) {
            throw new PDOException('Возникла ошибка, пересмотрите свой запрос.');
        }
    }

    public function update($conn) {
        try {
            $sql = "UPDATE teachers SET last_name = ?, first_name = ?, middle_name = ?, birth_date = ?, gender = ?, address = ?, phone = ?, email = ?, employment_date = ?, position = ? WHERE id = ?";
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
                $_POST['employment_date'],
                $_POST['position'],
                $_POST['teacher_id']
            ]);
            header('Location: ..\..\admin\admin_panel.php');
        } catch (PDOException $ex) {
            throw new PDOException('Возникла ошибка, пересмотрите свой запрос.');
        }
    }

    public function create($conn) {
        try {
            $sql = $conn->prepare("INSERT INTO teachers (last_name, first_name, middle_name, birth_date, gender, address, phone, email, position, employment_date role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
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
                $_POST['position'],
                $_POST['employment_date'],
                'teacher'
            ]);
        } catch (PDOException $ex) {
            throw new PDOException('Возникла ошибка, пересмотрите свой запрос.');
        }
    }
}
?>
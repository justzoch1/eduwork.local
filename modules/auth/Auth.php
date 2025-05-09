<?php 

class Auth {
    public PDO $conn;
    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function login() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $this->conn->prepare("SELECT id, password, role FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {
                header('Location: ../../../admin/admin_panel.php');
            } else {
                header('Location: ../../../index.php');
            }
            exit();
        }
    }

    public function logout() {
        session_destroy();
        header('Location: http://localhost/eduwork.local/index.php');
        exit();
    }
}
?>
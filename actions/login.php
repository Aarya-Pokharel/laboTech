<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    try {
        $conn = $pdo->open();

        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ? AND status = 'active'");
        $stmt->execute([$email]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            $_SESSION['admin_email'] = $admin['email'];
            header('Location: ../admin/');
            exit();
        }

    } catch (PDOException $e) {
        $_SESSION['error'] = '' . $e->getMessage();
    }

}else{
    header('../login');
}



?>
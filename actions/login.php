<?php
require_once '../includes/session.php';
require_once '../includes/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Please fill in all fields.';
        header('Location: ../login.php');
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Please enter a valid email address.';
        header('Location: ../login.php');
        exit();
    }
    try {
        $pdo = new Database();
        $conn = $pdo->open();
        $stmt = $conn->prepare('SELECT * FROM guides WHERE email = ?');
        $stmt->execute([$email]);
        $guide = $stmt->fetch();
        if ($guide && password_verify($password, $guide['password'])) {
            $_SESSION['guide'] = $guide['id'];
            $_SESSION['guide_name'] = $guide['name'];
            $_SESSION['guide_email'] = $guide['email'];
            header('Location: ../manager/index.php');
            exit();
        }
        $stmt = $conn->prepare('SELECT * FROM tourists WHERE email = ?');
        $stmt->execute([$email]);
        $tourist = $stmt->fetch();
        if ($tourist && password_verify($password, $tourist['password'])) {
            $_SESSION['tourist'] = $tourist['id'];
            $_SESSION['tourist_name'] = $tourist['name'];
            $_SESSION['tourist_email'] = $tourist['email'];
            header('Location: ../tourist/index.php');
            exit();
        }
        $_SESSION['error'] = 'Invalid email or password. Please try again.';
        header('Location: ../login.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Database error: ' . $e->getMessage();
        header('Location: ../login.php');
        exit();
    }
} else {
    header('Location: ../login.php');
    exit();
} 
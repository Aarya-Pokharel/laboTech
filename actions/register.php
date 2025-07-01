<?php
require_once '../includes/session.php';
require_once '../includes/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userType = $_POST['user_type'] ?? '';
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    if (empty($name) || empty($email) || empty($phone) || empty($location) || empty($password)) {
        $_SESSION['error'] = 'Please fill in all required fields.';
        header('Location: ../register.php');
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Please enter a valid email address.';
        header('Location: ../register.php');
        exit();
    }
    if (strlen($password) < 6) {
        $_SESSION['error'] = 'Password must be at least 6 characters long.';
        header('Location: ../register.php');
        exit();
    }
    if ($password !== $confirmPassword) {
        $_SESSION['error'] = 'Passwords do not match.';
        header('Location: ../register.php');
        exit();
    }
    try {
        $pdo = new Database();
        $conn = $pdo->open();
        $stmt = $conn->prepare('SELECT id FROM tourists WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $_SESSION['error'] = 'Email already registered as a tourist.';
            header('Location: ../register.php');
            exit();
        }
        $stmt = $conn->prepare('SELECT id FROM guides WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $_SESSION['error'] = 'Email already registered as a guide.';
            header('Location: ../register.php');
            exit();
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if ($userType === 'tourist') {
            $stmt = $conn->prepare('INSERT INTO tourists (name, email, phone, location, password) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$name, $email, $phone, $location, $hashedPassword]);
            $_SESSION['success'] = 'Tourist account created successfully!';
        } elseif ($userType === 'guide') {
            $bio = trim($_POST['bio'] ?? '');
            $stmt = $conn->prepare('INSERT INTO guides (name, email, phone, location, bio, password) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->execute([$name, $email, $phone, $location, $bio, $hashedPassword]);
            $_SESSION['success'] = 'Guide account created successfully!';
        } else {
            $_SESSION['error'] = 'Invalid user type.';
            header('Location: ../register.php');
            exit();
        }
        header('Location: ../login.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Database error: ' . $e->getMessage();
        header('Location: ../register.php');
        exit();
    }
} else {
    header('Location: ../register.php');
    exit();
} 
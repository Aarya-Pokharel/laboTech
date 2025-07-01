<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userType = $_POST['user_type'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $location = trim($_POST['location']);
    $password = $_POST['password'];
    
   
    try {
        $pdo = new Database();
        $conn = $pdo->open();
        
    
        $stmt = $conn->prepare("SELECT id FROM customers WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $_SESSION['error'] = "Email already registered as a customer.";
            header('Location: ../register');
            exit();
        }
        
        $stmt = $conn->prepare("SELECT id FROM employees WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $_SESSION['error'] = "Email already registered as an employee.";
            header('Location: ../register');
            exit();
        }
        

        $hashedPassword = $password;
        
        if ($userType === 'customer') {
            // Insert customer
            $stmt = $conn->prepare("INSERT INTO customers (name, email, phone, location, password, status, created_at) VALUES (?, ?, ?, ?, ?, 'active', NOW())");
            $stmt->execute([$name, $email, $phone, $location, $hashedPassword]);
            
            $_SESSION['success'] = "Customer account created successfully! You can now log in.";
            
        } elseif ($userType === 'employee') {
            // Validate employee-specific fields
            $jobCategories = $_POST['job_categories'];
            $description = trim($_POST['description'] ?? ''); // Optional field
            $hourlyRate = floatval($_POST['hourly_rate']);
            
            if (empty($jobCategories)) {
                $_SESSION['error'] = "Please select at least one job category.";
                header('Location: ../register');
                exit();
            }
            
            if ($hourlyRate <= 0) {
                $_SESSION['error'] = "Please enter a valid hourly rate.";
                header('Location: ../register');
                exit();
            }
            
            
            $jobCategoriesString = implode(',', $jobCategories);
            
            $stmt = $conn->prepare("INSERT INTO employees (name, email, phone, location, job_categories, skills, hourly_rate, password, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'active', NOW())");
            $stmt->execute([$name, $email, $phone, $location, $jobCategoriesString, $description, $hourlyRate, $hashedPassword]);
            
            $_SESSION['success'] = "Professional account created successfully! Your account will be reviewed and activated soon.";
            
        } else {
            $_SESSION['error'] = "Invalid user type.";
            header('Location: ../register');
            exit();
        }
        
        header('Location: ../login');
        exit();
        
    } catch (PDOException $e) {
        $_SESSION['error'] = "Database error: " . $e->getMessage();
        header('Location: ../register');
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = "An error occurred. Please try again.";
        header('Location: ../register');
        exit();
    }
} else {
    header('Location: ../register');
    exit();
}
?> 
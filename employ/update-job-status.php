<?php
session_start();
header('Content-Type: application/json');

require_once '../includes/db.php';

if (!isset($_SESSION['employ'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit();
}


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}


$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['job_id']) || !isset($input['status'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit();
}

$jobId = $input['job_id'];
$status = $input['status'];
$employeeId = $_SESSION['employ'];


$allowedStatuses = ['active', 'completed', 'cancelled'];
if (!in_array($status, $allowedStatuses)) {
    echo json_encode(['success' => false, 'message' => 'Invalid status']);
    exit();
}

try {
    $pdo = new Database();
    $conn = $pdo->open();
    
    
    $stmt = $conn->prepare("SELECT * FROM jobs WHERE id = ? AND employee_id = ?");
    $stmt->execute([$jobId, $employeeId]);
    $job = $stmt->fetch();
    
    if (!$job) {
        echo json_encode(['success' => false, 'message' => 'Job not found or not assigned to you']);
        exit();
    }
    
  
    $stmt = $conn->prepare("UPDATE jobs SET status = ?, updated_at = NOW() WHERE id = ?");
    $stmt->execute([$status, $jobId]);
    
 
    if ($status === 'completed') {
        $stmt = $conn->prepare("INSERT INTO payments (job_id, employee_id, customer_id, amount, status, created_at) 
                               VALUES (?, ?, ?, ?, 'completed', NOW())");
        $stmt->execute([$jobId, $employeeId, $job['customer_id'], $job['amount']]);
    }
    
    echo json_encode(['success' => true, 'message' => 'Job status updated successfully']);
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?> 
<?php
session_start();
require_once '../includes/db.php';

if($_SERVER["REQUEST_METHOD"] === 'POST'){
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    


}

?>
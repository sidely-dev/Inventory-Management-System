<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Hardcoded credentials for simulation simplicity
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['authenticated'] = true;
        $_SESSION['user'] = 'Administrator';
        header("Location: ../../public/pages/products.php");
        exit;
    } else {
        header("Location: ../../public/index.php?error=1");
        exit;
    }
}

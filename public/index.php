<?php
session_start();
// If already logged in, skip the screen and jump to the system dashboard
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header("Location: pages/products.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS Secure Gateway</title>
    <style>
        body { background: #0b0f19; color: #f1f5f9; font-family: sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .login-card { background: #111827; border: 1px solid rgba(255,255,255,0.05); padding: 40px; border-radius: 16px; width: 100%; max-width: 360px; text-align: center; }
        h2 { margin-bottom: 24px; color: #38bdf8; }
        input { width: 100%; padding: 12px; margin-bottom: 16px; border-radius: 8px; border: 1px solid #1f2937; background: #030712; color: #fff; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #38bdf8; color: #0b0f19; border: none; font-weight: bold; border-radius: 8px; cursor: pointer; }
        .error { color: #ef4444; margin-bottom: 16px; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>IMS Security Access</h2>
        <?php if (isset($_GET['error'])): ?>
            <div class="error">❌ Invalid Credentials Provided.</div>
        <?php endif; ?>
        <form action="../src/services/auth.php" method="POST">
            <input type="text" name="username" placeholder="Username (admin)" required>
            <input type="password" name="password" placeholder="Password (admin123)" required>
            <button type="submit">Authenticate</button>
        </form>
    </div>
</body>
</html>
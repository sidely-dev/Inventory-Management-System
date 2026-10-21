<?php
session_start();

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Categories</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div style="padding: 40px; max-width: 800px; margin: 0 auto;">
        <h1 style="color: #38bdf8; margin-bottom: 24px;">📁 Active Product Categories</h1>
        
        <ul id="categories-list" style="list-style: none; padding: 0;">
            <!-- Categories rendered here -->
        </ul>
        
        <div style="margin-top: 40px;">
            <a href="products.php" style="color: #38bdf8; text-decoration: none;">⬅️ Back to Products Ledger</a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", async () => {
            const list = document.getElementById("categories-list");
            try {
                const res = await fetch("../../api/categories/read.php");
                const result = await res.json();
                if(result.success) {
                    list.innerHTML = "";
                    result.data.forEach(cat => {
                        list.innerHTML += `<li style="background: #111827; padding: 16px; margin-bottom: 10px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.05);">🔹 <strong>ID #${cat.CategoryID}:</strong> ${cat.CategoryName}</li>`;
                    });
                }
            } catch (err) {
                list.innerHTML = "<li>Error loading system categories.</li>";
            }
        });
    </script>
</body>
</html>

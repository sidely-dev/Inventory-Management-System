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
    <title>IMS Analytics Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .metrics-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-top: 30px; }
        .metric-card { background: #111827; padding: 24px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05); text-align: center; }
        .metric-card h3 { color: #94a3b8; font-size: 0.9rem; margin-bottom: 8px; text-transform: uppercase; }
        .metric-card p { font-size: 1.8rem; font-weight: bold; color: #38bdf8; margin: 0; }
    </style>
</head>
<body>
    <div style="padding: 40px; max-width: 1200px; margin: 0 auto;">
        <h1 style="color: #38bdf8;">📊 Inventory Summary Analytics</h1>
        <p>Real-time system health calculations from your database cluster.</p>
        
        <div class="metrics-grid" id="metrics-container">
            <!-- Populated via Javascript -->
        </div>
        
        <div style="margin-top: 40px;">
            <a href="products.php" style="color: #38bdf8; text-decoration: none;">⬅️ Back to Products Spreadsheet</a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", async () => {
            const container = document.getElementById("metrics-container");
            try {
                const res = await fetch("../../api/products/reports.php");
                const result = await res.json();
                if(result.success) {
                    container.innerHTML = "";
                    for (const [key, value] of Object.entries(result.metrics)) {
                        container.innerHTML += `
                            <div class="metric-card">
                                <h3>${key}</h3>
                                <p>${value}</p>
                            </div>
                        `;
                    }
                }
            } catch (err) {
                container.innerHTML = "<p>Error loading analytics data.</p>";
            }
        });
    </script>
</body>
</html>

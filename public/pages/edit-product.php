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
    <title>Edit Product Specifications</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="app-wrapper">
        <nav>
            <div class="nav-brand">📦 IMS System</div>
            <ul>
                <li class="active-tab"><a href="products.php">🗃️ Products Ledger</a></li>
                <li><a href="dashboard.php">📊 Summary Analytics</a></li>
                <li><a href="categories.php">📁 Categories Catalog</a></li>
                <li><a href="../api/products/backup.php">💾 Database Backup</a></li>
            </ul>
        </nav>

        <!-- Replace your old <select id="category-filter"> area with this elegant dashboard block -->
<div class="main-content">
    <div class="page-header">
        <div class="page-title">
            <h1>Active Stock Inventory</h1>
            <p>Monitor warehouse metrics and relational stock units.</p>
        </div>
        <a href="add-product.php" class="btn primary-btn">+ Add Product</a>
    </div>

    <!-- 🏷️ NEW: Interactive Pipeline Category Filter Cards Row -->
    <div class="category-pipeline-container">
        <span class="pipeline-label">Quick Filter:</span>
        <div id="category-pills-row" class="pipeline-pills">
            <!-- JavaScript will dynamically drop pill cards here -->
        </div>
    </div>

    <!-- Spreadsheet Storage Matrix Table Card -->
    <div class="table-card" style="margin-top: 24px;">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="product-table-body">
                <!-- Data items injected automatically -->
            </tbody>
        </table>
    </div>
</div>
<!-- Script anchors tracking data fetches -->
<script src="../assets/js/products.js"></script>
<script src="../assets/js/main.js"></script>
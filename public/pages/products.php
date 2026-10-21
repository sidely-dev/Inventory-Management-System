<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: ../index.php");
    exit;
}
?>

<select id="category-filter">
    <option value="">📁 All Categories</option>
</select>


<div class="table-container">
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
            <!-- Dynamic rows will be injected here -->
        </tbody>
    </table>
</div>

<!-- Structural layout container inside public/pages/products.php -->
<div class="app-wrapper">
    <!-- Navigation Sidebar Container -->
    <nav>
        <div class="nav-brand">📦 IMS Portal</div>
        <ul>
            <li class="active-tab"><a href="products.php">🗃️ Products Ledger</a></li>
            <li><a href="dashboard.php">📊 Analytics View</a></li>
            <li><a href="../api/products/backup.php">💾 Database Backup</a></li>
        </ul>
    </nav>

    <!-- Content Workspace -->
    <div class="main-content">
        <div class="page-header">
            <div class="page-title">
                <h1>Active Stock Inventory</h1>
                <p>Monitor warehouse metrics and relational stock units.</p>
            </div>
            <a href="add-product.php" class="btn primary-btn">+ Add Product</a>
        </div>

        <!-- Real-Time Metrics Row (Adds the real dashboard feel!) -->
        <div class="stats-grid">
            <div class="stat-card"><h3>Total Unique SKUs</h3><p>6 Items</p></div>
            <div class="stat-card"><h3>Warehouse Value</h3><p>R 92,345.00</p></div>
            <div class="stat-card"><h3>Stock Status</h3><p style="color: #34d399;">Healthy</p></div>
        </div>

        <!-- Interactive Data Table Container Card -->
        <div class="table-card">
            <div class="table-toolbar">
                <select id="category-filter">
                    <option value="">📁 Filter By Category</option>
                </select>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th><th>Product Name</th><th>Category</th><th>SKU</th><th>Price</th><th>Stock</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody id="product-table-body">
                    <!-- JavaScript injected data goes here -->
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="../assets/js/products.js"></script>
<script src="../assets/js/main.js"></script>

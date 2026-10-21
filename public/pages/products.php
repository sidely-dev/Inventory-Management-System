<?php
session_start();
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: ../index.php");
    exit;
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS Product Management Ledger</title>
    
    <!-- 💡 CRITICAL FIX: Explicitly link your modern core stylesheet folder paths! -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- Main UI Grid Structural Wrapper -->
    <div class="app-wrapper">
        
        <!-- 🧭 Left Navigation Menu Sidebar Panel -->
        <nav>
            <div class="nav-brand">📦 IMS Portal</div>
            <ul>
                <li class="active-tab"><a href="products.php">🗃️ Products Spreadsheet</a></li>
                <li><a href="dashboard.php">📊 Summary Analytics</a></li>
                <li><a href="categories.php">📁 Categories Catalog</a></li>
                <li><a href="../api/products/backup.php">💾 Database Backup</a></li>
            </ul>
        </nav>

        <!-- 🖥️ Right Application Content Canvas Area -->
        <div class="main-content">
            <div class="page-header">
                <div class="page-title">
                    <h1>Active Stock Inventory</h1>
                    <p>Monitor warehouse metrics and relational stock units.</p>
                </div>
                <a href="add-product.php" class="btn primary-btn">+ Add Product</a>
            </div>

            <!-- Dashboard Analytics Indicators Card Matrix Row -->
            <div class="stats-grid">
                <div class="stat-card"><h3>Total Unique SKUs</h3><p>6 Items</p></div>
                <div class="stat-card"><h3>Warehouse Value</h3><p>R 92,345.00</p></div>
                <div class="stat-card"><h3>Stock Status</h3><p style="color: #34d399;">Healthy</p></div>
            </div>

            <!-- Spreadsheet Storage Matrix Table Card -->
            <div class="table-card">
                <div class="table-toolbar">
                    <select id="category-filter">
                        <option value="">📁 Filter By Category</option>
                    </select>
                </div>
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
                        <!-- JavaScript automatically drops your data rows right here! -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Script anchors tracking data fetches -->
    <script src="../assets/js/products.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

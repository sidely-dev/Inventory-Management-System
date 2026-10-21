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
    <title>Add New Inventory Record</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="app-wrapper">
        <!-- Locked Sidebar Navigation Component -->
        <nav>
            <div class="nav-brand">📦 IMS System</div>
            <ul>
                <li class="active-tab"><a href="products.php">🗃️ Products Ledger</a></li>
                <li><a href="dashboard.php">📊 Summary Analytics</a></li>
                <li><a href="categories.php">📁 Categories Catalog</a></li>
                <li><a href="../../api/products/backup.php">💾 Database Backup</a></li>
            </ul>
        </nav>

        <!-- Right Hand Workspace Area -->
        <div class="main-content">
            <div class="page-header">
                <div class="page-title">
                    <h1>Add New Product Record</h1>
                    <p>Enter stock parameters to write securely to the MySQL instance.</p>
                </div>
            </div>

            <!-- Clean Floating White Container Card Layout matching reference images -->
            <div class="card-container" style="max-width: 650px; margin: 0 auto;">
                <form id="add-product-form">
                    <div class="form-group">
                        <label>Product Name/Title</label>
                        <input type="text" id="product-name" required placeholder="e.g., Wireless Mechanical Keyboard">
                    </div>

                    <div class="form-group">
                        <label>Inventory Classification Category</label>
                        <select id="category-id" required>
                            <option value="1">Electronics</option>
                            <option value="2">Clothing</option>
                            <option value="3">Home & Kitchen</option>
                            <option value="4">Books</option>
                            <option value="5">Toys</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Alphanumeric Tracking SKU Code</label>
                        <input type="text" id="product-sku" required placeholder="e.g., KEY-MECH-RGB">
                    </div>

                    <div class="form-group">
                        <label>Unit Valuation Pricing (ZAR)</label>
                        <input type="number" step="0.01" id="product-price" required placeholder="0.00">
                    </div>

                    <div class="form-group">
                        <label>Initial Units in Warehouse</label>
                        <input type="number" id="product-qty" required placeholder="0">
                    </div>

                    <div class="form-group">
                        <label>Item Operational Description (Optional)</label>
                        <textarea id="product-desc" rows="4" placeholder="Enter optional product catalog descriptors..."></textarea>
                    </div>

                    <div style="display: flex; justify-content: flex-end; margin-top: 24px;">
                        <a href="products.php" class="btn secondary-btn">Cancel</a>
                        <button type="submit" class="btn primary-btn">Save New Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Client-Side Form Interceptor Validation Handling -->
    <script src="../assets/js/validation.js"></script>
</body>
</html>

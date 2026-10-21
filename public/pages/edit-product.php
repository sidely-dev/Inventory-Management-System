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

        <div class="main-content">
            <div class="page-header">
                <div class="page-title">
                    <h1>Modify Product Specifications</h1>
                    <p>Altering parameters updates database rows instantly on execution save.</p>
                </div>
            </div>

            <div class="card-container" style="max-width: 650px; margin: 0 auto;">
                <form id="edit-product-form">
                    <!-- Invisible tracker variable key -->
                    <input type="hidden" id="edit-product-id" value="">

                    <div class="form-group">
                        <label>Product Name/Title</label>
                        <input type="text" id="edit-product-name" required>
                    </div>

                    <div class="form-group">
                        <label>Inventory Classification Category</label>
                        <select id="edit-category-id" required>
                            <option value="1">Electronics</option>
                            <option value="2">Clothing</option>
                            <option value="3">Home & Kitchen</option>
                            <option value="4">Books</option>
                            <option value="5">Toys</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Alphanumeric Tracking SKU Code</label>
                        <input type="text" id="edit-product-sku" required>
                    </div>

                    <div class="form-group">
                        <label>Unit Valuation Pricing (ZAR)</label>
                        <input type="number" step="0.01" id="edit-product-price" required>
                    </div>

                    <div class="form-group">
                        <label>Units currently in Warehouse</label>
                        <input type="number" id="edit-product-qty" required>
                    </div>

                    <div class="form-group">
                        <label>Item Operational Description</label>
                        <textarea id="edit-product-desc" rows="4"></textarea>
                    </div>

                    <div style="display: flex; justify-content: flex-end; margin-top: 24px;">
                        <a href="products.php" class="btn secondary-btn">Cancel</a>
                        <button type="submit" class="btn primary-btn">Update Specifications</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/validation.js"></script>
</body>
</html>

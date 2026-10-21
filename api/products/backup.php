<?php
/**
 * 💾 ONE-CLICK SYSTEM DATABASE BACKUP ENGINE (api/products/backup.php)
 */
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=inventory_system_backup_" . date('Y-m-d') . ".sql");

require_once "../../src/config/database.php";

try {
    $db = getDatabaseConnection();
    
    echo "-- ======================================================\n";
    echo "-- SYSTEM BACKUP LEDGER GENERATED AUTOMATICALLY VIA APP\n";
    echo "-- GENERATION TIMESTAMP: " . date('Y-m-d H:i:s') . "\n";
    echo "-- ======================================================\n\n";

    // 1. Fetch data from categories
    $categories = $db->query("SELECT * FROM Categories")->fetchAll();
    foreach ($categories as $cat) {
        echo "INSERT INTO Categories (CategoryID, CategoryName) VALUES ({$cat['CategoryID']}, " . $db->quote($cat['CategoryName']) . ") ON DUPLICATE KEY UPDATE CategoryName=VALUES(CategoryName);\n";
    }

    // 2. Fetch data from products
    $products = $db->query("SELECT * FROM Products")->fetchAll();
    echo "\n";
    foreach ($products as $p) {
        echo "INSERT INTO Products (ProductID, ProductName, CategoryID, Price, sku, Description, QuantityInStock) VALUES ({$p['ProductID']}, " . $db->quote($p['ProductName']) . ", {$p['CategoryID']}, {$p['Price']}, " . $db->quote($p['sku']) . ", " . $db->quote($p['Description']) . ", {$p['QuantityInStock']}) ON DUPLICATE KEY UPDATE QuantityInStock=VALUES(QuantityInStock), Price=VALUES(Price);\n";
    }
    
} catch (Exception $e) {
    echo "-- Critical Error generating automated backup trace: " . $e->getMessage();
}

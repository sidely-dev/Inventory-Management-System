<?php
/**
 * 📊 INVENTORY ANALYTICS REPORTS ENGINE (api/products/reports.php)
 */
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

require_once "../../src/config/database.php";

try {
    $db = getDatabaseConnection();

    // Run high-speed statistical aggregate calculations directly in the database engine
    $query = "SELECT 
                COUNT(ProductID) as total_products,
                IFNULL(SUM(QuantityInStock), 0) as total_items,
                IFNULL(SUM(Price * QuantityInStock), 0) as total_valuation,
                COUNT(CASE WHEN QuantityInStock = 0 THEN 1 END) as out_of_stock,
                COUNT(CASE WHEN QuantityInStock > 0 AND QuantityInStock <= 10 THEN 1 END) as low_stock
              FROM Products";

    $stmt = $db->query($query);
    $reportMetrics = $stmt->fetch();

    http_response_code(200);
    echo json_encode([
        "success" => true,
        "metrics" => [
            "Total Unique Products" => $reportMetrics['total_products'],
            "Total Operational Units" => $reportMetrics['total_items'],
            "Gross Ledger Value" => "R " . number_format($reportMetrics['total_valuation'], 2),
            "Out of Stock Alerts" => $reportMetrics['out_of_stock'],
            "Critical Low Stock Warning" => $reportMetrics['low_stock']
        ]
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}

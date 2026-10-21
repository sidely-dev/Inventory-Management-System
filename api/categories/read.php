<?php
/**
 * 🏷️ CATEGORIES READ API ENDPOINT (api/categories/read.php)
 */
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

require_once "../../src/config/database.php";

try {
    $db = getDatabaseConnection();
    
    // Select categories ordered alphabetically
    $query = "SELECT CategoryID, CategoryName FROM Categories ORDER BY CategoryName ASC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    $categories = $stmt->fetchAll();
    
    http_response_code(200);
    echo json_encode([
        "success" => true,
        "data" => $categories
    ]);
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Database error loading categories.",
        "error" => $exception->getMessage()
    ]);
}

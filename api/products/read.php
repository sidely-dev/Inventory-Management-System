<?php
/**
 * PRODUCT READ API ENDPOINT
 * 
 * WHAT THIS DOES:
 * This script is a backend API Handler.
 * 1. When the Frontend asks for a product, this script activates.
 * 2. It then pulls up the product from the database.
 * 3. Then it returns the product result in JSON format to the frontend.
 */

// 🛠️ FORCE ERROR REPORTING ON (Crucial for learning and debugging locally!)
// Remove these two lines once the assignment is 100% finished and ready for submission.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// This tells the browser to interpret the result as JSON data
header("Content-Type: application/json; charset=UTF-8");
// Allows Frontend to access this API from any domain
header("Access-Control-Allow-Origin: *");

// Import the database connection hook.
require_once "../../src/config/database.php";

try {
    // Creating a connection to the PDO database channel
    $db = getDatabaseConnection();

    // SQL SECURE QUERY
    // Fixed the missing comma right after p.CreatedAt
    $query = "SELECT
                p.ProductID, 
                p.ProductName, 
                p.Price, 
                p.sku, 
                p.Description, 
                p.CreatedAt, 
                p.QuantityInStock, 
                c.CategoryName
              FROM Products p
              INNER JOIN Categories c ON p.CategoryID = c.CategoryID
              ORDER BY p.CreatedAt DESC";

    $stmt = $db->prepare($query);
    $stmt->execute();

    // This collects all the matching records in an array
    $products = $stmt->fetchAll();

    // Successful Handling
    http_response_code(200);

    // Return the product data as JSON
    echo json_encode([
        "success" => true,
        "count" => count($products),
        "data" => $products
    ]);

} catch (PDOException $exception) {
    // If the connection fails, catch the error, respond with a server error message
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Server Error: Unable to fetch inventory data. Please try again later.",
        "error" => $exception->getMessage()
    ]);
    exit;
}

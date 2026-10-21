<?php
/**
 * 🗑️ DELETE PRODUCT API ENDPOINT (api/products/delete.php)
 * 
 * WHAT THIS DOES:
 * This script accepts data submitted securely from the frontend interface table,
 * runs server-side validation checks, and deletes it directly from your MySQL instance.
 */

// Force error reporting on for local debugging inside your XAMPP network environment
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Tell the browser to communicate strictly via clean structured JSON text streams
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST"); // Using POST/DELETE via JSON transaction
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization");

// Import the secure database connection hook
require_once "../../src/config/database.php";

// Only proceed if the browser used a secure POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    try {
        // 1. Grab raw input stream payload data sent via JavaScript fetch()
        $rawInputData = file_get_contents("php://input");
        $data = json_decode($rawInputData, true); // Transmute raw text string into a clean associative array

        // 2. Server-Side Validation: Ensure no required parameter values are missing
        if (empty($data['ProductID'])) {
            http_response_code(400); // Bad Request
            echo json_encode([
                "success" => false,
                "message" => "Validation Error: Missing ProductID to execute row removal."
            ]);
            exit;
        }

        // 3. Establish the live PDO Database channel connection
        $db = getDatabaseConnection();

        // 4. Draft a secure Prepared SQL Query string to delete the record safely
        $query = "DELETE FROM Products WHERE ProductID = :product_id";

        $stmt = $db->prepare($query);

        // 5. Sanitize and bind the incoming form metrics into the statement variables safely
        $stmt->bindParam(':product_id', $data['ProductID'], PDO::PARAM_INT);

        // 6. Execute the query transaction
        $stmt->execute();

        // Check if a row was actually removed from the database
        if ($stmt->rowCount() > 0) {
            http_response_code(200); // OK
            echo json_encode([
                "success" => true,
                "message" => "Success: Product was successfully deleted from inventory ledger!"
            ]);
        } else {
            http_response_code(444); // Not Found
            echo json_encode([
                "success" => false,
                "message" => "Operational Notice: No product found matching the requested ID parameters."
            ]);
        }

    } catch (PDOException $exception) {
        http_response_code(500);
        echo json_encode([
            "success" => false,
            "message" => "Server Error: Unable to remove item records persistently.",
            "error" => $exception->getMessage()
        ]);
    }
    
} else {
    // Decline wrong request patterns gracefully
    http_response_code(405); // Method Not Allowed
    echo json_encode(["success" => false, "message" => "Operation Denied: Method pattern not supported."]);
}

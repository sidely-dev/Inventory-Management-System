<?php
/**
 * 📥 CREATE PRODUCT API ENDPOINT (api/products/create.php)
 * 
 * WHAT THIS DOES:
 * This script accepts data submitted securely from the frontend interface form,
 * runs server-side validation checks, and saves it directly into your MySQL instance.
 */

// Force error reporting on for local debugging inside your XAMPP network environment
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Tell the browser to communicate strictly via clean structured JSON text streams
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST"); // Only accept transactional POST requests
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
        if (
            empty($data['ProductName']) || 
            empty($data['CategoryID']) || 
            !isset($data['Price']) || 
            empty($data['sku']) || 
            !isset($data['QuantityInStock'])
        ) {
            http_response_code(400); // Bad Request
            echo json_encode([
                "success" => false,
                "message" => "Validation Error: Please fill in all required operational fields."
            ]);
            exit;
        }

        // 3. Establish the live PDO Database channel connection
        $db = getDatabaseConnection();

        // 4. Draft a secure Prepared SQL Query string
        // Note: Using placeholders (:name, :sku) blocks catastrophic SQL Injection hacks entirely!
        $query = "INSERT INTO Products (CategoryID, ProductName, Price, sku, Description, QuantityInStock) 
                  VALUES (:category_id, :product_name, :price, :sku, :description, :quantity)";

        $stmt = $db->prepare($query);

        // 5. Sanitize and bind the incoming form metrics into the statement variables safely
        $stmt->bindParam(':category_id', $data['CategoryID'], PDO::PARAM_INT);
        $stmt->bindParam(':product_name', $data['ProductName'], PDO::PARAM_STR);
        $stmt->bindParam(':price', $data['Price']);
        $stmt->bindParam(':sku', $data['sku'], PDO::PARAM_STR);
        $stmt->bindParam(':description', $data['Description'], PDO::PARAM_STR);
        $stmt->bindParam(':quantity', $data['QuantityInStock'], PDO::PARAM_INT);

        // 6. Execute the query transaction
        if ($stmt->execute()) {
            http_response_code(201); // 201 Created
            echo json_encode([
                "success" => true,
                "message" => "Success: Product successfully registered and logged in inventory!"
            ]);
        } else {
            throw new Exception("Operational execution error occurred within the database cluster.");
        }

    } catch (PDOException $exception) {
        http_response_code(500);
        
        // Catch duplicate SKU index entries gracefully
        if ($exception->getCode() == 23000) {
            echo json_encode([
                "success" => false,
                "message" => "Data Integrity Conflict: A product with this exact SKU code already exists."
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Server Error: Unable to store new item records persistently.",
                "error" => $exception->getMessage()
            ]);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
    
} else {
    // Decline wrong request patterns gracefully
    http_response_code(405); // Method Not Allowed
    echo json_encode(["success" => false, "message" => "Operation Denied: Method pattern not supported."]);
}

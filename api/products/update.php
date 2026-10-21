<?php
/**
 * 📝 UPDATE PRODUCT API ENDPOINT (api/products/update.php)
 * 
 * WHAT THIS DOES:
 * This script accepts modified data submitted securely from the frontend edit form,
 * runs server-side validation checks, and updates that specific record in MySQL.
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization");

require_once "../../src/config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // 1. Grab raw input stream data sent via JavaScript fetch()
        $rawInputData = file_get_contents("php://input");
        $data = json_decode($rawInputData, true);

        // 2. Server-Side Validation: Ensure no required tracking values are missing
        if (
            empty($data['ProductID']) ||
            empty($data['ProductName']) || 
            empty($data['CategoryID']) || 
            !isset($data['Price']) || 
            empty($data['sku']) || 
            !isset($data['QuantityInStock'])
        ) {
            http_response_code(400); // Bad Request
            echo json_encode([
                "success" => false,
                "message" => "Validation Error: Please fill in all required operational fields to complete update."
            ]);
            exit;
        }

        // 3. Establish the live PDO Database channel connection
        $db = getDatabaseConnection();

        // 4. Draft a secure Prepared SQL UPDATE Statement
        $query = "UPDATE Products 
                  SET CategoryID = :category_id, 
                      ProductName = :product_name, 
                      Price = :price, 
                      sku = :sku, 
                      Description = :description, 
                      QuantityInStock = :quantity 
                  WHERE ProductID = :product_id";

        $stmt = $db->prepare($query);

        // 5. Sanitize and bind variables safely to block injections
        $stmt->bindParam(':product_id', $data['ProductID'], PDO::PARAM_INT);
        $stmt->bindParam(':category_id', $data['CategoryID'], PDO::PARAM_INT);
        $stmt->bindParam(':product_name', $data['ProductName'], PDO::PARAM_STR);
        $stmt->bindParam(':price', $data['Price']);
        $stmt->bindParam(':sku', $data['sku'], PDO::PARAM_STR);
        $stmt->bindParam(':description', $data['Description'], PDO::PARAM_STR);
        $stmt->bindParam(':quantity', $data['QuantityInStock'], PDO::PARAM_INT);

        // 6. Execute the transaction
        if ($stmt->execute()) {
            http_response_code(200); // OK
            echo json_encode([
                "success" => true,
                "message" => "Success: Product specifications updated inside inventory database!"
            ]);
        } else {
            throw new Exception("Operational execution error occurred within the database cluster.");
        }

    } catch (PDOException $exception) {
        http_response_code(500);
        if ($exception->getCode() == 23000) {
            echo json_encode([
                "success" => false,
                "message" => "Data Integrity Conflict: This SKU code is already allocated to another item."
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Server Error: Unable to modify historical record entries.",
                "error" => $exception->getMessage()
            ]);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Operation Denied: Method pattern not supported."]);
}

<?php
/**
 * 📦 PRODUCT DATA ACCELERATOR MODEL (src/models/Product.php)
 */
class Product {
    private $db;

    // Inject our working PDO database connection channel on startup
    public function __construct($databaseConnection) {
        $this->db = $databaseConnection;
    }

    /**
     * Pulls every inventory record from MySQL
     */
    public function readAllProducts() {
        $query = "SELECT p.ProductID, p.ProductName, p.Price, p.sku, p.Description, p.CreatedAt, p.QuantityInStock, c.CategoryName
                  FROM Products p
                  INNER JOIN Categories c ON p.CategoryID = c.CategoryID
                  ORDER BY p.CreatedAt DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

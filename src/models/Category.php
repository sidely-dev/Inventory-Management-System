<?php
/**
 * 🏷️ CATEGORY DATA MODEL Blueprint (src/models/Category.php)
 */
class Category {
    private $db;

    public function __construct($databaseConnection) {
        $this->db = $databaseConnection;
    }

    public function getAllCategories() {
        $stmt = $this->db->prepare("SELECT CategoryID, CategoryName FROM Categories ORDER BY CategoryName ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

<?php
/**
 * 💼 CENTRALIZED INVENTORY UTILITY SERVICE (src/services/InventoryService.php)
 */
class InventoryService {
    private $db;

    public function __construct($databaseConnection) {
        $this->db = $databaseConnection;
    }

    public function calculateTotalValuation() {
        $stmt = $this->db->query("SELECT SUM(Price * QuantityInStock) as valuation FROM Products");
        $result = $stmt->fetch();
        return "R " . number_format($result['valuation'] ?? 0, 2);
    }
}

<?php
/**
 * 🛡️ SERVER-SIDE VALIDATION MODULE (src/validation/ProductValidator.php)
 */
class ProductValidator {
    public static function validate($data) {
        if (empty($data['ProductName']) || empty($data['CategoryID']) || !isset($data['Price']) || empty($data['sku']) || !isset($data['QuantityInStock'])) {
            return "Please fill in all required operational fields.";
        }
        if ($data['Price'] <= 0) return "Price must be a valid positive currency decimal.";
        if ($data['QuantityInStock'] < 0) return "Stock quantity cannot be a negative number.";
        return true; // Validation Passed
    }
}

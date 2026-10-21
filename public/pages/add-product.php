<!-- Inside public/pages/add-product.php -->
<form id="add-product-form">
    <input type="text" id="product-name" required>
    
    <select id="category-id" required>
        <option value="1">Electronics</option>
        <option value="2">Clothing</option>
    </select>
    
    <input type="text" id="product-sku" required>
    <input type="number" step="0.01" id="product-price" required>
    <input type="number" id="product-qty" required>
    <textarea id="product-desc"></textarea>

    <button type="submit">Save Product</button>
</form>

<!-- Inject script controls onto the form window view footer -->
<script src="../assets/js/validation.js"></script>

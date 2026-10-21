<!-- Inside public/pages/edit-product.php -->
<form id="edit-product-form">
    <!-- 💡 This hidden input saves the ProductID invisibly so our script knows which row to edit! -->
    <input type="hidden" id="edit-product-id" value="1"> 

    <input type="text" id="edit-product-name" required>
    <select id="edit-category-id" required>
        <option value="1">Electronics</option>
        <option value="2">Clothing</option>
    </select>
    <input type="text" id="edit-product-sku" required>
    <input type="number" step="0.01" id="edit-product-price" required>
    <input type="number" id="edit-product-qty" required>
    <textarea id="edit-product-desc"></textarea>

    <button type="submit">Update Product</button>
</form>

<script src="../assets/js/validation.js"></script>
